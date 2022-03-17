@extends('admin.dashboard.layouts.app')

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
                                        <?php $counter=0; ?>
                                        @foreach ($getprocess as $data)
                                        <?php $counter++; ?>
										<tr>
											<td>{{ $data->id}}</td>
											<td>{{ $data->processAudit}}</td>
											<td>{{ $data->auditor}}</td>
											<td>{{ $data->auditDate}}</td>
											<td>{{ $data->nonConformities}}</td>
											<td>{{ $data->Observations}}</td>
											<td>{{ $data->nonConfReport}}</td>
                                            <td>{{ $data->AdutiActions}}</td>
											<td>{{ $data->dateFrequency}}</td>

											<td><button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" onclick="getEid({{$data}});"><i class="la la-edit"></i></button>
										<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="viewaudit({{$data}})"><i class="la la-info"></i></button> 
										<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="deleteModal({{$data}})"><i class="la la-trash"></i></button> 
                                    </td>
                                        </tr>
                                        @endforeach
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
				<form action="{{route('deleteauditadmin')}} " method="POST">
				@csrf
                    <input type="hidden" name="id" value="" id="re_id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editProcessAudit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-lg">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Process Audit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="{{route('auditupdateadmin')}}" method="POST">
                @csrf
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit ID Number (See table below. For amendments only)::</label>
                                <input type="number" name="auditId" class="form-control"  placeholder="Enter Audit ID:">
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Process being audited:</label>
                                <input type="text" name="processAudit" class="form-control"  placeholder="Enter Months:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Auditor:</label>
                                <input type="text" name="auditor" class="form-control"  placeholder="Enter Auditor:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Date (YYYY/MM/DD):</label>
                                <input type="date" name="auditDate" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Non-Conformities:</label>
                                <input type="number" name="nonConformities" class="form-control"  placeholder="Enter Non-Conformities:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Observations:</label>
                                <input type="number" name="Observations" class="form-control"  placeholder="Enter Observations:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Non-Conformance Report Reference if applicable:</label>
                                <input type="text" name="nonConfReport" class="form-control"  placeholder="Enter Non-Conformance:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Actions:</label>
                                <input type="text" name="AdutiActions" class="form-control"  placeholder="Enter Audit Actions:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Audit Frequency (Months):</label>
                                <input type="date" name="dateFrequency" class="form-control"  placeholder="Enter Non-Conformance:">
                            </div>
                        </div>
                    </div>
					<h3>Add Audit Detail</h3>
					<hr />
					<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
											<label>1 - Is this process included in the system and relevant?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  name="qmsCorects"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  name="qmsCorects"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="qmsCorects"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidence" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>2 - Is this process being implemented as detailed in records?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="needExpactations"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="needExpactations"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="needExpactations"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance2" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction3"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction3"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction3"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence3"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>4 - Are key performance indicator information being monitored for this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction4"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction4"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction4"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance4"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction5"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction5"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction5"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence5" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>6 - Have previous targets and objectives been reviewed for this process?</label>
													<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction6"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction6"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction6"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance7" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>7 - Are all supporting procedures used and at the correct revision?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction7"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction7"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction7"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance8" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>8 - Is all equipment calibrated, in date and recorded?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction9"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction9"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction9"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance9" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>9 - Has the Management Review included this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction10"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction10"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction10"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance10" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues?</label>
											<input type="text" name="any_issues" class="form-control"  placeholder="Enter Any other issues::">
										</div>
									</div>
								</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Update</button>

            </div>
        </form>
		</div>
	</div>
</div>

<div class="modal fade" id="viewProcessAudit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Process Audit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form>
                @csrf
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Process being audited:</label>
                                <input type="text" name="processAudit" class="form-control"  placeholder="Enter Months:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Auditor:</label>
                                <input type="text" name="auditor" class="form-control"  placeholder="Enter Auditor:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Date (YYYY/MM/DD):</label>
                                <input type="date" name="auditDate" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Non-Conformities:</label>
                                <input type="number" name="nonConformities" class="form-control"  placeholder="Enter Non-Conformities:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Observations:</label>
                                <input type="number" name="Observations" class="form-control"  placeholder="Enter Observations:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Non-Conformance Report Reference if applicable:</label>
                                <input type="text" name="nonConfReport" class="form-control"  placeholder="Enter Non-Conformance:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Actions:</label>
                                <input type="text" name="AdutiActions" class="form-control"  placeholder="Enter Audit Actions:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Audit Frequency (Months):</label>
                                <input type="date" name="dateFrequency" class="form-control"  placeholder="Enter Non-Conformance:">
                            </div>
                        </div>
                    </div>
					<h3>Add Audit Detail</h3>
					<hr />
					<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
											<label>1 - Is this process included in the system and relevant?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  name="qmsCorects"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  name="qmsCorects"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="qmsCorects"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidence" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>2 - Is this process being implemented as detailed in records?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="needExpactations"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="needExpactations"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="needExpactations"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance2" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction3"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction3"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction3"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence3"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>4 - Are key performance indicator information being monitored for this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction4"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction4"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction4"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance4"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction5"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction5"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction5"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence5" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>6 - Have previous targets and objectives been reviewed for this process?</label>
													<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction6"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction6"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction6"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance7" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>7 - Are all supporting procedures used and at the correct revision?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction7"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction7"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction7"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance8" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>8 - Is all equipment calibrated, in date and recorded?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction9"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction9"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction9"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance9" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>9 - Has the Management Review included this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" name="correction10"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" name="correction10"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" name="correction10"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance10" class="form-control"  placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues?</label>
											<input type="text" name="any_issues" class="form-control"  placeholder="Enter Any other issues::">
										</div>
									</div>
								</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			

            </div>
        </form>
		</div>
	</div>
