@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Quality Policy</h2>
            <p>Company quality commitment and objectives</p>
        </div>
        <div>
            <a onclick="qualityshowpolicy()" class="am-btn am-btn-lightblue">ADD Quality Policy</a>
        </div>
    </div>

    <?php $companyName = Auth::user()->company_name; ?>

    {{-- Add Policy Form Card --}}
    <div class="am-card quality_add_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">Add Quality Policy</h6>
            <form action="{{ route('add_quality') }}" id="addcust" method="post">
                @csrf
                <div class="mb-3">
                    <label>Enter additional Quality Policies that are specific to your working Environment and Business activities</label>
                    <textarea name="message" maxlength="10000" class="form-control mt-2" rows="6" placeholder="Set a maximum for the number of character that can be entered to 10000." required>{{ $previousPolicy ? $previousPolicy->message : '' }}</textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" name="status" value="1" />
                <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                <button type="reset" onclick="qualityshowpolicy()" class="am-btn am-btn-outline ml-2">Cancel</button>
            </form>
        </div>
    </div>

    {{-- Policy Content Card --}}
    <div class="am-card">
        <div class="am-card__body" style="padding:32px; line-height:1.8;">
            <p>The Management of {{ $companyName }} are committed to providing products and services that consistently exceed our Customer's needs for Quality and Value and also to meet the expectations of interested parties.</p>
            <p>Such products will be based around our pillars of competence, namely Customer Management, Revenue Management, and a commitment to comply with all applicable Regulation &amp; Conformity.</p>
            <p>Accordingly, the following policies have been established in order to ensure profitable business development, for the benefit of all stakeholders including interested parties:</p>
            <p>To implement and maintain a formal QMS, based upon the requirements of ISO 9001:2015.<br>
            To ensure that measureable objectives are defined, focused upon business needs, Customer satisfaction and continuous improvement, for all levels and functions.</p>
            <p>To seek continual improvement in the products that we offer to Customers and the QMS employed, in order to ensure that our Customer's perceptions of {{ $companyName }} are further enhanced.</p>
            <p>To develop and maintain mutually beneficial relationships with our suppliers, customers, neighbours and other interested parties.</p>
            <p>To foster a spirit of Teamwork, recognising the part all employees have to play in the continuing success of {{ $companyName }}.</p>
            <p>To ensure the maximum utilisation of our most important resource, our people, through ongoing training and career development.</p>
            <p>To continually understand and respond to the needs and expectations of our interested parties.</p>
            <p>As the Managing Director, I accept ultimate responsibility for Quality. The Operational Management will, through example, and direction, ensure that this policy is understood, implemented and maintained throughout {{ $companyName }}.</p>

            <h6 class="mt-4" style="color:#7a97d9;font-weight:normal;">Additional Policies:</h6>
            @if ($previousPolicy)
                <p style="white-space:pre-wrap;font-weight:normal !important;color:#7a97d9 !important;">{{ $previousPolicy->message }}</p>
            @endif

            <p class="mt-3">Managing Director: {{ Auth::user()->director }}</p>
            @if ($date)
                <p>Date: {{ $date }}</p>
            @endif
        </div>
    </div>

</div>
@endsection
