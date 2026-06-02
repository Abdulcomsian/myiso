@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Customer Review</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Customer Review Details</h4>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable">
									<thead>
										<tr>
											<th>Customer Review ID</th>
											<th>Customer ID</th>
											<th>Customer</th>
											<th>Quality</th>
											<th>Price</th>
											<th>Delivery</th>
											<th>Overall</th>
                                            <th>Review Date</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($customer_review as $data)
										<tr>
											<td>{{$data->id}} </td>
                                            <td>{{$data->cus_id}} </td>
                                            <td>{{$data->cus_id}} </td>
                                            <td>{{$data->qualityScore}} </td>
                                            <td>{{$data->priceScore}} </td>
											<td>{{$data->DScore}} </td>
											<td>{{$data->OveralScore}} </td>
                                            <td>{{$data->AssesmentDate}} </td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="info" value="" onclick="getEid({{$data}});"><i class="fa fa-eye"></i>
												</button>
												<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete" value="" onclick="deletedata({{$data}});"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
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
                    	{{-- <div class="requirments_table_div">
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
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>58</td>
											<td>Block Computing</td>
											<td>Al Quasais, Unit 5, Dubai</td>
											<td>0971 56 491 5517</td>
											<td>B.Cmp@gmail.com</td>
											<td>Mr Ahmed</td>
										</tr>
									</tbody>
								</table>
								<!--end: Datatable -->
                    	</div>
					</div> --}}
	</section>

</div>


<div class="modal fade" id="editcustomer_rev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Customers Review Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form >
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Customer Review ID Number (See table below. For amendments only):</label><br>
                                <input type="number" class="form-control" name="revnumber" placeholder="Enter ID:">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Customer ID Number:</label><br>
                                <input type="number" class="form-control" name="cus_id" placeholder="Enter Customer ID:">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Quality Score (0-10):</label>
                                <input type="number" class="form-control" name="qualityScore">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Price Score (0-10):</label>
                                <input type="number" class="form-control" name="priceScore">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Delivery Score (0-10):</label>
                                <input type="number" class="form-control" name="DScore">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Overall Score (0-10):</label>
                                <input type="number" class="form-control" name="OveralScore">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Assessment Date (YYYY/MM/DD):</label>
                                <input type="date" class="form-control" name="AssesmentDate">
                            </div>
                        </div>
                    </div>
                    <button  class="submitBtn"  type="submit"  data-dismiss="modal" aria-label="Close">Close</button>
                </form>
		</div>
	</div>
</div>
</div>
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
			<form action="{{route('deleteCustomerRivewAdmin')}}" method="POST">
				@csrf
			<input type="hidden" id="re_id" value="" name="id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
<script>
    function getEid(data){
        console.log(data);

        $("#editid").val(data.id);
         $("input[name='AssesmentDate']").val(data.AssesmentDate);
         $("input[name='DScore']").val(data.DScore);
         $("input[name='OveralScore']").val(data.OveralScore);
         $("input[name='cus_id']").val(data.cus_id);
         $("input[name='priceScore']").val(data.priceScore);
         $("input[name='qualityScore']").val(data.qualityScore);
         $("input[name='revnumber']").val(data.revnumber);
         $("input[name='qualityScore']").val(data.qualityScore);
         $("#editcustomer_rev").modal('show');
     }
	 function deletedata(data){
		$("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

	 }
</script>
