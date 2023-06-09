@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Quality Policy</h2>
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
							<a onclick="qualityshowpolicy()" class="addBtn">ADD Quality Policy</a>
						</div>
					</div>

					<div class="quality_add_div">
						<form action="{{ route('add_quality') }}" id="addcust" method="post">
							@csrf
							<h3>Add Quality Policy</h3>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label>Enter additional Qualily Policies that are specific to your working Environment and Business activities</label><br>
										<textarea name="message" class="form-control" placeholder="Set a maximum for the number of character that can be entered to 450.">{{ $previousPolicy ? $previousPolicy->message : '' }}</textarea>
									</div>
								</div>
							</div>
							<input type="hidden" name="status" value="1" />
							<button type="submit" class="submitBtn">SUBMIT</button>
							<button type="reset" onclick="qualityshowpolicy()" class="btn btn-secondary submitBtn" style="margin-right:7px;">Cancel</button>
						</form>
					</div>
				</div>

				<div class="procedure_div">
					<p>The Management of <b><span class="authName">{{ $companyName}}</span></b> are committed to providing products and services that consistently exceed our Customer’s needs for Quality and Value and also to meet the expectations of interested parties.</p>
					<p>Such products will be based around our pillars of competence, namely Customer Management, Revenue Management, and a commitment to comply with all applicable Regulation & Conformity.</p>
					<p>Accordingly, the following policies have been established in order to ensure profitable business development, for the benefit of all stakeholders including interested parties:</p>
					<p>To implement and maintain a formal QMS, based upon the requirements of ISO 9001:2015.<br>
					To ensure that measureable objectives are defined, focused upon business needs, Customer satisfaction and continuous improvement, for all levels and functions.</p>
					<p>To seek continual improvement in the products that we offer to Customers and the QMS employed, in order to ensure that our Customer’s perceptions of <b><span class="authName">{{ $companyName}}</span></b> are further enhanced.</p>
					<p>To develop and maintain mutually beneficial relationships with our suppliers, customers, neighbours and other interested parties.</p>
					<p>To foster a spirit of Teamwork, recognising the part all employees have to play in the continuing success of <b><span class="authName">{{ $companyName}}</span></b>.</p>
					<p>To ensure the maximum utilisation of our most important resource, our people, through ongoing training and career development.</p>
					<p>To continually understand and respond to the needs and expectations of our interested parties.</p>
					<!-- Display the previous policy -->
					<h5 class="m-t-10">Additional Policies:</h5>
					@if ($previousPolicy)
						<pre style="font-size: 13px;color: #040404 !important;font-family: inherit;font-weight: normal;">{{ $previousPolicy->message }}</pre>
					@endif
						{{-- @foreach ($useraddpolicy as $policy)
                        <p>{{$policy->message}}</p>
                        @endforeach --}}
					<p>As the Managing Director, I accept ultimate responsibility for Quality. The Operational Management will, through example, and direction, ensure that this policy is understood, implemented and maintained throughout <b><span class="authName">{{ $companyName}}</span></b>.</p>
					<p>Managing Director: <span class="authName">{{Auth::user()->director}}</span></p>
					<p>Date: {{date("d-F-Y")}}</p>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>@endsection
<!-- end:: Content -->