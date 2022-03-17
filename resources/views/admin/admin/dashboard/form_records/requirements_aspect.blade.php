@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Requirements and Aspects</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, complete the Add a Requirement form below and select the add button. To amend a record, complete the Amend a Requirement form.</p>
                    <p>This section can be considered as a diary. Simply add items that you required to be recalled on a regular basis, such as when management review all audits are due etc.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="requirementFrom()" class="addBtn">ADD A REQUIRMENTS</a>
                    		</div>
                    	</div>
                    	<div class="requirments_from_div">
                    		<form>
                    			<div class="form-group">
									<label>Requirement:</label>
									<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Requirement:">
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Requirement Completion Date of the Activity (YYYY/MM/DD):</label>
											<input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Requirement:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>RPeriodicity (Months):</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Months:">
										</div>
									</div>
								</div>
								<button onclick="requirementFrom()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>ID</th>
											<th>Requirments</th>
											<th>Date Completed</th>
											<th>Periodic Month</th>
											<th>Due Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>75</td>
											<td>Internal Audit of all areas</td>
											<td>2019-02-16</td>
											<td>1</td>
											<td>2019-03-16</td>
											<td><a href="javascript:;" data-toggle="modal" data-target="#editRequirment" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">								<i class="la la-edit"></i>
										</a>
										<a href="javascript:;" data-toggle="modal" data-target="#deleteRequirment" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">								<i class="la la-trash"></i>
										</a></td>
										</tr>
									</tbody>
								</table>
								<!--end: Datatable -->
                    	</div>
                    </div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Requirements</h5>
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
<div class="modal fade" id="editRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Requirements</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
                    <div class="form-group">
						<label>Requirement:</label>
						<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>Requirement Completion Date of the Activity (YYYY/MM/DD):</label>
						<input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>RPeriodicity (Months):</label>
						<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Months:">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<form action="" method="POST">
				@csrf
				@method('DELETE')
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
				<button type="submit" class="btn btn-danger">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
<!-- end:: Content --''