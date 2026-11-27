<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The four figures on the client dashboard.
 *
 * Each is one ratio and one count - the shape a stat tile takes - and each
 * returns its own shape zeroed out, with `empty` set, when the client has no
 * rows behind it. Returning null and dropping the tile was tried first and is
 * wrong: most of these tables have rows for only 15-25% of the 181 clients
 * who signed in over the last year, so on a real account one tile was left
 * stretched across a collapsed grid, which reads as broken rather than tidy.
 * Six tiles that happen to say nought are a dashboard; one lonely card is a
 * bug. Each tile writes its own line for having nothing yet.
 *
 * Nothing here is plotted against time, and no tile claims a trend. Two or
 * three rows do not make one, and there is no stored history to compare a
 * month against.
 */
class DashboardCharts
{
    /** the audit checklist answers, as the forms spell them */
    const ANSWER_YES = 'Yes';
    const ANSWER_NO  = 'No';
    const ANSWER_NA  = 'NA';

    /**
     * Everything the four tiles need, for one client.
     *
     * @param  int  $userId
     * @return array  four keys, each an array of figures or null
     */
    public static function for($userId)
    {
        return [
            'certificates'    => self::certificates($userId),
            'requirements'    => self::requirements($userId),
            'objectives'      => self::objectives($userId),
            'training'        => self::training($userId),
            'audits'          => self::audits($userId),
            'reviews'         => self::reviews($userId),
            'activity'        => self::activity($userId),
        ];
    }

    /**
     * How long before an expiry date counts as "due soon".
     *
     * Ninety days is the surveillance-audit window a certification body
     * normally wants booking in, so it is the point at which a client can
     * still do something about it rather than the point at which it is too
     * late. It is here as a name because the card colours three rows by it.
     */
    const RENEW_SOON_DAYS = 90;

    /** the three standards, and the column each one's expiry lives in */
    const CERTIFICATES = [
        'iso9001_expirydate'  => 'ISO 9001',
        'iso14001_expirydate' => 'ISO 14001',
        'iso45001_expirydate' => 'ISO 45001',
    ];

