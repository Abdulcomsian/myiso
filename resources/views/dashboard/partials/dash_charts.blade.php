{{--
    The four figures, as stat tiles, where the five quick-link cards used to
    be. Those five all appear in the sidebar as well, so nothing lost its only
    way in when they came out.

    Each tile is one ratio and one count. There is no "since last month" on
    any of them, which the reference design has: this application keeps no
    history to compare a month against, and a trend nobody measured is the one
    thing a dashboard must not invent.

    Two shapes, as in the reference - a ring where the share is the headline,
    a track where the count is - and no three-dot menu, because it would open
    nothing.

    A hue per tile, and two shapes - a ring where the share is drawn round,
    a rail where it is drawn across. Four identical rings in a row read as
    one repeated object rather than four figures.

    The hues are measured rather than chosen by eye. All four clear 3:1
    against white, sit inside one lightness band so they read as a set, and
    are far enough apart to be told apart in normal vision; the full report
    is in the stylesheet below.

    No green and no red among them, deliberately. Those two are read as an
    all-clear and an alarm whatever they are put on, and none of these four
    tiles means either - a client seeing a green ring on Requirements Due
    would take it for reassurance nobody gave. Green and red are kept for
    Audit Conformity, where conformed and did not conform really are what is
    being said - and even there they are steps of one blue, because the
    client asked for that and the tick, the name and the count already carry
    the meaning three times over.
--}}
@php
    /* in display order: the key, the title, the shape, the hue */
    /* Two groups, laid out separately.

       The first four are each one ratio, so they share a row and narrow to
       quarter width on a wide screen.

       The last two are not one ratio. Certificate Expiry has three standards
       behind it and Customer Review has four scores, and a single figure was
       hiding most of both. Each needs room for its parts, so they sit two to
       a row at half width and never narrower, whatever the screen does. */
    /* Ring, rail, ring, rail. The alternation is the point: the same figure
       drawn the same way four times across one row stops being read.

       The fourth is Next Renewal - the countdown to whichever certificate
       runs out first, which is the same date the page header prints. It gets
       a rail rather than a ring because a ring beside a running clock was
       competing with the one thing on that card worth watching. The three
       standards behind it are broken out in full below. */
    /* Four cards, four different marks, and that is the point. A row of the
       same shape four times stops being read as four figures - and three of
       these had more behind them than one ratio could show:

         - five objective states were being folded into "on track or
           achieved" and everything else
         - requirements had an overdue count and no sense of WHEN the rest
           fall due, which is the half a client can act on
         - training put the person on nine courses in the same box as the
           person on one

       Next Renewal keeps a single figure because it genuinely is one: the
       days to the nearest date. It gets a half circle rather than a full
       one so the running clock beside it is not competing with a ring. */
    $amkRatio = [
        ['objectives',      'Objectives Tracker', 'donut'],
        ['requirements',    'Requirements Due',   'area'],
        ['training',        'Employee Training',  'donut'],
        ['certificates',    'Next Renewal',       'gauge'],
    ];
    /* Nothing takes the full width any more. The chart was given a whole row
       and came out half a screen tall; at half width it is the shape the
       reference designs actually draw, and it sits beside the card it reads
       against - activity on the left, what that activity is keeping alive on
       the right. */
    $amkWide   = [];
    $amkDetail = [
        ['activity',     'QMS Activity',       'chart'],
        ['certificates', 'Certificate Expiry', 'certs'],
    ];

    /* Hidden, not deleted.
       Audit Conformity is off the dashboard at the client's request, and
       "for now" were their words - so it stays here, whole, rather than
       being taken out and written again later. Putting it back is this one
       entry moved into $amkDetail above.
       It is still being WORKED OUT in DashboardCharts::for(), which costs
       two queries a page for a figure nobody currently sees. That is the
       deliberate trade: while it is only hidden, the data and the view can
       never drift apart. */
    $amkHidden = [
        ['audits',  'Audit Conformity', 'segments'],
        ['reviews', 'Customer Review',  'meters'],
    ];

    /* No filtering. These used to be left out when a client had no rows
       behind them, and on a real account that produced ONE card stretched
       across the whole row with the grid collapsed around it - which
       reads as broken, not as tidy. Six tiles that happen to say nought
       are a dashboard; one lonely card is a bug. Each tile writes its own
       line for having nothing yet. */
    $amkShown   = collect($amkRatio);
    $amkWides   = collect($amkWide);
    $amkDetails = collect($amkDetail);
@endphp

