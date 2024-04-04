@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<script>if (document.title != "Admin") {
    document.title = "Admin";
}</script>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Work Instructions</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
                <p>Work Instructions are also referred to as Processes.These are used as a step-by-step guide of how to conduct an activity in the workplace.This section should be used to create activities that are later selected to perform internal audits from your process audits. If you use documents that are external to this system, that is fine as long as they are referenced here. Do this by recording the work instruction detail and put a brief summary in the scope section.</p>

                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="workInstructionFrom()" class="addBtn">ADD WORK INSTRUCTION</a>
                    		</div>
                    	</div>
                    	<div class="work_instruction_from_div">
                            <form action="{{route('workinstructions')}} " method="POST">
                                @csrf
                                                                @csrf
                                            @php 
            $urlparam = request()->route()->parameters;
            @endphp
    

<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Work Instruction / Process Title:</label><br>
											<input type="text" class="form-control" name="workinstruction" placeholder="Add Work Instruction / Process" required="required">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Work Instruction Reference:</label><br>
											<input type="text" class="form-control" name="instructionref" required="required">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										    
											<label>Employee ID Number of Work Instruction Creater. This is taken from the Employee table:</label>
											 <select class="form-control" name="empId" required="required">
											     <option value="">Select Employee</option>
											      @foreach($employess as $emp)
											      <option value="{{$emp->empNumber}}">{{$emp->empNumber}}</option>
											      @endforeach
											 </select>
											<!--<input type="number" class="form-control" name="empId" required="required">-->
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Issue Date (MM/DD/YYYY):</label>
											<input type="date" max="2999-12-31" class="form-control" name="issueDate" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Revision Status:</label>
											<input type="text" class="form-control" name="revisionstatus" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Scope:</label>
											<input type="text" class="form-control" name="scop" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 1:</label>
											<input type="text" class="form-control" name="point1">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 2:</label>
											<input type="text" class="form-control" name="point2">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 3:</label>
											<input type="text" class="form-control" name="point3">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 4:</label>
											<input type="text" class="form-control" name="point4">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 5:</label>
											<input type="text" class="form-control" name="point5">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 6:</label>
											<input type="text" class="form-control" name="point6">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 7:</label>
											<input type="text" class="form-control" name="point7">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 8:</label>
											<input type="text" class="form-control" name="point8">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 9:</label>
											<input type="text" class="form-control" name="point9">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 10:</label>
											<input type="text" class="form-control" name="point10">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 11:</label>
											<input type="text" class="form-control" name="point11">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Point 12:</label>
											<input type="text" class="form-control" name="point12">
										</div>
									</div>
								</div>
					                    <div class="row">
					
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Compiled By:</label>
                                <input type="text" class="form-control" name="CompiledBy" required>
                            </div>
                        </div>

                    </div>


								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" class="submitBtn" onclick="closeform();" style="margin-right:10px">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
							<div class="d-flex justify-content-between mb-2">
								<h4>Total Work Instructions Listed</h4>
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
											<th>WI ID</th>
											<th>WI Name</th>
											<th>WI Ref</th>
											<th>WI Scope</th>
											<th>Compiled By</th>
											<th>Issue Date</th>
											<th>Revision</th>
											<th>Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($work as $data)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$data->workinstruction}}</td>
                                            <td>{{$data->instructionref}}</td>
                                            <td>{{$data->scop}}</td>
                                           
                                            <td>{{isset($data->CompiledBy) ? $data->CompiledBy :''}}</td>
                                            <td>{{date('d/m/Y', strtotime($data->issueDate))}}</td>
                                            <td>{{$data->revisionstatus}}</td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View" onclick="getEid({{$data}});"><i class="fa fa-eye"></i>
											    </button>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"  onclick="editDetails({{$data}});"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
                                                </button>
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#deleteworkinst{{$data->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
                                                 </button>
                                                 <div class="modal fade" id="deleteworkinst{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                	<div class="modal-dialog" role="document">
                                                		<div class="modal-content">
                                                			<div class="modal-header">
                                                				<h5 class="modal-title" id="exampleModalLabel">Deleting Work Instruction</h5>
                                                				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                				</button>
                                                			</div>
                                                			<div class="modal-body">
                                                				<p>Are you sure you want to delete this entry?</p>
                                                			</div>
                                                			<div class="modal-footer">
                                                            <form action="{{route('deleteWork')}}" method="POST">
                                                				@csrf
                                                				<input type="hidden" value="{{$data->id}}"  name="id">
                                                				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                				<button type="submit" class="btn btn-danger">Yes</button>
                                                				</form>
                                                			</div>
                                                		</div>
                                                	</div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
								</table>
								<!--end: Datatable -->
                    		</div>
						</div>
					</div>
					<div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Employees Listed</h4>
                    		
                    		
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Employee ID Number</th>
											<th>Surname</th>
											<th>Firstname</th>
											<!--<th>Employee Number</th>-->
											<th>Start Date</th>
                                            <th>Job Details</th>
                                            
										</tr>
									</thead>
									<tbody>
									   
                                        @foreach ($employess as $item)
										<tr>
											<td> {{$item->empNumber}}</td>
											<td> {{$item->surname}}</td>
											<td> {{$item->first_name}}</td>
											<!--<td> {$item->empNumber}</td>-->
											
											<td> {{date('d/m/Y', strtotime($item->startDate))}}</td>
                                            <td> {{$item->jobdetails}}</td>
                            

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
				<h5 class="modal-title" id="exampleModalLabel">Deleting Work Instruction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deleteWork')}}" method="POST">
				@csrf
				<input type="hidden" value="" id="re_id" name="id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="workinstructionsDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Work Instructions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form>
                   
                    <div class="row">
                        <div class="col-lg-6">
                    					<div class="form-group">
											<label>Work Instruction / Process Title:</label><br>
											<input type="text" class="form-control" name="workinstruction" placeholder="Add Work Instruction / Process" required="required">
										</div>
                    				</div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Reference:</label><br>
                                <input type="text" readyonly disabled class="form-control" name="instructionref">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee ID Number of Work Instruction Creater. This is taken from the Employee table:</label>
                                <!--<input type="number" readonly disabled class="form-control" name="empId">-->
                                 <select class="form-control" name="empId" required="required">
								     <option value="">Select Employee</option>
								      @foreach($employess as $emp)
								      <option value="{{$emp->id}}">{{$emp->empNumber}}</option>
								      @endforeach
								 </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Issue Date (MM/DD/YYYY):</label>
                                <input type="date" readonly disabled class="form-control" name="issueDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revision Status:</label>
                                <input type="text" readyonly disabled class="form-control" name="revisionstatus">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scope:</label>
                                <input type="text" readyonly disabled class="form-control" name="scop">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 1:</label>
                                <input type="text" readyonly disabled class="form-control" name="point1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 2:</label>
                                <input type="text" readyonly disabled class="form-control" name="point2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 3:</label>
                                <input type="text" readyonly disabled class="form-control" name="point3">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 4:</label>
                                <input type="text" readyonly disabled class="form-control" name="point4">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 5:</label>
                                <input type="text" readyonly disabled class="form-control" name="point5">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 6:</label>
                                <input type="text" readyonly disabled class="form-control" name="point6">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 7:</label>
                                <input type="text" readyonly disabled class="form-control" name="point7">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 8:</label>
                                <input type="text" readyonly disabled class="form-control" name="point8">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 9:</label>
                                <input type="text" readyonly disabled class="form-control" name="point9">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 10:</label>
                                <input type="text" readyonly disabled class="form-control" name="point10">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 11:</label>
                                <input type="text" readyonly disabled class="form-control" name="point11">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 12:</label>
                                <input type="text" readyonly disabled class="form-control" name="point12">
                            </div>
                        </div>
                    </div>
                    <div class="row">
					
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Compiled By:</label>
                                <input type="text" readyonly disabled class="form-control" name="CompiledBy">
                            </div>
                        </div>

                    </div>

                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>
{{-- work insturctions edit --}}