    /**
     * How long the certificates have left, and the nearest one to run out.
     *
     * This is the figure nearly everybody has: 176 of the 181 clients who
     * signed in over the last year carry at least one expiry date, against
     * 15-25% for any of the record tables. It is also the one with a deadline
     * attached - 20 of them are already past their ISO 9001 date and another
     * 10 go within ninety days - so it leads.
     *
     * The headline is the nearest date, expired or not. A client with one
     * certificate gone and two in hand should see the gone one.
     */
    private static function certificates($userId)
    {
        $row = DB::table('users')->where('id', $userId)
                 ->first(array_keys(self::CERTIFICATES));
        if (!$row) return self::noCertificates();

        $now   = time();
        $dates = [];
        $rows  = [];

        foreach (self::CERTIFICATES as $col => $label) {
            $raw = $row->$col ?? null;
            // '0000-00-00' is what this database holds for "never set"
            if (empty($raw) || $raw === '0000-00-00' || !strtotime($raw)) {
                // A standard with no date still gets a row. Three quarters of
                // the clients here hold one certificate rather than three, and
                // a card that simply left the other two out would read as "you
                // have one" when what it means is "two are not recorded".
                $rows[] = ['label' => $label, 'onFile' => false, 'status' => 'none',
                           'date' => null, 'at' => null, 'days' => null,
                           'expired' => false, 'share' => 0];
                continue;
            }
            $at = strtotime($raw);
            // A certificate dated the 15th is valid THROUGH the 15th, so the
            // instant it runs out is the end of that day and not its midnight.
            // Every figure below is measured from that one instant - the day
            // count, the expired flag, and how many are still in date - so the
            // three can never disagree with one another, and the clock the
            // tile runs beside the day count cannot drift away from it either.
            $ends    = $at + 86400;
            $expired = $now >= $ends;
            $days    = (int) floor(abs($now - $ends) / 86400);

            $dates[] = ['label' => $label, 'at' => $at, 'ends' => $ends];
            $rows[]  = [
                'label'   => $label,
                'onFile'  => true,
                // three states, and each one is written out as a word on the
                // card as well as coloured - the colour here MEANS something,
                // which is the one case where a red is not decoration
                'status'  => $expired ? 'expired' : ($days <= self::RENEW_SOON_DAYS ? 'soon' : 'current'),
                'date'    => date('j M Y', $at),
                'at'      => $at,
                'days'    => $days,
                'expired' => $expired,
                'share'   => 0,      // filled in below, once the longest is known
            ];
        }
        if (!$dates) return self::noCertificates();

        /* How long each one has left, against whichever has the most.
           Scaled against the data rather than against an assumed three-year
           cycle: this database holds no issue date, so "how far through its
           life" cannot be worked out and a bar drawn as if it could would be
           inventing the part nobody recorded. Longest-on-file is a comparison
           between the client's own certificates, which is true by
           construction. One certificate therefore fills its bar, and the day
           count beside it is what carries the meaning. */
        $longest = 0;
        foreach ($rows as $r) if (!$r['expired'] && $r['onFile']) $longest = max($longest, $r['days']);
        if ($longest > 0) {
            foreach ($rows as &$r) {
                if ($r['onFile'] && !$r['expired']) $r['share'] = $r['days'] / $longest;
            }
            unset($r);
        }

        usort($dates, function ($a, $b) { return $a['at'] <=> $b['at']; });
        $next = $dates[0];

        $current = 0;
        foreach ($dates as $d) if ($d['ends'] > $now) $current++;

        return [
            'onFile'  => count($dates),
            'current' => $current,
            'share'   => $current / count($dates),
            'label'   => $next['label'],
            'date'    => date('j M Y', $next['at']),
            // the instant the nearest one runs out, as a unix timestamp, so
            // the tile can count towards it second by second rather than
            // print a day count that goes stale on a page left open
            'ends'    => $next['ends'],
            'days'    => (int) floor(abs($now - $next['ends']) / 86400),
            'expired' => $now >= $next['ends'],
            // one row per standard, in the order the forms list them, for the
            // card that shows all three rather than only the nearest
            'rows'    => $rows,
        ];
    }

