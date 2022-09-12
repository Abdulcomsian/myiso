@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
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
				<p>Work instructions are procedures that are used locally to support what the business does. If you use documents that are external to this system, that is fine as long as they are referenced here. Do this by recording the work instruction detail and put a brief summary in the scope section. This will ensure that your external work instruction is included in the document register.</p>
                   
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Work Instructions Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>WI ID</th>
											<th>WI Name</th>
											<th>WI Ref</th>
											<th>WI Scope</th>
											<th>Issue Date</th>
											<th>Revision</th>
											{{-- <th>Compiled By</th> --}}
											<th>Detail View</th>
											<th>Edit Record</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($work as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->workinstruction}}</td>
                                            <td>{{$data->instructionref}}</td>
                                            <td>{{$data->scop}}</td>
                                            <td>{{$data->issueDate}}</td>
                                            <td>{{$data->revisionstatus}}</td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="info" onclick="getEid({{$data}});"><i class="fa fa-eye"></i>
											</button>

                                            </td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="trash"  onclick="deleteModal({{$data}});"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
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
                    		<h4>Total Employees Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>System Employee ID</th>
											<th>Surname</th>
											<th>Firstname</th>
											<th>Employee Number</th>
											<th>Start Date</th>
											<th>Job Details</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($employess as $emdata)
                                        <tr>
                                           <td> {{$emdata->systemid}}</td>
                                           <td> {{$emdata->surname}}</td>
                                           <td> {{$emdata->first_name}}</td>
                                           <td> {{$emdata->empNumber}}</td>
                                           <td> {{$emdata->startDate}}</td>
                                           <td> {{$emdata->jobdetails}}</td>
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
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deleteWorkadmin')}}" method="POST">
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
				<h5 class="modal-title" id="exampleModalLabel">Work Instructions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form action="{{route('workinstructions')}} " method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Title:</label><br>
                                <input type="text" readyonly disabled class="form-control" name="workinstruction">
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
                                <input type="number" readonly disabled class="form-control" name="empId">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Issue Date (YYYY/MM/DD):</label>
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

                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>

			</div>
		</div>
	</div>
</div>
{{-- work insturctions edit --}}

<div class="modal fade" id="editworkinstuction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Work Instructions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="{{route('editworkinstructions')}} " method="POST">
                @csrf
			<div class="modal-body">

                    <div class="row">
                        <input type="hidden" id="editit" name="id" value="">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Work Instruction Title:</label><br>
                                <input type="text"  class="form-control" name="workinstruction">
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
                                <input type="number"  class="form-control" name="empId">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Issue Date (YYYY/MM/DD):</label>
                                <input type="date"  class="form-control" name="issueDate">
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

         $("#id_feild").val(data.work_id);
         $("input[name='empId']").val(data.empId);
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
         $("#workinstructionsDetails").modal('show');
     }
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

     }
     function editDetails(data){
        $("#editit").val(data.id);
         $("input[name='empId']").val(data.empId);
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
         $("#editworkinstuction").modal('show');
     }
 </script>

