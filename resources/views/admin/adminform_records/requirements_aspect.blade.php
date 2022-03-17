@extends('admin.dashboard.layouts.app')

@section('content')
<style>
    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
  color: #fff;
  position: relative;
}

input[type="date"]::-webkit-datetime-edit-year-field{
  position: absolute !important;
  border-left:1px solid #8c8c8c;
  padding: 2px;
  color:#000;
  left: 56px;
}

input[type="date"]::-webkit-datetime-edit-month-field{
  position: absolute !important;
  border-left:1px solid #8c8c8c;
  padding: 2px;
  color:#000;
  left: 26px;
}


input[type="date"]::-webkit-datetime-edit-day-field{
  position: absolute !important;
  color:#000;
  padding: 2px;
  left: 4px;
  
}
</style>
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
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="requirementFrom()" class="addBtn">ADD A REQUIRMENT</a>
                    		</div>
                    	</div>
                    	<div class="requirments_from_div">
                    		<form action="{{route('addRequirementadmin')}}" method="POST">
                    		    @csrf
                    			<div class="form-group">
									<label>Requirement:</label>
									<input type="text" class="form-control" name="requirement" aria-describedby="emailHelp" placeholder="Enter Requirement:" required>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Requirement Completion Date of the Activity (dd/mm/yyyy):</label>
											<input type="date" max="2999-12-31" name="req_date" class="form-control" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" value="yyyy/mm/dd" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Periodicity (Months):</label>
											<input type="number" min="1" max="12" name="period" class="form-control validate_number" aria-describedby="emailHelp" placeholder="Enter Months:" required>
										</div>
									</div>
								</div>
								
            @php 
            $urlparam = request()->route()->parameters;
            @endphp  

<input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">

								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" class="submitBtn" style="
    margin-right: 20px;
" onclick="requirementFrom()">Cancel</button>
                    		</form>
                    	</div>
                    </div>
		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
						{{-- <div class="kt-portlet__head-toolbar"> --}}
							{{-- <div class="kt-portlet__head-wrapper"> --}}
								<a href="/view_user" class="btn btn-clean btn-icon-sm" style="float: right;">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
						
					
                    	<div class="requirments_table_div">
                    		<div class="kt-portlet__body">
								
                                <!--begin: Datatable -->

								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>No.</th>
											<th>Requirements.</th>
											<th>Date Completed</th>
											<th>Periodicity
												(Months)</th>
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
											<td>{{ date("d-M-Y",strtotime($data->completion_date)) }}</td>
											<td>{{ $data->periods}}</td>
												@php 
											$d = strtotime("+$data->periods months",strtotime($data->completion_date)); 
										$d_id = $data->id;
											@endphp
											<td>{{ date("d-M-Y",$d)}}</td>
                                        <td>
											<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" 
                                            onclick="getEid({{json_encode($data)}});">								<i class="la la-edit"></i>
                                            </button>
										<!--<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"  onclick="deleteModal({{json_encode($data)}});" ><i class="la la-trash"></i>-->
          <!--                              </button>-->
                                        
<button data-toggle="modal" data-target="#confirm-{{$d_id}}" id="remove_{{$d_id}}" title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
 <i class="la la-trash"></i>
</button>
                  <!-- Delete Modal -->

                  <div class="modal fade modal-mini modal-primary" id="confirm-{{$d_id}}" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{route('deleteRequirementadmin')}}" method="post">
                          <div class="modal-header justify-content-center"> @csrf 
                            <div class="modal-profile"><h5>Deleting an entry</h5></div>
                          </div>
                          <div class="modal-body text-center">
                            <p>Are you sure you want to delete this entry?</p>
                          </div>
                          <div class="modal-footer">
                              <input type="hidden" name="id" value="{{$d_id}}">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
                          </div>
                        </form>
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
		</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting an
					entry.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
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
				<h5 class="modal-title" id="exampleModalLabel">Amend a
					Requirement.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
			<form action="{{route('updaterequiremntadmin')}}" method="POST">
			<div class="modal-body">
				@csrf
					<input type="hidden" name="requirment_id" value="" id="id_feild" >
					
                    <div class="form-group">
						<label>Requirement:</label>
						<input type="text" class="form-control" value="" name="requirment_title" required placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>Requirement Completion Date of the Activity (DD/MM/YYYY):</label>
						<input type="date" class="form-control" value="" name="completion_date" required placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>Periodicity (Months):</label>
						<input type="number" class="form-control periodicity" onkeyup="myFunction()" min="1" max="12" value="" name="periods" required placeholder="Enter Months:">
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
<script>
    function myFunction(){
        var value=$(".periodicity").val();
        if(value<=0)
           { 
              $(".periodicity").val();
           }else if(value>12){
               $(".periodicity").val(12);
           } 
    }
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
