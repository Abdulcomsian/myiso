@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Risk Assessments</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<h5>Scope:</h5>
				<p>This procedure details possible scenarios of potential in accepting a contract and compares this with risk and consequence of issues occurring.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="riskAssessment()" class="addBtn">ADD A RISK ASSESSMENT</a>
                    		</div>
                    	</div>
                    	<div class="risk_assessment_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Job Number:</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Date (YYY/MM/DD):</label><br>
											<input type="date" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    			</div>
                    			
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the quality standard?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the delivery date?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the price?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Could interested parties be deemed affected?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Decision Comment:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Delivery Date (YYY/MM/DD):</label>
											<input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Probability (see instructions) - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Severity (see instructions) - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<button onclick="riskAssessment()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Risk Assessments Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Risk ID Number</th>
											<th>Job Number</th>
											<th>Order Date</th>
											<th>Quality Accepted?</th>
											<th>Delivery Accepted?</th>
											<th>Price Accepted?</th>
											<th>Risk Decision</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>28</td>
											<td>1</td>
											<td>2019-01-01</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>Yes</td>
											<td>This will be our first contract in the education sector, with our experience in the UK education sector, the Dubai collage are keen for us to win the tender.</td>
										</tr>
									</tbody>
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