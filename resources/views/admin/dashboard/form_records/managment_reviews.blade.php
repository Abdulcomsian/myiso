@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Management Reviews</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="managemnetReviewForm()" class="addBtn">ADD MANAGEMENT REVIEW</a>
                    		</div>
                    	</div>
                    	<div class="managemnet_review_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Management Review ID Number (See table below. For amendments only):</label><br>
											<input type="number" class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Management Review Date:</label><br>
											<input type="date" max="2999-12-31"  class="form-control" aria-describedby="emailHelp">
										</div>
                    				</div>
                    			</div>
                    			
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Management Review Meeting Attendees:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Management Review Meeting:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Review previous meeting minutes:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Review Previous Meeting:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comment on previous objectives:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Process performance and conformity of products and services:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Nonconformities and corrective actions:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Monitoring and measurement results:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comment on Audit results:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comment on the performance of external providers:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>The adequacy of resources and changes recommended:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>The effectiveness of actions taken to address risks and opportunities:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<button onclick="managemnetReviewForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Management Review</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>ID Number</th>
											<th>Date</th>
											<th>Attendees</th>
											<th>Planned Objectives</th>
											<th>Detail View</th>
											<th>Action</th>
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