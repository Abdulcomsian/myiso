@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12 d-flex justify-content-between">
			<h2>Additional Policies</h2>
		

			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<a href="/edit_user/{id}" class="btn btn-clean btn-icon-sm">
						<i class="la la-long-arrow-left"></i>
						Back
					</a>
					&nbsp;
					
				</div>
			</div>
		</div>
	</div>
	<section id="procedure_section">
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<!-- Display Quality Policy -->
					<h5 class="m-t-10">Quality Policy:</h5>
					@if ($qualityPolicy)
						<pre style="font-size: 13px;color: #040404 !important;font-family: inherit;font-weight: normal;">{{ $qualityPolicy->message }}</pre>
					@endif
				</div>
				<div class="procedure_div">
					<!-- Display Environmental Policy -->
					<h5 class="m-t-10">Environmental Policy:</h5>
					@if ($environmentalPolicy)
						<pre style="font-size: 13px;color: #040404 !important;font-family: inherit;font-weight: normal;">{{ $environmentalPolicy->message }}</pre>
					@endif
				</div>
				<div class="procedure_div">
					<!-- Display Health and Safety Policy -->
					<h5 class="m-t-10">Health and Safety Policy:</h5>
					@if ($healthSafetyPolicy)
						<pre style="font-size: 13px;color: #040404 !important;font-family: inherit;font-weight: normal;">{{ $healthSafetyPolicy->message }}</pre>
					@endif
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
@endsection
<!-- end:: Content -->
