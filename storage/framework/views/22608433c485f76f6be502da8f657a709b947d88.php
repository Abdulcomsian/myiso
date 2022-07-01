

<?php $__env->startSection('content'); ?>
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
                    <p>To add a record, click on the “Add
						Process Audit Details” button. To amend a record, click on the edit icon of
						the entry that needs to be modified.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    		    
                    			<a onclick="processAuditForm()" class="addBtn">Add process audit details</a>
                    		</div>
                    	</div>
                    	<div class="process_audit_from_div">
                    		<form action="<?php echo e(route('auditform')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                    			<div class="row">
									
									<div class="col-lg-12">
										<div class="form-group">
											<label>Process Being Audited:</label>
											<input type="text" name="processAudit" class="form-control" placeholder="Enter Process Name" id="processAudit" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Auditor:</label>
											<input type="text" name="auditor" class="form-control"  placeholder="Enter Auditor name:" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Date (DD/MM/YYYY):</label>
											<input type="date" max="2999-12-31" name="auditDate" class="form-control" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Number of Non-Conformities:</label>
											<input type="text" name="nonConformities"  min="0" id="nonConformities1" required class="form-control "  placeholder="Enter Number of Non-Conformities" >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Number of Observations:</label>
											<input type="number" name="Observations" min="0" class="form-control "  placeholder="Enter no of observations" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Non-Conformance Report Reference (if applicable):</label>
											<input type="text" name="nonConfReport" class="form-control validate_number" >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Actions:</label>
											<textarea name="AdutiActions" class="form-control"  placeholder="Enter Audit Actions:" required="required"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Audit Frequency (Months):</label>
											<input type="number" min="1" max="12" name="dateFrequency" id="dateFrequency" class="form-control"  placeholder="Enter Frequency Month" required="required">
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
														<input type="radio" required value="Yes"  name="qmsCorects"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="qmsCorects"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="qmsCorects"> NA
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
														<input type="radio" value="Yes"  required  name="needExpactations"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required  name="needExpactations"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required  name="needExpactations"> NA
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
														<input type="radio" value="Yes"  required  name="correction3"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required  name="correction3"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required  name="correction3"> NA
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
														<input type="radio" value="Yes"  required  name="correction4"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required  name="correction4"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required  name="correction4"> NA
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
														<input type="radio" value="Yes"  required  name="correction5"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required  name="correction5"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required  name="correction5"> NA
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
														<input type="radio" value="Yes" required   name="correction6"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required   name="correction6"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required   name="correction6"> NA
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
														<input type="radio" value="Yes" required   name="correction7"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required  name="correction7"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required   name="correction7"> NA
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
														<input type="radio" value="Yes" required   name="correction9"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required   name="correction9"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required  name="correction9"> NA
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
														<input type="radio" value="Yes"  required  name="correction10"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No" required   name="correction10"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required  name="correction10"> NA
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
										<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence:</label>
											<input type="file" name="attach_evidence" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues or points to note?</label>
											<input type="text" name="any_issues" class="form-control"  placeholder="Enter Any other issues:" >
										</div>
									</div>
								</div>
								<!--<button type="reset" onclick="processAuditFormclose()" class=" closeBtn btn btn-secondary">Cancel</button>-->
								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" style="float: right;margin-right: 6px;border: none;background: #646c9a;color: #fff;padding: 8px 47px;border-radius: 5px;"  class="btn btn-secondary" onclick="processAuditFormclose()">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<div class="table-responsive">
								<!--begin: Datatable -->
								<table style="width: auto;" class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th style="width:auto;">Audit ID</th>
											<th style="width:auto;">Audit Process</th>
											<th style="width:auto;">Auditor</th>
											<th style="width:auto;">Audit Date</th>
											<th style="width:auto;">Number of
												Non-Conformities</th>
											<th style="width:auto">Number of
												Observations</th>
											<th style="width:auto">NonConformance Report Reference (if applicable)</th>
											<th style="width:auto">Audit Actions</th>
											<th style="width:auto;">Audit Frequency (Months).</th>
											<th style="width:auto;">Action</th>
										</tr>
									</thead>
									<tbody>
                                        <?php $counter=0; ?>
										<?php
											$i=1;
										?>
                                        <?php $__currentLoopData = $audit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $counter++; ?>
										<tr>
											<td><?php echo e($i++); ?></td>
											<td><?php echo e($data->processAudit); ?></td>
											<td><?php echo e($data->auditor); ?></td>
                                            
											<td><?php echo e(date('d-M-Y', strtotime($data->auditDate))); ?></td>
											<td><?php echo e($data->nonConformities); ?></td>
											<td><?php echo e($data->Observations); ?></td>
											<td><?php echo e($data->nonConfReport); ?></td>
                                            <td><?php echo e($data->AdutiActions); ?></td>
											<td><?php echo e($data->dateFrequency); ?></td>

											<td>
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" onclick="getEid(<?php echo e($data); ?>);"><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span></button>
                                            <button class="btn btn-sm btn-clean btn-icon btn-con-md"  title="View" onclick="viewaudit(<?php echo e($data); ?>);">
                                                 <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#5d78ff" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                <!--<span class="fa fa-eye"></sapn>-->
                                                
                                                </button>
                                                	<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="deleteModal(<?php echo e($data); ?>);"><i class="la la-trash"></i>
											</button>
                                                
                                    </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
								<!--end: Datatable -->
                    	</div>
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
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
				<form action="<?php echo e(route('deleteProcess')); ?> " method="POST">
				<?php echo csrf_field(); ?>
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
					<h5 class="modal-title" id="exampleModalLabel">Edit Process Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="<?php echo e(route('auditDelete')); ?>" method="POST">
                <?php echo csrf_field(); ?>
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Process Being Audited:</label>
                                <input type="text" name="processAudit" id="processAudit" class="form-control"  placeholder="Enter Process Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Auditor:</label>
                                <input type="text" name="auditor" class="form-control"  placeholder="Enter Auditor name:" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Date (DD/MM/YYYY):</label>
                                <input type="date" max="31-12-2200" name="auditDate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Non-Conformities:</label>
                                <input type="text" required name="nonConformities" min="0" id="nonConformities2" class="form-control "  placeholder="Enter Number of Non-Conformities" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Observations:</label>
                                <input type="number" name="Observations" min="0" class="form-control "  placeholder="Enter no of observations" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Non-Conformance Report Reference (if applicable):</label>
                                <input type="text"  name="nonConfReport" class="form-control validate_number">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Actions:</label>
                                <textarea name="AdutiActions" class="form-control" placeholder="Enter Audit Actions:" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Audit Frequency (Months):</label>