    /**
     * Requirements that have run past their review date.
     *
     * Worked out the way the Requirements Due card below already works it
     * out, line for line: a record is dated when completion_date is set and
     * parses, its next date is that plus `periods` months, and it is overdue
     * once that has gone by. Reusing the card's own arithmetic rather than
     * writing a tidier version is the point - a tile that disagreed with the
     * table directly under it would be worse than no tile.
     *
     * Three quarters of the live dated rows are overdue, so this is not a
     * figure that will sit quietly at nil.
     */
    private static function requirements($userId)
    {
        $rows = DB::table('tbl_requiremnt')->where('user_id', $userId)
                  ->get(['completion_date', 'periods']);
        if ($rows->isEmpty()) {
            /* the seven columns are still named, at nought. The card
               draws them either way, and a client with nothing recorded
               should see the six months it is going to be asked about. */
            $blank = [['key' => 'over', 'label' => 'Past', 'long' => 'Already overdue',
                       'count' => 0, 'over' => true]];
            for ($i = 0; $i < 6; $i++) {
                $at = strtotime("+$i months", strtotime('today'));
                $blank[] = ['key' => date('Y-m', $at), 'label' => date('M', $at),
                            'long' => date('F Y', $at), 'count' => 0, 'over' => false];
            }
            return ['total' => 0, 'dated' => 0, 'overdue' => 0, 'onTrack' => 0,
                    'cols' => $blank, 'peak' => 0,
                    'share' => 0, 'empty' => true];
        }

        $today = strtotime('today');
        $dated = $overdue = 0;

        /* The six months ahead, as buckets, plus everything already past.
           This is the figure the card never had and the one a client can act
           on: "sixteen overdue" says there is a problem, "and four more fall
           due in March" says when to do something about it. Worked out from
           the same completion_date plus periods the card below uses, so the
           two cannot disagree. */
        $ahead = ['over' => 0];
        for ($i = 0; $i < 6; $i++) {
            $ahead[date('Y-m', strtotime("+$i months", $today))] = 0;
        }
        $last = array_key_last($ahead);

        foreach ($rows as $r) {
            if (empty($r->completion_date)) continue;
            $from = strtotime($r->completion_date);
            if (!$from) continue;
            $due = strtotime('+' . (int) $r->periods . ' months', $from);
            if (!$due) continue;

            $dated++;
            if ($due < $today) { $overdue++; $ahead['over']++; continue; }

            $key = date('Y-m', $due);
            // anything past the sixth month is beyond what this strip shows,
            // and is counted nowhere rather than crowded into the last column
            if (isset($ahead[$key])) $ahead[$key]++;
        }

        $cols = [];
        foreach ($ahead as $key => $n) {
            $cols[] = [
                'key'   => $key,
                'label' => $key === 'over' ? 'Past' : date('M', strtotime($key . '-01')),
                'long'  => $key === 'over' ? 'Already overdue' : date('F Y', strtotime($key . '-01')),
                'count' => $n,
                'over'  => $key === 'over',
            ];
        }

        if ($dated === 0) {
            return ['total' => $rows->count(), 'dated' => 0, 'overdue' => 0,
                    'onTrack' => 0, 'cols' => $cols, 'peak' => 0, 'share' => 0];
        }

        return [
            'total'   => $rows->count(),
            'dated'   => $dated,
            'overdue' => $overdue,
            'onTrack' => $dated - $overdue,
            'cols'    => $cols,
            'peak'    => max(array_column($cols, 'count')),
            'share'   => ($dated - $overdue) / $dated,
        ];
    }

    /**
     * Objectives, by the status the tracker holds for each.
     *
     * A progress track and a count, not a ring: there are fifteen objectives
     * in the whole system and they belong to one client, so most clients will
     * see nothing here and the one who does has three or four. A ring split
     * into two slices of a three-row table says nothing a number does not say
     * better.
     *
     * "On track or achieved" is the share, because those are the two states
     * that need no action. not_started, at_risk and not_achieved all do.
     */
    private static function objectives($userId)
    {
        $counts = [];
        foreach (array_keys(\App\Objective::statuses()) as $key) $counts[$key] = 0;

        $rows = DB::table('tbl_objectives')->where('user_id', $userId)->pluck('status');
        if ($rows->isEmpty()) {
            /* the five states are still named, at nought, so the donut
               keeps its legend and a client can see which five the
               tracker has before setting a single objective */
            return ['total' => 0, 'healthy' => 0, 'atRisk' => 0,
                    'counts' => $counts, 'share' => 0, 'empty' => true,
                    'parts' => self::parts([
                        ['achieved',     'Achieved',     0],
                        ['on_track',     'On track',     0],
                        ['not_started',  'Not started',  0],
                        ['at_risk',      'At risk',      0],
                        ['not_achieved', 'Not achieved', 0],
                    ], 0)];
        }

        foreach ($rows as $s) {
            $s = trim((string) $s);
            if (!array_key_exists($s, $counts)) $s = 'not_started';
            $counts[$s]++;
        }

        $healthy = $counts['on_track'] + $counts['achieved'];

        return [
            'total'   => $rows->count(),
            'healthy' => $healthy,
            'atRisk'  => $counts['at_risk'],
            'counts'  => $counts,
            'share'   => $healthy / $rows->count(),
            /* The five states as segments, best to worst, for a donut that
               shows what "on track or achieved" was folding away. The order
               is the reading order, not the alphabet: a client looks for the
               bad end, and it is always in the same place. */
            'parts'   => self::parts([
                ['achieved',     'Achieved',     $counts['achieved']],
                ['on_track',     'On track',     $counts['on_track']],
                ['not_started',  'Not started',  $counts['not_started']],
                ['at_risk',      'At risk',      $counts['at_risk']],
                ['not_achieved', 'Not achieved', $counts['not_achieved']],
            ], $rows->count()),
        ];
    }

