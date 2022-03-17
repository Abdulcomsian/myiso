@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Employees</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="employeeForm()" class="addBtn">ADD EMPLOYEE</a>
                    		</div>
                    	</div>
                    	<div class="employee_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>System ID Number:</label><br>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Surname:</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Equipment Name:">
										</div>
                    				</div>
                    			</div>
                    			
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>First Name:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Serial Number:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Payroll or Employee Number:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Location:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Start Date (YYYY/MM/DD):</label>
											<input type="date" max="2999-12-31"  class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Job Details:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Acceptance Criteria:">
										</div>
									</div>
								</div>
								<button onclick="employeeForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div m-t-20">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="employeeSkillForm()" class="addBtn">ADD PROCESS SKILL FOR EMPLOYEE</a>
                    		</div>
                    	</div>
                    	<div class="employee_skill_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Employee ID:</label><br>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Skill:</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Equipment Name:">
										</div>
                    				</div>
                    			</div>
								<button onclick="employeeSkillForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div m-t-20">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="employeeRecordForm()" class="addBtn">ADD A TRAINING RECORD FOR EMPLOYEE</a>
                    		</div>
                    	</div>
                    	<div class="employee_record_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Employee ID:</label><br>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Training Date (YYYY/MM/DD):</label><br>
											<input type="date" max="2999-12-31"  class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    			</div>
                    			<div class="row">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Training Details:</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    			</div>
								<button onclick="employeeRecordForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Employees Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>System Employee ID</th>
											<th>Surname</th>
											<th>Firstname</th>
											<th>Employee Number</th>
											<th>Start Date</th>
											<th>Job Details</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>802</td>
											<td>Bocking</td>
											<td>Oliver</td>
											<td></td>
											<td>2018-01-01</td>
											<td>CEO/Owner</td>
										</tr>
									</tbody>
								</table>
								<!--end: Datatable -->
                    	</div>
					</div>
					</div>
					 <div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Total Employee Skills Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Skills ID</th>
											<th>Employee ID</th>
											<th>Surname</th>
											<th>Firstname</th>
											<th>Employee Number</th>
											<th>Skill</th>
										</tr>
									</thead>
								</table>
								<!--end: Datatable -->
                    		</div>
						</div>
					</div>
					<div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Training Record Summary</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>ID Number</th>
											<th>Surname</th>
											<th>First Name</th>
											<th>Start Date</th>
											<th>Employee Stamp Number</th>
											<th>Training Date</th>
											<th>Training Details</th>
										</tr>
									</thead>
								</table>
								<!--end: Datatable -->
                    		</div>
						</div>
					</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Supplier</h5>
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
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>ID Number:</label><br>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter ID:">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Supplier Name:</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Name:">
										</div>
                    				</div>
                    			</div>
                    			
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Address:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Address:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>City:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter City:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>County or State:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Country or State:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Post Code or Zip Code:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Customer Contact Number:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Country:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Country">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Telephone:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Telephone:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Email::</label>
											<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Email:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Contact Name:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Contact Number:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Supplier Service:</label>
											<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Service:">
										</div>
									</div>
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