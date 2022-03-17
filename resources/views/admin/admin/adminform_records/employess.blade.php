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
				<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                 
                   
                   
                    <div class="procedure_div">
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
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($userinfo as $item)
										<tr>
                                            <td> {{$item->id}}</td>
											<td> {{$item->surname}}</td>
											<td> {{$item->first_name}}</td>
											<td> {{$item->empNumber}}</td>
											<td> {{$item->startDate}}</td>
                                            <td> {{$item->jobdetails}}</td>
                                            <td>
                                                <button onclick="getEid({{json_encode($item)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="indo"><i class="la la-info"></i>
												</button>
												<button onclick="deletemodal({{json_encode($item)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete"><i class="la la-trash"></i>
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
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Skills ID</th>
											<th>Employee ID</th>
											<th>Surname</th>
											<th>Firstname</th>
											<th>Employee Number</th>
                                            <th>Skill</th>

										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employess as $item)
										<tr>
                                            <td> {{$item->skill_id}}</td>
                                            <td> {{$item->empid}}</td>
											<td> {{$item->surname}}</td>
											<td> {{$item->first_name}}</td>
											<td> {{$item->empNumber}}</td>
                                            <td> {{$item->empskill}}</td>



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
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>ID Number</th>
											<th>Surname</th>
											<th>First Name</th>
											<th>Start Date</th>
											{{-- <th>Employee Stamp Number</th> --}}
											<th>Training Date</th>
                                            <th>Training Details</th>

										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emptraining as $item)
                                        <tr>
                                            <td> {{$item->traning_id}}</td>
											<td> {{$item->surname}}</td>
                                            <td> {{$item->first_name}}</td>
											<td> {{$item->startDate}}</td>
											<td> {{$item->traningdate}}</td>
                                            <td> {{$item->traningdetails}}</td>


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
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Employess Informations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
			<form action="{{route('deleteEmployeeadmin')}}" method="POST">
				@csrf
					<input type="hidden" name="id" id="re_id" value="">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- edit modal --}}
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Employee Informations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form >
                @csrf
			<div class="modal-body">

                        <div class="row">
                            <input type="hidden" name="id" id="editproject" value="">

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>System ID Number:</label><br>
                                    <input type="number" class="form-control"  name="systemid">
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Surname:</label><br>
                                    <input type="text" class="form-control" name="surname" placeholder="Enter Equipment Name:">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" name="first_name"  placeholder="Enter Serial Number:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Payroll or Employee Number:</label>
                                    <input name="empNumber" type="text" class="form-control"  placeholder="Enter Location:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Start Date (YYYY/MM/DD):</label>
                                    <input name="startDate" type="date" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Job Details:</label>
                                    <input type="text" name="jobdetails" class="form-control"  placeholder="Enter Acceptance Criteria:">
                                </div>
                            </div>
                        </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				
            </div>
        </form>
		</div>
	</div>
</div>


@endsection

<script>
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
         $("#deleteSupplier").modal('show');

	 }


</script>