    /** remembers each audit table's question columns for the rest of the request */
    private static $questionCols = [];

    /**
     * The checklist-answer columns on an audit table.
     *
     * Read from the schema, not listed here: they run correction3..correction30
     * with two spellings of the same word (correciton17), and a hand-written
     * list would be wrong the first time one was added.
     */
    private static function questionColumns($table)
    {
        if (!isset(self::$questionCols[$table])) {
            self::$questionCols[$table] = array_values(array_filter(
                Schema::getColumnListing($table),
                function ($c) { return (bool) preg_match('~^(qmsCorects|correction|correciton)~i', $c); }
            ));
        }
        return self::$questionCols[$table];
    }

    /**
     * Employees who have any training recorded against them.
     *
     * Two tables: the people (tbl_employees) and the courses they have been
     * put through (tbl_employees_traning, one row per course per person).
     *
     * The ratio is PEOPLE, not courses, and that is the whole design of this
     * tile. A course count answers the wrong question and flatters badly: one
     * client live holds 461 course records against 35 employees, and another
     * holds 27 shared between 3 of its 53 people. Both look busy counted by
     * course. "How many of our staff have any training on file" is what
     * clause 7.2 actually asks, and it is the number that can be acted on.
     *
     * The join is on the employee AND the client, so a training row pointing
     * at nobody - there are 40 such rows live, left behind when an employee
     * was deleted - is never counted towards anyone.
     *
     * traningdate is deliberately not used. It is a varchar and the live data
     * holds years like 2932 and 2179 from mistyped entry, so "trained within
     * the last N months" could not be worked out honestly. Whether a course
     * was recorded at all can be.
     */
    private static function training($userId)
    {
        // one query for all three figures. A left join, so an employee with
        // nothing on file still counts towards the staff total - which is the
        // denominator, and the point.
        $r = DB::table('tbl_employees AS e')
               ->leftJoin('tbl_employees_traning AS t', function ($j) {
                   $j->on('t.empid', '=', 'e.id')->on('t.user_id', '=', 'e.user_id');
               })
               ->where('e.user_id', $userId)
               ->selectRaw('COUNT(DISTINCT e.id) AS staff,'
                         . ' COUNT(DISTINCT t.empid) AS trained,'
                         . ' COUNT(t.traning_id) AS courses,'
                         // how many have had exactly one, and how many more
                         // than one. Trained-or-not was hiding the person on
                         // nine courses behind the person on one.
                         . ' SUM(CASE WHEN c.n = 1 THEN 1 ELSE 0 END) AS one,'
                         . ' SUM(CASE WHEN c.n > 1 THEN 1 ELSE 0 END) AS several')
               ->leftJoinSub(
                   DB::table('tbl_employees_traning')->where('user_id', $userId)
                     ->selectRaw('empid, COUNT(*) AS n')->groupBy('empid'),
                   'c', 'c.empid', '=', 'e.id')
               ->first();

        $staff = (int) ($r->staff ?? 0);
        if ($staff === 0) {
            return ['staff' => 0, 'trained' => 0, 'untrained' => 0, 'courses' => 0,
                    'one' => 0, 'several' => 0,
                    'parts' => self::parts([
                        ['several', 'Two or more courses', 0],
                        ['one',     'One course',          0],
                        ['none',    'Nothing on file',     0],
                    ], 0),
                    'share' => 0, 'empty' => true];
        }

        // the join cannot hand back more trained than there are staff, but the
        // share is held to one anyway: a ring drawing past its own
        // circumference would be a figure nobody could read
        $trained = min((int) ($r->trained ?? 0), $staff);

        $several = min((int) ($r->several ?? 0), $trained);
        $one     = max(0, $trained - $several);

        return [
            'staff'     => $staff,
            'trained'   => $trained,
            'untrained' => $staff - $trained,
            'courses'   => (int) ($r->courses ?? 0),
            'one'       => $one,
            'several'   => $several,
            'share'     => $trained / $staff,
            /* Three buckets rather than two. "Trained" was putting the person
               on nine courses and the person on one into the same box, and on
               this data that is most of the difference between the clients
               who are covered and the clients who are not. */
            'parts'     => self::parts([
                ['several', 'Two or more courses', $several],
                ['one',     'One course',          $one],
                ['none',    'Nothing on file',     $staff - $trained],
            ], $staff),
        ];
    }