<input type="number" min="1" max="12" name="dateFrequency" class="form-control" placeholder="Enter Non-Conformance:" required>
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
														<input type="radio" value="Yes"  required name="qmsCorects"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"   required name="qmsCorects"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA" required  name="qmsCorects"> NA
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
														<input type="radio" value="Yes"  required name="needExpactations"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="needExpactations"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="needExpactations"> NA
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
														<input type="radio" value="Yes"  required name="correction3"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction3"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction3"> NA
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
														<input type="radio" value="Yes"  required name="correction4"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction4"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction4"> NA
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
														<input type="radio" value="Yes"  required name="correction5"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction5"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction5"> NA
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
														<input type="radio" value="Yes" required  name="correction6"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  required name="correction6"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="NA"  required name="correction6"> NA
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
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence:</label>
											<input type="file" name="attach_evidence" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues?</label>
											<input type="text" name="any_issues" class="form-control"  placeholder="Enter Any other issues:" >
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
				<h5 class="modal-title" id="exampleModalLabel">Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form>
                <?php echo csrf_field(); ?>
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Process being audited:</label>
                                <input disabled type="text" name="processAudit" class="form-control"  placeholder="Enter process name:"required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Auditor:</label>
                                <input  disabled type="text" name="auditor" class="form-control"  placeholder="Enter Auditor name:" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Date (MM/DD/YYYY):</label>
                                <input  disabled type="date" max="2999-12-31" name="auditDate" class="form-control" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Non-Conformities:</label>
                                <input  disabled type="number" name="nonConformities" required class="form-control  validate_number" id="nonConformities" placeholder="Enter no of non-conformities" min="0">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Number of Observations:</label>
                                <input  disabled type="number" name="Observations" min="0" class="form-control  validate_number"  placeholder="Enter no of observations" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Non-Conformance Report Reference (if applicable):</label>
                                <input  disabled type="text" name="nonConfReport" class="form-control validate_number"  placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Audit Actions: </label>
                                <textarea name="AdutiActions" class="form-control"  placeholder="Enter Audit Actions:" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Audit Frequency (Months):</label>
                                <input type="number" min="1" max="12" name="dateFrequency" class="form-control" placeholder="Enter Non-Conformance:" disabled>
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
														<input type="radio"  disabled  value="Yes"  name="qmsCorects"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio"  disabled value="No"  name="qmsCorects"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio"  disabled value="NA" name="qmsCorects"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidence" disabled class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>2 - Is this process being implemented as detailed in documented information?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="needExpactations"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="needExpactations"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="needExpactations"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" disabled name="evidance2" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction3"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction3"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction3"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" disabled name="evidence3"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>4 - Are key performance indicator information being monitored for this process?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction4"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction4"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction4"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" disabled name="evidance4"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction5"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction5"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction5"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" disabled name="evidence5" placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>6 - Have previous targets and objectives been reviewed for this process?</label>
													<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction6"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction6"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction6"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance7" disabled class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>7 - Are all supporting procedures and work instructions used and at the correct revision?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction7"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction7"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction7"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance8" disabled class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>8 - Are all equipment calibrated, up-to-date and recorded?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction9"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction9"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction9"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" name="evidance9" disabled class="form-control"  placeholder="Enter Evidence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>9 - Is the job paperwork satisfactory? Record the job details for this process here.</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" disabled value="Yes" name="correction10"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="No" name="correction10"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" disabled value="NA" name="correction10"> NA
														<span></span>
													</label>
												</div>
												
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" disabled name="evidance10" class="form-control" placeholder="Enter Evidence:">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence:</label>
											<input type="file" name="attach_evidence" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Any other issues?</label>
											<input type="text" name="any_issues" disabled class="form-control"  placeholder="Enter Any other issues:">
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
<?php $__env->stopSection(); ?>
<script>
    function getEid(data){
        console.log(data);

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
         $("#viewProcessAudit").modal('show');
     }
	 
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

     }
     
     

 </script>
 <?php $__env->startSection('myscript'); ?>
 <script>
     
function processAuditFormshow()
    {
        $(".process_audit_from_div").toggle();
    }
     
     $("#dateFrequency").on('keyup',function(){
         var value=parseInt($(this).val());
         if(value>12)
         {
             $('#dateFrequency').val('');
         }
         else if(value<0)
         {
             $('#dateFrequency').val('');
         }
         
     });
      $("#nonConformities2").on('keyup',function(){

          if(parseInt($("#nonConformities2").val()) >= 0)
         {
             
             $('#nonConformities2').val($("#nonConformities2").val());
         }else{
             $('#nonConformities2').val('');
         }
     });
      $("#nonConformities1").on('keyup',function(){
        
          if(parseInt($("#nonConformities1").val()) >= 0)
         {
             
             $('#nonConformities1').val($("#nonConformities1").val());
         }else{
             $('#nonConformities1').val('');
         }
     });
    
     function processAuditFormclose()
     {
         $(".process_audit_from_div").hide();
     }
 </script>
 <?php $__env->stopSection(); ?>



<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/dashboard/form_records/process_audit.blade.php ENDPATH**/ ?>