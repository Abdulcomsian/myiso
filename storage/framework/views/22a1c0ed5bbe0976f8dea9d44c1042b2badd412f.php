

<?php $__env->startSection('content'); ?>
<!-- begin:: Content -->
<style>    .risk_assessment_from_div .row:nth-child(even){     background:#FFF !important;        padding: 5px;    }</style>
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
                            <form action="<?php echo e(route('assessment')); ?> " method="POST">
                                <?php echo csrf_field(); ?>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Job Number:</label><br>
											<input type="text" min="1" class="form-control validate_number" name="jobNumber" required>
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Date (MM/DD/YYY):</label><br>
											<input type="date" max="2999-12-31" class="form-control" name="date" required>
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the quality standard?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="qualitySatandard" value="Yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="qualitySatandard" value="No"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="qualitySatandard" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsstandard">
										</div>
									</div>
                                </div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the delivery date?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="delevryStandard" value="yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="delevryStandard" value="no"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="delevryStandard" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsdelvery">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the price?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="priceRequiremnt" value="yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="priceRequiremnt" value="No"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="priceRequiremnt" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentprice">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Could interested parties be deemed affected?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="interestedDeemed" value="Yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="interestedDeemed" value="No"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="interestedDeemed" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsDeemed">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Decision Comment:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="DecisionComment" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Delivery Date (MM/DD/YYY):</label>
											<input type="date"  max="2999-12-31" class="form-control"  placeholder="Enter Comment" name="dateDevelry" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Probability (see instructions) - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
											<!--<input type="number" class="form-control" name="RiskProbability">-->
																						<select name="RiskProbability" id="RiskProbability" class="form-control" required>
											    <option value="">Select One</option>
											    
											    <option value="4">4</option>
											    <option value="3">3</option>
											    <option value="2">2</option>
											    <option value="1">1</option>
											    
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Severity (see instructions) - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
											<!--<input type="number" class="form-control" name="riskSeverity">-->
											
											<select name="riskSeverity" id="riskSeverity" class="form-control" required>
											    <option value="">Select One</option>
											    
											    <option value="4">4</option>
											    <option value="3">3</option>
											    <option value="2">2</option>
											    <option value="1">1</option>
											    
											</select>
											
										</div>
									</div>
								</div>
							
								<button type="submit" class="submitBtn">SUBMIT</button>
									<button onclick="riskAssessment()" type="reset" class="submitBtn" data-dismiss="modal" style="margin-right:7px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Risk Assessments Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Risk ID Number</th>
											<th>Job Number</th>
											<th>Order Date</th>
											<th>Quality Accepted?</th>
											<th>Delivery Accepted?</th>
											<th>Price Accepted?</th>
                                            <th>Risk Decision</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
									    <?php
									    $i=1
									    ?>
                                        <?php $__currentLoopData = $assessment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                        <tr>
                                            <td><?php echo e($i); ?></td>
                                            <!--<td><?php echo e($data->id); ?></td>-->
											<td><?php echo e($data->jobNumber); ?></td>
											
											<td><?php echo e(date('d-M-Y', strtotime($data->date))); ?></td>
											<td><?php echo e(ucfirst($data->qualitySatandard)); ?></td>
											<td><?php echo e(ucfirst($data->delevryStandard)); ?></td>
											<td><?php echo e(ucfirst($data->priceRequiremnt)); ?></td>
                                            <td><?php echo e(ucfirst($data->DecisionComment)); ?></td>
                                            <td>
                                              <button class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-toggle="modal" data-target="#viewData-<?php echo e($data->id); ?>" id="viewData_<?php echo e($data->id); ?>" title="View" type="button">
                                                  <i class="fa fa-eye"></i>
                                                  </button> 
                                               <!--EDIT MODAL-->
                                               <div class="modal fade" id="viewData-<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel2">View Risk Assessments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form>

			<div class="modal-body ">
                
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Job Number:</label><br>
								<input disabled type="text" class="form-control" name="jobNumber" value="<?php echo e($data->jobNumber); ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Date (MM/DD/YYY):</label><br>
								<input disabled type="date" max="2999-12-31" class="form-control" name="date" value="<?php echo e($data->date); ?>" disabled>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Can I meet the quality standard?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input disabled type="radio" name="qualitySatandard" value="Yes" <?php echo e($data->qualitySatandard == "Yes" ? 'checked':''); ?>> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="qualitySatandard" value="No" <?php echo e($data->qualitySatandard == "No" ? 'checked':''); ?>> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="qualitySatandard" value="NA"  <?php echo e($data->qualitySatandard == "NA" ? 'checked':''); ?>> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input disabled type="text" class="form-control"  placeholder="Enter Comment" name="commentsstandard" value="<?php echo e($data->commentsstandard); ?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Can I meet the delivery date?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input disabled type="radio" name="delevryStandard" value="yes"  <?php echo e($data->delevryStandard == "yes" ? 'checked':''); ?>> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="delevryStandard" value="no"  <?php echo e($data->delevryStandard == "no" ? 'checked':''); ?>> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="delevryStandard" value="NA"  <?php echo e($data->delevryStandard == "NA" ? 'checked':''); ?>> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input disabled type="text" class="form-control"  placeholder="Enter Comment" name="commentsdelvery" value="<?php echo e($data->commentsdelvery); ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Can I meet the price?: (<?php echo e($data->priceRequiremnt); ?>)</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input disabled type="radio" name="priceRequiremnt" value="yes"  <?php echo e($data->priceRequiremnt == "yes" ? 'checked':''); ?>> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="priceRequiremnt" value="No"  <?php echo e($data->priceRequiremnt == "No" ? 'checked':''); ?>> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="priceRequiremnt" value="NA"  <?php echo e($data->priceRequiremnt == "NA" ? 'checked':''); ?>> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input disabled type="text" class="form-control"  placeholder="Enter Comment" name="commentprice" value="<?php echo e($data->commentprice); ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Could interested parties be deemed affected?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input disabled type="radio" name="interestedDeemed" value="Yes"  <?php echo e($data->interestedDeemed == "Yes" ? 'checked':''); ?>> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="interestedDeemed" value="No"  <?php echo e($data->interestedDeemed == "No" ? 'checked':''); ?>> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input disabled type="radio" name="interestedDeemed" value="NA"  <?php echo e($data->interestedDeemed == "NA" ? 'checked':''); ?>> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input disabled type="text" class="form-control"  placeholder="Enter Comment" name="commentsDeemed" value="<?php echo e($data->commentsDeemed); ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Decision Comment:</label>
								<input disabled type="text" class="form-control"  placeholder="Enter Comment" name="DecisionComment" value="<?php echo e($data->DecisionComment); ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Delivery Date (MM/DD/YYY):</label>
								<input disabled type="date" max="2999-12-31" class="form-control"  placeholder="Enter Comment" name="dateDevelry" value="<?php echo e($data->dateDevelry); ?>">
							</div>
						</div>
					</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Probability (see instructions) - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
											<!--<input disabled type="number" class="form-control" name="RiskProbability">-->
											<select name="RiskProbability" id="RiskProbability" class="form-control" disabled>
											    <option value="">Select One</option>
											    
											    <option value="4" <?php echo e($data->RiskProbability == "4" ? 'selected="selected"':''); ?>>4</option>
											    <option value="3" <?php echo e($data->RiskProbability == "3" ? 'selected="selected"':''); ?>>3</option>
											    <option value="2" <?php echo e($data->RiskProbability == "2" ? 'selected="selected"':''); ?>>2</option>
											    <option value="1" <?php echo e($data->RiskProbability == "1" ? 'selected="selected"':''); ?>>1</option>
											    
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Severity (see instructions) - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
											<!--<input disabled type="number" class="form-control" name="riskSeverity">-->
											
											<select name="riskSeverity" id="riskSeverity" class="form-control" disabled>
											    <option value="">Select One</option>
											    
											    <option value="4" <?php echo e($data->riskSeverity == "4" ? 'selected="selected"':''); ?>>4</option>
											    <option value="3" <?php echo e($data->riskSeverity == "3" ? 'selected="selected"':''); ?>>3</option>
											    <option value="2" <?php echo e($data->riskSeverity == "2" ? 'selected="selected"':''); ?>>2</option>
											    <option value="1" <?php echo e($data->riskSeverity == "1" ? 'selected="selected"':''); ?>>1</option>
											    
											</select>
											
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
                                               <!--EDIT MODAL ENDS-->
                                               <button class="btn btn-sm btn-clean btn-icon btn-icon-md" type="button" onclick="EditData(<?php echo e($data); ?>);" title="Edit">
                                                <span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
                                               </button>
                                               
                                               
                                               <button data-toggle="modal" data-target="#confirm-<?php echo e($data->id); ?>" id="remove_<?php echo e($data->id); ?>" title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
 <i class="la la-trash"></i>
</button>
                  <!-- Delete Modal -->

                  <div class="modal fade modal-mini modal-primary" id="confirm-<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="<?php echo e(route('delete_assesment')); ?>" method="post">
                          <div class="modal-header justify-content-center"> <?php echo csrf_field(); ?> 
                            <div class="modal-profile"> Deleting an entry </div>
                          </div>
                          <div class="modal-body text-center">
                            <p>Are you sure you want to delete this entry?</p>
                          </div>
                          <div class="modal-footer">
                              <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                                               
                                            </td>

										</tr>
										<?php $i++  ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									</tbody>
								</table>
								<!--end: Datatable -->
                    		</div>
						</div>
					</div>


	</section>

	<!--End::Section-->
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Risk Assessments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="<?php echo e(route('editassessment')); ?> " method="POST">
                    <?php echo csrf_field(); ?>

			<div class="modal-body ">
			<input type="hidden" name="id"  value="" id="id_feild">
			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Job Number:</label><br>
											<input type="number" min="1" class="form-control validate_number" name="jobNumber" >
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Date (MM/DD/YYY):</label><br>
											<input type="date" max="2999-12-31" class="form-control" name="date" required>
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the quality standard?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="qualitySatandard" value="Yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="qualitySatandard" value="No"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="qualitySatandard" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsstandard">
										</div>
									</div>
                                </div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the delivery date?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="delevryStandard" value="yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="delevryStandard" value="no"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="delevryStandard" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsdelvery">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Can I meet the price?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="priceRequiremnt" value="yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="priceRequiremnt" value="No"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="priceRequiremnt" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentprice">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Could interested parties be deemed affected?:</label>
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="interestedDeemed" value="Yes" required> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="interestedDeemed" value="No"> No
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="interestedDeemed" value="NA"> NA
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsDeemed">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Decision Comment:</label>
											<input type="text" class="form-control"  placeholder="Enter Comment" name="DecisionComment" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Delivery Date (MM/DD/YYY):</label>
											<input type="date"  max="2999-12-31" class="form-control"  placeholder="Enter Comment" name="dateDevelry" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Probability (see instructions) - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
											<!--<input type="number" class="form-control" name="RiskProbability">-->
																						<select name="RiskProbability" id="RiskProbability" class="form-control" required>
											    <option value="">Select One</option>
											    
											    <option value="4">4</option>
											    <option value="3">3</option>
											    <option value="2">2</option>
											    <option value="1">1</option>
											    
											</select>
										</div>
									</div>
									
																		<div class="col-lg-6">
										<div class="form-group">
											<label>Risk Severity (see instructions) - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
											<!--<input type="number" class="form-control" name="riskSeverity">-->
											
											<select name="riskSeverity" id="riskSeverity" class="form-control" required>
											    <option value="">Select One</option>
											    
											    <option value="4">4</option>
											    <option value="3">3</option>
											    <option value="2">2</option>
											    <option value="1">1</option>
											    
											</select>
											
										</div>
									</div>
									
									
			
			</div>
			
			
	</div>
	<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right:20px;">Cancel</button>
								<button type="submit" class="submitBtn">Update</button>
	</div>
</div>
</div>
</div>



<?php $__env->stopSection(); ?>
<style>
    .risk_assessment_from_div .row:nth-child(even){
        background:#fff;
        padding: 5px;
    }
</style>
<script>
    function EditData(data){
        console.log(data);

        $("#id_feild").val(data.id);
         $("input[name='DecisionComment']").val(data.DecisionComment);
         $("input[name='RiskProbability']").val(data.RiskProbability);
         $("input[name='commentprice']").val(data.commentprice);
         $("input[name='commentsDeemed']").val(data.commentsDeemed);
         $("input[name='commentsdelvery']").val(data.commentsdelvery);
         $("input[name='commentsstandard']").val(data.commentsstandard);
         $("input[name='date']").val(data.date);
         $("input[name='dateDevelry']").val(data.dateDevelry);
         $("input[name='jobNumber']").val(data.jobNumber);

         $("input[name='delevryStandard'][value="+data.delevryStandard+"]").prop('checked',true);
         $("input[name='interestedDeemed'][value="+data.interestedDeemed+"]").prop('checked',true);
         $("input[name='priceRequiremnt'][value="+data.priceRequiremnt+"]").prop('checked',true);
         $("input[name='qualitySatandard'][value="+data.qualitySatandard+"]").prop('checked',true);

         $("select[name='RiskProbability']").val(data.RiskProbability);
         $("select[name='riskSeverity']").val(data.riskSeverity);

        $("#editModal").modal('show');

    }

</script>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/dashboard/form_records/risk_assessment.blade.php ENDPATH**/ ?>