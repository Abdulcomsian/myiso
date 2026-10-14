{{--
    Part 3 of the Management Review: what you decided, the objectives for next
    year, who will do what by when, and the meeting files.

    $prefix   'add' or 'edit', so the two copies keep separate ids
    $answers  the answers keyed by question number; 'A' holds the decisions
    $review   the review being edited, or null when adding
--}}
@php
    $L    = App\MgtReviewQuestions::labels();
    $dec  = App\MgtReviewQuestions::decisions();
    $obj  = App\MgtReviewQuestions::objectives();
    $act  = App\MgtReviewQuestions::actions();
    $fil  = App\MgtReviewQuestions::files();
    $p    = $prefix ?? 'add';
    $prevDec = $answers['A'] ?? null;
    $decText = is_array($prevDec) ? ($prevDec['answer'] ?? '') : '';
    $rows    = isset($review) && $review ? $review->actions : collect();
    $myFiles = isset($review) && $review ? $review->files : collect();
@endphp

{{-- A: what did you decide? --}}
<div class="qms-question" data-mr-q="A">
    <div class="qms-question__head">
        <span class="qms-question__no">{{ $dec['key'] }}</span>
        <div class="qms-question__title">{{ $dec['title'] }}</div>
        <button type="button" class="am-page-guide-btn qms-guide-toggle" title="{{ $dec['head'] }}" aria-label="{{ $dec['head'] }}"><i class="fa fa-info-circle"></i></button>
        <div class="qms-question__badges">
            @foreach ($dec['badges'] as $badge)
                <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$badge] ?? '' }}">{{ $badge }}</span>
            @endforeach
        </div>
    </div>

    <div class="qms-guide">
        @include('dashboard.form_records.partials.mgtreview_panels', ['q' => $dec, 'head' => $dec['head']])
    </div>

    <div class="qms-question__evidence mr-answer">
        <label>{{ $dec['label'] }}</label>
        <textarea name="mrq[A]" rows="4" placeholder="{{ $dec['ph'] }}">{{ $decText }}</textarea>
    </div>
</div>

{{-- B: objectives for next year. The three boxes are the columns
     tbl_mgtreviews has always had, so nothing recorded before is lost. --}}
<div class="qms-question" data-mr-q="B">
    <div class="qms-question__head">
        <span class="qms-question__no">{{ $obj['key'] }}</span>
        <div class="qms-question__title">{{ $obj['title'] }}</div>
        <button type="button" class="am-page-guide-btn qms-guide-toggle" title="{{ $obj['head'] }}" aria-label="{{ $obj['head'] }}"><i class="fa fa-info-circle"></i></button>
        <div class="qms-question__badges">
            @foreach ($obj['badges'] as $badge)
                <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$badge] ?? '' }}">{{ $badge }}</span>
            @endforeach
        </div>
    </div>

    <div class="qms-guide">
        @include('dashboard.form_records.partials.mgtreview_panels', ['q' => $obj, 'head' => $obj['head']])
    </div>

    <div class="mr-objectives">
        @foreach ($obj['boxes'] as $box)
            @php
                $val   = isset($review) && $review ? ($review->{$box['field']} ?? '') : '';
                $boxId = 'mrObj' . $p . ucfirst($box['field']);
            @endphp
            {{-- four rows handed back to the grid: the chip, the heading, the
                 box, and the button. The three boxes then line up row for row
                 however long a heading runs. --}}
            <div class="mr-objective">
                <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$box['badge']] ?? '' }}">{{ $box['badge'] }}</span>
                <label class="mr-objective__name" for="{{ $boxId }}">{{ $box['label'] }}</label>
                <textarea id="{{ $boxId }}" name="{{ $box['field'] }}" rows="4" placeholder="{{ $box['ph'] }}">{{ $val }}</textarea>
                <div class="mr-objective__foot">
                    <input type="hidden" name="addtotracker[{{ $box['field'] }}]" value="0">
                    <button type="button" class="mr-dashed-btn mr-add-tracker"
                            data-field="{{ $box['field'] }}">{{ $obj['add_to_tracker'] }}</button>
                    <div class="mr-tracker-note" hidden>{{ $obj['added_note'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- C: who will do what, and by when --}}
<div class="qms-question" data-mr-q="C">
    <div class="qms-question__head">
        <span class="qms-question__no">{{ $act['key'] }}</span>
        <div class="qms-question__title">{{ $act['title'] }}</div>
        <div class="qms-question__badges">
            @foreach ($act['badges'] as $badge)
                <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$badge] ?? '' }}">{{ $badge }}</span>
            @endforeach
        </div>
    </div>

    <div class="am-table-wrap">
        <table class="am-table mr-actions-table" id="mrActions{{ $p }}">
            <thead>
                <tr>
                    @foreach ($act['columns'] as $i => $col)
                        <th @if($i === 3) style="width:70px;text-align:center;" @endif>{{ $col }}</th>
                    @endforeach
                    <th style="width:48px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $i => $row)
                    <tr>
                        <td><input type="text" name="mract[{{ $i }}][action]" value="{{ $row->action }}" placeholder="{{ $act['ph_action'] }}"></td>
                        <td><input type="text" name="mract[{{ $i }}][who]" value="{{ $row->who }}" placeholder="{{ $act['ph_who'] }}"></td>
                        <td><input type="date" max="2999-12-31" name="mract[{{ $i }}][when]" value="{{ $row->by_when }}"></td>
                        <td style="text-align:center;">
                            <input type="hidden" name="mract[{{ $i }}][done]" value="0">
                            <input type="checkbox" class="mr-done" name="mract[{{ $i }}][done]" value="1" {{ $row->done ? 'checked' : '' }}>
                        </td>
                        <td style="text-align:center;">
                            <button type="button" class="am-icon-btn danger mr-row-remove" title="{{ $L['remove'] }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="button" class="mr-dashed-btn mr-add-action" data-table="mrActions{{ $p }}">{{ $act['add'] }}</button>

    <div class="mr-note">{{ $act['note'] }}</div>
</div>

{{-- D: the minutes, slides, photos or video --}}
<div class="qms-question" data-mr-q="D">
    <div class="qms-question__head">
        <span class="qms-question__no">{{ $fil['key'] }}</span>
        <div class="qms-question__title">{{ $fil['title'] }}</div>
        <div class="qms-question__badges">
            @foreach ($fil['badges'] as $badge)
                <span class="am-chip {{ App\MgtReviewQuestions::badgeChips()[$badge] ?? '' }}">{{ $badge }}</span>
            @endforeach
        </div>
    </div>

    <div class="qms-question__evidence mr-answer">
        <label>{{ $fil['label'] }}</label>
        @if ($myFiles->count())
            <div class="mr-files">
                @foreach ($myFiles as $f)
                    <span class="mr-file-chip">
                        <a href="{{ $f->file }}" target="_blank">{{ $f->original_name ?: basename($f->file) }}</a>
                        <label title="{{ $L['remove'] }}"><input type="checkbox" name="mrfiledrop[]" value="{{ $f->id }}"> &times;</label>
                    </span>
                @endforeach
            </div>
        @endif
        @include('dashboard.form_records.partials.mgtreview_file_input', [
            'id'       => 'mrFiles' . $p,
            'name'     => 'mrfiles[]',
            'accept'   => $fil['accept'],
            'hint'     => $fil['hint'],
            'multiple' => true,
        ])
        {{-- the files just picked, each one with a cross to take it off again --}}
        <div class="mr-files mr-files--picked" hidden></div>
    </div>
</div>
