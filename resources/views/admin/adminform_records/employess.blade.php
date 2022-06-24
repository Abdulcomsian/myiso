@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Employees</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
				<p>To add a record, click on the
					“ADD EMPLOYEE” buttons. To amend or delete a record, click on the edit or
					delete icon of the entry that needs to be modified or deleted.</p>
                    <!--add form-->
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="employeeForm()" class="addBtn">ADD EMPLOYEE</a>
                    		</div>
                    	</div>
                    	<div class="employee_from_div">
                        <form method="POST" action="{{ route('employee') }}" enctype="multipart/form-data">
                            @csrf
                    			<div class="row">
                    				{{-- <div class="col-lg-6">
                    					<div class="form-group">
											<label>System ID Number:</label><br>
											<input type="number" class="form-control" required name="systemid">
										</div>
                    				</div> --}}
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Surname:</label><br>
											<input type="text" class="form-control" required name="surname" placeholder="Enter Surname">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>First Name:</label>
											<input type="text" class="form-control" name="first_name"  required placeholder="Enter First Name">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Employee ID Number:</label>
											<input name="empNumber" type="text" class="form-control"  required placeholder="Enter Employee ID Number">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Start Date (MM/DD/YYYY):</label>
											<input name="startDate" max="2999-12-31" type="date" required class="form-control" >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Job Details:</label>
											<input type="text" name="jobdetails" class="form-control"  required placeholder="Enter Job Details">
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
								 @php 
                                    $urlparam = request()->route()->parameters;
                                @endphp
								<input type="hidden" name="is_admin" value="admin"/>
								<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}"/>
								<button type="reset" onclick="emp1()" class="submitBtn" style="margin-left: 7px;">Cancel</button>
								<button class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div m-t-20">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="employeeSkillForm()" class="addBtn">ADD PROCESS SKILL FOR EMPLOYEE</a>
                    		</div>
                    	</div>
                    	<div class="employee_skill_from_div">
                        <form action="{{ route('empSkills')}}" method="POST">
                            @csrf
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Employee ID Number:</label><br>
											<select name="empid" required class="form-control">
											   <option  value="" selected="selected" disabled="disabled">Select One</option>
											    @if(isset($userinfo) && $userinfo!= "")
											    @foreach($userinfo as $item)
											    <option value="{{$item->empNumber}}" title="{{ $item->first_name }}">{{$item->empNumber.' ('.$item->first_name.')'}}</option>
											    @endforeach
											    @endif
											</select>
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Skill:</label><br>
											<input type="text" required  name="empskill" class="form-control"  placeholder="Enter Skills Name">
										</div>
                    				</div>
                    			</div>
                    			@php 
                                    $urlparam = request()->route()->parameters;
                                @endphp
								<input type="hidden" name="is_admin" value="admin"/>
								<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}"/>
								<button type="reset" onclick="emp2()" class="submitBtn" style="margin-left: 7px;">Cancel</button>
								<button type="submit" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div m-t-20">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="employeeRecordForm()" class="addBtn">ADD A TRAINING RECORD FOR EMPLOYEE</a>
                    		</div>
                    	</div>
                    	<div class="employee_record_from_div">
                            <form action=" {{route('empTraining')}} " method="POST">
                                @csrf
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Employee ID Number:</label><br>
											<select name="empid" required class="form-control">
											   <option  value="" selected="selected" disabled="disabled">Select One</option>
											    @if(isset($userinfo) && $userinfo!= "")
											    @foreach($userinfo as $item)
											    <option value="{{$item->empNumber}}" title="{{ $item->first_name }}">{{$item->empNumber.' ('.$item->first_name.')'}}</option>
											    @endforeach
											    @endif
											</select>
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Training Date (MM/DD/YYYY):</label><br>
											<input type="date" required max="2999-12-31" class="form-control" name="traningdate">
										</div>
                    				</div>
                    			</div>
                    			<div class="row">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Training Details:</label><br>
											<input type="text" placeholder="Enter Training Details" required class="form-control"  name="traningdetails">
										</div>
                    				</div>
                    			</div>
                    			 @php 
                                    $urlparam = request()->route()->parameters;
                                @endphp
								<input type="hidden" name="is_admin" value="admin"/>
								<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}"/>
								<button type="reset" onclick="emp3()" class="submitBtn" style="margin-left: 7px;">Cancel</button>
								<button type="submit" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                   
                   <!--endform-->
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
							<div class="d-flex justify-content-between mb-2">
								<h4>Total Employees Listed</h4>
								<a href="/edit_user/{{ $urlparam['userid'] }}" class="btn btn-clean btn-icon-sm back_icon" style="float: right;">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
							</div>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Employee ID Number</th>
											<th>Surname</th>
											<th>Firstname</th>
											<th>Job Details</th>
											<th>CV</th>
											<th>Start Date</th>
                                            <!--<th>Job Title</th>-->
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
										@php
											$i=1;
										@endphp
                                        @foreach ($userinfo as $item)
										<tr>
                                            <td> {{$item->empNumber}}</td>
											<td> {{$item->surname}}</td>
											<td> {{$item->first_name}}</td>
											<td> {{$item->jobdetails}}</td>
											<td>
												@if(!empty($item->cv))
													<a target="_blank" href="{{ asset($item->cv) }}">View CV</a>
												@else
													No data found
												@endif
											</td>
											<td> {{date('d-M-Y', strtotime($item->startDate))}}</td>
                                            <!--<td> {item->jobdetails}</td>-->
                                            <td>
												<button onclick="deletemodal({{json_encode($item)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete"><i class="la la-trash"></i>
                                                </button>
												<button  onclick="getEid({{json_encode($item)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"><i class="la la-edit"></i>
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
					 <div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Total Employee Skills Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											{{-- <th>Skills ID</th> --}}
											<th>Employee ID Number</th>
											<th>Last Name</th>
											<th> First Name</th>
                                            <th>Skills</th>
                                            <th>Actions</th>

										</tr>
                                    </thead>
                                    <tbody>
										@php
										$i=1
									@endphp
									@foreach ($employess as $item)
									<tr>
                                            <td> {{$item->empNumber}}</td> 
											<td> {{$item->surname}}</td>
											<td> {{$item->first_name}}</td>
                                            <td> {{$item->empskill}}</td>
                                             <td>
                                                <button onclick="getEidskill({{json_encode($item)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><span class="svg-icon svg-icon-md">									<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
                                                </button>
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md"  onclick="deleteemplskill({{$item->skill_id}})" title="Delete Employee">
									                <span class="svg-icon svg-icon-md">
									                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>

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
					<div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Training Record Summary</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Employee ID Number</th>
											<th>Surname</th>
											<th>First Name</th>
											<th>Start Date</th>
											{{-- <th>Employee Stamp Number</th> --}}
											<th>Training Date</th>
                                            <th>Training Details</th>
                                            <th>Actions</th>

										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emptraining as $item)
                                        <tr>
                                            <td> {{$item->empid}}</td>
											<td> {{$item->surname}}</td>
                                            <td> {{$item->first_name}}</td>
											<td>  {{date('d-M-Y', strtotime($item->startDate))}}</td>
											<td>  {{date('d-M-Y', strtotime($item->traningdate))}}</td>
                                            <td> {{$item->traningdetails}}</td>
                                            <td>
                                                <button onclick="getEidtraining({{json_encode($item)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><span class="svg-icon svg-icon-md">									<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
                                                </button>
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md"  onclick="deleteempltraining({{$item->traning_id}})" title="Delete Employee">
									                <span class="svg-icon svg-icon-md">
									                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>

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
                    </div>
                    </div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteskill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Employee Details 22</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
			<form action="{{route('deleteEmployeeskill')}}" method="POST">
				@csrf
					<input type="hidden" name="type" value="" id="type2"/>
					<input type="hidden" name="id" id="re_id2" value="">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Employee Details 1</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
			<form action="{{route('deleteEmployeeadmin')}}" method="POST">
				@csrf
					<input type="hidden" name="type" value="" id="type"/>
					<input type="hidden" name="id" id="re_id" value="">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form method="POST" action=" {{ route('editemployee') }} " enctype="multipart/form-data">
                @csrf
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
                                <div class="form-group">
                                    <label>Employee ID:</label> 
                                    <input type="number" name="empNumber" required class="form-control">
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
			</div>
			 @php 
                $urlparam = request()->route()->parameters;
            @endphp
				<input type="hidden" name="is_admin" value="admin"/>
				<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}"/>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Update</button>
            </div>
        </form>
		</div>
	</div>
