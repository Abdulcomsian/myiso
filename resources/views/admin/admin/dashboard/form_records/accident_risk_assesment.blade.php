@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Accident Risk Assessments</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<h5>Scope:</h5>
				<p>This procedure details possible scenarios of potential accidents and compares this with risk and consequence of such an accident occurring. It will also provide details as to what measures have been taken to reduce the risk of such accidents occurring.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="accidentRiskForm()" class="addBtn">ADD ACCIDENTAL RISK ASSESSMENT</a>
                    		</div>
                    	</div>
                    	<div class="accident_risk_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Scenario - Describe the activity:</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Risk likelihood of scenario occuring - Enter a number between 1-6 (6 being most likely):</label><br>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    			</div>
                    			
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk severity - Enter a number between 1-6 (6 being most severe):</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Management Review Meeting:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>If an environmental accident, what gets out and how much:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Review Previous Meeting:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>If an environmental accident, where does it end up?</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>What are the consequences?:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>What can prevent or reduce the risk?:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Revised Risk likelihood of scenario occuring following prevention step - A number between 1-6 (6 being most likely):</label>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Revised Risk severity following prevention step - A number between 1-6 (6 being most severe):</label>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<button onclick="accidentRiskForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Accident Risk Assessments Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Scenario</th>
											<th>Detail View</th>
											<th>Delete Record</th>
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