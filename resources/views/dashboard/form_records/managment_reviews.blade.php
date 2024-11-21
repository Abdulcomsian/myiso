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
            <p>Management Reviews are to ensure that the company can measure the effectiveness of the management system, whilst focusing on the direction of the business and its continual improvement. These should be conducted monthly, quarterly, semiannually, or annually depending on the size and nature of the business.</p>

				<p>To add a record, click on the “Add Management review” button. To amend a record, click on the edit icon of the entry that needs to be modified or deleted.</p>

                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="managemnetReviewForm()" class="addBtn">ADD MANAGEMENT REVIEW</a>
                    		</div>
                    	</div>
                    	<div class="managemnet_review_from_div">
                        <form action="{{route('mgtreview')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                    				<!-- <div class="col-lg-6">
                    					<div class="form-group">
											<label>Management Review ID Number (See table below. For amendments only):</label><br>
											<input type="number" class="form-control" name="mgtreviewId">
										</div>
                                    </div>  -->
                                    <input type="hidden" class="form-control" name="mgtreviewId" value="241">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Management Review Date:</label><br>
											<input type="date" max="2999-12-31" required class="form-control" name="reviewdate">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Management Review Meeting Attendees:</label>
                                            <textarea class="form-control" name="meetingatt" required placeholder="Enter attendees name:" cols="30" rows="4"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Review of previous meeting minutes:</label>
                                            <textarea class="form-control" name="prevmeeting" required placeholder="Enter Previous meetings key points" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                                            <textarea class="form-control" name="recommendedchange" required placeholder="Enter Changes" cols="30" rows="4"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                                            <textarea class="form-control" placeholder="Enter Summary" name="sammarisecustomr" required placeholder="" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comment on previous objectives:</label>
                                            <textarea class="form-control" name="prevobjectv" placeholder="Enter Comments of Previous Objects" required placeholder="" cols="30" rows="4"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Process Audit performance and conformity of products and services:</label>
                                            <textarea class="form-control" placeholder="Enter Feedback of performance of products and services created in process audits" name="conformity" required  placeholder="" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Nonconformities and corrective actions:</label>
                                            <textarea class="form-control" name="nonconformities" required placeholder="Enter Nonconformities and corrective actions" cols="30" rows="4"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Monitoring and measurement results:</label>
                                            <textarea class="form-control" name="monitoringres" required  placeholder="Enter Outcome" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comment on Audit results:</label>
                                            <textarea class="form-control" name="auditres" required placeholder="Enter comments of audit findings" cols="30" rows="4"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comment on the performance of external providers:</label>
                                            <textarea class="form-control" name="externalprovider" required placeholder="Enter Comments of external providers performance" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>The adequacy of resources and changes recommended:</label>
                                            <textarea class="form-control" name="adequacy" required placeholder="Enter Comments of adequacy of the resources and recommended changes" cols="30" rows="4"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>The effectiveness of actions taken to address risks and opportunities:</label>
                                            <textarea class="form-control" name="effectiveness" required placeholder= "Enter Effectiveness of actions" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Add New Quality Objectives, Targets and
                                        opportunities for improvement. Consider who is
                                        responsible, when they will be completed and
                                        what is considered a success. Objectives should be both quality based and financial. Consider aligning objectives to the quality policy:</label>
                                            <textarea class="form-control" name="newquality" required placeholder="Enter New Quality Objectives" cols="30" rows="4"></textarea>
										</div>
									</div>
								</div>
                                <div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Attachment File (PDF, jpeg, txt, .docx, doc, png):</label>
                                            <input name="attach_file" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf,.jpeg,.png">
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="mngmnt_reviews()" class="submitBtn" style="margin-right:12px;">Cancel</button>
								
								
								<!--<button  onclick="customerForm()" type="reset" class="submitBtn"style="margin-right: 8px;">Cancel</button>-->
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Management Review</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>ID Number</th>
											<th>Date</th>
											<th>Attendees</th>
											<th>Planned Objectives</th>
											<!--<th>Detail View</th>-->
											<th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($userData as $item)
                                           <tr>
                                               <!--<td> {{$item->id}}</td>-->
                                               <td>@php echo $i; @endphp</td>
                                               <td> {{date('d/m/Y', strtotime($item->reviewdate))}}</td>
                                               <td> {{$item->meetingatt}}</td>
                                               <td> {{$item->newquality}}</td>
                                               <td>
                                                    <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value=""
                                                 onclick="displaydetail({{json_encode($item)}});">
                                                 <i class="fa fa-eye"></i>
                                               </button>
                                               <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value="" onclick="getEid({{$item}});"><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
                                               </button>
                                               <button  onclick="deleteData({{$item}})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" value=""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
                                           </button>
                                            </td>
                                        <!--       <td>-->
                                        <!--   {{-- <button  onclick="deleteData({{$item}})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" value=""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>-->
                                        <!--   </button> --}}-->
                                        <!--</td>-->

                                           </tr>
                                           @php $i++; @endphp
                                        @endforeach
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting Management review</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deletemgtreview')}}" method="POST">
				@csrf
                    <input type="hidden" name="id" id="validid">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Management Reviews Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form>
                        <div class="row">
                            <input type="hidden" readonly disabled name="id" value="" id="id_feild">
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review ID Number (See table below. For amendments only):</label><br>
                                    <input type="number" readonly disabled class="form-control" name="1mgtreviewId">
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Management Review Date:</label><br>
                                    <input type="date" readonly disabled class="form-control" name="1reviewdate">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review Meeting Attendees:</label>
                                    <input type="text" readonly disabled class="form-control" name="1meetingatt" placeholder="Enter attendees name:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review of previous meeting minutes:</label>
                                    <input type="text" readonly disabled class="form-control" name="1prevmeeting" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                                    <input type="text" readonly disabled class="form-control" placeholder="Enter Changes" name="1recommendedchange">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                                    <input type="text" readonly disabled class="form-control" placeholder="Enter Summary" name="1sammarisecustomr">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on previous objectives:</label>
                                    <input type="text" readonly disabled class="form-control" placeholder="Enter Comments of Previous Objects" name="1prevobjectv">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Process performance and conformity of products and services:</label>
                                    <input type="text" readonly disabled placeholder="Enter Feedback of performance of products and services" class="form-control" name="1conformity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nonconformities and corrective actions:</label>
                                    <input type="text" readonly disabled class="form-control" placeholder="Enter Nonconformities and corrective actions" name="1nonconformities">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Monitoring and measurement results:</label>
                                    <input type="text" readonly disabled class="form-control" placeholder="Enter Outcome" name="1monitoringres">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on Audit results:</label>
                                    <input type="text" readonly disabled class="form-control" name="1auditres">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on the performance of external providers:</label>
                                    <input type="text" readonly disabled class="form-control" name="1externalprovider">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The adequacy of resources and changes recommended:</label>
                                    <input type="text" readonly disabled class="form-control" name="1adequacy">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The effectiveness of actions taken to address risks and opportunities:</label>
                                    <input type="text" readonly disabled class="form-control" name="1effectiveness">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
                                    <input type="text" readonly disabled class="form-control" name="1newquality">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Attachment File (PDF, jpeg, txt, .docx, doc, png):</label>
                                    <div class="file_attachemnt_div">
                                    </div>
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