</div>
<!--employe skills-->
<div class="modal fade" id="editepmloyeeskills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form method="POST" action="{{route('update-employes-skill')}}">
                @csrf
			<div class="modal-body">
                <div class="row">
    				<div class="col-lg-6">
    					<div class="form-group">
							<label>Employee ID Number:</label><br>
							<input name="editempid" type="number"  readonly  class="form-control">
							<input type="hidden" name="employskillid" value=""/>
						</div>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group">
							<label>Skill:</label><br>
							<input type="text" name="editempskill" class="form-control" placeholder="Enter Skills Name:">
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
<!--edit employ traninging-->
<div class="modal fade" id="editepmloyeetraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Employee Training</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form method="POST" action="{{route('update-employes-training')}}">
                @csrf
			<div class="modal-body">
                <div class="row">
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label>Employee ID:</label><br>
    						<input type="hidden" name="edittrainid"/>
    						<input type="number"  readonly class="form-control" name="editempidt">
    					</div>
    				</div>
    				<div class="col-lg-6">
    					<div class="form-group">
    						<label>Training Date (MM/DD/YYYY):</label><br>
    						<input type="date" max="2999-12-31" class="form-control" name="edittraningdate">
    					</div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-lg-12">
    					<div class="form-group">
							<label>Training Details:</label><br>
							<input type="text" class="form-control" name="edittraningdetails">
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
@endsection
@section('myscript')
<script>
function employeeCV(){
        if($(".employee_cv_from_div").css("display")=="none"){
            $(".employee_cv_from_div").css("display","block")
        } else{
            $(".employee_cv_from_div").css("display","none")
        }
    }
     function editEmployee(data){
        alert("data");
     }