<div class="modal fade" id="editworkinstuction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Work Instructions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="{{route('editworkinstructions')}} " method="POST">
                @csrf
                                            @php 
            $urlparam = request()->route()->parameters;
            @endphp
    

<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
<input type="hidden" name="id" id="editit" value="">
			<div class="modal-body">

                    <div class="row">
                        
                        <div class="col-lg-6">
                    					<div class="form-group">
											<label>Work Instruction / Process Title:</label><br>
											<input type="text" class="form-control" name="workinstruction" placeholder="Add Work Instruction / Process" required="required">
										</div>
                    				</div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Reference:</label><br>
                                <input type="text"  class="form-control" name="instructionref">
                            </div>
                        </div>
                    </div>

                    <div class="row">
					
                        <div class="col-lg-6">
                   								<div class="form-group">
										    
											<label>Employee ID Number of Work Instruction Creater. This is taken from the Employee table:</label>
											 <select class="form-control" name="empId" required="required">
								     <option value="">Select Employee</option>
								      @foreach($employess as $emp)
								      <option value="{{$emp->id}}">{{$emp->empNumber}}</option>
								      @endforeach
								 </select>
											<!--<input type="number" class="form-control" name="empId" required="required">-->
										</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Issue Date (MM/DD/YYYY):</label>
                                <input type="date"  max="2999-12-31" class="form-control" name="issueDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revision Status:</label>
                                <input type="text"  class="form-control" name="revisionstatus">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scope:</label>
                                <input type="text"  class="form-control" name="scop">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 1:</label>
                                <input type="text"  class="form-control" name="point1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 2:</label>
                                <input type="text"  class="form-control" name="point2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 3:</label>
                                <input type="text"  class="form-control" name="point3">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 4:</label>
                                <input type="text"  class="form-control" name="point4">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 5:</label>
                                <input type="text"  class="form-control" name="point5">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 6:</label>
                                <input type="text"  class="form-control" name="point6">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 7:</label>
                                <input type="text"  class="form-control" name="point7">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 8:</label>
                                <input type="text"  class="form-control" name="point8">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 9:</label>
                                <input type="text"  class="form-control" name="point9">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 10:</label>
                                <input type="text"  class="form-control" name="point10">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 11:</label>
                                <input type="text"  class="form-control" name="point11">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Point 12:</label>
                                <input type="text"  class="form-control" name="point12">
                            </div>
                        </div>
                    </div>

