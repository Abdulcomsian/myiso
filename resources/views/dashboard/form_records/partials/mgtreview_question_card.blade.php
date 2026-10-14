{{--
    One Management Review question, as the client drew it: the number, the
    question, the standards it covers, the "what to bring" and "a good answer"
    panels, then the answer and the file that supports it.

    $q        the question, from App\MgtReviewQuestions
    $prefix   'add' or 'edit', so the two copies of the form keep separate ids
    $answers  what was answered last time, keyed by question number

    The panels open in place behind the "i", exactly as they do on a QMS Audit
    question, so the two forms behave the same way.
--}}
@php
    $qNo    = $q['no'];
    $L      = App\MgtReviewQuestions::labels();
    $prev   = $answers[$qNo] ?? null;
    $pAns   = is_array($prev) ? ($prev['answer'] ?? '') : '';
    $fileId = 'mrFile' . ($prefix ?? 'add') . $qNo;
@endphp

<div class="qms-question" data-mr-q="{{ $qNo }}">

    <div class="qms-question__head">
        <span class="qms-question__no">{{ $qNo }}</span>
        <div class="qms-question__title">{{ $q['title'] }}</div>
        <button type="button" class="am-page-guide-btn qms-guide-toggle"
            title="{{ $L['bring_head'] }}" aria-label="{{ $L['bring_head'] }}"><i class="fa fa-info-circle"></i></button>
        <div class="qms-question__badges">
            @foreach ($q['badges'] as $badge)
                <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$badge] ?? '' }}">{{ $badge }}</span>
            @endforeach
        </div>
    </div>

    <div class="qms-guide">
        @include('dashboard.form_records.partials.mgtreview_panels', ['q' => $q])
    </div>

    {{-- the answer in the meeting's own words, and the file that supports it --}}
    <div class="qms-question__evidence mr-answer">
        <label>{{ $L['answer_head'] }}</label>
        <textarea name="mrq[{{ $qNo }}]" id="{{ $fileId }}-text" rows="4" placeholder="{{ $q['ph'] }}">{{ $pAns }}</textarea>
        @include('dashboard.form_records.partials.mgtreview_file_input', [
            'id'     => $fileId,
            'name'   => 'mrfile[' . $qNo . ']',
            'accept' => $L['accept'],
            'hint'   => $L['attach_hint'],
        ])
    </div>
</div>
