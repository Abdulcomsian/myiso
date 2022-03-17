@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Environmental Policy</h2>
		</div>
	</div>
	<section id="procedure_section">
		<?php
			$companyName=Auth::user()->company_name;
			
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<p><b><span class="authName">{{ $companyName}}</span></b> is committed to continually monitoring and improving the environmental performance of the company. It will regularly measure its impact on the environment and set targets to ensure ongoing improvement.</p>
					<p>It is the policy of <b><span class="authName">{{ $companyName}}</span></b> to:</p>
					<ol>
						<li>Strive to prevent pollution in its processes and at its facilities.</li>
						<li>Comply with all current legislation regarding environmental issues.</li>
						<li>Encourage its suppliers to adopt similar principles where possible.</li>
						<li>Set, monitor and review environmental performance, targets and objectives.</li>
						<li>Ensure its staff understand the importance of protecting the environment and enlist their support to raise awareness and strive to improve the company’s performance.</li>
						<li>To continually improve the environmental performance of the company.</li>
						<li>Actively promote recycling within the company and, where possible, its suppliers.</li>
						<li>Seek to minimise harmful emissions of its fleet and power usage.</li>
						<li>Minimise waste by regular evaluation of operations and efficiency.</li>
						<li>Source a product range or supply services that will minimise the environmental impact of the company’s distribution and production.</li>
					</ol>
					<p>On behalf of <b><span class="authName">{{ $companyName}}</span></b>:</p>
					<p>Name: <span class="authName">{{Auth::user()->director}}</span> </p>
					<p>Date: {{date("d-F-Y")}}</p>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Requirements Due</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
				<form action="" method="POST">
				@csrf
				@method('DELETE')
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
<!-- end:: Content -->