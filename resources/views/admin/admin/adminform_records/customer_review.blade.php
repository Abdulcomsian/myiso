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
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="info" value="" onclick="getEid({{$data}});"><i class="la la-info"></i>
												</button>
												<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete" value="" onclick="deletedata({{$data}});"><i class="la la-trash"></i>
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
