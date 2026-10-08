{{--
    One audit question, as the client drew it: the number, the question, the
    standards it covers, the "what to check" / "when to tick" panels, the
    answer, and the evidence.

    $q        the question, from App\QmsAuditQuestions
    $style    how its panels open - 'inline' slides them open under the
              question, 'modal' points at the overlay the page writes once.
              Only the first two carry one while the client decides.
    $answers  what was answered last time, keyed by question number
    $notes    kept for the stored notes column; the form asks for the file only
--}}
@php
    $qNo      = $q['no'];
    $style    = $style ?? null;
    $prev     = $answers[$qNo] ?? null;
@endphp

<div class="qms-question" data-qms-q="{{ $qNo }}">

    <div class="qms-question__head">
        <span class="qms-question__no">{{ $qNo }}</span>
        <div class="qms-question__title">{{ $q['title'] }}</div>
        @if ($style)
            <button type="button" class="am-page-guide-btn qms-guide-toggle"
                style="width:26px;height:26px;font-size:12px;flex-shrink:0;"
                @if ($style === 'modal') data-qms-modal="qmsQ{{ $qNo }}" @endif
                title="What to check for question {{ $qNo }}"
                aria-label="What to check for question {{ $qNo }}"><i class="fa fa-info-circle"></i></button>
        @endif
        <div class="qms-question__badges">
            @foreach ($q['badges'] as $badge)
                <span class="am-chip {{ App\QmsAuditQuestions::badgeChips()[$badge] ?? '' }}">{{ $badge }}</span>
            @endforeach
        </div>
    </div>

    @if ($style === 'inline')
        <div class="qms-guide">
            @include('dashboard.form_records.partials.qms_question_panels', ['q' => $q])
        </div>
    @endif

    <div class="qms-question__answer">
        <label><input type="radio" name="q[{{ $qNo }}]" value="Yes" {{ $prev === 'Yes' ? 'checked' : '' }}> YES</label>
        <label><input type="radio" name="q[{{ $qNo }}]" value="No" {{ $prev === 'No' ? 'checked' : '' }}> NO</label>
        @if ($q['tick_na'])
            <label><input type="radio" name="q[{{ $qNo }}]" value="NA" {{ $prev === 'NA' ? 'checked' : '' }}> N/A</label>
        @endif
    </div>

    <div class="qms-question__evidence">
        <label>Evidence <span style="color:var(--am-text-soft);font-weight:500;text-transform:none;letter-spacing:0;">Attachment file (PDF, JPEG, TXT, DOCX, PNG)</span></label>
        <input type="file" name="qfile[{{ $qNo }}]" accept=".pdf,.jpg,.jpeg,.txt,.doc,.docx,.png">
    </div>
</div>
