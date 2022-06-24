@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Non-Conformities</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="nonConformities()" class="addBtn">ADD A NON-CONFORMITY</a>
                    		</div>
                    	</div>
                    	<div class="non_conformities_from_div">
                    		<form>
                    			<div class="form-group">
									<label>Customer ID Number:</label><br>
									<span>Select a customer ID from the table. For an internal non-conformity, select Internal as a Customer. If this is the first internal non-conformity, click here to add a customer called Internal.</span>
									<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Customer ID:">
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Fault Description:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Fault Description:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Root Cause:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Root Cause:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Immediate Corrective Action:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Immediate Corrective Action:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Action to Prevent Recurrence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Effectiveness of Action to Prevent Recurrence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Effectiveness Review Date (YYY/MM/DD):</label>
											<input type="date"  max="2999-12-31" class="form-control" aria-describedby="emailHelp" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Review Performed By:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Review Performed:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date NC Processed (YYY/MM/DD):</label>
											<input  max="2999-12-31"  max="2999-12-31" type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date NC Received (YYY/MM/DD):</label>
											<input type="date"  max="2999-12-31" class="form-control" aria-describedby="emailHelp" placeholder="Enter Review Performed:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Customer Response Expected Time (Days):</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Time:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Product Impact (Yes or No):</label>
											<input type="date"  max="2999-12-31" class="form-control" aria-describedby="emailHelp" placeholder="Enter Product Impact:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Root Cause Category:</label>
											<select name="root_cause_category" class="form-control">
											<option value="Other">Other</option>
											<option value="Planning">Planning</option>
											<option value="Production">Production</option>
											<option value="Non-liable">Non-liable</option>
											<option value="Training">Training</option>
											<option value="Management">Management</option>
											<option value="Human Factor">Human Factor</option>
											</select>
										</div>
									</div>
								</div>
								<button onclick="nonConformities()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Customers Listed</h4>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Customer ID</th>
											<th>Name</th>
											<th>Address</th>
											<th>Tel</th>
											<th>Email</th>
											<th>Contact</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>58</td>
											<td>Block Computing</td>
											<td>Al Quasais, Unit 5, Dubai</td>
											<td>0971 56 491 5517</td>
											<td>B.Cmp@gmail.com</td>
											<td>Mr Ahmed</td>
										</tr>
									</tbody>
								</table>
								<!--end: Datatable -->
                    	</div>

                    </div>
                    
		</div>
		<div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Total Non-Conformities Listed</h4>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="non_conformities_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>NCR ID Number</th>
											<th>Customer ID Number</th>
											<th>Fault Description</th>
											<th>Category</th>
											<th>Date NCR Processed</th>
											<th>Detail View</th>
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
@endsection
<!-- end:: Content --''