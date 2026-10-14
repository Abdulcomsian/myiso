{{-- The two panels on a Management Review question: what to bring on the left,
     a good answer on the right. Shared so every copy of the form - add, edit,
     user and admin - says the same thing.

     $q     the question, or one of the Part 3 sections
     $head  the heading over the left panel, defaulting to "What to bring"
--}}
@php
    $L  = App\MgtReviewQuestions::labels();
    $lh = $head ?? $L['bring_head'];
    // Part 3 B has no example beside it, so its panel runs the full width,
    // the way the client's document draws it
    $solo = empty($q['eg']);
@endphp
<div class="qms-panels {{ $solo ? 'qms-panels--solo' : '' }}">

    <div class="qms-panel qms-panel--check">
        <div class="qms-panel__head">{{ $lh }}</div>
        <ul>
            @foreach ($q['bring'] as [$line, $tags])
                <li>
                    @foreach ($tags as $tag)
                        <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$tag] ?? '' }}" style="font-size:10.5px;padding:2px 8px;margin-inline-end:6px;">{{ $tag }}</span>
                    @endforeach
                    {{ $line }}
                </li>
            @endforeach
        </ul>
        @if (!empty($q['where']) || !empty($q['where_text']))
            <div class="qms-panel__where">
                <strong>{{ $L['where_head'] }}</strong>
                @if (!empty($q['where_text']))
                    {{ $q['where_text'] }}
                @else
                    @foreach ($q['where'] as $w)
                        @if ($w[1])<a href="{{ url($w[1]) }}" target="_blank">{{ $w[0] }}</a>@else{{ $w[0] }}@endif{{ $w[2] ? ' ' . $w[2] : '' }}{{ $loop->last ? '' : ',' }}
                    @endforeach
                @endif
            </div>
        @endif
    </div>

    @if (!empty($q['eg']))
        <div class="qms-panel qms-panel--tick">
            <div class="qms-panel__head">{{ $L['eg_head'] }}</div>
            <div style="font-size:13.5px;line-height:1.55;color:var(--am-text);">{{ $q['eg'] }}</div>
        </div>
    @endif

</div>
