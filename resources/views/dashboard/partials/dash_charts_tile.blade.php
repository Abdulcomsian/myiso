{{-- One tile.

     Rendered from two grids - the four ratio tiles, and the two that break
     their figures out - so this markup lives in one place rather than being
     written twice.

     Takes $t, which is [key, title, shape], and $charts. There is no hue
     per tile: they all wear the theme colour. --}}
    @php
        [$key, $title, $shape] = $t;
        $d   = $charts[$key];
        /* Not every figure on this dashboard is a ratio. The QMS Activity
           card is a series - twelve counts over twelve months - and has no
           share to take a percentage of, so there is a nought behind it
           rather than a missing key. */
        $pct = (int) round(($d['share'] ?? 0) * 100);

        /* value, the line under it, and what the ring prints, per tile.
           $clock stays null on every tile but Certificate Expiry, and is
           what the markup below keys the countdown off. */
        $value = $sub = $ringText = $clock = null;
        /* what the rail's left-hand caption says, on the two tiles that
           have one. Named per tile because "100%" on its own says
           nothing - a hundred per cent of what is the whole question. */
        $barCap = ['requirements' => 'on track', 'certificates' => 'in date'][$key] ?? 'done';
        /* Set here and not in a branch. It was being built inside the
           Requirements branch, which an account with nothing recorded
           never reaches - and the area markup below reads it either way,
           so that account got a 500 instead of a dashboard. */
        $areaLabel = isset($d['cols'])
                   ? implode(', ', array_map(function ($c) {
                         return $c['long'] . ' ' . $c['count'];
                     }, array_slice($d['cols'], 1)))
                   : '';
        /* Nothing recorded yet.
           Written out per tile rather than left to the figures, because the
           figures read badly at nought: "0 of 0 closed", or a countdown to a
           date nobody has set. A dash where the number would be, and a line
           saying what is missing, is both honest and the one thing a client
           in this position can act on. */
        if (!empty($d['empty'])) {
            $value    = '–';
            $ringText = '–';
            $sub = [
                'certificates'    => 'no certificate expiry date on file yet',
                // the big card names the three standards in its own list,
                // so its empty line says what to do rather than what is absent
                'certs'           => 'none of the three standards has a date yet',
                'requirements'    => 'no requirements recorded yet',
                'objectives'      => 'no objectives set yet',
                'training'        => 'no employees recorded yet',
                'audits'          => 'no audits recorded yet',
                'reviews'         => 'no customer reviews yet',
            ][$shape === 'certs' ? 'certs' : $key] ?? 'nothing recorded yet';
        } elseif ($shape === 'chart') {
            /* The headline is the twelve-month total; the shape of it is the
               chart. Nothing here is a rate or a score - every figure on this
               card is a count of records, which is why one axis carries both
               series. */
            $value = number_format($d['total']);
            $sub   = 'records added over the last 12 months';
        } elseif ($shape === 'certs') {
            /* SHAPE before key, and the order matters.

               Two tiles are built from the 'certificates' figures: the Next
               Renewal countdown at the top of the page, and this card
               listing all three standards. They share a key, so a chain that
               tested the key first gave this card the countdown's branch -
               two running clocks on one page, and a headline reading 1,547
               days where it should have read how many are in date.

               Its headline is the count still in date, because that is the
               one number a client can act on; which of them, and when, is
               the list underneath. */
            $value    = $d['current'];
            $sub      = 'of ' . $d['onFile'] . ' ' . ($d['onFile'] == 1 ? 'certificate' : 'certificates')
                      . ' on file still in date';
        } elseif ($key === 'certificates') {
            /* the headline is the nearest date, whether or not it has gone.
               A client with one certificate lapsed and two in hand should be
               looking at the lapsed one. */
            /* Both figures come off one number of seconds, so the clock can
               never show 00:00:00 beside a day count that has not rolled
               over. $d['days'] is the same arithmetic in the class, and the
               script below redoes it every second from $d['ends']. */
            $left     = abs(time() - $d['ends']);
            $value    = intdiv($left, 86400);
            $clock    = sprintf('%02d:%02d:%02d', intdiv($left % 86400, 3600),
                                                  intdiv($left % 3600, 60), $left % 60);
            $ringText = $pct . '%';
            $sub      = $d['expired']
                      ? 'days since ' . $d['label'] . ' expired, ' . $d['date']
                      : 'days until ' . $d['label'] . ' expires, ' . $d['date'];
            /* the gauge beside this prints the share already, so the
               sentence does not repeat it - it was wrapping onto a
               second line to say the same thing twice */
            if ($shape !== 'gauge') {
                $sub .= ' · ' . $d['current'] . ' of ' . $d['onFile'] . ' current';
            }
        } elseif ($shape === 'area' || $shape === 'columns') {
            /* The backlog is the headline, and the strip underneath says
               when the rest land. "Overdue" on its own was half the
               sentence. */
            $value = $d['overdue'];
            $sub   = $d['dated']
                   ? 'overdue, of ' . $d['dated'] . ' dated ' . ($d['dated'] == 1 ? 'requirement' : 'requirements')
                   : 'none of the ' . $d['total'] . ' has a completion date yet';
        } elseif ($key === 'requirements') {
            $value    = $d['overdue'];
            $ringText = $pct . '%';
            $sub   = $d['dated']
                   ? 'overdue, of ' . $d['dated'] . ' dated ' . ($d['dated'] == 1 ? 'requirement' : 'requirements')
                   : 'none of the ' . $d['total'] . ' has a completion date yet';
        } elseif ($key === 'objectives') {
            $value    = $d['healthy'];
            $ringText = $pct . '%';
            $sub   = 'of ' . $d['total'] . ' ' . ($d['total'] == 1 ? 'objective' : 'objectives')
                   . ' on track or achieved'
                   . ($d['atRisk'] ? ' · ' . $d['atRisk'] . ' at risk' : '');
        } elseif ($key === 'training') {
            /* People, not courses. The headline is how many of the staff have
               any training on file, because that is the number that can be
               acted on - and the one left over is named outright rather than
               left to be worked out of a percentage. */
            $value    = $d['trained'];
            $ringText = $pct . '%';
            $sub      = 'of ' . $d['staff'] . ' ' . ($d['staff'] == 1 ? 'employee' : 'employees')
                      . ' have training on file'
                      . ($d['untrained'] ? ' · ' . $d['untrained'] . ' not yet' : '');
        } elseif ($key === 'risks') {
            $value = $d['reduced'];
            $sub   = 'of ' . $d['total'] . ' ' . ($d['total'] == 1 ? 'risk' : 'risks')
                   . ' lowered by controls'
                   . ($d['skipped'] ? ' · ' . $d['skipped'] . ' scored outside 1–6' : '');
        } elseif ($key === 'audits') {
            $value    = number_format($d['yes']);
            $ringText = $pct . '%';
            $sub      = 'of ' . number_format($d['answered']) . ' answers, across '
                      . $d['audits'] . ' ' . ($d['audits'] == 1 ? 'audit' : 'audits');
        } else {
            $value = $d['score'];
            $sub   = 'average overall score out of ' . $d['scale'] . ', from '
                   . $d['count'] . ' ' . ($d['count'] == 1 ? 'review' : 'reviews');
        }

        /* the ring's arc: r is 15.9155 so the circumference is exactly 100
           and the dash array can be read as a percentage */

        /* One sentence per mark, written once and used by whichever shape
           this tile turns out to be - so the hover, the ring and the rail
           can never end up saying different things about the same figure.

           A tile with nothing behind it leaves out the figure: "– no
           objectives set yet (0%)" is three ways of saying nothing at once
           and reads like something broken. The percentage is left out
           everywhere, because every shape here already prints it beside the
           mark the hover is explaining. */
        $tip = !empty($d['empty'])
             ? $title . ' — ' . $sub
             : $title . ' — ' . $value . ' ' . $sub;

    @endphp

    {{-- the key is on the element because the hue hangs off it: one rule
         per tile in the stylesheet rather than a colour written inline,
         so the palette can be read and checked in one place --}}
    <div class="am-card amk-tile amk-tile--{{ $key }}">
        @php
            /* One glyph per card, drawn inline rather than taken from an icon
               font. Both Font Awesome 4 and 5 are loaded on this page and
               they define `.fa` differently, so which one wins depends on the
               order two stylesheets happen to load in - which is not a thing
               to hang a design on. These are four paths. */
            $amkGlyph = [
                'objectives'   => '<circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3.4"/><path d="M12 1.5v3M12 19.5v3M1.5 12h3M19.5 12h3"/>',
                'requirements' => '<rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M3 9.5h18M8 2.5v4M16 2.5v4M8.5 14.5l2.5 2.5 4.5-4.5"/>',
                'training'     => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20.5a6.5 6.5 0 0 1 13 0"/><circle cx="17.5" cy="9.5" r="2.6"/><path d="M16 15.2a5.4 5.4 0 0 1 5.5 5.3"/>',
                'certificates' => '<circle cx="12" cy="9" r="6"/><path d="M8.5 14.2L7 22l5-2.4L17 22l-1.5-7.8"/>',
                'activity'     => '<path d="M4 20.5V11M10 20.5V4.5M16 20.5V14M22 20.5V8"/>',
                'reviews'      => '<path d="M12 2.5l2.9 6 6.6.9-4.8 4.6 1.2 6.5L12 17.4 6.1 20.5l1.2-6.5L2.5 9.4l6.6-.9z"/>',
            ][$key] ?? '<circle cx="12" cy="12" r="8"/>';
        @endphp
        <div class="amk-tile__head">
            <h3 class="amk-tile__title">{{ $title }}</h3>
            <span class="amk-tile__badge" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">{!! $amkGlyph !!}</svg>
            </span>
        </div>

        @if ($shape === 'donut')
            {{-- The donut and its legend, side by side. There is no big
                 number and no sentence under it: the total sits inside the
                 ring and every part is named and counted in the list. That
                 is the shape the reference designs use, and it is also what
                 fixes the line this card used to wrap - "of 22 objectives on
                 track or achieved · 5 at risk" was one sentence trying to be
                 a table. --}}
            @php
                $whole = $key === 'training' ? $d['staff'] : $d['total'];
                $cap   = $key === 'training' ? 'staff' : 'total';
                /* built here rather than with an inline @foreach in the
                   attribute: Blade will not compile a directive that sits
                   straight after a word character, so "in all@foreach"
                   went to the browser as those literal letters */
                $donutLabel = $title . ': ' . $whole . ' in all';
                foreach ($d['parts'] as $pt) {
                    $donutLabel .= ', ' . $pt['label'] . ' ' . $pt['count'];
                }
            @endphp
            <div class="amk-donut">
                <svg class="amk-donut__svg" viewBox="0 0 42 42" role="img"
                     aria-label="{{ $donutLabel }}">
                    <circle class="amk-donut__track" cx="21" cy="21" r="15.9155"
                            fill="none" stroke-width="5.5"></circle>
                    @foreach ($d['parts'] as $pt)
                        @if ($pt['count'] > 0)
                            @php
                                /* 1.2 shorter than its true length, which is
                                   the gap between segments. A segment too
                                   small to carry one is drawn at a minimum
                                   rather than vanishing - its count is in the
                                   legend either way. */
                                $len = max(0.6, $pt['share'] * 100 - 1.2);
                            @endphp
                            {{-- the arc carries the same hover its legend row
                                 does. Without it, pointing at the donut itself
                                 did nothing - which is the first thing anyone
                                 tries - and only the list beside it answered.
                                 No tabindex here though: the legend row is
                                 already a tab stop for this same figure, and
                                 two of them would mean tabbing through the
                                 card twice. --}}
                            <circle class="amk-donut__seg amk-seg--{{ $pt['key'] }}"
                                    data-amk-tip="{{ $pt['label'] }} — {{ $whole ? $pt['count'] . ' of ' . $whole . ' (' . round($pt['share'] * 100) . '%)' : 'none recorded yet' }}"
                                    cx="21" cy="21" r="15.9155" fill="none" stroke-width="5.5"
                                    stroke-dasharray="{{ round($len, 2) }} {{ round(100 - $len, 2) }}"
                                    stroke-dashoffset="{{ round(25 - $pt['offset'] * 100, 2) }}"></circle>
                        @endif
                    @endforeach
                    <text class="amk-donut__total" x="21" y="21.5">{{ $whole }}</text>
                    <text class="amk-donut__cap" x="21" y="26">{{ $cap }}</text>
                </svg>

                <ul class="amk-donut__keys">
                    @foreach ($d['parts'] as $pt)
                        <li class="amk-seg--{{ $pt['key'] }}" @if (!$pt['count']) data-zero @endif
                            tabindex="0"
                            {{-- "Achieved — 0 of 0" is what this said on an
                                 account with nothing recorded: a ratio of
                                 nothing to nothing, which is not a figure --}}
                            data-amk-tip="{{ $pt['label'] }} — {{ $whole ? $pt['count'] . ' of ' . $whole . ' (' . round($pt['share'] * 100) . '%)' : 'none recorded yet' }}">
                            <span class="amk-donut__dot" aria-hidden="true"></span>
                            <span class="amk-donut__name">{{ $pt['label'] }}</span>
                            <span class="amk-donut__n">{{ $pt['count'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($shape !== 'chart' && $shape !== 'donut')
        <div class="amk-tile__body">
            @if ($shape === 'gauge')
                {{-- Half a circle. The clock beside it rewrites itself every
                     second, and a full ring next to that was a second thing
                     asking to be watched. The arc carries the same share the
                     rail did; the figure is written under it. --}}
                @php
                    /* a semicircle of radius 15 is pi*15 long, so a share
                       reads straight off as a length */
                    $gl = round(M_PI * 15, 2);
                    $gf = round($gl * ($pct / 100), 2);
                @endphp
                <svg class="amk-gauge" viewBox="0 0 44 38" role="img" tabindex="0"
                     aria-label="{{ $title }}: {{ !empty($d['empty']) ? 'nothing recorded yet' : $pct . ' per cent in date' }}"
                     data-amk-tip="{{ $tip }}">
                    {{-- butt ends, not round: a round cap adds half a
                         stroke width to each end, so the arc reads longer
                         than the share it is drawing --}}
                    <path class="amk-gauge__track" d="M 7 19 A 15 15 0 0 1 37 19"
                          fill="none" stroke-width="4.5" stroke-linecap="butt"></path>
                    @if ($pct > 0)
                        <path class="amk-gauge__fill" d="M 7 19 A 15 15 0 0 1 37 19"
                              fill="none" stroke-width="4.5" stroke-linecap="butt"
                              stroke-dasharray="{{ $gf }} {{ $gl }}"></path>
                    @endif
                    {{-- Under the arc, not inside it.
                         Inside, "100%" overlapped the arc by 1.32 units: the
                         inner edge of the stroke sits at y 11.82 where the
                         text reaches, and the text's cap top was at 10.50.
                         Shrinking the figure would have fixed it by making
                         the headline harder to read. Down here the arc only
                         ever occupies the top half, so no figure can reach
                         it - at any width, in any language. --}}
                    <text class="amk-gauge__label" x="22" y="29.5">{{ !empty($d['empty']) ? '–' : $pct . '%' }}</text>
                    <text class="amk-gauge__cap" x="22" y="36">in date</text>
                </svg>
            @endif

            @if ($shape === 'ring')
                <svg class="amk-ring" width="92" height="92" viewBox="0 0 42 42"
                     role="img" tabindex="0"
                     aria-label="{{ $title }}: {{ $pct }} per cent — {{ $sub }}"
                     data-amk-tip="{{ $tip }}">
                    <circle class="amk-ring__track" cx="21" cy="21" r="15.9155"
                            fill="none" stroke-width="5.5"></circle>
                    <circle class="amk-ring__fill" cx="21" cy="21" r="15.9155"
                            fill="none" stroke-width="5.5"
                            {{-- a round cap leaves a dot behind at nought, which
                                 reads as a value that is not there --}}
                            stroke-linecap="{{ $pct > 0 ? 'round' : 'butt' }}"
                            stroke-dasharray="{{ $pct }} {{ 100 - $pct }}"
                            stroke-dashoffset="25"></circle>
                    <text class="amk-ring__label" x="21" y="21">{{ $ringText }}</text>
                </svg>
            @endif


            {{-- The two data attributes appear only where $clock is set -
                 the certificate tile. The script finds its work by them, so
                 no other tile has to know the countdown exists. --}}
            <div class="amk-tile__figures"
                 @if ($clock !== null) data-amk-ends="{{ $d['ends'] }}" data-amk-dir="{{ $d['expired'] ? 'up' : 'down' }}" @endif>
                <div class="amk-tile__value" @if ($clock !== null) data-amk-days @endif>{{ $value }}</div>
                @if ($clock !== null)
                    {{-- The live half of the countdown, and the reason the
                         tile is worth watching rather than only reading.
                         aria-hidden: a figure rewritten every second is noise
                         read aloud, and the ring's own label and the line
                         below already carry the figure. --}}
                    <div class="amk-tile__clock" aria-hidden="true">{{ $clock }}</div>
                @endif
                {{-- a div and not a p: custom.css carries a blanket
                     `p { text-align: justify; color: #040404 !important }`,
                     which spaced these words out across the line and took the
                     colour off them. Not a p, not its problem. --}}
                <div class="amk-tile__sub">{{ $sub }}</div>
            </div>
        </div>
        @endif

        @if ($shape === 'chart')
            @php
                /* The plot, worked out here and written into the markup, so
                   the page arrives finished. Chart.js is on this site but it
                   loads in the footer - after this partial - so a chart that
                   waited for it would be a hole on the page until it did.

                   The box is a viewBox rather than pixels: the card is a
                   quarter of a screen on a phone and the full width of one on
                   a desktop, and an SVG that scales needs no second layout. */
                /* Sized for the card it sits in, which is half the page. A box
                   much wider than the card is scaled DOWN to fit, and the axis
                   labels go down with it - at 1180 across a 700px card the
                   months were unreadable. Near 1:1 is the whole trick. */
                $W = 740; $H = 236;
                $padL = 34; $padR = 6; $padT = 12; $padB = 34;
                $plotW = $W - $padL - $padR;
                $plotH = $H - $padT - $padB;

                $ms = $d['months'];
                $n  = max(1, count($ms));

                /* A round top for the axis: four equal steps, each one a 1, 2,
                   5 or 10 times a power of ten, so the labels read as numbers
                   rather than as arithmetic. 31 becomes 40 and not 31; 7
                   becomes 8 and not 7. */
                $raw  = max(1, (int) $d['max']);
                $unit = pow(10, max(0, floor(log10(max(1, $raw / 4)))));
                $step = $unit * 10;
                foreach ([1, 2, 5, 10] as $mult) {
                    if ($raw / 4 <= $mult * $unit) { $step = $mult * $unit; break; }
                }
                $top   = (int) (ceil($raw / $step) * $step);
                $ticks = 4;

                $slot = $plotW / $n;
                $barW = min(16, $slot * 0.42);

                $yOf = function ($v) use ($padT, $plotH, $top) {
                    return $padT + $plotH - ($top ? ($v / $top) * $plotH : 0);
                };
                $xOf = function ($i) use ($padL, $slot) { return $padL + $slot * $i + $slot / 2; };

                /* the nonconformity line, as one polyline */
                $pts = [];
                foreach ($ms as $i => $m) {
                    $pts[] = round($xOf($i), 1) . ',' . round($yOf($m['ncr']), 1);
                }
            @endphp

            <svg class="amk-chart__plot" viewBox="0 0 {{ $W }} {{ $H }}"
                 role="img" aria-label="QMS activity, {{ $n }} months to {{ end($ms)['long'] }}: {{ number_format($d['total']) }} records added, of which {{ array_sum(array_column($ms, 'ncr')) }} nonconformities">

                {{-- the axis: four gridlines and a label apiece. Recessive,
                     because a gridline is there to be measured against and
                     not to be looked at. --}}
                @for ($t = 0; $t <= $ticks; $t++)
                    @php $v = (int) round($top * $t / $ticks); $y = round($yOf($v), 1); @endphp
                    <line class="amk-chart__grid" x1="{{ $padL }}" y1="{{ $y }}"
                          x2="{{ $W - $padR }}" y2="{{ $y }}"></line>
                    <text class="amk-chart__axis" x="{{ $padL - 8 }}" y="{{ $y + 3.5 }}"
                          text-anchor="end">{{ $v }}</text>
                @endfor

                @foreach ($ms as $i => $m)
                    @php
                        $x  = $xOf($i);
                        $bh = $m['total'] > 0 ? max(2, $yOf(0) - $yOf($m['total'])) : 0;
                    @endphp

                    {{-- the whole month is the hover target. A 16px bar is a
                         hard thing to point at, and a month with no bar at all
                         still has something to say. --}}
                    <rect class="amk-chart__hit" x="{{ round($padL + $slot * $i, 1) }}" y="{{ $padT }}"
                          width="{{ round($slot, 1) }}" height="{{ $plotH }}"
                          data-amk-tip="{{ $m['long'] }} — {{ $m['total'] }} {{ $m['total'] == 1 ? 'record' : 'records' }} added{{ $m['ncr'] ? ', ' . $m['ncr'] . ' ' . ($m['ncr'] == 1 ? 'nonconformity' : 'nonconformities') : '' }}"></rect>

                    @if ($bh > 0)
                        <rect class="amk-chart__bar" x="{{ round($x - $barW / 2, 1) }}"
                              y="{{ round($yOf($m['total']), 1) }}" width="{{ round($barW, 1) }}"
                              height="{{ round($bh, 1) }}"
                              style="animation-delay:{{ $i * 45 }}ms"></rect>
                    @endif

                    <text class="amk-chart__axis" x="{{ round($x, 1) }}"
                          y="{{ $padT + $plotH + 20 }}" text-anchor="middle">{{ $m['label'] }}</text>
                @endforeach

                {{-- Nonconformities, on the SAME axis as the bars. Allowed
                     here and not in general: both are counts of records in
                     that month, and every nonconformity is also one of the
                     records the bar counts. The line sits low because it is
                     low. --}}
                <polyline class="amk-chart__line" points="{{ implode(' ', $pts) }}"></polyline>
                @foreach ($ms as $i => $m)
                    <circle class="amk-chart__dot" cx="{{ round($xOf($i), 1) }}"
                            cy="{{ round($yOf($m['ncr']), 1) }}" r="3"></circle>
                @endforeach
            </svg>

            <ul class="amk-keys">
                <li><span class="amk-keys__dot amk-keys__dot--bar"></span>Records added</li>
                <li><span class="amk-keys__dot amk-keys__dot--line"></span>Nonconformities raised</li>
            </ul>

            @php
                /* The only change-over-time figure anywhere on this
                   dashboard, and it is here because it is the only one that
                   was measured: these are counts of records with a date on
                   them. A month against a month that held nothing is not a
                   percentage - nought to five is "five where there were
                   none" - so that case says so in words. */
                $chg  = $d['change'];
                $dir  = $chg === null ? 'flat' : ($chg > 0 ? 'up' : ($chg < 0 ? 'down' : 'flat'));
                $arrow = ['up' => '&#9650;', 'down' => '&#9660;', 'flat' => '&#8212;'][$dir];
                $chgText = $chg === null
                         ? ($d['thisMonth'] > 0 ? 'none last month' : 'none either month')
                         : ($chg > 0 ? '+' : '') . round($chg * 100) . '%';
            @endphp
            <div class="amk-foot">
                <div>
                    <span class="amk-foot__k">This month</span>
                    <span class="amk-foot__v">{{ $d['thisMonth'] }}</span>
                    <span class="amk-foot__d amk-foot__d--{{ $dir }}"
                          data-amk-tip="{{ $d['thisMonth'] }} this month against {{ $d['lastMonth'] }} last month">{!! $arrow !!} {{ $chgText }}</span>
                </div>
                <div>
                    <span class="amk-foot__k">Last month</span>
                    <span class="amk-foot__v">{{ $d['lastMonth'] }}</span>
                </div>
                <div>
                    <span class="amk-foot__k">12-month total</span>
                    <span class="amk-foot__v">{{ number_format($d['total']) }}</span>
                </div>
            </div>
        @endif

        @if ($shape === 'area')
            {{-- Six months of what falls due, as a line with a wash under
                 it. No axis and no month labels: the hover carries both, and
                 the headline above is what this card is actually for. --}}
            @php
                /* the backlog is the big number above, not a point on this
                   line - as a seventh point it would tower over the six and
                   flatten the shape they make */
                $ahead = array_slice($d['cols'], 1);
                $an    = max(1, count($ahead));
                $aw    = 300; $ah = 64;
                $atop  = 10; $abase = 54;           // the band the line moves in
                $amax  = max(1, max(array_column($ahead, 'count')));

                $ax = function ($i) use ($aw, $an) {
                    return $an > 1 ? $i * ($aw / ($an - 1)) : $aw / 2;
                };
                $ay = function ($v) use ($atop, $abase, $amax) {
                    return $abase - ($v / $amax) * ($abase - $atop);
                };

                $pts = [];
                foreach ($ahead as $i => $c) $pts[] = round($ax($i), 1) . ',' . round($ay($c['count']), 1);
                $line = 'M ' . implode(' L ', $pts);
                $fill = $line . ' L ' . $aw . ',' . $ah . ' L 0,' . $ah . ' Z';
            @endphp
            <div class="amk-area">
                <svg class="amk-area__svg" viewBox="0 0 {{ $aw }} {{ $ah }}"
                     preserveAspectRatio="none" role="img"
                     aria-label="Requirements due over the next {{ $an }} months: {{ $areaLabel }}">
                    <path class="amk-area__fill" d="{{ $fill }}"></path>
                    <path class="amk-area__line" d="{{ $line }}"></path>
                    @foreach ($ahead as $i => $c)
                        @if ($c['count'] > 0)
                            <circle class="amk-area__dot" cx="{{ round($ax($i), 1) }}"
                                    cy="{{ round($ay($c['count']), 1) }}" r="2.5"></circle>
                        @endif
                        <rect class="amk-area__hit"
                              x="{{ round($ax($i) - ($aw / $an) / 2, 1) }}" y="0"
                              width="{{ round($aw / $an, 1) }}" height="{{ $ah }}"
                              data-amk-tip="{{ $c['long'] }} — {{ $c['count'] }} {{ $c['count'] == 1 ? 'requirement' : 'requirements' }} due"></rect>
                    @endforeach
                </svg>
            </div>
        @endif

        @if ($shape === 'columns')
            {{-- Seven columns: the backlog, then a month each for six months.
                 The first is red and stands apart because it is not a month,
                 it is everything already past - and a client reading this
                 card wants to know both "how many" and "when the next lot
                 lands", which a single overdue count never said. --}}
            @php
                $cw = 160; $ch = 62;
                $cs = $cw / max(1, count($d['cols']));         // one slot per column
                $cb = min(13, $cs * 0.52);                     // the bar inside it
                $cmax = max(1, (int) $d['peak']);
                $cfloor = 44;                                  // where the bars stand
                $colsLabel = 'Requirements due: ';
                $colsLabel .= implode(', ', array_map(function ($c) {
                    return $c['long'] . ' ' . $c['count'];
                }, $d['cols']));
            @endphp
            <div class="amk-cols">
                <svg class="amk-cols__svg" viewBox="0 0 {{ $cw }} {{ $ch }}"
                     role="img" aria-label="{{ $colsLabel }}">
                    <line class="amk-cols__base" x1="0" y1="{{ $cfloor }}" x2="{{ $cw }}" y2="{{ $cfloor }}"></line>
                    @foreach ($d['cols'] as $i => $c)
                        @php
                            $cx = $cs * $i + $cs / 2;
                            $bh = $c['count'] > 0 ? max(3, ($c['count'] / $cmax) * 30) : 0;
                        @endphp
                        <rect class="amk-cols__hit" x="{{ round($cs * $i, 1) }}" y="0"
                              width="{{ round($cs, 1) }}" height="{{ $cfloor }}"
                              data-amk-tip="{{ $c['long'] }} — {{ $c['count'] }} {{ $c['count'] == 1 ? 'requirement' : 'requirements' }}{{ $c['over'] ? ' already past their review date' : ' due' }}"></rect>
                        @if ($bh > 0)
                            <rect class="amk-cols__bar{{ $c['over'] ? ' amk-cols__bar--over' : '' }}"
                                  x="{{ round($cx - $cb / 2, 1) }}" y="{{ round($cfloor - $bh, 1) }}"
                                  width="{{ round($cb, 1) }}" height="{{ round($bh, 1) }}"
                                  rx="{{ round($cb / 2, 1) }}"></rect>
                            <text class="amk-cols__n" x="{{ round($cx, 1) }}"
                                  y="{{ round($cfloor - $bh - 3, 1) }}">{{ $c['count'] }}</text>
                        @endif
                        <text class="amk-cols__lab" x="{{ round($cx, 1) }}" y="{{ $cfloor + 11 }}">{{ $c['label'] }}</text>
                    @endforeach
                </svg>
            </div>
        @endif

        @if ($shape === 'bar')
            {{-- The same share the ring tiles draw, laid out flat. Its
                 figure is written out beside the caption and not only held
                 in the width, so nothing here depends on seeing the bar. --}}
            <div class="amk-track" role="img" tabindex="0"
                 aria-label="{{ $barCap }}: {{ !empty($d['empty']) ? 'nothing recorded yet' : $pct . ' per cent' }}"
                 data-amk-tip="{{ $tip }}">
                <span class="amk-track__cap">{{ $barCap }}</span>
                <span class="amk-track__pct">{{ !empty($d['empty']) ? '–' : $pct . '%' }}</span>
                <span class="amk-track__rail">
                    <span class="amk-track__fill" style="width:{{ $pct }}%"></span>
                </span>
            </div>
        @endif

        @if ($shape === 'certs')
            {{-- One row per standard, including the standards with no date
                 on them. Three quarters of the clients here hold ONE
                 certificate rather than three, and a card that quietly left
                 the other two out would read as "you have one" when what it
                 means is "two were never recorded". --}}
            <ul class="amk-certs">
                @foreach ($d['rows'] as $c)
                    @php
                        /* the word, the icon and the right-hand figure, per
                           state. The word is here and not only in the colour:
                           a status hue that is the only thing saying "expired"
                           is a status hue saying nothing. */
                        $state = [
                            'expired' => ['Expired',      '&#10005;'],
                            'soon'    => ['Expires soon', '&#33;'],
                            'current' => ['In date',      '&#10003;'],
                            'none'    => ['Not recorded', '&#8211;'],
                        ][$c['status']];

                        if (!$c['onFile']) {
                            $right = '—';
                            $meta  = 'no expiry date recorded';
                            $rowTip = $c['label'] . ' — no expiry date has been recorded';
                        } else {
                            $n     = number_format($c['days']);
                            $right = $c['expired'] ? $n . ' d ago' : $n . ' d left';
                            $meta  = $state[0] . ' · ' . $c['date'];
                            $rowTip = $c['label'] . ' — ' . strtolower($state[0]) . ' · '
                                   . ($c['expired'] ? 'ran out ' . $c['date'] . ', ' . $n . ' days ago'
                                                    : 'runs out ' . $c['date'] . ', in ' . $n . ' days');
                        }
                    @endphp
                    <li class="amk-cert amk-cert--{{ $c['status'] }}"
                        tabindex="0" data-amk-tip="{{ $rowTip }}">
                        <span class="amk-cert__ico" aria-hidden="true">{!! $state[1] !!}</span>
                        <span class="amk-cert__name">{{ $c['label'] }}</span>
                        <span class="amk-cert__days">{{ $right }}</span>
                        <span class="amk-cert__meta">{{ $meta }}</span>
                        <span class="amk-cert__rail">
                            <span class="amk-cert__fill" style="width:{{ round($c['share'] * 100, 1) }}%"></span>
                        </span>
                    </li>
                @endforeach
            </ul>
            @php
                $tally = ['current' => 0, 'soon' => 0, 'expired' => 0, 'none' => 0];
                foreach ($d['rows'] as $c) $tally[$c['status']]++;
            @endphp
            <div class="amk-foot">
                <div>
                    <span class="amk-foot__k">In date</span>
                    <span class="amk-foot__v">{{ $tally['current'] }}</span>
                </div>
                <div>
                    <span class="amk-foot__k">Due soon</span>
                    <span class="amk-foot__v">{{ $tally['soon'] }}</span>
                </div>
                <div>
                    <span class="amk-foot__k">Expired</span>
                    <span class="amk-foot__v">{{ $tally['expired'] }}</span>
                </div>
            </div>
        @endif

        @if ($shape === 'segments')
            {{-- One whole split three ways. A ring could only have shown the
                 conforming share; what a client needs out of an audit is also
                 how much did not conform and how much did not apply. --}}
            <div class="amk-seg" role="img"
                 aria-label="@foreach ($d['parts'] as $p){{ $p['label'] }}: {{ $p['count'] }} ({{ round($p['share'] * 100) }} per cent)@if (!$loop->last), @endif @endforeach">
                @if (!$d['answered'])
                    {{-- nothing answered yet. The bar still draws, as an
                         empty track: a client should see the shape the
                         figure will take, and the legend below already
                         carries the three noughts. --}}
                    <span class="amk-seg__part amk-seg__part--none" style="flex:1 0 0%"></span>
                @endif
                @foreach ($d['parts'] as $p)
                    @if ($p['count'])
                    <span class="amk-seg__part amk-seg__part--{{ $p['key'] }}"
                          style="flex:{{ $p['count'] }} 0 0%">
                        {{-- printed inside only where there is room: a
                             narrower block prints nothing and its figure is
                             in the legend right below --}}
                        @if ($p['share'] >= 0.14){{ round($p['share'] * 100) }}%@endif
                    </span>
                    @endif
                @endforeach
            </div>
            <ul class="amk-legend">
                @foreach ($d['parts'] as $p)
                <li>
                    <span class="amk-legend__sw amk-legend__sw--{{ $p['key'] }}"></span>
                    <span class="amk-legend__ico" aria-hidden="true">{!! $p['key'] === 'yes' ? '&check;' : ($p['key'] === 'no' ? '&cross;' : '&ndash;') !!}</span>
                    <span class="amk-legend__name">{{ $p['label'] }}</span>
                    <span class="amk-legend__n">{{ number_format($p['count']) }}</span>
                </li>
                @endforeach
            </ul>
        @endif

        @if ($shape === 'meters')
            {{-- Four scores, not one. The overall score above is the client's
                 own summary; these are the three judgements behind it, which
                 a single figure was hiding. Each is its own ratio against its
                 own limit of ten, read a row at a time - so a meter apiece
                 rather than a bar chart. --}}
            <div class="amk-meters">
                @foreach ($d['rows'] as $m)
                    <div class="amk-meter" role="img" tabindex="0"
                         aria-label="{{ $m['label'] }}: {{ $m['avg'] }} out of {{ $d['scale'] }}"
                         data-amk-tip="{{ $m['label'] }} — {{ $d['count'] ? $m['avg'] . ' out of ' . $d['scale'] . ', averaged over ' . $d['count'] . ' ' . ($d['count'] == 1 ? 'review' : 'reviews') : 'no customer reviews yet' }}">
                        <span class="amk-meter__name">{{ $m['label'] }}</span>
                        <span class="amk-meter__val">{{ $m['avg'] }}</span>
                        <span class="amk-meter__track">
                            <span class="amk-meter__fill" style="width:{{ round($m['share'] * 100, 1) }}%"></span>
                        </span>
                    </div>
                @endforeach
            </div>
            @php
                /* The best and the worst of the four, named. An average
                   hides exactly this: on the live data a client can sit at
                   an overall 3 with quality at 2 and price at 3.8, and
                   which end is which is the actionable half. */
                $ordered = $d["rows"];
                usort($ordered, function ($a, $b) { return $b["avg"] <=> $a["avg"]; });
                $best  = $ordered[0] ?? null;
                $worst = end($ordered) ?: null;
            @endphp
            <div class="amk-foot">
                <div>
                    <span class="amk-foot__k">Reviews</span>
                    <span class="amk-foot__v">{{ number_format($d["count"]) }}</span>
                </div>
                <div>
                    <span class="amk-foot__k">{{ $d["count"] && $best ? $best["label"] : "Highest" }}</span>
                    <span class="amk-foot__v">{{ $d["count"] && $best ? $best["avg"] : "–" }}</span>
                </div>
                <div>
                    <span class="amk-foot__k">{{ $d["count"] && $worst ? $worst["label"] : "Lowest" }}</span>
                    <span class="amk-foot__v">{{ $d["count"] && $worst ? $worst["avg"] : "–" }}</span>
                </div>
            </div>
        @endif

    </div>