    /**
     * How the audit checklist questions were answered, across every audit.
     *
     * Not the audit rows - the answers inside them. Each audit carries a
     * checklist (8 questions on a process audit, 28 on a QMS audit), so one
     * filled-in audit is 8 or 28 data points. That is why this tile has
     * something to show for a client who has done a single audit.
     *
     * Anything that is not Yes/No/NA - a stray "on" from a checkbox, an empty
     * string, a null - is counted as unanswered, never as a conforming
     * answer.
     */
    private static function audits($userId)
    {
        // counted apart, not just totalled: the segmented bar shows all three
        $yes = $no = $na = $answered = $audits = 0;

        foreach (['tbl_audit', 'tbl_qmsaudit'] as $table) {
            $cols = self::questionColumns($table);
            if (!$cols) continue;

            $rows = DB::table($table)->where('user_id', $userId)->get($cols);
            if ($rows->isEmpty()) continue;
            $audits += $rows->count();

            foreach ($rows as $row) {
                foreach ($cols as $c) {
                    $v = trim((string) ($row->$c ?? ''));
                    if ($v === '') continue;
                    if     (strcasecmp($v, self::ANSWER_YES) === 0) { $yes++; $answered++; }
                    elseif (strcasecmp($v, self::ANSWER_NO)  === 0) { $no++;  $answered++; }
                    elseif (strcasecmp($v, self::ANSWER_NA)  === 0) { $na++;  $answered++; }
                    // anything else - a stray "on" from a checkbox - is not an
                    // answer and is counted as neither
                }
            }
        }

        if ($answered === 0) {
            return ['yes' => 0, 'no' => 0, 'na' => 0, 'answered' => 0, 'audits' => $audits,
                    'share' => 0, 'empty' => true,
                    'parts' => [
                        ['key' => 'yes', 'label' => 'Conforms',         'count' => 0, 'share' => 0],
                        ['key' => 'na',  'label' => 'Not applicable',   'count' => 0, 'share' => 0],
                        ['key' => 'no',  'label' => 'Does not conform', 'count' => 0, 'share' => 0],
                    ]];
        }

        // the three parts, in the order they are drawn: what conformed, what
        // did not apply, and what did not conform
        $parts = [
            ['key' => 'yes', 'label' => 'Conforms',         'count' => $yes],
            ['key' => 'na',  'label' => 'Not applicable',   'count' => $na],
            ['key' => 'no',  'label' => 'Does not conform', 'count' => $no],
        ];
        foreach ($parts as &$p) $p['share'] = $p['count'] / $answered;
        unset($p);

        return [
            'yes'      => $yes,
            'no'       => $no,
            'na'       => $na,
            'parts'    => $parts,
            'answered' => $answered,
            'audits'   => $audits,
            'share'    => $yes / $answered,
        ];
    }

    /**
     * The average overall customer review score.
     *
     * Overall rather than an average of the four columns: the form asks for it
     * as its own judgement, so it is the client's own summary rather than one
     * this works out for them.
     *
     * These are the cleanest numbers on the dashboard - not one of the 494
     * live rows holds a score outside 0 to 10.
     */
    /** the four things a customer review scores, and what each column is called */
    const REVIEW_SCORES = [
        'qualityScore' => 'Quality',
        'priceScore'   => 'Price',
        'DScore'       => 'Delivery',
        'OveralScore'  => 'Overall',
    ];

