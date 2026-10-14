@extends('admin.dashboard.layouts.app')

@section('content')
@php
    // whose objectives these are; every form has to say so, because the
    // controller takes the owner from the request when an admin is signed in
    $ownerId = $ownerId ?? request()->route('userid');
@endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="About Objectives Tracker" aria-label="About Objectives Tracker">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>Objectives Tracker</h2>
            </div>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$ownerId) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    @if(session('Success'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('Success') }}
        </div>
    @endif

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/objectivesCheck/' . $ownerId) }}" class="am-search" id="amObjSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amObjSearch" value="{{ $search ?? '' }}" placeholder="Search objectives…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleObjForm">
                <i class="fa fa-plus"></i> Add Objective
            </button>
        </div>

        <div class="am-inline-form" id="newObjForm" style="margin:16px 20px;">
            <form action="{{ route('objective.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $ownerId }}">
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Objective *</label><input type="text" name="objective" placeholder="Reduce general waste sent to landfill by 15%" required></div>
                </div>
                <div class="form-row">
                    <div><label>How it is measured *</label><input type="text" name="how_measured" placeholder="Monthly waste weight on supplier invoices" required></div>
                    <div><label>Starting point</label><input type="text" name="starting_point" placeholder="4.2 tonnes in 2025"></div>
                    <div><label>Target *</label><input type="text" name="target" placeholder="3.6 tonnes or less" required></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>How will this be achieved</label><textarea name="how_achieved" rows="3" placeholder="Add recycling bins to every station; train staff at the April team meeting; switch to a supplier that recycles cardboard"></textarea></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Person responsible *</label>
                        <select name="person_responsible" required>
                            <option value="">Choose employee…</option>
                            @foreach ($employees as $emp)
                                <option value="{{ trim($emp->first_name . ' ' . $emp->surname) }}">{{ trim($emp->first_name . ' ' . $emp->surname) ?: $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @include('dashboard.form_records.partials.objective_agreed_field', ['uid' => 'add', 'cls' => ''])
                    </div>
                    <div><label>Deadline *</label><input type="date" max="2999-12-31" name="deadline" required></div>
                    <div>
                        <label>Status</label>
                        <select name="status">
                            @foreach (App\Objective::statuses() as $key => $st)
                                <option value="{{ $key }}" {{ $key === 'not_started' ? 'selected' : '' }}>{{ $st['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelObjForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Objective</button>
                </div>
            </form>
        </div>
    </div>

    {{-- What each status means --}}
    <div class="am-card" style="margin-bottom:16px;padding:16px 20px;background:rgba(46,59,154,0.04);border:1px solid var(--am-primary);">
        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-primary);font-weight:600;margin-bottom:12px;">What each status means</div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px 18px;">
            @foreach (App\Objective::statuses() as $st)
                <div>
                    <span class="am-chip {{ $st['chip'] }}">{{ $st['label'] }}</span>
                    <div style="font-size:12.5px;color:var(--am-text);line-height:1.5;margin-top:6px;">{{ $st['means'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="am-card">
        <div id="amObjContainer">
            @include('dashboard.form_records.partials.objectives_table')
        </div>
    </div>
</div>

{{-- View modal --}}
@include('dashboard.form_records.partials.objective_modals', ['evidenceId' => 'objAdminEvidence', 'ownerId' => $ownerId])

@include('dashboard.form_records.partials.objective_scripts', ['listUrl' => url('/objectivesCheck/' . $ownerId), 'ownerId' => $ownerId])
{{-- The guide behind the "i" beside the title --}}
@include('dashboard.form_records.partials.guides.objectives_tracker')

@endsection
