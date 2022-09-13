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
											<td><a href="javascript:;" data-toggle="modal" data-target="#editRequirment" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
										</a>
										<a href="javascript:;" data-toggle="modal" data-target="#deleteRequirment" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
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