@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Requirements and Aspects</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<div class="kt-portlet__body">
                                <!--begin: Datatable -->

								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>No</th>
											<th>Requirments</th>
											<th>Date Completed</th>
											<th>Periodic Month</th>
											<th>Due Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $counter=0; ?>
                                        @foreach ($getReq as $data)
                                        <?php $counter++; ?>
										<tr>
											<td> {{ $counter}}</td>
											<td>{{ $data->requirment_title}}</td>
											<td>{{ $data->completion_date}}</td>
											<td>{{ $data->periods}}</td>
											<td>{{ $data->due_date}}</td>
                                        <td>
											<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" 
                                            onclick="getEid({{json_encode($data)}});">								<i class="la la-edit"></i>
                                            </button>
										<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"  onclick="deleteModal({{json_encode($data)}});" ><i class="la la-trash"></i>
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
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Requirements</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deleteRequirementadmin')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="re_id">

				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Requirements</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
			<form action="{{route('updaterequiremntadmin')}}" method="POST">
			<div class="modal-body">
				@csrf
					<input type="hidden" name="requirment_id" value="" id="id_feild">
					
                    <div class="form-group">
						<label>Requirement:</label>
						<input type="text" class="form-control" value="" name="requirment_title" placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>Requirement Completion Date of the Activity (YYYY/MM/DD):</label>
						<input type="date" class="form-control" value="" name="completion_date" placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>RPeriodicity (Months):</label>
						<input type="text" class="form-control" value="" name="periods" placeholder="Enter Months:">
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
@endsection
<script>
   function getEid(data){

        $("#id_feild").val(data.id);
		$("input[name='periods']").val(data.periods);
		$("input[name='requirment_title']").val(data.requirment_title);
		$("input[name='completion_date']").val(data.completion_date);
        $("#editRequirment").modal('show');
    }
    function deleteModal(data){
        $("#re_id").val(data.id);
        $("#deleteRequirment").modal('show');

    }
</script>
