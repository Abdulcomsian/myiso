@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin:Dashboard 1-->


	<!--Begin:Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Process Audits</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>Process audits are sometimes known as job audits or vertical audits. These audits are performed by the auditor selecting a routine job and making sure that it is processed correctly. The audit frequency should be based on past results and the importance of the process to the company.</p>
                    <p>To add a record, click on the
						“Add Process Audit” button. To amend or delete a record, click on the edit
						or delete icon of the entry that needs to be modified or deleted.</p>
						
						<div class="procedure_div">
                        <div class="row">
                    		<div class="col-lg-12">
                    		    <!--<h3>Add Process Audit</h3>-->
					
                    		</div>
                    	</div>
                        <div class="row"><div class="col-lg-12">&nbsp;</div></div>
                        <div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="processAuditFormshow()" class="addBtn">Add process audit</a>
                    		</div>
                    	</div>
                    	<div class="process_audit_from_div">
                    		<form action="{{route('auditsaveadmin')}}" method="POST" enctype="multipart/form-data" id="addForm">
                                @csrf
                                @php 
                                    $urlparam = request()->route()->parameters;
                                   
                                @endphp
                                <input type="hidden" name="user_id" value="{{$urlparam['userid'] }}">
                    			<div class="row">
									{{-- <div class="col-lg-6">
		                    			<div class="form-group">
											<label>Audit ID Number (See table below. For amendments only):</label>
											<input type="number" name="auditId" class="form-control" placeholder="Enter Audit ID:">
										</div>
									</div> --}}
									<div class="col-lg-12">
										<div class="form-group">
											<label>Process:</label>
											<input type="text" name="processAudit" class="form-control processAudit" placeholder="Enter Process Name:" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Auditor:</label>
											<input type="text" name="auditor" class="form-control" required placeholder="Enter Auditor Name:" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Date (DD/MM/YYYY):</label>
											<input type="date" required name="auditDate" id="format_date" placeholder="dd/mm/yyyy" class="form-control" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Number of Non-Conformities:</label>
											<input type="number" min="0" required onkeyup="myFunction('nonConformities')" name="nonConformities" class="validate-number-2 form-control nonConformities" placeholder="Enter Number of Non-Conformities:" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Number of Observations:</label>
											<input type="number" min="0" required onkeyup="myFunction('Observations')" name="Observations" class="validate-number-2 form-control Observations"  placeholder="Enter Number of Observations:" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Non-Conformance Report Reference (if applicable):</label>
											 <input type="text"  name="nonConfReport" class="form-control validate_number"  placeholder="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Actions:</label>
											<textarea required name="AdutiActions" class="form-control" placeholder="Enter Audit Actions:" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Audit Frequency (Months):</label>
											<input type="number" required  onkeyup="myFunction('auditfrequency')" min="1" max="12" name="dateFrequency" class="validate-number-2 form-control auditfrequency"  placeholder="Enter Number of Months:" required>
										</div>
									</div>
								</div>
								
								<hr />
								
								
							<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
											<label>1 - Is this process included in the system scope and is it still relevant?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required name="qmsCorects" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required  name="qmsCorects" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="qmsCorects" required> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidence" class="form-control" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>2 - Is this process being implemented as detailed in documented information?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="needExpactations" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required  name="needExpactations" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="needExpactations" required> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance2" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction3" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction3" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction3" required> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence3" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>4 - Are key performance indicator information being monitored for this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction4" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction4" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="correction4" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance4"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction5" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction5" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="correction5" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence5" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>6 - Have previous targets and objectives been reviewed for this process?</label>
													<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction6" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction6" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction6" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance7" class="form-control" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>7 - Are all supporting procedures and work instructions used and at the correct revision?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction7" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required  name="correction7" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction7" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance8" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>8 - Are all equipment calibrated, up-to-date and recorded?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction9" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction9" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction9" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance9" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>9 - Is the job paperwork satisfactory? Record the job details for this process here.</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction10" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction10" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="correction10" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance10" class="form-control" placeholder="Enter Evidence:">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence: <span class="text-danger">(jpeg, mp3, mp4,.xls,.doc)</span></label>
											<!-- <input name="attach_evidence" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf"> -->
											<input name="attach_evidence" type="file" class="form-control" accept="all">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues or point to note?</label>
											<input type="text" name="any_issues"  class="form-control" placeholder="Enter Any other issues:">
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn" >SUBMIT</button>
								<button type="reset" class="btn btn-secondary" style="float: right;margin-right: 6px;border: none;background: #646c9a;color: #fff;padding: 8px 47px;border-radius: 5px;"   onclick="processAuditFormshow()">Cancel</button>
                    		</form>
                    	</div>
                    	<div class="requirments_table_div">
							<a href="/edit_user/{{$urlparam['userid'] }}" class="btn btn-clean btn-icon-sm back_icon" style="float: right;">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
					

                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Audit ID</th>
											<th>Audit Process</th>
											<th>Auditor</th>
											<th>Audit Date</th>
											<th>Number of Non-Conformities</th>
											<th>Number of Observations</th>
											<th>Non-Conformities Reference</th>
											<th>Audit Actions</th>
											<th>Audit Frequency</th>
											<th>Attachment</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        <?php $counter=0; ?>
                                        @foreach ($getprocess as $data)
                                        <?php $counter++; ?>
										<tr>
											<!--<td>{{ $data->id}}</td>-->
											<td>{{$loop->index+1}}</td>
											<td>{{ $data->processAudit}}</td>
											<td>{{ $data->auditor}}</td>
											<td>{{date('d-M-Y', strtotime($data->auditDate))}}</td>
											<td>{{ $data->nonConformities}}</td>
											<td>{{ $data->Observations}}</td>
											<td>{{ $data->nonConfReport}}</td>
                                            <td>{{ $data->AdutiActions}}</td>
											<td>{{ $data->dateFrequency}}</td>
											<td>
												@if(!empty($data->attach_evidence))
													<a target="_blank" href="{{ asset($data->attach_evidence) }}">View</a>
												@else
													No data found
												@endif
											</td>
											<td><button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" onclick="getEid({{$data}});"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg></button>
										<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View" onclick="viewaudit({{$data}})"><i class="fa fa-eye"></i></button> 
										<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="deleteModal({{$data}})"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg></button> 
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

	<!--End:Section-->
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
				<p>Are you sure you want to delete this entry?</p>
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
				<h5 class="modal-title" id="exampleModalLabel">Edit Process Audit Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="{{route('auditupdateadmin')}}" method="POST" enctype="multipart/form-data">
                @csrf
			<div class="modal-body">
			    		
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit ID Number (See table below. For amendments only):</label>
                                <input type="number" name="auditId" class="form-control"  placeholder="Enter Audit ID:">
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Enter Process Name</label>
                                <input type="text" name="processAudit" class="form-control"  placeholder="Enter Process Name:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Auditor:</label>
                                <input type="text" name="auditor" class="form-control" placeholder="Enter Auditor Name:" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Date (MM/DD/YYYY):</label>
                                <input type="date" name="auditDate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Non-Conformities:</label>
                                <input type="text" min="0" onkeyup="myFunction('nonConformities')" name="nonConformities" class="validate-number-2 form-control nonConformities"  placeholder="Enter Number of Non-Conformities:" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Observations:</label>
                                <input type="number" min="0" onkeyup="myFunction('Observations')" name="Observations" class="validate-number-2 form-control Observations"  placeholder="Enter Number of Observations:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Non-Conformance Report Reference (if applicable):</label> 
                                <input type="text" required name="nonConfReport" class="form-control validate_number" placeholder="Enter Non-Conformance:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Actions:</label>
                                <textarea required name="AdutiActions" class="form-control" placeholder="Enter Audit Actions:" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Audit Frequency (Months):</label>
                                <input type="number" min="1" max="12" onkeyup="myFunction('auditfrequency')" name="dateFrequency" class="validate-number-2 form-control auditfrequency"  placeholder="Enter Number of Months:" required>
                            </div>
                        </div>
                    </div>
			
					<hr />
					<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
											<label>1 - Is this process included in the system scope and is it still relevant?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required  name="qmsCorects" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"   required name="qmsCorects" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="qmsCorects" required> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidence" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>2 - Is this process being implemented as detailed in documented information?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="needExpactations" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="needExpactations" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="needExpactations" required> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance2" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction3" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction3" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction3" required> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence3"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>4 - Are key performance indicator information being monitored for this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction4" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction4" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction4" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidance4" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction5" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required  name="correction5" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction5" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" name="evidence5" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>6 - Have previous targets and objectives been reviewed for this process?</label>
													<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction6" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required  name="correction6" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="correction6" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance7" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>7 - Are all supporting procedures and work instructions used and at the correct revision?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction7" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required  name="correction7" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction7" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance8" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>8 - Are all equipment calibrated, up-to-date and recorded?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  required name="correction9" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction9" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction9" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance9" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>9 - Is the job paperwork satisfactory? Record the job details for this process here.</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes" required  name="correction10" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required  name="correction10" required> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction10" required> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance10" class="form-control"  placeholder="Enter Evidence:" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence:</label>
											<input name="attach_evidence" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues or points to note?</label>
											<input type="text" name="any_issues" class="form-control"  placeholder="Enter Any other issues:">
										</div>
									</div>
								</div>

			</div>

			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
				<h5 class="modal-title" id="exampleModalLabel">View Process Audit Details</h5>
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
                                <input type="text" name="processAudit" class="form-control"  placeholder="Enter Months:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Auditor:</label>
                                <input type="text" name="auditor" class="form-control"  placeholder="Enter Auditor:" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Date (MM/DD/YYYY):</label>
                                <input type="date" name="auditDate" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Non-Conformities:</label>
                                <input type="number" name="nonConformities" required class="validate-number-2 form-control"  placeholder="Enter Non-Conformities:" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Observations:</label>
                                <input type="number" name="Observations" class="validate-number-2 form-control"  placeholder="Enter Observations:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Non-Conformance Report Reference (if applicable):</label> 
                                <input type="text"  name="nonConfReport" class="form-control validate_number"  placeholder="Enter Non-Conformance:" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Actions:</label>
                                <input type="text" name="AdutiActions" class="form-control"  placeholder="Enter Audit Actions:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Audit Frequency (Months):</label>
                                <input type="number" min="1" max="12" onkeyup="myFunction('auditfrequency')" name="dateFrequency" class="validate-number-2 form-control auditfrequency" disabled>
                            </div>
                        </div>
                    </div>
				<hr />
					<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
											<label>1 -  Is this process included in the system scope and is it still relevant?</label>
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
											<input type="text" name="evidence" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>2 - Is this process being implemented as detailed in documented information?</label>
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
											<input type="text" class="form-control" name="evidance2" placeholder="Enter Evidence:">
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
											<input type="text" class="form-control" name="evidence3"  placeholder="Enter Evidence:">
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
											<input type="text" class="form-control" name="evidance4"  placeholder="Enter Evidence:">
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
											<input type="text" class="form-control" name="evidence5" placeholder="Enter Evidence:">
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
											<input type="text" name="evidance7" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>7 - Are all supporting procedures and work instructions used and at the correct revision?</label>
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
											<input type="text" name="evidance8" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>8 - Are all equipment calibrated, up-to-date and recorded?</label>
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
											<input type="text" name="evidance9" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>9 - Is the job paperwork satisfactory? Record the job details for this process here.</label>
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
											<input type="text" name="evidance10" class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Attach Evidence:</label>
							<div class="evidence_attachemnt_div">
							</div>
						</div>
					</div>
				</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues or points to note?</label>
											<input type="text" name="any_issues" class="form-control"  placeholder="Enter Any other issues:">
										</div>
									</div>
								</div>


			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			

            </div>
        </form>
		</div>
	</div>