<div class="row">
					
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Compiled By:</label>
                                <input type="text" class="form-control" name="CompiledBy" required>
                            </div>
                        </div>

                    </div>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
				<button type="submit" class="btn btn-primary" >Update</button>


            </div>
        </form>
		</div>
	</div>
</div>
@endsection

<script>
    function getEid(data){
        // console.log(data);

         $("#editit").val(data.work_id);
        $("select[name='empId']").val(data.empId);
         $("input[name='instructionref']").val(data.instructionref);
         $("input[name='issueDate']").val(data.issueDate);
         $("input[name='point1']").val(data.point1);
         $("input[name='point2']").val(data.point2);
         $("input[name='point3']").val(data.point3);
         $("input[name='point4']").val(data.point4);
         $("input[name='point5']").val(data.point5);
         $("input[name='point6']").val(data.point6);
         $("input[name='point7']").val(data.point7);
         $("input[name='point8']").val(data.point8);
         $("input[name='point9']").val(data.point9);
         $("input[name='point10']").val(data.point10);
         $("input[name='point11']").val(data.point11);
         $("input[name='point12']").val(data.point12);
         $("input[name='revisionstatus']").val(data.revisionstatus);
         $("input[name='scop']").val(data.scop);
         $("input[name='workinstruction']").val(data.workinstruction);
         $("input[name='CompiledBy']").val(data.CompiledBy);
         $("#workinstructionsDetails").modal('show');
     }
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

     }
     function closeform()
     {
         $(".work_instruction_from_div").hide();
     }
     function editDetails(data){
        $("#editit").val(data.id);
         $("select[name='empId']").val(data.empId);
         $("input[name='instructionref']").val(data.instructionref);
         $("input[name='issueDate']").val(data.issueDate);
         $("input[name='point1']").val(data.point1);
         $("input[name='point2']").val(data.point2);
         $("input[name='point3']").val(data.point3);
         $("input[name='point4']").val(data.point4);
         $("input[name='point5']").val(data.point5);
         $("input[name='point6']").val(data.point6);
         $("input[name='point7']").val(data.point7);
         $("input[name='point8']").val(data.point8);
         $("input[name='point9']").val(data.point9);
         $("input[name='point10']").val(data.point10);
         $("input[name='point11']").val(data.point11);
         $("input[name='point12']").val(data.point12);
         $("input[name='revisionstatus']").val(data.revisionstatus);
         $("input[name='scop']").val(data.scop);
         $("input[name='workinstruction']").val(data.workinstruction);
		 $("input[name='CompiledBy']").val(data.CompiledBy);
         $("#editworkinstuction").modal('show');
     }
 </script>
