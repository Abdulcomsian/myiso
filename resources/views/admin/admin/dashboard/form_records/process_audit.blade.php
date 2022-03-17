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
											<input type="date" class="form-control" aria-describedby="emailHelp">
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
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Non-Conformance:">
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
											<input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Non-Conformance:">
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
											<td><a href="javascript:;" data-toggle="modal" data-target="#editProcessAudit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">								<i class="la la-edit"></i>
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
								<label>Any other issues?</label>
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