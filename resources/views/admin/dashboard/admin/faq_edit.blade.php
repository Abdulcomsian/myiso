@extends('admin.dashboard.layouts.app')

@section('styles')
<script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
<style>
    .am-form label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #6c757d;
        margin-bottom: 6px;
        text-align: left !important;
    }
    .am-form .form-control {
        border: 1px solid #e2e6ee;
        border-radius: 8px;
        background: #f9fafc;
        padding: 10px 14px;
        font-size: 13.5px;
        color: #212529;
        transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
    }
    .am-form .form-control:focus {
        outline: none;
        background: #fff;
        border-color: #5560C4;
        box-shadow: 0 0 0 3px rgba(46, 59, 154, 0.10);
    }
    .am-form .form-group { margin-bottom: 20px; }
</style>
@endsection

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>Edit FAQ</h2>
            <p>Update this frequently asked question.</p>
        </div>
        <div>
            <a href="{{ url('/all_faqs') }}" class="am-btn am-btn-outline"><i class="fa fa-arrow-left"></i> Back to FAQs</a>
        </div>
    </div>

    {{-- Flash message --}}
    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Form card --}}
    <div class="am-card am-form">
        <div class="am-card__header">
            <h3><i class="fa fa-pen" style="color:var(--am-primary);margin-right:8px;"></i> Update FAQ</h3>
        </div>

        <div style="padding:26px;">
            <form action="{{ url('/faq_update/'.$faq->id) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $faq->id }}">

                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" id="question" name="question" class="form-control" placeholder="Enter question" required value="{{ $faq->question }}">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select required name="category" id="category" class="form-control">
                        <option disabled value="">Select Category</option>
                        @foreach($all_cate as $cate)
                            <option value="{{ $cate->id }}" {{ $faq->category == $cate->id ? 'selected' : '' }}>{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea required name="answer" id="answer" class="form-control">{{ $faq->answer }}</textarea>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;border-top:1px solid var(--am-border);padding-top:18px;margin-top:8px;">
                    <a href="{{ url('/all_faqs') }}" class="am-btn am-btn-outline">
                        <i class="fa fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="am-btn am-btn-primary">
                        <i class="fa fa-check"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    CKEDITOR.replace('answer');
</script>
@endsection
