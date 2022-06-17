@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>COSHH</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>Control of Substances Hazardous to Health (COSHH). COSHH is a method that allows employers to control substances that are hazardous to health. You can prevent or reduce workers exposure to hazardous substances by:</p>
<ul><li style="font-size:13px;color:#000;font-weight:500;">finding out what the health hazards are.</li>
<li style="font-size:13px;color:#000;font-weight:500;">deciding how to prevent harm to health (risk assessment).</li>
<li style="font-size:13px;color:#000;font-weight:500;">providing control measures to reduce harm to health.</li>
<li style="font-size:13px;color:#000;font-weight:500;">making sure they are used.</li>
<li style="font-size:13px;color:#000;font-weight:500;">keeping all control measures in good working order.</li>
<li style="font-size:13px;color:#000;font-weight:500;">providing information, instruction and training for employees and others.</li>
<li style="font-size:13px;color:#000;font-weight:500;">providing monitoring and health surveillance in appropriate cases.</li>
<li style="font-size:13px;color:#000;font-weight:500;">planning for emergencies.</li>
</ul>
<p>Most businesses use substances, or products that are mixtures of substances. Some processes create substances. These could cause harm to employees, contractors and other people.</p>
<p>Sometimes substances are easily recognised as harmful. Common substances such as paint, bleach or dust from natural materials may also be harmful.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="processinterestedForm()" class="addBtn">Add COSHH</a>
                    		</div>
                    	</div>
                    	<div class="process_interested_from_div" style="display:none">
                    		<form action="{{route('chemicalform')}}" method="POST">
                                @csrf
                    			<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Chemical Name:</label>
											<input type="text" name="chemicalname" class="form-control"  required placeholder="Enter Chemical Name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Chemical Description (What are the main constituents):</label>
											<input type="text" name="chemical_desc" class="form-control" required placeholder="Enter Chemical Description">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Chemical Type (Gas, liquid or solid):</label>
											<input type="text" name="chemical_type" class="form-control"  required placeholder="Enter Chemical Type (Gas, liquid or solid)">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Location Used (Consider area or department where the chemical is being used:</label>
											<input type="text" name="location" class="form-control" required  placeholder="Enter Location Used (Consider area or department where the chemical is being used">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Activity Hazard (Consider chemical use, making additions, chemical discarding etc):</label>
											<input type="text" name="activity_hazard" class="form-control" required placeholder="Enter Activity Hazard (Consider chemical use, making additions, chemical discarding etc)">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Identified Chemical Hazard (Consider Corrosive; Very Toxic; Oxidiser etc):</label>
											<input type="text" name="identified_chazard" class="form-control" required placeholder="Enter Identified Chemical Hazard">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Identified Hazard (Consider Splashes and breathing fume vapour etc):</label>
											<input type="text" name="identified_hazard" class="form-control" required placeholder="Enter Identified Hazard">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Target Organs:</label>
											<input type="text" name="target_organs" class="form-control" required placeholder="Enter Target Organs">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Who is at Risk:</label>
											<input type="text" name="who_risk" class="form-control" required placeholder="Who is at Risk:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Protection Required (Consider gloves, glasses, overalls or shoes etc):</label>
											<input type="text" name="protection_required" class="form-control" required placeholder="Enter Protection Required">
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-lg-12">
										<div class="form-group">
											<label>Is this chemical still used in production or legacy?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" required value="Yes"  name="still_used"> Yes, still used
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" required value="No"  name="still_used"> No, legacy
														<span></span>
													</label>
											
												</div>
										</div>
									</div>
										<div style="text-align: right; width: 100%;">
								    <button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="cosh()" class="submitBtn" style="margin-right: 7px;">Cancel</button>
								</div>
								</div>
								
							
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>S-No</th>
											<th>Chemical Name</th>
											<th>Chemical Description</th>
											<th>Location</th>
											<th>Activity</th>
											<th>Still used</th>
										<!--	<th>Created At</th>-->
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        <?php $counter=0; ?>
										@php
											$i=1;
										
										@endphp
                                        @foreach ($chemical as $data)
                                        <?php $counter++; ?>
										<tr>
											<td>{{ $i++}}</td>
											<td>{{ $data->chemical_name}}</td>
											<td>{{ $data->chemical_desc}}</td>
											<td>{{ $data->location_used}}</td>
											<td>{{$data->activity_hazard}}</td>
											<td>{{$data->still_used}}</td>
											<!--<td>{{date('d-M-Y h:i', strtotime($data->created_at))}}</td>-->

											<td>
											    <button class="btn btn-sm btn-clean btn-icon btn-con-md"  title="View" onclick="viewinterested({{$data}});">
                                                    <!--<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
                                                    <!--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
                                                    <!--        <polygon points="0 0 24 0 24 24 0 24"/>-->
                                                    <!--        <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>-->
                                                    <!--        <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#5d78ff" fill-rule="nonzero"/>-->
                                                    <!--    </g>-->
                                                    <!--</svg></span>-->
                                                    
                                                                                                    <i class="fa fa-eye"></i>
                                            </button>
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" onclick="getEid({{$data}});"><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span></button>
                                            
                                            <button data-toggle="modal" data-target="#deleteChemechal_id{{$data->id}}" style="top: -2px;position: relative;border: none !important;background: transparent !important;">
                                                    <span class="svg-icon svg-icon-md">
												    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											
													<rect x="0" y="0" width="24" height="24"></rect>											
													<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>	
													<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
                                            </button>
                                            </td>
                                        </tr>
                                        <!--delete modal for chemecal control-->
                                        <div class="modal fade" id="deleteChemechal_id{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                        	<div class="modal-dialog" role="document">
                                        		<div class="modal-content">
                                        			<div class="modal-header">
                                        				<h5 class="modal-title" id="exampleModalLabel">Deleting Chemical Record</h5>
                                        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        				</button>
                                        			</div>
                                        			<div class="modal-body">
                                        				<p>Are you sure you want to delete this entry?</p>
                                        			</div>
                                        			<div class="modal-footer">
                                                      <form action="{{url('/chemical_control_delete')}}" method="POST">
                                                         @csrf                                                         
                                                         <input type="hidden" name="id" value="{{$data->id}}">
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
		</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Chemical Control</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
				<form action="{{route('deleteInterested')}} " method="POST">
				@csrf
                    <input type="hidden" name="id" value="" id="re_id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editinterestedmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-lg">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Chemical Control Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="{{route('chemicalUpdate')}}" method="POST">
                @csrf
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Chemical Control:</label>
								<input type="text" name="chemical_name" required class="form-control"  placeholder="Enter Chemical Name">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Chemical Description (What are the main constituents):</label>
								<input type="text" name="chemical_desc" required class="form-control"  placeholder="Enter Chemical Description">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Chemical Type (Gas, liquid or solid):</label>
								<input type="text" name="chemical_type" required class="form-control"  placeholder="Enter Chemical Type">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Location Used (Consider area or department where the chemical is being used:</label>
								<input type="text" name="location" required class="form-control"  placeholder="Enter Location">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Activity Hazard (Consider chemical use, making additions, chemical discarding etc):</label>
								<input type="text" name="activity_hazard" required class="form-control"  placeholder="Enter Activity Hazard">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Identified Chemical Hazard (Consider Corrosive; Very Toxic; Oxidiser etc):</label>
								<input type="text" name="identified_chazard" required class="form-control"  placeholder="Enter Identified Chemical Hazard" id="identified_chazard">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Identified Hazard (Consider Splashes and breathing fume vapour etc):</label>
								<input type="text" name="identified_hazard" required class="form-control"  placeholder="Enter Identified Hazard" id="identified_hazard">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Target Organ</label>
								<input type="text" name="target_hazard" required class="form-control"  placeholder="Enter Identified Target Hazard">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Who is at Risk</label>
								<input type="text" name="who_risk" required class="form-control"  placeholder="Enter Who is at Risk">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Protection Required (Consider gloves, glasses, overalls or shoes etc):</label>
								<input type="text" name="protection_required" required class="form-control"  placeholder="Protection Required">
							</div>
						</div>
					</div>
					

					<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Is this chemical still used in production or legacy?</label>
											<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" value="Yes"  name="still_used"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" value="No"  name="still_used"> No
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<!--<div class="col-lg-12">-->
									<!--	<div class="form-group">-->
									<!--		<label>Evidence:</label>-->
									<!--		<input type="text" class="form-control" name="evidence30" placeholder="Enter Evidence::">-->
									<!--	</div>-->
									<!--</div>-->
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

<div class="modal fade" id="viewinterestedparty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Chemical Control Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form>
                @csrf
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                     <div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Chemical Control</label>
								<input type="text" name="chemical_name"  required class="form-control"  placeholder="Enter Chemical Name:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Chemical Description (What are the main constituents):</label>
								<input type="text" name="chemical_desc" required class="form-control"  placeholder="Enter Chemical Description:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Chemical Type (Gas, liquid or solid):</label>
								<input type="text" name="chemical_type"  required class="form-control"  placeholder="Enter Chemical Type:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Location Used (Consider area or department where the chemical is being used:</label>
								<input type="text" name="location" required class="form-control"  placeholder="Enter Location:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Activity Hazard (Consider chemical use, making additions, chemical discarding etc):</label>
								<input type="text" name="activity_hazard" required class="form-control"  placeholder="Enter Activity Hazard:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Identified Chemical Hazard (Consider Corrosive; Very Toxic; Oxidiser etc):</label>
								<input type="text" name="identified_chazard" required class="form-control"  placeholder="Enter Identified Chemical Hazard:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Identified Hazard (Consider Splashes and breathing fume vapour etc):</label>
								<input type="text" name="identified_hazard" required class="form-control"  placeholder="Enter Identified Hazard:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Target Organ</label>
								<input type="text" name="target_hazard" required class="form-control"  placeholder="Enter Identified Target Hazard:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Who is at Risk</label>
								<input type="text" name="who_risk" required class="form-control"  placeholder="Enter Who is at Risk:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Protection Required (Consider gloves, glasses, overalls or shoes etc):</label>
								<input type="text" name="protection_required" required class="form-control"  placeholder="Protection Required:">
							</div>
						</div>
					</div>
					

					<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Is this chemical still used in production or legacy?</label>
											<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" required value="Yes"  name="still_used"> Yes
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" required value="No"  name="still_used"> No
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<!--<div class="col-lg-12">-->
									<!--	<div class="form-group">-->
									<!--		<label>Evidence:</label>-->
									<!--		<input type="text" class="form-control" name="evidence30" placeholder="Enter Evidence::">-->
									<!--	</div>-->
									<!--</div>-->
							</div> 
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close </button>
			

            </div>
        </form>
		</div>
	</div>
</div>
@endsection
<script>
    function getEid(data){
        console.log(data);
console.log(data);
         $("#id_feild").val(data.id);
         $("input[name='chemical_name']").val(data.chemical_name);
         $("input[name='chemical_desc']").val(data.chemical_desc);
         $("input[name='chemical_type']").val(data.chemical_type);
         $("input[name='location']").val(data.location_used);
         $("input[name='activity_hazard']").val(data.activity_hazard);
         $("input[name='identified_chazard']").val(data.identified_chazard);
         $("input[name='identified_hazard']").val(data.identified_hazard);
         
         $("input[name='target_hazard']").val(data.target_hazard);
         $("input[name='who_risk']").val(data.who_risk);
         $("input[name='protection_required']").val(data.protection_required);
         $("input[name='still_used'][value="+data.still_used+"]").prop('checked',true);
         $("#editinterestedmodal").modal('show');
     }
	   function viewinterested(data){
        console.log(data);

          $("#id_feild").val(data.id);
         $("input[name='chemical_name']").val(data.chemical_name);
         $("input[name='chemical_desc']").val(data.chemical_desc);
         $("input[name='chemical_type']").val(data.chemical_type);
         $("input[name='location']").val(data.location_used);
         $("input[name='activity_hazard']").val(data.activity_hazard);
         $("input[name='identified_chazard']").val(data.identified_chazard);
         $("input[name='identified_hazard']").val(data.identified_hazard);
         $("input[name='target_hazard']").val(data.target_hazard);
         $("input[name='who_risk']").val(data.who_risk);
         $("input[name='protection_required']").val(data.protection_required);
         $("input[name='still_used'][value="+data.still_used+"]").prop('checked',true);
         $("#viewinterestedparty").modal('show');
     }
	 
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

     }
function cosh(){
				if($(".process_interested_from_div").css("display")==="block"){
					$(".process_interested_from_div").css("display","none");
				}
				else{
					$(".process_interested_from_div").css("display","block");
				}
			}
 </script>


