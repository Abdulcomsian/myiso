@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Additional Policies</h2>
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
