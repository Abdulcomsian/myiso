@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Add or Amend a Calibration Record</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
			<p>Calibration is the testing and/or parameter settings of machinery or instruments to ensure they are working correctly. Depending on the environment this could be heavy machinery or a desktop printer. </p>

<p>To add a record, click on the “Add Calibration Record” button. All Calibration Records created require a frequency of calibration, this is shown on your MyISOOnline control panel as a reminder.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="calibrationForm()" class="addBtn">ADD CALIBRATION RECORD</a>
                    		</div>
                    	</div>
                    	<div class="calibration_from_div">
                            <form action="{{route('calibration')}} " method="POST"  enctype="multipart/form-data">
                                @csrf
                    			<div class="row">
                    				{{-- <div class="col-lg-6">
                    					<div class="form-group">
											<label>Calibration ID Number (See table below. For amendments only):</label><br>
											<input type="number" class="form-control" name="calibrationid" required="required">
										</div>
                    				</div> --}}
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Equipment Name:</label><br>
											<input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name:" required="required">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Serial Number:</label>
											<input type="text" class="form-control" name="serialNum"  placeholder="Enter Serial Number:" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Location:</label>
											<input type="text" class="form-control" name="locaction"  placeholder="Enter Location:" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Test Method Reference:</label>
											<input type="text" class="form-control" name="testMethod"  placeholder="Enter Test Method Reference:" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Acceptance Criteria:</label>
											<input type="text" class="form-control" name="acceptance"  placeholder="Enter Acceptance Criteria:" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date Calibrated:</label>
											<input type="date" max="2999-12-31" class="form-control" name="calibratedDate" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Certificate Number:</label>
											<input type="text" class="form-control" name="certificatenumber"  placeholder="Enter Certificate Number:" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Frequency (Months):</label>
											<input type="number" oninput="this.value = Math.abs(this.value)" min="1" max="12" name="freq" class="form-control" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Report Reviewer:</label>
											<input type="text" class="form-control" name="reportRev"  placeholder="Enter report reviewer's name:" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Sentence (Pass or Fail):</label>
											<select name="sentence" class="form-control" required="required">
											<option value="">Select One</option>
											<option value="Pass">Pass</option>
											<option value="Fail">Fail</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
											<input name="attach_evidence" type="file" class="form-control"
												   accept="all">
										</div>
									</div>
								</div>
								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="calibration()" class="submitBtn" style="margin-right: 7px;">Cancel</button>
									<!--<button type="button"  class="btn btn-secondary submitBtn " style="margin-right:7px;">Cancel</button>-->
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Calibration Due</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
										    <th>Equipment ID</th>
											<!--<th>Equipment ID</th>-->
											<th>Equipment Name</th>
											<th>Serial Number</th>
											<th>Date Calibrated</th>
                                            <th>Date Due</th>
                                            <th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter=0; ?>
										 @foreach ($calibration as $data)
										 <?php $counter++; ?>
														
																	 
										 <tr>
								    		<td> {{ $counter}}</td>
                                            <!--<td>{{$data->id}}</td>-->
                                            <td>{{$data->equipment}}</td>
                                            <td>{{$data->serialNum}}</td>
                                          <td>{{date('d/m/Y', strtotime($data->calibratedDate))}}</td>
                                            <!--<td>{{$data->calibratedDate}}</td>-->
											@php $d = strtotime("+$data->freq months",strtotime($data->calibratedDate)); @endphp
                                            <td>{{date("d/m/Y",$d)}}</td>
                                            <td> 
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value="" onclick="getEid({{$data}});"><span class="svg-icon svg-icon-md">								<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
                                                </button>
                                                <button data-toggle="modal" data-target="#deleteCalibrat_{{$data->id}}" style="top: -2px;position: relative;border: none !important;background: transparent !important;">
                                                    <span class="svg-icon svg-icon-md">
												    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											
													<rect x="0" y="0" width="24" height="24"></rect>											
													<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>	
													<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
       											 </button>
												 	<!-- new  -->
													 <button class="btn btn-sm btn-clean btn-icon btn-icon-md"
															title="View Customer Details" value="" o data-toggle="modal" data-target="#model3"><i
																class="fa fa-eye"></i>
													</button>


													<!-- Modal -->
													<div class="modal fade" id="model3" tabindex="-1" role="dialog" aria-labelledby="model3Label" aria-hidden="true">
														<div class="modal-dialog" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Calibration Due</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">

                        <div class="row">
                            <input type="hidden" name="id" id="editproject" value="">

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>System ID Number:</label><br>
                                    <input type="number" readonly class="form-control"  name="systemid">
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Surname:</label><br>
                                    <input type="text" class="form-control" name="surname" placeholder="Enter Surname">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" name="first_name"  placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group edit-emp-number-div">
                                    <label>Employee ID:</label> 
                                    <input type="text" name="empNumber" required class="form-control" data-type="edit">
         		 								 <!--                         <select name="empNumber" required class="form-control">-->
											<!--    <option>Select One</option>-->
											<!--    @if(isset($userinfo) && $userinfo!= "")-->
											<!--    @foreach($userinfo as $item)-->
											<!--    <option value="{{$item->id}}" title="{{ $item->first_name }}">{{$item->empNumber.' ('.$item->first_name.')'}}</option>-->
											<!--    @endforeach-->
											<!--    @endif-->
											<!--</select>-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Start Date (YYYY/MM/DD):</label>
                                    <input name="startDate" max="2999-12-31" type="date" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Job Details:</label>
                                    <input type="text" name="jobdetails" class="form-control"  placeholder="Enter Job Details:">
                                </div>
                            </div>
                        </div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Upload Employee CV:</label>
							<input name="employee_cv" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf">
						</div>
					</div>
				</div>
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group">
																		<label>Attach Evidence <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span>:</label>
																		<div class="evidence_attachemnt_div"></div>
																	</div>
																</div>
															</div>
			</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
															</div>
														</div>
													</div>
                                            </td>

                                        </tr>
                                        
                                        <!--MODEL FOR DELETE-->
                                        <div class="modal fade" id="deleteCalibrat_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        	<div class="modal-dialog" role="document">
                                        		<div class="modal-content">
                                        			<div class="modal-header">
                                        				<h5 class="modal-title" id="exampleModalLabel">Deleting Entry</h5>
                                        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        				</button>
                                        			</div>
                                        			<div class="modal-body">
                                        				<p>Are you sure you want to delete this entry?</p>
                                        			</div>
                                        			<div class="modal-footer">
                                                     <form action="{{url('/calibration_delete')}}" method="POST">
                                                         @csrf
                                                         <input type="hidden" name="id" value="{{$data->id}}"/>
                                        				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        				<button type="submit" class="btn btn-danger">Yes</button>
                                        			 </form>
                                        			</div>
                                        		</div>
                                        	</div>
                                        </div>

                                        @endforeach
                                    </tbody>
								</table>
								<!--end: Datatable -->
                    	</div>
					</div>
					</div>
					 <div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Total Items Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Equipment ID</th>
											<th>Equipment Name</th>
											<th>Serial Number</th>
											<th>Location</th>
											<th>Test Method</th>
											<th>Acceptance Criteria</th>
											<th>Date Calibrated</th>
											<th>Certificate Number</th>
											<th>Frequency (M)</th>
											<th>Reviewer</th>
											<th>Sentence</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter=0; ?>
						 				 @foreach ($calibration as $data)
										 <?php $counter++; ?>
														
																	 
										 <tr>
											<td> {{ $counter}}</td>
                                            
                                            <td>{{$data->equipment}}</td>
                                            <td>{{$data->serialNum}}</td>
                                            <td>{{$data->locaction}}</td>
                                            <td>{{$data->testMethod}}</td>
                                            <td>{{$data->acceptance}}</td>
											<td>{{date('d/m/Y', strtotime($data->calibratedDate))}}</td>
                                            <td>{{$data->certificatenumber}}</td>

                                            <td>{{$data->freq}}</td>
                                            <td>{{$data->reportRev}}</td>
                                            <td>{{$data->sentence}}</td>
                                        </tr>
                                        @endforeach
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting Entry</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
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
											<input type="number" class="form-control"  placeholder="Enter ID:">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Supplier Name:</label><br>
											<input type="text" class="form-control"  placeholder="Enter Supplier Name:">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Address:</label>
											<input type="text" class="form-control"  placeholder="Enter Supplier Address:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>City:</label>
											<input type="text" class="form-control"  placeholder="Enter City:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>County or State:</label>
											<input type="text" class="form-control"  placeholder="Enter Country or State:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Post Code or Zip Code:</label>
											<input type="text" class="form-control"  placeholder="Enter Customer Contact Number:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Country:</label>
											<input type="text" class="form-control"  placeholder="Enter Country">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Telephone:</label>
											<input type="text" class="form-control"  placeholder="Enter Supplier Telephone:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Email::</label>
											<input type="email" class="form-control"  placeholder="Enter Supplier Email:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Contact Name:</label>
											<input type="text" class="form-control"  placeholder="Enter Supplier Contact Number:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Supplier Service:</label>
											<input type="email" class="form-control"  placeholder="Enter Supplier Service:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
											<input name="attach_evidence" type="file" class="form-control"
												   accept="all">
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

