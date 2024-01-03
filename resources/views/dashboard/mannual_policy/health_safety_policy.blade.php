@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Health and Safety Policy</h2>
		</div>
	</div>
	<section id="procedure_section">
		<?php
			$companyName=Auth::user()->company_name;
			
		?>
		<div class="row">
			<div class="col-lg-12">

				<div class="procedure_div">
					<div class="row">
						<div class="col-lg-12 text-right">
							<a onclick="qualityshowpolicy()" class="addBtn">Add Health and Safety Policy</a>
						</div>
					</div>

					<div class="quality_add_div">
						<form action="{{ route('health_policy') }}" id="addcust" method="post">
							@csrf
							<h3>Add Health and Safety Policy</h3>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label>Enter additional Health and Safety Policies that are specific to your working Environment and Business activities</label><br>
										<textarea name="message" maxlength="10000" class="form-control" placeholder="Set a maximum for the number of character that can be entered to 450.">{{ $previousPolicy ? $previousPolicy->message : '' }}</textarea>
										@error('message')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<input type="hidden" name="status" value="3" />
							<button type="submit" class="submitBtn">SUBMIT</button>
							<button type="reset" onclick="qualityshowpolicy()" class="btn btn-secondary submitBtn" style="margin-right:7px;">Cancel</button>
						</form>
					</div>
				</div>



				<div class="procedure_div">
					<p>Each country has its own regulations and laws relating to health and safety at work. These must be complied with by both the employer and the company employees. It is the obligation of the company to ensure that they are aware and understand their responsibilities and regularly check for updates and changes.</p>
					<p><b><span class="authName">{{ $companyName}}</span></b> will develop and maintain procedures to identify and assess hazards, determine controls and then implement them. These controls will be reviewed and monitored on a regular basis. The company will take all reasonable steps to reduce the risks within the workplace and to provide guidance on the measures that should be applied within the hierarchy of control. Where the hazards cannot be removed, the company will take steps to ensure that the risk to injury or health is removed or reduced.</p>
					<h5 class="m-t-30">Duties of Employers:</h5>
					<p>Employers have a duty to ensure, as far is reasonably practicable, the health, safety and welfare at work of all employees and non-employees. Employers must carry out a suitable and sufficient assessment of risks to health and safety of employees at work and non-employees affected by the business. The assessment must identify measures which need to be taken to comply with the statutory provisions. The assessment must include routine and non-routine activities and must be reviewed if there is a significant change or belief it is no longer valid.</p>
					<p>In addition, employers must also ensure preventative and protective measures are implemented and arrangements should be made for effective planning organisation, control, monitoring and review of the preventative and protective measures introduced.</p>
					<p>It is the duty of the employer to provide employees with comprehensive and relevant information of the risks to their health and safety identified by the assessment and the preventive and protective measures introduced.</p>
					<h5 class="m-t-30">Duties of Employees:</h5>
					<p>Employees have a duty to take reasonable care of their own health and safety and that of other people who may be affected by their work or actions. They also have a duty to co-operate with their employer to comply with their health and safety obligations under the relevant health and safety at work regulations in their country.</p>
					<p>It is the responsibility of the employee to ensure the correct use of machinery, equipment, means of production or safety devices provided by their employer in accordance with any instruction, training or guidance received under the relevant regulations.</p>
					<h5 class="m-t-10">Additional Policies:</h5>
					<h5 class="m-t-10">Purpose:</h5>
					<p>This document specifies the policy and practices to be adopted to ensure that suitable and sufficient risk assessments are carried out in accordance with the requirements of the relevant regulations in force. It describes the system for undertaking general risk assessments at <b><span class="authName">{{ $companyName}}</span></b> as part of the programme for the management of Safety, Health and Environment. This procedure does not include risk assessments made under the control or handling of hazardous metals, chemicals and other substances or usage of display screens and repetitive actions.</p>
					@if ($previousPolicy)
					<pre style="font-size: 13px;color: #040404 !important;font-family: inherit;font-weight: normal; white-space: pre-wrap; overflow: hidden;">{{ $previousPolicy->message }}</pre>
					@endif  
					{{-- @foreach ($useraddpolicy as $health)
						<p>{{$health->message}}</p>
						@endforeach --}}
					<p>On behalf of <b><span class="authName">{{ $companyName}}</span></b>:</p>
					<p>Name: <span class="authName">{{Auth::user()->director}}</span> </p>
					<p>Date: {{date("d-F-Y")}}</p>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
@endsection
<!-- end:: Content -->