<style>
    .amk {
        --amk-track: #eef1f5;
        --amk-ink: #212529;
        --amk-ink-soft: #6c757d;
    }
    /* The theme's own colour is the default - Audit Conformity and Customer
       Review wear it, since neither is one of the four. */
    .amk {
        --amk-hue:  var(--am-primary, #2E3B9A);
        --amk-tint: #e6e7f3;   /* the primary at 12% on white, written out */
    }

    /* A hue per tile, run through validate_palette.js rather than picked by
       eye - which is how the last set got onto the page with three of its
       four marks under 3:1 against white.

       This set passes every check: all four inside one lightness band so the
       row reads as a set, all four above the chroma floor, and all four
       above 3:1 on white - 4.98 (indigo), 3.58 (orange), 3.95 (teal), 4.85
       (magenta), against the 2.05 / 2.54 / 2.88 the old yellow, aqua and
       orange managed.

       Magenta is doing a second job and had to clear a higher bar for it.
       The certificate countdown's clock is TEXT, not a mark, and 13px
       semibold is normal text rather than large - so 4.5 to one, not 3. At
       4.85 it clears that. No other hue here is used for text; if one ever
       were, orange at 3.58 would not be legible and the test says so.

       One warning stands: indigo and magenta sit 6.2 apart under protanopia,
       inside the 6-8 band that is legal only where something other than hue
       tells the two apart. Three things do - each tile carries its own
       heading, prints its own figure, and writes its share as text - and the
       two are at opposite ends of the row rather than side by side.

       No green, no red. Both are read as a verdict wherever they are put,
       and not one of these four tiles is making one. */
    .amk-tile--objectives   { --amk-hue: #4263EB; }   /* indigo  4.98:1 */
    .amk-tile--requirements { --amk-hue: #E8590C; }   /* orange  3.58:1 */
    .amk-tile--training     { --amk-hue: #099268; }   /* teal    3.95:1 */
    .amk-tile--certificates { --amk-hue: #AE3EC9; }   /* magenta 4.85:1 */
    /* One per row on a phone, two on a small screen, and all four in one row
       once there is really room for them.

       1400px for the four, because the space a tile gets is not the viewport:
       the sidebar holds 260px above 992px and the content is padded 26px
       each side, so 1400px leaves 1088px - four 260px tiles and their gaps.
       Switching any earlier would make a tile narrower than its own ring and
       figure sitting side by side. */
    .amk-grid { display: grid; gap: 1rem; grid-template-columns: minmax(0, 1fr); margin-bottom: 1.5rem; }

    @media (min-width: 700px) {
        .amk-grid--2, .amk-grid--3, .amk-grid--4,
        .amk-grid--half { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (min-width: 1400px) {
        .amk-grid--3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .amk-grid--4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        /* only the quarter-width tiles tighten up, so the figure keeps its
           line. The half-width pair below has room and keeps full size. */
        .amk-grid--4 .amk-tile { padding: 18px; }
        .amk-grid--4 .amk-tile__body { gap: 12px; }
        .amk-grid--4 .amk-ring { width: 72px; height: 72px; }
        .amk-grid--4 .amk-tile__value { font-size: 26px; }
    }
    /* --half never goes past two: these two carry a bar with three parts and
       a list of four scores, and quarter width would crush both. One per row
       on a phone, two at fifty-fifty on anything bigger. */

    /* Tighter than it was, at the client's asking. The four sit in a row
       and all four take the height of the tallest, so the Objectives card
       with five legend rows was setting it for everybody. */
    .amk-tile { padding: 18px 20px; }

    /* ---- the card head: a title and the badge beside it ----

       The badge is the one piece of pure decoration on these cards, and it
       earns its place by doing what a title alone cannot: it tells the four
       apart at a glance, from across a desk, before any of them is read. It
       is the tile's own hue at 12% with the hue's glyph on it, so the badge,
       the ring and the rail on one card are visibly one card. */
    .amk-tile__head {
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 10px; margin-bottom: 10px;
    }
    .amk-tile__title {
        margin: 0; font-size: 15px; font-weight: 600;
        color: var(--amk-ink); line-height: 1.3;
    }
    .amk-tile__badge {
        flex: none; width: 34px; height: 34px; border-radius: 9px;
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--amk-wash, #eef1f5); color: var(--amk-hue);
    }
    .amk-tile__badge svg { width: 17px; height: 17px; display: block; }
    /* the hue at 12% on white, written out rather than mixed at run time:
       color-mix() would leave an older browser with no badge at all */
    .amk-tile--objectives   { --amk-wash: #ecefFd; }
    .amk-tile--requirements { --amk-wash: #fdeee5; }
    .amk-tile--training     { --amk-wash: #e6f4ef; }
    .amk-tile--certificates { --amk-wash: #f7ecfa; }
    .amk-tile--activity     { --amk-wash: #ecefFd; }
    .amk-tile--reviews      { --amk-wash: #ecefFd; }

    /* ---- the figures under a card that has more than one ----

       The reference designs close their bigger cards with a row of two or
       three figures, and it is not decoration there either: it is where the
       numbers a chart cannot label go. */
    .amk-foot {
        display: grid; grid-auto-flow: column; grid-auto-columns: 1fr;
        margin: 14px -20px -18px; border-top: 1px solid #eef1f5;
    }
    .amk-foot > div {
        padding: 10px 12px; text-align: center; min-width: 0;
    }
    .amk-foot > div + div { border-inline-start: 1px solid #eef1f5; }
    .amk-foot__k {
        display: block; font-size: 11.5px; color: var(--amk-ink-soft);
        margin-bottom: 3px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .amk-foot__v {
        font-size: 17px; font-weight: 700; color: var(--amk-ink);
        font-variant-numeric: tabular-nums;
    }
    /* up and down are states, so they carry an arrow as well as a colour,
       and the word is in the hover. 5.46 and 3.45 to one on white. */
    .amk-foot__d { margin-inline-start: 6px; font-size: 12px; font-weight: 600; }
    .amk-foot__d--up   { color: #2F9E44; }
    .amk-foot__d--down { color: #C92A2A; }
    .amk-foot__d--flat { color: var(--amk-ink-soft); }

    /* ---- the twelve-month chart ----

       Drawn as SVG the server writes out, not by a charting library. Chart.js
       is on this page but it loads in the footer, AFTER this partial, so
       anything here that reached for it would run too early; and the whole
       figure is known at render time, so there is nothing for a library to
       work out.

       The bars and the line share ONE axis, which is allowed here and would
       not be in general: both are counts of records in the same month, and
       the line is a SUBSET of the bars - every nonconformity is also a
       record added. That is why the line sits low. It sits low because it
       is low. */
    .amk-chart__plot { display: block; width: 100%; height: auto; overflow: visible; }
    .amk-chart__grid { stroke: #eef1f5; stroke-width: 1; }
    .amk-chart__axis {
        font-size: 10px; fill: var(--amk-ink-soft);
        font-variant-numeric: tabular-nums;
    }
    .amk-chart__bar  { fill: #4263EB; }
    .amk-chart__line { fill: none; stroke: #C92A2A; stroke-width: 2;
                       stroke-linejoin: round; stroke-linecap: round; }
    .amk-chart__dot  { fill: #ffffff; stroke: #C92A2A; stroke-width: 2; }
    /* an invisible column per month, so a hover anywhere over that month
       finds it - a 16px bar is a hard thing to point at */
    .amk-chart__hit  { fill: transparent; }
    .amk-chart__hit:hover { fill: rgba(66, 99, 235, .06); }

    /* the key: a dot and a name per series, which is the channel that is not
       colour - red and blue are far apart, but a legend is not optional */
    .amk-keys { list-style: none; display: flex; flex-wrap: wrap; gap: 6px 18px;
                margin: 12px 0 0; padding: 0; }
    .amk-keys li { display: inline-flex; align-items: center; gap: 7px;
                   font-size: 12px; color: var(--amk-ink); }
    .amk-keys__dot { width: 9px; height: 9px; border-radius: 50%; flex: none; }
    .amk-keys__dot--bar  { background: #4263EB; }
    .amk-keys__dot--line { background: #C92A2A; }
    .amk-tile__body { display: flex; align-items: center; gap: 18px; }
    .amk-tile__figures { margin-inline-start: auto; text-align: end; min-width: 0; }
    .amk-tile__value {
        font-size: 30px; font-weight: 700; color: var(--amk-ink); line-height: 1.1;
        /* proportional figures: tabular-nums gives every digit a zero's width,
           which reads loose at this size and these are not in a column */
    }
    .amk-tile__sub {
        margin: 4px 0 0; font-size: 12.5px; color: var(--amk-ink-soft); line-height: 1.4;
    }

    /* ---- the live half of the certificate countdown ----

       Tabular figures here and nowhere else on these tiles. This one really
       is a column - the same three fields rewritten every second - and
       proportional digits make it jitter as the widths change underneath it.

       It wears the theme colour rather than the soft ink: it is the only
       thing on these tiles that moves of its own accord, and the hue ties it
       to the ring beside it. 9.51 to one against white. */
    .amk-tile__clock {
        margin: 3px 0 0; font-size: 13px; font-weight: 600;
        color: var(--amk-hue); line-height: 1.2;
        font-variant-numeric: tabular-nums; letter-spacing: .01em;
    }

    /* ---- the ring ---- */
    /* ---- the ring ----
       Thicker and larger than it was. At 4 units on an 84px box it read as a
       hairline next to the reference's donuts; at 5.5 on 92 it reads as the
       mark it is, and its figure inside has room to be legible. */
    .amk-ring { flex: none; display: block; }
    .amk-ring__track { stroke: var(--amk-track); }
    .amk-ring__fill  { stroke: var(--amk-hue); transition: stroke-dasharray .4s ease; }
    .amk-ring__label {
        font-size: 10px; font-weight: 700; fill: var(--amk-ink);
        text-anchor: middle; dominant-baseline: central;
    }

    /* ---- the donut: one whole, split as many ways as it really is ----

       Built the same way the ring is - a radius of 15.9155 makes the
       circumference exactly 100, so a segment's length and its starting
       point are both read straight off as percentages - but with a segment
       per state rather than one arc and a gap.

       Each segment is drawn 1.2 short of its true length. That is the 2px
       surface gap a stacked mark wants: without it two segments of similar
       colour run into one another and the eye reads one. The figure is never
       taken from the arc, it is in the legend beside it, so a segment being
       drawn a shade short costs nothing. */
    .amk-donut { display: flex; align-items: center; gap: 14px; }
    .amk-donut__svg { flex: none; width: 78px; height: 78px; display: block; }
    .amk-donut__track { stroke: var(--amk-track); }
    .amk-donut__seg { stroke: var(--amk-part); transition: stroke-dasharray .4s ease; }
    .amk-donut__dot { background: var(--amk-part); }
    .amk-donut__total {
        font-size: 10px; font-weight: 700; fill: var(--amk-ink);
        text-anchor: middle;
    }
    .amk-donut__cap {
        font-size: 4.2px; fill: var(--amk-ink-soft); text-anchor: middle;
        letter-spacing: .06em; text-transform: uppercase;
    }

    /* the legend IS the figure here: the donut shows the shape, the list
       beside it carries every name and every count as text */
    .amk-donut__keys { list-style: none; margin: 0; padding: 0; flex: 1 1 auto; min-width: 0; }
    .amk-donut__keys li {
        display: grid; grid-template-columns: 9px minmax(0, 1fr) auto;
        align-items: center; gap: 8px; padding: 1px 0;
        font-size: 11.5px; color: var(--amk-ink);
    }
    .amk-donut__dot { width: 9px; height: 9px; border-radius: 50%; }
    .amk-donut__name { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .amk-donut__n { font-weight: 600; font-variant-numeric: tabular-nums; }
    /* a state with nothing in it stays on the list and steps back, so the
       five the tracker has are all visible before any is used */
    .amk-donut__keys li[data-zero] { color: var(--amk-ink-soft); }

    /* The objective states. Colour MEANS something here - these are states,
       not five things being told apart - and the rule that comes with that
       is that it is never the only channel: every row has its name and its
       count beside it. Measured on white: 3.45, 4.98, 3.32, 3.58, 5.46. */
    .amk-seg--achieved     { --amk-part: #2F9E44; }
    .amk-seg--on_track     { --amk-part: #4263EB; }
    .amk-seg--not_started  { --amk-part: #868E96; }
    .amk-seg--at_risk      { --amk-part: #E8590C; }
    .amk-seg--not_achieved { --amk-part: #C92A2A; }

    /* The training buckets are ordinal rather than categorical - more is
       better - so they are steps of one hue, not three hues. 11.80 and 3.12
       on white with 3.79 between them, which clears the 2:1 an ordinal ramp
       needs; "nothing on file" takes the grey because it is an absence
       rather than a step. */
    .amk-seg--several { --amk-part: #05402E; }
    .amk-seg--one     { --amk-part: #0CA678; }
    .amk-seg--none    { --amk-part: #868E96; }

    /* ---- the area: the load coming over the next six months ----

       Drawn the way the reference dashboards draw a card like this - a line
       with a wash under it, running edge to edge along the bottom of the
       card with no axis and no labels. That is the right amount of chart
       here: the figure above it is the headline, and this says only whether
       the next few months are heavy or quiet.

       The backlog is deliberately NOT in it. "Overdue" is already the big
       number on this card, and putting it in the line as if it were a month
       would make the first point tower over the rest and flatten everything
       the line is for. */
    .amk-area {
        margin: 12px -20px -18px;      /* flush to the card's own edges */
        line-height: 0;
    }
    .amk-area__svg { display: block; width: 100%; height: auto; }
    .amk-area__fill { fill: var(--amk-hue); opacity: .16; }
    .amk-area__line { fill: none; stroke: var(--amk-hue); stroke-width: 2;
                      stroke-linejoin: round; stroke-linecap: round;
                      vector-effect: non-scaling-stroke; }
    .amk-area__dot  { fill: var(--amk-hue); }
    .amk-area__hit  { fill: transparent; }
    .amk-area__hit:hover { fill: rgba(0, 0, 0, .04); }

    /* ---- the gauge: half a circle, because the clock is the headline ----

       A full ring beside a figure that rewrites itself every second was two
       things asking to be watched. Half a circle says the same share and
       leaves the eye somewhere to rest. */
    /* height from the viewBox, not pinned: the figure moved below the arc
       and a fixed height would have squashed the two back together. */
    .amk-gauge { flex: none; width: 84px; height: auto; display: block; }
    .amk-gauge__track { stroke: var(--amk-track); }
    .amk-gauge__fill  { stroke: var(--amk-hue); transition: stroke-dasharray .4s ease; }
    .amk-gauge__label {
        font-size: 9.5px; font-weight: 700; fill: var(--amk-ink); text-anchor: middle;
    }
    .amk-gauge__cap {
        font-size: 4.4px; fill: var(--amk-ink-soft); text-anchor: middle;
        letter-spacing: .06em; text-transform: uppercase;
    }

    /* ---- the rail: the same share, drawn across instead of round ----

       A caption and a figure over a track, which is how the reference
       dashboards draw this. The two labels wear the text inks rather than
       the tile's hue: at 12px they would need 4.5 to one, which is a harder
       floor than a mark has to clear, and tying them to the hue is what put
       unreadable text on the last version of these cards. The hue is on the
       fill, where it is a mark and 3:1 is the bar it has to clear. */
    .amk-track {
        display: grid; grid-template-columns: minmax(0, 1fr) auto;
        gap: 3px 8px; margin-top: 16px;
    }
    .amk-track__cap {
        font-size: 12px; color: var(--amk-ink-soft);
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .amk-track__pct {
        font-size: 12px; font-weight: 600; color: var(--amk-ink);
        text-align: end; font-variant-numeric: tabular-nums;
    }
    .amk-track__rail {
        grid-column: 1 / -1; height: 8px; border-radius: 999px;
        background: var(--amk-track); overflow: hidden;
    }
    .amk-track__fill {
        display: block; height: 100%; border-radius: 999px;
        background: var(--amk-hue);
        /* the same keyframe the meters use: a `from` and no `to`, so it ends
           at the width the figure already set */
        animation: amk-grow .9s cubic-bezier(.22, .61, .36, 1) both;
    }

    /* ---- the certificate list: one row per standard ----

       Here, and only here, a red and a green are the right colours. These
       are states - run out, running out, in date - not four things being
       told apart, and a client reading this card is looking for exactly the
       thing a red is for. The rule that goes with status colour is that it
       is never the only channel, and it is not: every row carries an icon,
       the state as a word, the date, and the day count.

       Measured against white: expired 5.46, due soon 3.58, in date 3.45,
       not recorded 3.32 - all above the 3:1 a mark needs. Only the dot and
       the rail wear them; the text stays in the ink tokens, because 11.5px
       would need 4.5 and tying small text to a status hue is how unreadable
       labels get onto a page. */
    .amk-certs { list-style: none; margin: 10px 0 0; padding: 0; }
    .amk-cert {
        display: grid; grid-template-columns: 16px minmax(0, 1fr) auto;
        align-items: center; gap: 3px 8px; padding: 9px 0;
    }
    .amk-cert + .amk-cert { border-top: 1px solid #eef1f5; }
    .amk-cert__ico {
        grid-row: 1; width: 16px; text-align: center;
        font-size: 12px; line-height: 1; color: var(--amk-state);
    }
    .amk-cert__name {
        grid-row: 1; font-size: 13px; font-weight: 600; color: var(--amk-ink);
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .amk-cert__days {
        grid-row: 1; text-align: end; font-size: 12px; font-weight: 600;
        color: var(--amk-ink); font-variant-numeric: tabular-nums; white-space: nowrap;
    }
    .amk-cert__meta {
        grid-row: 2; grid-column: 2 / -1; font-size: 11.5px;
        color: var(--amk-ink-soft); line-height: 1.35;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .amk-cert__rail {
        grid-row: 3; grid-column: 2 / -1; height: 6px; margin-top: 3px;
        border-radius: 999px; background: var(--amk-track); overflow: hidden;
    }
    .amk-cert__fill {
        display: block; height: 100%; border-radius: 999px;
        background: var(--amk-state);
        animation: amk-grow .9s cubic-bezier(.22, .61, .36, 1) both;
    }
    /* the state each row is in, as one variable the row's own marks read */
    .amk-cert--expired { --amk-state: #C92A2A; }
    .amk-cert--soon    { --amk-state: #E8590C; }
    .amk-cert--current { --amk-state: #2F9E44; }
    .amk-cert--none    { --amk-state: #868E96; }

    /* a row answers to the keyboard as well as the mouse, so the tooltip is
       not something only a pointer can reach */
    .amk-cert:focus-visible,
    [data-amk-tip]:focus-visible { outline: 2px solid var(--amk-hue); outline-offset: 3px; }

    /* ---- the tooltip every mark shares ----

       Fixed rather than absolute, and moved to the end of <body> when the
       script starts: the tiles sit inside the main column, and an ancestor
       with its own overflow would otherwise clip a tooltip reaching past a
       card's edge.

       pointer-events: none matters more than it looks. Without it the
       tooltip appears under the cursor, takes the hover from the mark that
       opened it, and the pair flicker against each other. */
    /* What colour the tooltip takes, per card and per mark.

       A DEEP step of the mark's hue, not the hue itself. White text at 12px
       needs 4.5 to one and the marks run 3.12 to 5.46 - orange, teal, green
       and grey would each have given a bright tooltip nobody could read,
       which is worse than the black one. These measure 7.04, 7.63, 8.06,
       8.80, 8.97, 9.02 and 9.23, and each is recognisably its own hue. */
    .amk-tile                { --amk-tip-bg: #343A40; }
    .amk-tile--objectives    { --amk-tip-bg: #1D3FA8; }
    .amk-tile--requirements  { --amk-tip-bg: #9A3A08; }
    .amk-tile--training      { --amk-tip-bg: #06603F; }
    .amk-tile--certificates  { --amk-tip-bg: #722A85; }
    .amk-tile--activity      { --amk-tip-bg: #1D3FA8; }

    /* and where a mark means something of its own, that wins over its card */
    .amk-cert--expired       { --amk-tip-bg: #8A1D1D; }
    .amk-cert--soon          { --amk-tip-bg: #9A3A08; }
    .amk-cert--current       { --amk-tip-bg: #1A5C27; }
    .amk-cert--none          { --amk-tip-bg: #434A52; }
    .amk-seg--achieved       { --amk-tip-bg: #1A5C27; }
    .amk-seg--on_track       { --amk-tip-bg: #1D3FA8; }
    .amk-seg--not_started    { --amk-tip-bg: #434A52; }
    .amk-seg--at_risk        { --amk-tip-bg: #9A3A08; }
    .amk-seg--not_achieved   { --amk-tip-bg: #8A1D1D; }
    .amk-seg--several        { --amk-tip-bg: #05402E; }
    .amk-seg--one            { --amk-tip-bg: #06603F; }
    .amk-seg--none           { --amk-tip-bg: #434A52; }

    .amk-tip {
        position: fixed; z-index: 1090; max-width: 260px;
        padding: 7px 10px; border-radius: 6px;
        background: #343A40; color: #ffffff;
        font-size: 12px; font-weight: 500; line-height: 1.45;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .18);
        pointer-events: none;
    }
    /* some of this site's older stylesheets do not honour the hidden
       attribute on their own, so it is spelled out */
    .amk-tip[hidden] { display: none; }

    /* ---- the segmented bar: one whole split three ways ----

       Three steps of the theme blue, not green/grey/red. The colours were
       never what told these apart anyway: every part carries a tick, a dash
       or a cross, its name, and its count, which is three channels before
       hue. Green and red measured 4.0 apart under deuteranopia against a
       target of 8, so for a large minority of readers they were already the
       same colour - and on a page with one hue everywhere else they were the
       only thing shouting.

       The steps are measured, not picked: 9.51, 2.39 and 5.27 to one against
       white, the lightest clearing the 2:1 an ordinal ramp needs; adjacent
       blocks sit 3.97 and 2.20 apart. The label inside each follows its own
       fill - white on the two dark ones, near-black on the light one - at
       9.51, 8.23 and 5.27, all clear of the 4.5 that 11px bold needs.

       The 2px gaps are surface, not strokes. */
    .amk-seg {
        display: flex; gap: 2px; height: 26px; margin: 4px 0 14px;
        background: #ffffff;
    }
    .amk-seg__part {
        min-width: 0; border-radius: 4px;
        display: flex; align-items: center; padding-inline-start: 7px;
        font-size: 11px; font-weight: 600; white-space: nowrap;
    }
    .amk-seg__part--yes { background: #2E3B9A; color: #ffffff; }
    .amk-seg__part--na  { background: #9fa5d1; color: #0b0b0b; }
    .amk-seg__part--no  { background: #5c66b0; color: #ffffff; }
    /* nothing answered yet: an empty track. Light enough to read as
       "no data", dark enough to be seen on the card - the tint at 12%
       was 1.08 to one against white and simply vanished. */
    .amk-seg__part--none { background: #dde1ee; }

    .amk-legend { list-style: none; margin: 0; padding: 0; }
    .amk-legend li {
        display: flex; align-items: center; gap: 8px;
        padding: 2px 0; font-size: 12px; color: var(--amk-ink);
    }
    .amk-legend__sw { flex: none; width: 10px; height: 10px; border-radius: 3px; }
    .amk-legend__sw--yes { background: #2E3B9A; }
    .amk-legend__sw--na  { background: #9fa5d1; }
    .amk-legend__sw--no  { background: #5c66b0; }
    /* the channel that is not colour */
    .amk-legend__ico { flex: none; width: 11px; text-align: center; color: var(--amk-ink-soft); }
    .amk-legend__name { flex: 1 1 auto; min-width: 0; overflow: hidden; text-overflow: ellipsis; }
    .amk-legend__n { font-weight: 600; font-variant-numeric: tabular-nums; }

    /* ---- the meter list: one row per thing scored, each out of ten ---- */
    .amk-meters { margin-top: 2px; }
    .amk-meter {
        display: grid; grid-template-columns: minmax(0, 1fr) 34px;
        align-items: center; gap: 1px 8px; padding: 4px 0;
    }
    .amk-meter__name {
        font-size: 12px; color: var(--amk-ink);
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .amk-meter__val {
        font-size: 12px; font-weight: 600; text-align: end;
        font-variant-numeric: tabular-nums;
    }
    .amk-meter__track {
        grid-column: 1 / -1; height: 7px; border-radius: 999px;
        background: var(--amk-tint); overflow: hidden;
    }
    .amk-meter__fill {
        display: block; height: 100%; min-width: 3px; border-radius: 999px;
        background: var(--amk-hue);
    }

    /* ---- they fill in when the page arrives ----

       Each keyframe set has a `from` and no `to`, so the end of every
       animation is the element's own computed style - the width the figure
       already set, the arc the ring already carries. Nothing is restated
       here, which means an animation can never disagree with the number it
       is drawing.

       `both` holds the `from` before the animation starts, so a bar is not
       seen at full width for one frame and then snapped back. */
    @keyframes amk-grow { from { width: 0; } }
    /* A bar grows out of the axis, which means scaling about its own
       bottom edge - fill-box, because an SVG shape's transform origin is
       otherwise the whole canvas and the bar would slide off it. */
    @keyframes amk-rise { from { transform: scaleY(0); } }
    .amk-chart__bar {
        transform-box: fill-box; transform-origin: bottom;
        animation: amk-rise .8s cubic-bezier(.22, .61, .36, 1) both;
    }
    @keyframes amk-draw { from { stroke-dasharray: 0 100; } }
    /* The segmented bar is revealed, not grown. Its three parts are sized by
       flex-grow against each other, so animating that only re-proportions
       them - all three start equal and the bar is full width the whole time,
       which is not what anyone means by "it fills in". A clip does what the
       eye expects and touches no layout at all. */
    @keyframes amk-open {
        from { clip-path: inset(0 100% 0 0); }
        to   { clip-path: inset(0 0 0 0); }
    }

    .amk-meter__fill { animation: amk-grow .9s cubic-bezier(.22, .61, .36, 1) both; }
    .amk-ring__fill  { animation: amk-draw 1.1s cubic-bezier(.22, .61, .36, 1) both; }
    .amk-donut__seg  { animation: amk-draw 1.1s cubic-bezier(.22, .61, .36, 1) both; }
    .amk-gauge__fill { animation: amk-draw 1.1s cubic-bezier(.22, .61, .36, 1) both; }
    .amk-seg        { animation: amk-open .9s cubic-bezier(.22, .61, .36, 1) both; }

    /* someone who asked their system for less movement gets the finished
       figures straight away, not a slower version of the same thing */
    @media (prefers-reduced-motion: reduce) {
        .amk-ring__fill, .amk-meter__fill, .amk-seg, .amk-track__fill,
        .amk-cert__fill, .amk-chart__bar, .amk-donut__seg, .amk-gauge__fill {
            animation: none;
            transition: none;
        }
        /* and no clock at all. The script checks the same preference and
           never starts, so leaving this visible would show a clock stopped
           at page load, which reads as broken - and the day count above it
           already says everything the seconds were adding to it. */
        .amk-tile__clock { display: none; }
    }
</style>
@if ($amkShown->count())
<div class="amk amk-grid amk-grid--{{ $amkShown->count() }}">
@foreach ($amkShown as $t)
    @include('dashboard.partials.dash_charts_tile', ['t' => $t, 'charts' => $charts])
@endforeach
</div>
@endif

{{-- $amkWides is empty now: nothing on this dashboard takes a whole row.
     The loop stays because the next card that needs one will go in it. --}}
@if ($amkWides->count())
<div class="amk amk-grid amk-grid--1">
@foreach ($amkWides as $t)
    @include('dashboard.partials.dash_charts_tile', ['t' => $t, 'charts' => $charts])
@endforeach
</div>
@endif

@if ($amkDetails->count())
{{-- Half width and never narrower. A bar split three ways and a list of
     four scores both need the room; at a quarter they would be unreadable,
     which is the whole reason these two are not rings. --}}
<div class="amk amk-grid {{ $amkDetails->count() > 1 ? 'amk-grid--half' : 'amk-grid--1' }}">
@foreach ($amkDetails as $t)
    @include('dashboard.partials.dash_charts_tile', ['t' => $t, 'charts' => $charts])
@endforeach
</div>
@endif

{{-- The certificate countdown.

     The day count is rendered by the server and is right when the page
     arrives; this keeps it right afterwards. A dashboard gets left open, and
     a tile that says "412 days" at nine in the morning is saying the wrong
     thing by midnight.

     It depends on nothing. No jQuery, no Chart.js - Chart.js is loaded in
     the footer, AFTER this partial, so anything here that needed it would
     run too early - and no library at all. If the script never runs, the
     figures below it are the ones the server wrote, and they are correct. --}}
<script>
(function () {
    'use strict';

    var boxes = document.querySelectorAll('[data-amk-ends]');
    if (!boxes.length) return;

    /* Somebody who asked their system for less movement gets the figure the
       server rendered and no clock - the stylesheet hides it under the same
       preference. The two have to go together: hiding it without stopping
       this would rewrite an element nobody can see, and stopping this
       without hiding it would leave a clock frozen at page load. */
    var still = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)');
    if (still && still.matches) return;

    function pad(n) { return (n < 10 ? '0' : '') + n; }

    function tick() {
        var now = Math.floor(Date.now() / 1000);

        for (var i = 0; i < boxes.length; i++) {
            var box  = boxes[i];
            /* a unix timestamp, so the browser's own timezone cannot shift
               it - when the certificate runs out is the server's rule */
            var ends = parseInt(box.getAttribute('data-amk-ends'), 10);
            if (!ends) continue;

            var left = box.getAttribute('data-amk-dir') === 'up' ? now - ends : ends - now;

            /* A countdown that reaches nought while the page is open stops
               there rather than turning itself into a count-up: the line
               underneath still reads "days until", and only a reload changes
               that wording. A clock stopped on the deadline is better than a
               tile whose figure and sentence disagree. */
            if (left < 0) left = 0;

            var clock = box.querySelector('.amk-tile__clock');
            if (clock) {
                clock.textContent = pad(Math.floor(left % 86400 / 3600)) + ':'
                                  + pad(Math.floor(left % 3600 / 60)) + ':'
                                  + pad(left % 60);
            }

            /* The day count is the same quantity as the clock, so it is
               written from the same number and never counted down on its
               own. That is the whole reason the two cannot drift apart. */
            var days  = box.querySelector('[data-amk-days]');
            var whole = String(Math.floor(left / 86400));
            if (days && days.textContent !== whole) days.textContent = whole;
        }
    }

    tick();
    setInterval(tick, 1000);
})();
</script>

{{-- The tooltip every mark on these tiles shares. One element, moved to the
     end of <body> by the script below, rather than one per mark. --}}
<div class="amk-tip" id="amkTip" role="tooltip" hidden></div>
<script>
(function () {
    'use strict';

    var tip = document.getElementById('amkTip');
    if (!tip) return;
    /* out of the main column, so a card's own overflow cannot clip it */
    if (tip.parentNode !== document.body) document.body.appendChild(tip);

    var openOn = null;

    /* Walk up by hand rather than with closest(). The marks here include
       <svg> and <circle>, and Element.closest on an SVG element is not
       something every browser this site still serves can be relied on for. */
    function tipFor(node) {
        while (node && node !== document) {
            if (node.getAttribute && node.getAttribute('data-amk-tip')) return node;
            node = node.parentNode;
        }
        return null;
    }

    function hide() {
        if (!openOn) return;
        tip.hidden = true;
        openOn = null;
    }

    function show(el) {
        var text = el.getAttribute('data-amk-tip');
        if (!text) return;

        tip.textContent = text;

        /* The colour comes from the mark, as a custom property it inherits
           from its card - so a certificate row that has run out opens a red
           tooltip and the objective segment beside it opens a green one,
           without either of them having to know a tooltip exists.

           A browser that gives nothing back here leaves the dark default in
           place, which is why that default is a real colour and not a
           missing one. */
        var bg = '';
        try {
            bg = (getComputedStyle(el).getPropertyValue('--amk-tip-bg') || '').trim();
        } catch (e) { bg = ''; }
        tip.style.background = bg || '#343A40';

        tip.hidden = false;          // unhidden first: it has to be measurable

        var mark = el.getBoundingClientRect();
        var box  = tip.getBoundingClientRect();
        var gap  = 10, pad = 8;

        var left = mark.left + (mark.width - box.width) / 2;
        var top  = mark.top - box.height - gap;

        /* kept on the screen. A tooltip half off the left edge is worse than
           one that is not quite centred over its mark. */
        if (left < pad) left = pad;
        if (left + box.width > window.innerWidth - pad) {
            left = window.innerWidth - pad - box.width;
        }
        /* no room above - the top row of tiles sits under a fixed header -
           so it goes underneath instead */
        if (top < pad) top = mark.bottom + gap;

        tip.style.left = Math.round(left) + 'px';
        tip.style.top  = Math.round(top) + 'px';
        openOn = el;
    }

    document.addEventListener('mouseover', function (e) {
        var el = tipFor(e.target);
        if (el) { if (el !== openOn) show(el); }
        else hide();
    });
    /* the keyboard gets the same thing the mouse gets */
    document.addEventListener('focusin',  function (e) {
        var el = tipFor(e.target);
        if (el) show(el);
    });
    document.addEventListener('focusout', hide);
    /* a tooltip left behind by a scroll points at nothing */
    window.addEventListener('scroll', hide, true);
    window.addEventListener('resize', hide);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.keyCode === 27) hide();
    });
})();
</script>