</script>
<script>
    function getEid(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='empNumber']").val(data.empNumber);
         $("input[name='first_name']").val(data.first_name);
         $("input[name='jobdetails']").val(data.jobdetails);
         $("input[name='startDate']").val(data.startDate);
         $("input[name='surname']").val(data.surname);
         $("input[name='systemid']").val(data.systemid);
         $("input[name='equipment']").val(data.equipment);
         $("input[name='certificatenumber']").val(data.certificatenumber);
         $("input[name='calibrationid']").val(data.calibrationid);
         $("input[name='calibratedDate']").val(data.calibratedDate);
         $("input[name='acceptance']").val(data.acceptance);
         $("#editepmloyee").modal('show');
     }
	 function deletemodal(data){
		$("#re_id").val(data.id);
		 $("#type").val('employee');
         $("#deleteSupplier").modal('show');

	 }
	  function deleteemplskill(id)
     {
         $("#modallabel").html("Deleting Employee Skill");
         $("#re_id2").val(id);
         $("#type2").val('employeeskill');
         $("#deleteskill").modal('show');
     }
     function deleteempltraining(id)
     {
         console.log(id)
         $("#modallabel").html("Deleting Employee Training");
         $("#re_id").val(id);
         $("#type").val('employeetraining');
         $("#deleteSupplier").modal('show');
     }
     
    function getEidskill(data)
     {
         $("input[name='editempid']").val(data.empNumber);
         $("input[name='editempskill']").val(data.empskill);
         $("input[name='employskillid']").val(data.skill_id);
         $("#editepmloyeeskills").modal('show');
         
     }
     
      function getEidtraining(data)
     {
         $("input[name='editempidt']").val(data.empid);
         $("input[name='edittraningdate']").val(data.traningdate);
         $("input[name='edittraningdetails']").val(data.traningdetails);
         $("input[name='edittrainid']").val(data.traning_id);
        
         $("#editepmloyeetraining").modal('show');
         
     }
 function emp1(){
         
				if($(".employee_from_div").css("display")==="block"){
					$(".employee_from_div").css("display","none");
				}
				else{
					$(".employee_from_div").css("display","block");
				}
			}
function emp2(){

	if($(".employee_skill_from_div").css("display")==="block"){
		$(".employee_skill_from_div").css("display","none");
	}
	else{
		$(".employee_skill_from_div").css("display","block");
	}
}
function emp3(){

	if($(".employee_record_from_div").css("display")==="block"){
		$(".employee_record_from_div").css("display","none");
	}
	else{
		$(".employee_record_from_div").css("display","block");
	}
}

</script>
@endsection
