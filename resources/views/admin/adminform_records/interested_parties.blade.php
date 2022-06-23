@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Interested Parties</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>Section 4.2 of the ISO9001:2015 standard requires the understanding the needs and expectations of interested parties. This register is a place where these can be documented if you so wish. The Quality Manual in section 4.2.2 defines who the interested parties are.</p>
					<p>To add a record, click on the “Add Interested Parties” button. To amend a record, click on the edit icon of the entry that needs to be modified."</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="processinterestedForm()" class="addBtn">ADD Interested Parties</a>
                    		</div>
                    	</div>
                    	<div class="process_interested_from_div" style="display:none;   position: relative;bottom: 10px;">
                    		<form action="{{route('interestedform')}}" method="POST">
                                @csrf
            @php 
            $urlparam = request()->route()->parameters;
            @endphp

<input type="hidden" name="user_id" value="{{ $urlparam['id'] }} ">
                    			<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Interested Party:</label>
											<input type="text" name="interestedparty" class="form-control" required  placeholder="Enter Interested Parties e.g Customers, Suppliers, Employees:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Needs and Expectations:</label>
											<input type="text" name="needs" class="form-control"  required placeholder="Enter Need & Expectations:">
										</div>
									</div>
								</div>
<!--<button type="button" class="btn btn-secondary" onclick="processinterestedForm()">Cancel</button>-->
								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="processinterestedForm()" class="submitBtn" style="margin-right: 7px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
							<a href="/edit_user/{{ $urlparam['id'] }}" class="btn btn-clean btn-icon-sm mb-2" style="float: right;">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>S-No.</th>
											<th>Interested Parties</th>
											<th>Needs and Expectations</th>
											<th>Created At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        <?php $counter=0; ?>
										@php
											$i=1;
										@endphp
                                        @foreach ($interested as $data)
                                        <?php $counter++; ?>
										<tr>
											<td>{{ $i++}}</td>
											<td>{{ $data->interested_party}}</td>
											<td>{{ $data->needs}}</td>
											<td>{{date('d-M-Y h:i', strtotime($data->created_at))}}</td>

											<td>
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" onclick="getEid({{json_encode($data)}});"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-clean btn-icon btn-con-md"  title="View" onclick="viewinterested({{ json_encode($data) }});"><i class="fa fa-eye"></i></button>
	<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete" value="" onclick="deleteModal({{json_encode($data)}});"><i class="la la-trash"></i>
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting Interested Party</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
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
				<h5 class="modal-title" id="exampleModalLabel">Edit Interested Party Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form action="{{route('interestedUpdate')}}" method="POST">
                @csrf
           @php 
            $urlparam = request()->route()->parameters;
            @endphp

<input type="hidden" name="user_id" value="{{ $urlparam['id'] }} ">
			<div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Interested Party:</label>
								<input type="text" name="interestedparty" required  class="form-control"  placeholder="Enter Interested Parties e.g Customers, Suppliers, Employees:">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Needs & Expectations:</label>
								<input type="text" name="needs" required  class="form-control"  placeholder="Enter Need & Expectations:">
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

<div class="modal fade" id="viewinterestedparty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Interested Party Details</h5>
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
                                <label>Interested Party:</label>
                                <input type="text" name="interestedparty" required placeholder="Enter Interested Parties e.g Customers, Suppliers, Employees:" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Needs & Expectations:</label>
                                <input type="text" name="needs" required placeholder="Enter Need & Expectations:" class="form-control" >
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
     function processinterestedForm()
			{
				if($(".process_interested_from_div").css("display")==="block"){
					$(".process_interested_from_div").css("display","none");
				}
				else{
					$(".process_interested_from_div").css("display","block");
				}

			}
    function getEid(data){
        console.log(data);

         $("#id_feild").val(data.id);
         $("input[name='interestedparty']").val(data.interested_party);
         $("input[name='needs']").val(data.needs);
         $("#editinterestedmodal").modal('show');
     }
	   function viewinterested(data){
        console.log(data);

          $("#id_feild").val(data.id);
         $("input[name='interestedparty']").val(data.interested_party);
         $("input[name='needs']").val(data.needs);
         $("#viewinterestedparty").modal('show');
     }
	 
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

     }

 </script>