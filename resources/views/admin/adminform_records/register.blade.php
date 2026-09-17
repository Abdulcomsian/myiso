@extends('admin.dashboard.layouts.app')

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>{{ $module['title'] }}</h2>
            <p>{{ $module['subtitle'] }}</p>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$ownerId) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    {{-- Delete confirmation modal and modal close handlers come from the admin layout --}}
    @include('dashboard.form_records.partials.register_page')
</div>
@endsection