</div>
@endsection
@section('myscript')

@endsection
<script>
  
    function processAuditFormshow()
    {
		document.getElementById('addForm').reset();
		$(".process_audit_from_div").toggle();
    }
    function myFunction(classname){
       var value=parseInt($("."+classname).val());
       if(classname=='Observations' || classname=='nonConformities')
       {
           if(value<0)
           { 
              $("."+classname).val('');
           } 
       }
       else{
          if(value<0)
           { 
              $("."+classname).val('');
           }else if(value>12){
               $("."+classname).val(12);
           } 
       }
       
    }
    function getEid(data){
        console.log(data);
		if($(".process_audit_from_div").is(":visible")){
			processAuditFormshow();
		}

		$("#id_feild").val(data.id);
         $("input[name='auditId']").val(data.auditId);

         $("textarea[name='AdutiActions']").val(data.AdutiActions);
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
		   if($(".process_audit_from_div").is(":visible")){
			   processAuditFormshow();
		   }

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
           if(data.attach_evidence){
               $('.evidence_attachemnt_div').empty().append(`<span class="text-dark">Click to view evidence <a target="_blank" href="${data.attach_evidence}">Here</a>`);
           }else{
               $('.evidence_attachemnt_div').empty().append('No data found');
           }
         $("#viewProcessAudit").modal('show');
     }
	 
     function deleteModal(data){
		 if($(".process_audit_from_div").is(":visible")){
			 processAuditFormshow();
		 }
         $("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

     }
     

 </script>