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
	<p>To add a record, click on the “Add
						Customer Evaluation” button. To amend a record, click on the edit icon of
						the entry that needs to be modified.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="customerReview()" class="addBtn">ADD CUSTOMER EVALUATION</a>
                    		</div>
                    	</div>
                    	<div class="customer_review_from_div">
                            <form method="POST" action="{{route('customer_rview')}} ">
                                
                                                            @csrf
            @php 
            $urlparam = request()->route()->parameters;
            @endphp
                            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
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
											
											<!-- <input type="number" class="form-control" name="cus_id" placeholder="Enter Customer ID:"> -->
											<select class="form-control" name="cus_id" required="required">
												<option value="">Select CustomerId</option>
                                                @foreach($all_customers as $customer)
                                                <option value="{{$customer->idNumber}}">{{$customer->idNumber}}</option>
                                                @endforeach
											</select>
										@if(isset($all_customers) && $all_customers != "")@else 
											<!--<p>No Customers associated!</p>-->
											@endif
											
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Quality Score (0-10):</label>
											<input type="number" min="0" max="10" id="qualityScore"  class="form-control" name="qualityScore" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Price Score (0-10):</label>
											<input type="number" class="form-control"min="0" max="10" name="priceScore" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Delivery Score (0-10):</label>
											<input type="number"min="0" max="10" class="form-control" name="DScore" required="required">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Overall Score (0-10):</label>
											<input type="number" class="form-control"min="0" max="10" name="OveralScore" required="required">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Assessment Date (MM/DD/YYYY):</label>
											<input type="date" class="form-control" max="2999-12-31" name="AssesmentDate" required="required">
										</div>
									</div>
								</div>
								<button  class="submitBtn" type="submit">SUBMIT</button>
								<button  class="btn btn-secondary submitBtn" type="reset" onclick="customerReview()" style="margin-right: 6px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
							<div class="d-flex justify-content-between mb-2">
								<h4>Customer Review Details</h4>
								<a href="/edit_user/{{ $urlparam['userid'] }}" class="btn btn-clean btn-icon-sm" style="float: right;">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
							</div>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable">
									<thead>
										<tr>
											<th>Customer Review ID</th>
											<th>Customer ID Number</th>
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
											<td>{{$loop->index+1}} </td>
                                            <td>{{$data->cus_id}} </td>
                                             @php 
                                             $customersName=\App\customers::where('user_id',$request)->where('idNumber',$data->cus_id)->first();
                                            @endphp
                                            <td>@if(isset($customersName->name)){{$customersName->name}} @endif </td>
                                            <td>{{$data->qualityScore}} </td>
                                            <td>{{$data->priceScore}} </td>
											<td>{{$data->DScore}} </td>
											<td>{{$data->OveralScore}} </td>
                                            <td>{{date('d-M-Y', strtotime($data->AssesmentDate))}} </td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="info" value="" onclick="getEid({{$data}});">
                                                   <span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
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
				<h5 class="modal-title" id="exampleModalLabel">Edit Customer Evaluation Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form method="POST" action="{{route('editCustomerReview')}} ">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                               @php 
            $urlparam = request()->route()->parameters;
            @endphp
                            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
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
                                <input type="number" class="form-control" name="cus_id" placeholder="Enter Customer ID:" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Quality Score (0-10):</label>
                                <input type="number" min="0" max="10" class="form-control" name="qualityScore" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Price Score (0-10):</label>
                                <input type="number" min="0" max="10" class="form-control" name="priceScore" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Delivery Score (0-10):</label>
                                <input type="number" class="form-control"min="0" max="10"name="DScore" required="required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Overall Score (0-10):</label>
                                <input type="number" class="form-control" min="0" max="10"  name="OveralScore" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Assessment Date (MM/DD/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="AssesmentDate" required="required">
                            </div>
                        </div>
                    </div>
                    <button  class="submitBtn"  type="submit">Update</button>
					
					<button  class="btn btn-secondary submitBtn" type="reset" data-dismiss="modal" aria-label="Close" style="margin-right: 6px;">Cancel</button>
                </form>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Customer Review Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
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
