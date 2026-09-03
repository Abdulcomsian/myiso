@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Health and Safety Policy</h2>
            <p>Company health and safety commitment and obligations</p>
        </div>
        <div>
            <a onclick="qualityshowpolicy()" class="am-btn am-btn-lightblue">Add Health and Safety Policy</a>
        </div>
    </div>

    <?php $companyName = Auth::user()->company_name; ?>

    {{-- Add Policy Form Card --}}
    <div class="am-card quality_add_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">Add Health and Safety Policy</h6>
            <form action="{{ route('health_policy') }}" id="addcust" method="post">
                @csrf
                <div class="mb-3">
                    <label>Enter additional Health and Safety Policies that are specific to your working Environment and Business activities</label>
                    <textarea name="message" maxlength="10000" class="form-control mt-2" rows="6" placeholder="Set a maximum for the number of character that can be entered to 450.">{{ $previousPolicy ? $previousPolicy->message : '' }}</textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" name="status" value="3" />
                <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                <button type="reset" onclick="qualityshowpolicy()" class="am-btn am-btn-outline ml-2">Cancel</button>
            </form>
        </div>
    </div>

    {{-- Policy Content Card --}}
    <div class="am-card">
        <div class="am-card__body" style="padding:32px; line-height:1.8;">
            <p>Each country has its own regulations and laws relating to health and safety at work. These must be complied with by both the employer and the company employees. It is the obligation of the company to ensure that they are aware and understand their responsibilities and regularly check for updates and changes.</p>
            <p>{{ $companyName }} will develop and maintain procedures to identify and assess hazards, determine controls and then implement them. These controls will be reviewed and monitored on a regular basis. The company will take all reasonable steps to reduce the risks within the workplace and to provide guidance on the measures that should be applied within the hierarchy of control. Where the hazards cannot be removed, the company will take steps to ensure that the risk to injury or health is removed or reduced.</p>

            <h6 class="dash-section-title mt-4" style="font-weight:normal">Duties of Employers:</h6>
            <p>Employers have a duty to ensure, as far is reasonably practicable, the health, safety and welfare at work of all employees and non-employees. Employers must carry out a suitable and sufficient assessment of risks to health and safety of employees at work and non-employees affected by the business. The assessment must identify measures which need to be taken to comply with the statutory provisions. The assessment must include routine and non-routine activities and must be reviewed if there is a significant change or belief it is no longer valid.</p>
            <p>In addition, employers must also ensure preventative and protective measures are implemented and arrangements should be made for effective planning organisation, control, monitoring and review of the preventative and protective measures introduced.</p>
            <p>It is the duty of the employer to provide employees with comprehensive and relevant information of the risks to their health and safety identified by the assessment and the preventive and protective measures introduced.</p>

            <h6 class="dash-section-title mt-4" style="font-weight:normal">Duties of Employers:</h6>
            <p>Employees have a duty to take reasonable care of their own health and safety and that of other people who may be affected by their work or actions. They also have a duty to co-operate with their employer to comply with their health and safety obligations under the relevant health and safety at work regulations in their country.</p>
            <p>It is the responsibility of the employee to ensure the correct use of machinery, equipment, means of production or safety devices provided by their employer in accordance with any instruction, training or guidance received under the relevant regulations.</p>

            <h6 class="mt-4" style="color:#7a97d9;font-weight:normal;">Additional Policies — Purpose:</h6>
            <p>This document specifies the policy and practices to be adopted to ensure that suitable and sufficient risk assessments are carried out in accordance with the requirements of the relevant regulations in force. It describes the system for undertaking general risk assessments at {{ $companyName }} as part of the programme for the management of Safety, Health and Environment. This procedure does not include risk assessments made under the control or handling of hazardous metals, chemicals and other substances or usage of display screens and repetitive actions.</p>

            @if ($previousPolicy)
                <p style="white-space:pre-wrap;font-weight:normal !important;color:#7a97d9 !important;">{{ $previousPolicy->message }}</p>
            @endif

            <p class="mt-3">On behalf of {{ $companyName }}:</p>
            <p>Name: {{ Auth::user()->director }}</p>
            @if ($date)
                <p>Date: {{ $date }}</p>
            @endif
        </div>
    </div>

</div>
@endsection