</div>
@endsection
<script>
    function getEid(data){
        console.log(data);

         $("#id_feild").val(data.id);
         $("input[name='auditId']").val(data.auditId);

         $("input[name='AdutiActions']").val(data.AdutiActions);
         $("input[name='Observations']").val(data.Observations);
         $("input[name='auditDate']").val(data.auditDate);
         $("input[name='auditor']").val(data.auditor);
         $("input[name='dateFrequency']").val(data.dateFrequency);
         $("input[name='nonConfReport']").val(data.nonConfReport);
         $("input[name='nonConformities']").val(data.nonConformities);
         $("input[name='processAudit']").val(data.processAudit);
         $("input[name='any_issues']").val(data.any_issues);
       
         $("input[name='evidance2']").val(data.evidance2);
         $("input[name='evidance4']").val(data.evidance4);
         $("input[name='evidance7']").val(data.evidance7);
         $("input[name='evidance8']").val(data.evidance8);
         $("input[name='evidance9']").val(data.evidance9);
         $("input[name='evidance10']").val(data.evidance10);
         $("input[name='evidence']").val(data.evidence);
         $("input[name='evidence3']").val(data.evidence3);
         $("input[name='evidence5']").val(data.evidence5);
    
		 
		  $("input[name='correction3'][value="+data.correction3+"]").prop('checked',true);
     	 $("input[name='correction4'][value="+data.correction4+"]").prop('checked',true);
     	 $("input[name='correction5'][value="+data.correction5+"]").prop('checked',true);
     	 $("input[name='correction6'][value="+data.correction6+"]").prop('checked',true);
     	 $("input[name='correction7'][value="+data.correction7+"]").prop('checked',true);
     	 $("input[name='correction9'][value="+data.correction9+"]").prop('checked',true);
		  $("input[name='correction10'][value="+data.correction10+"]").prop('checked',true);
		  $("input[name='needExpactations'][value="+data.needExpactations+"]").prop('checked',true);
		  $("input[name='qmsCorects'][value="+data.qmsCorects+"]").prop('checked',true);

         $("#editProcessAudit").modal('show');
     }
	   function viewaudit(data){
        console.log(data);

         $("#id_feild").val(data.id);
         $("input[name='auditId']").val(data.auditId);

         $("input[name='AdutiActions']").val(data.AdutiActions);
         $("input[name='Observations']").val(data.Observations);
         $("input[name='auditDate']").val(data.auditDate);
         $("input[name='auditor']").val(data.auditor);
         $("input[name='dateFrequency']").val(data.dateFrequency);
         $("input[name='nonConfReport']").val(data.nonConfReport);
         $("input[name='nonConformities']").val(data.nonConformities);
         $("input[name='processAudit']").val(data.processAudit);
         $("input[name='any_issues']").val(data.any_issues);

         $("input[name='evidance2']").val(data.evidance2);
         $("input[name='evidance4']").val(data.evidance4);
         $("input[name='evidance7']").val(data.evidance7);
         $("input[name='evidance8']").val(data.evidance8);
         $("input[name='evidance9']").val(data.evidance9);
         $("input[name='evidance10']").val(data.evidance10);
         $("input[name='evidence']").val(data.evidence);
         $("input[name='evidence3']").val(data.evidence3);
         $("input[name='evidence5']").val(data.evidence5);
		 
		 $("input[name='correction3'][value="+data.correction3+"]").prop('checked',true);
     	 $("input[name='correction4'][value="+data.correction4+"]").prop('checked',true);
     	 $("input[name='correction5'][value="+data.correction5+"]").prop('checked',true);
     	 $("input[name='correction6'][value="+data.correction6+"]").prop('checked',true);
     	 $("input[name='correction7'][value="+data.correction7+"]").prop('checked',true);
     	 $("input[name='correction9'][value="+data.correction9+"]").prop('checked',true);
		  $("input[name='correction10'][value="+data.correction10+"]").prop('checked',true);
		  $("input[name='needExpactations'][value="+data.needExpactations+"]").prop('checked',true);
		  $("input[name='qmsCorects'][value="+data.qmsCorects+"]").prop('checked',true);
         $("#viewProcessAudit").modal('show');
     }
	 
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

     }

 </script>