<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Management Reviews Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form action="{{route('mgtreviewupdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="row">
                            <input type="hidden" name="id" value="" id="sdsd">
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review ID Number (See table below. For amendments only):</label><br>
                                    <input type="number" class="form-control" name="mgtreviewId">
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Management Review Date:</label><br>
                                    <input type="date" max="2999-12-31" required class="form-control" name="reviewdate">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review Meeting Attendees:</label>
                                    <input type="text" class="form-control" required name="meetingatt" placeholder="Enter attendees name:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review of previous meeting minutes:</label>
                                    <input type="text" class="form-control" required name="prevmeeting" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                                    <input type="text" class="form-control" placeholder="Enter Changes" required name="recommendedchange">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                                    <input type="text" class="form-control" placeholder="Enter Summary" required name="sammarisecustomr">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on previous objectives:</label>
                                    <input type="text" class="form-control" placeholder="Enter Comments of Previous Objects" required name="prevobjectv">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Process performance and conformity of products and services:</label>
                                    <input type="text" class="form-control" placeholder="Enter Feedback of performance of products and services" required  name="conformity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nonconformities and corrective actions:</label>
                                    <input type="text" class="form-control"placeholder="Enter Nonconformities and corrective actions"  name="nonconformities">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Monitoring and measurement results:</label>
                                    <input type="text" class="form-control" placeholder="Enter Outcome" required name="monitoringres">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on Audit results:</label>
                                    <input type="text" class="form-control" required name="auditres">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on the performance of external providers:</label>
                                    <input type="text" class="form-control"  required name="externalprovider">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The adequacy of resources and changes recommended:</label>
                                    <input type="text" class="form-control" required name="adequacy">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The effectiveness of actions taken to address risks and opportunities:</label>
                                    <input type="text" class="form-control" required name="effectiveness">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
                                    <input type="text" class="form-control" required name="newquality">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Attachment File (PDF, jpeg, txt, .docx, doc, png):</label>
                                    <input name="attach_file" type="file" class="form-control" accept="image/*,.doc, .docx,.txt,.pdf,.jpeg,.png">
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


