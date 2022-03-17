@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Document Register</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<h4>1.0 - Main Procedures and Forms</h4>
					<ul>
						<li><a href="{{ url('/quality_manual') }}">Quality Manual</a></li>
						<li><a href="{{ url('/quality_policy') }}">Quality Policy</a></li>
						<li><a href="{{ url('/enviornment_policy') }}">Environmental Policy</a></li>
						<li><a href="{{ url('/health_policy') }}">Health and Safety Policy</a></li>
						<li><a href="{{ url('/management_organogram') }}">Management Organogram</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="procedure_div">
					<h4>Processes</h4>
					<ul>
						<li><a href="{{ url('/sale_processes') }}">QP1-Sales Process</a></li>
						<li><a href="{{ url('/purchasing_processes') }}">QP2-Purchasing Process</a></li>
						<li><a href="{{ url('/servicing_contract') }}">QP3-Servicing of a Contract</a></li>
						<li><a href="{{ url('/competency_process') }}">QP4-Competency Process</a></li>
						<li><a href="{{ url('/process_interaction') }}">Process Interaction</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="procedure_div">
					<h4>Procedures</h4>
					<ul>
						<li><a href="{{ url('/documented_information') }}">P1-Documented Information</a></li>
						<li><a href="{{ url('/corrective_action') }}">P2-Corrective Actions Including Non-Conformities</a></li>
						<li><a href="{{ url('/management_review') }}">P3-Management Review</a></li>
						<li><a href="{{ url('/monitoring_measure') }}">P4-Monitoring and measuring equipment</li>
						<li><a href="{{url('auidt')}}">P5-Audits</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="procedure_div">
					<h4>Forms and Records</h4>
					<div class="list_display">
						<ul>
							<li><a href="{{ url('/requirements_aspect') }}"> Requirements Due</a></li>
							<li><a href="{{ url('/process_audit') }}">Process Audits</a></li>
							<li><a href="{{ url('/interesting_parties')}}">Interested Parties</a></li>
							<li><a href="{{ url('/qms_audit') }}">QMS Audits</a></li>
							<li><a href="{{ url('/non_confromities') }}">Non-Conformities</a></li>
							<li><a href="{{ url('/customer') }}">Customers</a></li>
						</ul>
						<ul>
							<li><a href="{{ url('/customer_review') }}">Customer Review</a></li>
							<li><a href="{{ url('/supplier') }}">Suppliers</a></li>
							<li><a href="{{ url('/calibration_record') }}">Calibration</a></li>
							<li><a href="{{ url('/employess') }}">Employees</a></li>
							<li><a href="{{ url('/add_management_review') }}">Management Reviews</a></li>
						</ul>
						<ul>
							<li><a href="{{ url('/maintance_record') }}">Maintenance Records</a></li>
							<li><a href="{{ url('/accident_risk') }}">Accident Risk Assessments</a></li>
							<li><a href="{{ url('chemical_control') }}">Chemical Control</a></li>
							<li><a href="{{ url('/risk_assessment') }}">Risk Assessments</a></li>
							<li><a href="{{ url('/work_instruction') }}">Work Instructions</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<h4>2.0 - Local Work Instructions</h4>

					    <div class="list_display">
						<ul>
					        @foreach($work as $item)						    
							<li><a href="{{ url('/work_instruction') }}">{{ $item->workinstruction}}</a></li>
                            @endforeach;
						</ul>
						</div>
						
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