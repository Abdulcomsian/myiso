@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Process Audits</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
					<p>Process audits are sometimes known as job audits or vertical audits. These audits are performed by the auditor selecting a routine job and making sure that it is processed correctly. The audit frequency should be based on past results and the importance of the process to the company.</p>
                    <p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="processAuditForm()" class="addBtn">ADD OR AMEND PROCESS AUDIT</a>
                    		</div>
                    	</div>
                    	<div class="process_audit_from_div">
                    		<form>
                    			<div class="row">
									<div class="col-lg-6">
		                    			<div class="form-group">
											<label>Audit ID Number (See table below. For amendments only)::</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Audit ID:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Process being audited:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Months:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Auditor:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Auditor:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Date (YYYY/MM/DD):</label>
											<input type="date"  max="2999-12-31" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Number of Non-Conformities:</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Non-Conformities:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Number of Observations:</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter Observations:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Non-Conformance Report Reference if applicable:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Report Reference:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Actions:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Audit Actions:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Audit Frequency (Months):</label>
											<input type="date"  max="2999-12-31" class="form-control" aria-describedby="emailHelp" placeholder="Enter Non-Conformance:">
										</div>
									</div>
								</div>
								<button onclick="processAuditForm()" class="submitBtn">SUBMIT</button>
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
											<th>Audit ID</th>
											<th>Audit Process</th>
											<th>Auditor</th>
											<th>Audit Date</th>
											<th>Number of NCR</th>
											<th>Number of Obs</th>
											<th>NCR Ref</th>
											<th>Audit Actions</th>
											<th>Audit Frequency</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>155</td>
											<td></td>
											<td></td>
											<td>0000-00-00</td>
											<td>2</td>
											<td>1</td>
											<td></td>
											<td></td>
											<td>0</td>
											<td><a href="javascript:;" data-toggle="modal" data-target="#editProcessAudit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting Process</h5>
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
<div class="modal fade" id="editProcessAudit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Requirements</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>1 - Is this process included in the system scope and is it still relevant?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>2 - Is this process being implemented as detailed in documented information?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>4 - Are key performance indicator information being monitored for this process?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>6 - Have previous targets and objectives been reviewed for this process?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>7 - Are all supporting procedures and work instructions used and at the correct revision?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>9 - Is the job paperwork satisfactory? Record the job details for this process here.</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Any other issues or points to note?</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Issue:">
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