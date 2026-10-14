{{--
    Everything inside the Management Review form: who met and when, the twelve
    questions in their two parts, then Part 3.

    Shared by the add form and the edit modal, user side and admin side, so no
    copy of the form can drift from another.

    $prefix   'add' or 'edit'
    $answers  the answers keyed by question number, 'A' for the decisions
    $review   the review being edited, or null when adding
--}}
@php
    $L     = App\MgtReviewQuestions::labels();
    $parts = App\MgtReviewQuestions::parts();
    $qs    = App\MgtReviewQuestions::all();
    $p     = $prefix ?? 'add';
    $rev   = $review ?? null;
@endphp

{{-- the intro the client wrote, above the form. The three standards are chips
     there, so they are chips here: the same ones every question wears. --}}
@php
    $chips = App\MgtReviewQuestions::badgeChips();
    $three = array_slice(array_keys($chips), 1);       // all but "All standards"
@endphp
<div class="mr-intro">
    <p>
        <strong class="mr-intro__lead">{{ $L['intro_lead'] }}</strong>
        {{ $L['intro_a'] }}
        @foreach ($three as $i => $badge)
            @if ($i === count($three) - 1) {{ $L['intro_or'] }} @endif
            <span class="am-chip {{ $chips[$badge] }}">{{ $badge }}</span>
        @endforeach
        {{ $L['intro_b'] }}
    </p>
    {{-- "Where to look" is picked out here the way it is in the client's
         document, because it names the panel further down the form --}}
    <p>
        <strong class="mr-intro__lead">{{ $L['before'] }}</strong>
        {{ $L['before_a'] }}
        <strong class="mr-intro__lead">{{ $L['before_where'] }}</strong>
        {{ $L['before_b'] }}
    </p>
</div>

<div class="mr-meta">
    <div>
        <label>{{ $L['reviewdate'] }}</label>
        <input type="date" max="2999-12-31" name="reviewdate" value="{{ $rev->reviewdate ?? '' }}" required>
    </div>
    <div>
        <label>{{ $L['chairedby'] }}</label>
        <input type="text" name="chairedby" value="{{ $rev->chairedby ?? '' }}" placeholder="{{ $L['chairedby_ph'] }}">
        <div class="mr-hint">{{ $L['chairedby_hint'] }}</div>
    </div>
    <div>
        <label>{{ $L['attendees'] }}</label>
        <textarea name="meetingatt" rows="2" placeholder="{{ $L['attendees_ph'] }}">{{ $rev->meetingatt ?? '' }}</textarea>
    </div>
    <div>
        <label>{{ $L['nextdue'] }}</label>
        <input type="date" max="2999-12-31" name="nextreviewdue" value="{{ $rev->nextreviewdue ?? '' }}">
        <div class="mr-hint">{{ $L['nextdue_hint'] }}</div>
    </div>
</div>

@foreach ([1, 2] as $partNo)
    <div class="mr-part-head">
        <span class="mr-part-head__label">{{ $parts[$partNo]['label'] }}</span>
        <span class="mr-part-head__title">{{ $parts[$partNo]['title'] }}</span>
    </div>
    @foreach ($qs as $q)
        @if ($q['part'] === $partNo)
            @include('dashboard.form_records.partials.mgtreview_question_card', [
                'q' => $q,
                'prefix' => $p,
                'answers' => $answers ?? [],
            ])
        @endif
    @endforeach
@endforeach

<div class="mr-part-head">
    <span class="mr-part-head__label">{{ $parts[3]['label'] }}</span>
    <span class="mr-part-head__title">{{ $parts[3]['title'] }}</span>
</div>
@include('dashboard.form_records.partials.mgtreview_part3', [
    'prefix' => $p,
    'answers' => $answers ?? [],
    'review' => $rev,
])
