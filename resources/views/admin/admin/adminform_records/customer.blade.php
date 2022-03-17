@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Customers</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Customers Listed</h4>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Customer ID</th>
											<th>Name</th>
											<th>Address</th>
											<th>Tel</th>
											<th>Email</th>
                                            <th>Contact</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($customer as $item)

										<tr>
                                            <td>{{$item->id}}</td>
											<td>{{$item->name}}</td>
											<td>{{$item->address}}</td>
											<td>{{$item->phoneNumber}}</td>
											<td>{{$item->Email}}</td>
											<td>{{$item->contactName}}</td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="info" value="" onclick="getEid({{$item}});"><i class="la la-info"></i>
												</button>
												<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete" value="" onclick="deletethisitem({{$item}});"><i class="la la-trash"></i>
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
	<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Deleting Process</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure?Do you really want to delete this?.</p>
				</div>
				<div class="modal-footer">
				<form action="{{route('deletecustomeradmin')}}" method="POST">
					@csrf
				<input type="hidden" id="re_id" value="" name="id">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-danger">Yes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--End::Section-->
</div>

<div class="modal fade" id="EditCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Customers Informations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form >
                    @csrf

                    <input type="hidden" name="id" id="id_feild" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            {{-- <div class="form-group">
                                <label>ID Number:</label><br>
                                <input type="number" class="form-control" name="idNumber" placeholder="Enter ID:">
                            </div> --}}
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Customer Name:</label><br>
                                <input type="text" class="form-control" name="name" placeholder="Enter Customer Name:">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Customer Address:</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Customer Address:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Customer Telephone:</label>
                                <input type="number" class="form-control" name="phoneNumber" placeholder="Enter Customer Telephone:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Customer Email:</label>
                                <input type="email" class="form-control" name="Email" placeholder="Enter Customer Email:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Customer Contact Name:</label>
                                <input type="text" class="form-control" name="contactName" placeholder="Enter Customer Contact Number:">
                            </div>
                        </div>
                    </div>
                    <button  data-dismiss="modal" aria-label="Close" class="submitBtn">Cancel</button>
                </form>
		</div>
	</div>
</div>
</div>

@endsection
<script>
    function getEid(data){
        console.log(data);
         $("#id_feild").val(data.id);
         $("input[name='Email']").val(data.Email);
         $("input[name='address']").val(data.address);
         $("input[name='contactName']").val(data.contactName);
         $("input[name='idNumber']").val(data.idNumber);

         $("input[name='name']").val(data.name);
         $("input[name='phoneNumber']").val(data.phoneNumber);


         $("#EditCustomer").modal('show');
     }

	 function deletethisitem(data){
		$("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

	 }
</script>

