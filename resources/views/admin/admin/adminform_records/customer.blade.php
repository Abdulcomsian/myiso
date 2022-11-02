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
					<p>Customers should be listed so that internal audits can be carried out on their delivery / service quality assessments, but also used to assist with customer satisfaction surveys. </p>
					<p>To add a record, click on the “Add Customer” button. To amend a record, click on the edit icon of the entry that needs to be modified.</p>
                    
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
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="info" value="" onclick="getEid({{$item}});"><i class="fa fa-eye"></i>
												</button>
												<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete" value="" onclick="deletethisitem({{$item}});"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
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

