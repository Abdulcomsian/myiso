@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Management Organogram</h2>
            <p>Upload and manage your organisation chart</p>
        </div>
        <div>
            @if($img_exist == "Yes")
                <form action="{{ url('mgmtorg') }}" method="post" class="d-inline">
                    @csrf
                    <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>"/>
                    <button type="submit" class="am-btn am-btn-outline">Remove Image</button>
                </form>
            @endif
            <a onclick="workInstructionFrom()" class="am-btn am-btn-primary ml-2"><i class="fa fa-upload"></i> Upload Image</a>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message') }}
        </div>
    @endif

    @if($errors->has('sales_process_photo'))
        <div class="alert alert-danger alert-dismissible">
            {{ $errors->first('sales_process_photo') }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif

    {{-- Upload Form Card --}}
    <div class="am-card work_instruction_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">Upload Organogram Image</h6>
            <form enctype="multipart/form-data" action="{{ url('uploadimg') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>"/>
                <div class="mb-3">
                    <label>Upload Photo:</label>
                    <input type="file" class="form-control mt-2" name="organogram">
                </div>
                <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
            </form>
        </div>
    </div>

    {{-- Organogram Display Card --}}
    @if($img)
        <div class="am-card">
            <div class="am-card__body" style="padding:32px; text-align:center;">
                <img src="{{ $img }}" class="img-fluid">
            </div>
        </div>
    @else
        <div class="am-card">
            <div class="am-card__body">
                <div class="am-empty">
                    <i class="fa fa-sitemap"></i>
                    <p>No organogram image uploaded yet. Click "ADD ALTERNATIVE PROCESS" to upload one.</p>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