    private static function reviews($userId)
    {
        // one query for the count and all four averages. The column names are
        // this class's own constants, never input, and are checked against
        // that list again before they reach the statement.
        $select = ['COUNT(*) AS n'];
        foreach (array_keys(self::REVIEW_SCORES) as $col) {
            if (!preg_match('~^[A-Za-z]+$~', $col)) continue;      // belt and braces
            $select[] = "AVG(CASE WHEN `$col` BETWEEN 0 AND 10 THEN `$col` END) AS `avg_$col`";
        }

        $r = DB::table('tbl_customer_reviews')->where('user_id', $userId)
               ->selectRaw(implode(', ', $select))->first();

        $n = (int) ($r->n ?? 0);
        if ($n === 0) return self::noReviews();

        $rows = [];
        $overall = null;
        foreach (self::REVIEW_SCORES as $col => $label) {
            $key = 'avg_' . $col;
            if (($r->$key ?? null) === null) continue;
            $avg = round($r->$key, 1);
            $rows[] = ['label' => $label, 'avg' => $avg, 'share' => $avg / 10];
            if ($col === 'OveralScore') $overall = $avg;
        }
        if (!$rows) return self::noReviews();

        // Overall is the client's own summary judgement, so it is the
        // headline. Where it was never filled in, the mean of what was.
        if ($overall === null) {
            $overall = round(array_sum(array_column($rows, 'avg')) / count($rows), 1);
        }

        return [
            'count' => $n,
            'score' => $overall,
            'scale' => 10,
            'share' => $overall / 10,
            'rows'  => $rows,
        ];
    }
    /**
     * The tables whose rows count as QMS activity, and which of them is the
     * one worth drawing a line through.
     *
     * These names are this class's own constants and never input; they are
     * checked against this list again before they reach the statement.
     */
    const ACTIVITY = [
        'tbl_objectives', 'tbl_requiremnt', 'tbl_noconformance', 'tbl_audit',
        'tbl_qmsaudit', 'tbl_customer_reviews', 'tbl_employees', 'tbl_employees_traning',
    ];

    /** how many months the chart shows */
    const ACTIVITY_MONTHS = 12;

    /**
     * Twelve months of records added, and nonconformities raised alongside.
     *
     * The one figure on this dashboard that is a series rather than a
     * snapshot, and it is a series for a specific reason: created_at is
     * filled in on all eight of these tables, every row, back to 2020. So
     * "how much went into the system each month" is measured.
     *
     * Nothing else here could be drawn over time. The status columns hold
     * what a record says now and keep no history, so "objectives on track,
     * up twelve per cent since last month" is not a figure that exists in
     * this database - and a trend nobody measured is the one thing a
     * dashboard must not invent. Volume was measured. Volume is what this
     * draws.
     *
     * One query, not eight: a UNION ALL across the tables, grouped by month
     * once at the top. Eight separate counts would have more than doubled
     * what the whole dashboard costs.
     */
    private static function activity($userId)
    {
        $from  = date('Y-m-01', strtotime('-' . (self::ACTIVITY_MONTHS - 1) . ' months'));

        $parts = [];
        foreach (self::ACTIVITY as $t) {
            if (!in_array($t, self::ACTIVITY, true)) continue;          // belt and braces
            if (!preg_match('~^[a-z_]+$~', $t)) continue;
            $isNcr = $t === 'tbl_noconformance' ? 'COUNT(*)' : '0';
            $parts[] = "SELECT DATE_FORMAT(created_at, '%Y-%m') AS m, COUNT(*) AS n, $isNcr AS ncr"
                     . " FROM `$t` WHERE user_id = ? AND created_at >= ?"
                     . " GROUP BY DATE_FORMAT(created_at, '%Y-%m')";
        }

        $binds = [];
        foreach (self::ACTIVITY as $t) { $binds[] = $userId; $binds[] = $from; }

        $rows = DB::select(
            'SELECT m, SUM(n) AS total, SUM(ncr) AS ncr FROM (' . implode(' UNION ALL ', $parts)
          . ') AS a GROUP BY m', $binds);

        $byMonth = [];
        foreach ($rows as $r) $byMonth[$r->m] = ['total' => (int) $r->total, 'ncr' => (int) $r->ncr];

        /* Every month gets a column, including the ones with nothing in them.
           A chart that drew only the months with records would put March next
           to September and call the gap between them one step - which is a
           shape the data never had. */
        $months = [];
        $max = $sum = 0;
        for ($i = self::ACTIVITY_MONTHS - 1; $i >= 0; $i--) {
            $at  = strtotime("-$i months", strtotime(date('Y-m-01')));
            $key = date('Y-m', $at);
            $hit = $byMonth[$key] ?? ['total' => 0, 'ncr' => 0];
            $months[] = [
                'key'   => $key,
                'label' => date('M', $at),
                'long'  => date('F Y', $at),
                'total' => $hit['total'],
                'ncr'   => $hit['ncr'],
            ];
            $max  = max($max, $hit['total']);
            $sum += $hit['total'];
        }

        $thisMonth = end($months)['total'];
        $prev      = $months[count($months) - 2]['total'] ?? 0;

        return [
            'months'    => $months,
            'max'       => $max,
            'total'     => $sum,
            'thisMonth' => $thisMonth,
            'lastMonth' => $prev,
            /* A change against a month that held nothing is not a percentage -
               nought to five is not "up five hundred per cent", it is "five
               where there were none". null here, and the view says it in
               words. */
            'change'    => $prev > 0 ? ($thisMonth - $prev) / $prev : null,
            'empty'     => $sum === 0,
        ];
    }

