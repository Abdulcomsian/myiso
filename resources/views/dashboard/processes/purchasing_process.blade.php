@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

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

    <div class="am-page-header">
        <div>
            <h2>QP2 – Purchasing Process</h2>
            <p>Process flow chart for purchasing</p>
        </div>
        <div class="am-page-header__actions" style="display:flex;gap:10px;align-items:center;">
            @if($img_exist == "Yes")
            <form action="{{ url('purchprocess') }}" method="post" style="display:inline;">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <button type="submit" class="am-btn am-btn-outline am-btn-sm">
                    <i class="fa fa-trash"></i> Remove Image
                </button>
            </form>
            @endif
            <button class="am-btn am-btn-primary am-btn-sm" onclick="workInstructionFrom()">
                <i class="fa fa-upload"></i> Upload Process Image
            </button>
        </div>
    </div>

    {{-- Upload Form --}}
    <div class="am-card work_instruction_from_div" style="display:none; margin-bottom:20px;">
        <div class="am-card__body am-form">
            <form enctype="multipart/form-data" action="{{ url('uploadimg') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <div class="form-row">
                    <div class="form-col">
                        <label>Upload Photo</label>
                        <input type="file" class="form-control" name="purch_process_photo">
                    </div>
                </div>
                <div style="margin-top:14px;">
                    <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Submit</button>
                    <button type="button" class="am-btn am-btn-outline" onclick="workInstructionFrom()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Process Display --}}
    <div class="am-card">
        <div class="am-card__body" style="padding:32px; line-height:1.8;">
            @if($img)
            <div style="margin-bottom:20px;">
                <img src="{{ $img }}" class="img-fluid" style="max-width:100%; border-radius:8px;">
            </div>
            @endif
            <p>This process is to be used when purchasing goods or services from an external supplier.</p>
            <p><strong>Input:</strong> The requirement to purchase.</p>
            <p><strong>Output:</strong> Reception and implementation of supplied goods or services.</p>
            <p><strong>Process owner:</strong> {{ Auth::user()->purchasing_process }}</p>
        </div>
    </div>

</div>
@endsection
