@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Maintenance Records</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
            <p>Carrying out frequent maintenance checks and repairs are necessary to maintain production and service. Maintenance Reviews within the working environment including equipment should be carried out monthly, quarterly, semiannually, or annually depending on the size and nature of the business.</p>

<p>To add a record, click on the “Add Maintenance Record” button. To amend a record, click on the edit icon of the entry that needs to be modified or deleted.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    				<a onclick="maintanceRecordForm()" class="addBtn">Add Maintenance records</a>
                    		</div>
                    	</div>
                    <div class="maintance_record_from_div">
                        <form action="{{route('maintain_rec')}} " method="POST" enctype="multipart/form-data">
                                @csrf
                    			<div class="row">
       
       <!--<input type="hidden" class="form-control" name="mgtreviewId" value="241">-->
                                       @csrf
                                            @php 
            $urlparam = request()->route()->parameters;
            @endphp
    

<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Maintenance Record Date (DD/MM/YYYY):</label><br>
											<input type="date" max="2999-12-31" class="form-control" name="mrdate" required>
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Item:</label>
											<input type="text" class="form-control" placeholder="Enter Object name:" name="mritem" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Activity:</label>
											<input type="text" class="form-control" placeholder="Enter Activity:" name="mractivity" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Location:</label>
											<input type="text" class="form-control"  placeholder="Enter Location" name="mlocation" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Observations:</label>
											<input type="text" class="form-control" placeholder="Enter Observation"  name="mrobservation" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Actions:</label>
											<input type="text" class="form-control" placeholder="Enter Action Taken" name="mractions" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Activity Performed By:</label>
											<input type="text" class="form-control" placeholder="Enter Name of person carrying out maintenance" name="mractivityperofrmby" required>
										</div>
									</div>
								</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                                            <input name="attach_evidence" type="file" class="form-control"
                                                   accept="all">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Any other issues or points to note?</label>
                                            <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
                                        </div>
                                    </div>
                                </div>
								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="maintanceRecordForm()" class="submitBtn" style="margin-right: 10px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                            <div class="d-flex justify-content-between mb-2">
                                <h4>Total Records Listed</h4>
                                <a href="/edit_user/{{ $urlparam['userid'] }}" class="btn btn-clean btn-icon-sm back_icon" style="float: right;">
                                    <i class="la la-long-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                            <!--<button>Add an Entry</button>-->
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Maintenance Record ID</th>
											<th>Maintenance Record Date</th>
											<th>Item</th>
											<th>Activity</th>
											<th>Location</th>
											<th>Observations</th>
											<th>Actions</th>
                                            <th>Performed By</th>
                                            <th>Maintenance Record Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($mainrecord as $data)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td> {{date('d/m/Y', strtotime($data->mrdate))}}</td>
                                                <td>{{$data->mritem}}</td>
                                                <td>{{$data->mractivity}}</td>
                                                <td>{{$data->mlocation}}</td>
                                                <td>{{$data->mrobservation}}</td>
                                                <td>{{$data->mractions}}</td>
                                                <td>{{$data->mractivityperofrmby}}</td>
                                                <td>
                                                    <button onclick="viewMR({{json_encode($data)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="view"><i class="fa fa-eye"></i>
													</button>
                                                    <button onclick="getEid({{json_encode($data)}});"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
													</button>
													<button onclick="deleteModal({{json_encode($data)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
													</button>
													
                                                </td>
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting an entry.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
			
					<form action="{{route('deletemaintanceRecAdmin')}}" method="POST">
						@csrf
						<input type="hidden" name="id" id="re_id" value="">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-danger">Yes</button>
						</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Maintenance Record Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
		<form action="{{route('editmentainance')}} " method="POST" enctype="multipart/form-data">
            @csrf
			<div class="modal-body">
                <input type="hidden" name="id" value="" id="editproject">
                            @php 
            $urlparam = request()->route()->parameters;
            @endphp
    

<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance ID Number (See table below. For amendments only):</label><br>
                                <input type="number" class="form-control" name="mid">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date (DD/MM/YYYY):</label><br>
                                <input type="date" class="form-control" name="mrdate">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Item:</label>
                                <input type="text" class="form-control" name="mritem" placeholder="Enter Management Review Meeting:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity:</label>
                                <input type="text" class="form-control" name="mractivity" placeholder="Enter Review Previous Meeting:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Location:</label>
                                <input type="text" class="form-control" name="mlocation">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Observations:</label>
                                <input type="text" class="form-control" name="mrobservation">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Actions:</label>
                                <input type="text" class="form-control" name="mractions">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity Performed By:</label>
                                <input type="text" class="form-control" name="mractivityperofrmby">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                                <input name="attach_evidence" type="file" class="form-control"
                                       accept="all">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
                            </div>
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
				<button type="submit" class="btn btn-danger">Update</button>
            </div>
        </form>
		</div>
	</div>
</div>
<!--VIEW--->
<div class="modal fade" id="viewMR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Maintenance Record Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
		<form >
            @csrf
			<div class="modal-body">
                <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance ID Number (See table below. For amendments only):</label><br>
                                <input type="number" class="form-control" name="mid">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date:</label><br>
                                <input type="date" class="form-control" name="mrdate" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Item:</label>
                                <input type="text" class="form-control" name="mritem" placeholder="Enter Management Review Meeting:" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity:</label>
                                <input type="text" class="form-control" name="mractivity" placeholder="Enter Review Previous Meeting:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Location:</label>
                                <input type="text" class="form-control" name="mlocation" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Observations:</label>
                                <input type="text" class="form-control" name="mrobservation" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Actions:</label>
                                <input type="text" class="form-control" name="mractions" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity Performed By:</label>
                                <input type="text" class="form-control" name="mractivityperofrmby" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span>:</label>
                                <div class="evidence_attachemnt_div"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
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

<script>

		function maintanceRecordForm(){
				if($(".maintance_record_from_div").css("display")==="block"){
					$(".maintance_record_from_div").css("display","none");
				}
				else{
					$(".maintance_record_from_div").css("display","block");
				}
			}
			
    function getEid(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='mlocation']").val(data.mlocation);
         $("input[name='mractions']").val(data.mractions);
         $("input[name='mractivity']").val(data.mractivity);
         $("input[name='mractivityperofrmby']").val(data.mractivityperofrmby);
         $("input[name='mrdate']").val(data.mrdate);
         $("input[name='mritem']").val(data.mritem);
         $("input[name='mrobservation']").val(data.mrobservation);
         $("input[name='mid']").val(data.mid);
        $("textarea[name='any_issues']").val(data.any_issues);
        $("#editepmloyee").modal('show');

     }
    function viewMR(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='mlocation']").val(data.mlocation);
         $("input[name='mractions']").val(data.mractions);
         $("input[name='mractivity']").val(data.mractivity);
         $("input[name='mractivityperofrmby']").val(data.mractivityperofrmby);
         $("input[name='mrdate']").val(data.mrdate);
         $("input[name='mritem']").val(data.mritem);
         $("input[name='mrobservation']").val(data.mrobservation);
         $("input[name='mid']").val(data.mid);
        $("textarea[name='any_issues']").val(data.any_issues);
        if (data.attach_evidence) {
            $('.evidence_attachemnt_div').empty().append(`<span class="text-dark">Click to view evidence <a target="_blank" href="${data.attach_evidence}">Here</a></span>`);
        } else {
            $('.evidence_attachemnt_div').empty().append('No data found');
        }
        $("#viewMR").modal('show');

     }
     
     
     
	 function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

     }


</script>