{{-- deyail modal --}}

@endsection
<script>
    function getEid(data){
        console.log(data);
         $("#sdsd").val(data.id);
         $("input[name='adequacy']").val(data.adequacy);
         $("input[name='mgtreviewId']").val(data.mgtreviewId);
         $("input[name='auditres']").val(data.auditres);
         $("input[name='conformity']").val(data.conformity);
         $("input[name='effectiveness']").val(data.effectiveness);
         $("input[name='externalprovider']").val(data.externalprovider);
         $("input[name='meetingatt']").val(data.meetingatt);
         $("input[name='monitoringres']").val(data.monitoringres);
         $("input[name='newquality']").val(data.newquality);
         $("input[name='nonconformities']").val(data.nonconformities);
         $("input[name='prevmeeting']").val(data.prevmeeting);
         $("input[name='prevobjectv']").val(data.prevobjectv);
         $("input[name='recommendedchange']").val(data.recommendedchange);
         $("input[name='reviewdate']").val(data.reviewdate);
         $("input[name='sammarisecustomr']").val(data.sammarisecustomr);
         $("#editSupplier").modal('show');
     }
     function deleteData(data){
         $("#validid").val(data.id);
         $("#deleteRequirment").modal('show');

     }
   function  displaydetail(data){
         $("input[name='1adequacy']").val(data.adequacy);
         $("input[name='1mgtreviewId']").val(data.mgtreviewId);
         $("input[name='1auditres']").val(data.auditres);
         $("input[name='1conformity']").val(data.conformity);
         $("input[name='1effectiveness']").val(data.effectiveness);
         $("input[name='1externalprovider']").val(data.externalprovider);
         $("input[name='1meetingatt']").val(data.meetingatt);
         $("input[name='1monitoringres']").val(data.monitoringres);
         $("input[name='1newquality']").val(data.newquality);
         $("input[name='1nonconformities']").val(data.nonconformities);
         $("input[name='1prevmeeting']").val(data.prevmeeting);
         $("input[name='1prevobjectv']").val(data.prevobjectv);
         $("input[name='1recommendedchange']").val(data.recommendedchange);
         $("input[name='1reviewdate']").val(data.reviewdate);
         $("input[name='1sammarisecustomr']").val(data.sammarisecustomr);
         console.log("modal here");

         if(data.attach_file){
			$('.file_attachemnt_div').empty().append(`<a target="_blank" href="${data.attach_file}">Click to View</a>`);
		}else{
			$('.file_attachemnt_div').empty().append('No data found');
		}

        $("#DetailModal").modal('show');
     }
  function mngmnt_reviews(){
         
				if($(".managemnet_review_from_div").css("display")==="block"){
					$(".managemnet_review_from_div").css("display","none");
				}
				else{
					$(".managemnet_review_from_div").css("display","block");
				}
			}
 </script>

