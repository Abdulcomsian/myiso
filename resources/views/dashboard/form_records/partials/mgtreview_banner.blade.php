{{-- The line above the list when a review still has actions nobody has ticked
     off. The wording comes from App\MgtReviewQuestions, so both languages read
     the same shape. --}}
@if (!empty($openBanner))
    @php
        $L    = App\MgtReviewQuestions::labels();
        $n    = $openBanner['open'];
        $when = $openBanner['date'] ? date('d.m.Y', strtotime($openBanner['date'])) : '';
        $line = strtr($n == 1 ? $L['banner_one'] : $L['banner_many'], [':n' => $n, ':date' => $when]);
        if (!empty($openBanner['nextdue'])) {
            $line .= ' ' . strtr($L['banner_next'], [':date' => date('d.m.Y', strtotime($openBanner['nextdue']))]);
        }
    @endphp
    <div class="mr-banner">
        <span class="am-chip warning">{{ strtr($L['chip_open'], [':n' => $n]) }}</span>
        <span>{{ $line }}</span>
    </div>
@endif