<div class="modal fade" id="editcustomer_rev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Calibration Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form action="{{route('calibrationedit')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Calibration ID Number (See table below. For amendments only):</label><br>
                                <input type="number" class="form-control" name="calibrationid">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Equipment Name:</label><br>
                                <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name:" required="required">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Serial Number:</label>
                                <input type="text" class="form-control" name="serialNum"  placeholder="Enter Serial Number:" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Location:</label>
                                <input type="text" class="form-control" name="locaction"  placeholder="Enter Location:" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Test Method Reference:</label>
                                <input type="text" class="form-control" name="testMethod"  placeholder="Enter Test Method Reference:" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Acceptance Criteria:</label>
                                <input type="text" class="form-control" name="acceptance"  placeholder="Enter Acceptance Criteria:" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date Calibrated:</label>
                                <input type="date" max="2999-12-31" class="form-control" name="calibratedDate" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Certificate Number:</label>
                                <input type="text" class="form-control" name="certificatenumber"  placeholder="Enter Certificate Number:" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Frequency (Months):</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="1" max="12" name="freq" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Report Reviewer:</label>
                                <input type="text" class="form-control" name="reportRev"  placeholder="Enter Report Reviewer:" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Sentence (Pass or Fail):</label>
                                <select name="sentence" class="form-control" required="required" id="sentence">
                                     <option value="">Select One</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                                </select>
                            </div>
                        </div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
								<input name="attach_evidence" type="file" class="form-control"
									   accept="all">
							</div>
						</div>
					</div>
                    <button type="submit" class="submitBtn ml-2">Update</button>
                    <button type="button" class="submitBtn"  data-dismiss="modal" aria-label="Close">Cancel</button>
                </form>
		</div>
	</div>
</div>
</div>
@endsection
<script>
    function getEid(data){
       console.log(data.sentence);
         $("#editproject").val(data.id);
         $("input[name='testMethod']").val(data.testMethod);
         $("input[name='serialNum']").val(data.serialNum);
        
                $("select[name='sentence']").val(data.sentence);
         $("#sentence").val(data.sentence);
        
         $("input[name='reportRev']").val(data.reportRev);
         $("input[name='locaction']").val(data.locaction);
         $("input[name='freq']").val(data.freq);
         $("input[name='equipment']").val(data.equipment);
         $("input[name='certificatenumber']").val(data.certificatenumber);
         $("input[name='calibrationid']").val(data.calibrationid);
         $("input[name='calibratedDate']").val(data.calibratedDate);
         $("input[name='acceptance']").val(data.acceptance);
		$("#editcustomer_rev").modal('show');
     }
     
     function calibration(){
         
				if($(".calibration_from_div").css("display")==="block"){
					$(".calibration_from_div").css("display","none");
				}
				else{
					$(".calibration_from_div").css("display","block");
				}
			}
</script>
