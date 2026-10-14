@extends('admin.dashboard.layouts.app')

@section('content')
@php
    $L       = App\MgtReviewQuestions::labels();
    $rev     = $editing ?? null;
    $listUrl = url('/managementCheck/' . $userid);
    $amMgtWords = [
        'decisions'  => App\MgtReviewQuestions::decisions()['label'],
        'objectives' => App\MgtReviewQuestions::objectives()['title'],
        'actions'    => App\MgtReviewQuestions::actions()['title'],
        'files'      => App\MgtReviewQuestions::files()['title'],
        'cols'       => App\MgtReviewQuestions::actions()['columns'],
        'meta'       => [$L['reviewdate'], $L['chairedby'], $L['attendees'], $L['nextdue']],
        'evidence'   => $L['attach'],
        'none'       => '—',
    ];
@endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="{{ $L['page_title'] }}" aria-label="{{ $L['page_title'] }}">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>{{ $L['page_title'] }}</h2>
            </div>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$userid) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    @if ($message = Session::get('message'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ $listUrl }}" class="am-search" id="amMgtSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amMgtSearch" value="{{ $search ?? '' }}" placeholder="{{ $L['search_ph'] }}" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleMgtForm">
                <i class="fa fa-plus"></i> {{ $L['add_review'] }}
            </button>
        </div>

        <div class="am-inline-form {{ $rev ? 'open' : '' }}" id="newMgtForm" style="margin:16px 20px;">
            <form action="{{ $rev ? route('mgtreviewupdate') : route('mgtreview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userid }}">
                <input type="hidden" name="is_admin" value="admin">
                @if ($rev)
                    <input type="hidden" name="id" value="{{ $rev->id }}">
                    <input type="hidden" name="back" value="{{ $listUrl }}">
                @else
                    <input type="hidden" name="mgtreviewId" value="241">
                @endif

                @include('dashboard.form_records.partials.mgtreview_form_body', [
                    'prefix'  => $rev ? 'edit' : 'add',
                    'answers' => $answers ?? [],
                    'review'  => $rev,
                ])

                <div class="form-actions">
                    @if ($rev)
                        <a class="am-btn am-btn-outline am-btn-sm" id="cancelMgtForm" href="{{ $listUrl }}">{{ $L['cancel'] }}</a>
                    @else
                        <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelMgtForm">{{ $L['cancel'] }}</button>
                    @endif
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm">
                        <i class="fa fa-check"></i> {{ $rev ? $L['update'] : $L['save'] }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('dashboard.form_records.partials.mgtreview_banner')

    <div class="am-card">
        <div id="amMgtContainer">
            @include('admin.adminform_records.partials.management_reviews_table')
        </div>
    </div>
</div>

{{-- Page guide --}}
@include('dashboard.form_records.partials.guides.managment_reviews')

@include('dashboard.form_records.partials.mgtreview_modals')

<script>
var amMgtWords = @json($amMgtWords);
</script>
@include('dashboard.form_records.partials.mgtreview_scripts', ['listUrl' => $listUrl])
@endsection