    /**
     * Named counts turned into drawable segments.
     *
     * Each gets its share of the whole and, with it, the two things a donut
     * needs that a count alone does not: where its arc starts, and how long
     * it is. Worked out here once rather than in the view, because an arc
     * that began a fraction of a per cent off would leave a hairline of
     * white between two segments and look like a rendering fault.
     *
     * A segment with nothing in it is kept, not dropped: the legend names
     * every state the tracker has, and a client should be able to see that
     * "not achieved" exists and stands at nought.
     *
     * @param  array  $rows   [key, label, count] apiece
     * @param  int    $total  what they are a share of
     */
    private static function parts(array $rows, $total)
    {
        $total = max(1, (int) $total);
        $at    = 0.0;
        $out   = [];

        foreach ($rows as [$key, $label, $count]) {
            $count = (int) $count;
            $share = $count / $total;
            $out[] = [
                'key'    => $key,
                'label'  => $label,
                'count'  => $count,
                'share'  => $share,
                'offset' => $at,          // where this arc begins, 0..1
            ];
            $at += $share;
        }
        return $out;
    }

    /**
     * The shape this returns when a client has no certificate date at all.
     *
     * The three standards are still named, with nothing against them, so the
     * card keeps its shape and a client can see which three this portal is
     * asking about before any of them has been filled in.
     */
    private static function noCertificates()
    {
        $rows = [];
        foreach (self::CERTIFICATES as $label) {
            $rows[] = ['label' => $label, 'onFile' => false, 'status' => 'none',
                       'date' => null, 'at' => null, 'days' => null,
                       'expired' => false, 'share' => 0];
        }
        return ['onFile' => 0, 'current' => 0, 'share' => 0, 'label' => null,
                'date' => null, 'days' => null, 'ends' => null, 'expired' => false,
                'rows' => $rows, 'empty' => true];
    }

    /**
     * The shape this returns when there are no reviews.
     *
     * The four rows are still named, with nothing scored, so the meter list
     * keeps its shape and a client can see which four things a review asks
     * about before they have written one.
     */
    private static function noReviews()
    {
        $rows = [];
        foreach (self::REVIEW_SCORES as $label) {
            $rows[] = ['label' => $label, 'avg' => 0, 'share' => 0];
        }
        return ['count' => 0, 'score' => null, 'scale' => 10, 'share' => 0,
                'rows' => $rows, 'empty' => true];
    }
}
