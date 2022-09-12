@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Non-Conformities</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="nonConformities()" class="addBtn">ADD A NON-CONFORMITY</a>
                    		</div>
                    	</div>
                    	<div class="non_conformities_from_div">
                            <form action=" {{route('nonConfromForm')}} " method="POST">
                                @csrf
                    			{{-- <div class="form-group">
									<label>Customer ID Number:</label><br>
									<span>Select a customer ID from the table. For an internal non-conformity, select Internal as a Customer. If this is the first internal non-conformity, click here to add a customer called Internal.</span>
									<input type="number" class="form-control" name="customerID" placeholder="Enter Customer ID:">
								</div> --}}
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Fault Description:</label>
											<input type="text" class="form-control" name="description" placeholder="Enter Fault Description:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Root Cause:</label>
											<input type="text" class="form-control" name="rootCause" placeholder="Enter Root Cause:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Immediate Corrective Action:</label>
											<input type="text" class="form-control" name="immediateCorp" placeholder="Enter Immediate Corrective Action:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Action to Prevent Recurrence:</label>
											<input type="text" class="form-control" name="actionPrevent" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Effectiveness of Action to Prevent Recurrence:</label>
											<input type="text" class="form-control" name="ActionRecurnce" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Effectiveness Review Date (YYY/MM/DD):</label>
											<input type="date" class="form-control" name="effectiveDate" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Review Performed By:</label>
											<input type="text" class="form-control" name="reviewdBy" placeholder="Enter Review Performed:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date NC Processed (YYY/MM/DD):</label>
											<input type="date" class="form-control" name="dateNcP" placeholder="Enter Prevent Recurrence:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date NC Received (YYY/MM/DD):</label>
											<input type="date" class="form-control" name="dateNcR" placeholder="Enter Review Performed:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Customer Response Expected Time (Days):</label>
											<input type="number" class="form-control" name="CRE" placeholder="Enter Time:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Product Impact (Yes or No):</label>
											<input type="date" class="form-control" name="PI" placeholder="Enter Product Impact:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Root Cause Category:</label>
											<select name="root_cause_category" class="form-control">
											<option value="Other">Other</option>
											<option value="Planning">Planning</option>
											<option value="Production">Production</option>
											<option value="Non-liable">Non-liable</option>
											<option value="Training">Training</option>
											<option value="Management">Management</option>
											<option value="Human Factor">Human Factor</option>
											</select>
										</div>
									</div>
								</div>
								<button type="submit" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
                    {{-- <div class="procedure_div">
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

                    </div>

		</div> --}}
		<div class="procedure_div m-t-20">
                    	<div class="requirments_table_div">
                    		<h4>Total Non-Conformities Listed</h4>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>NCR ID Number</th>
											{{-- <th>Customer ID Number</th> --}}
											<th>Fault Description</th>
											<th>Category</th>
											<th>Date NCR Processed</th>
											<th>Detail View</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($noneConform as $data)

                                    
                                                        <tr>
                                              <td>{{$data->id}} </td>
                                              {{-- <td>  {{$data->customerID}}</td> --}}
                                              <td>  {{$data->description}}</td>
                                              <td>  {{$data->root_cause_category}}</td>
                                              <td>  {{$data->dateNcR}}</td>
                                              <td> <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value="{{ $data->requirment_id }}"
                                                onclick="getEid({{json_encode($data)}});">								<i class="la la-eye"></i>
                                                </button>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"
                                                    onclick="removeinfo({{json_encode($data)}});">								<i class="la la-trash"></i>
                                                    </button>
                                                {{-- <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"
                                                    onclick="EditData({{json_encode($data)}});">								<i class="la la-edit"></i>
                                                    </button> --}}
                                            </td>


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

<div class="modal fade" id="nonconfirmDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Requirements</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <div class="form-row">
                <div class="col-md-12 p-3">
                    <form>
                        @csrf
                        <input type="hidden" name="id" value="" id="id_feild">
                        {{-- <div class="form-group">
                            <label>Customer ID Number:</label><br>
                            <span>Select a customer ID from the table. For an internal non-conformity, select Internal as a Customer. If this is the first internal non-conformity, click here to add a customer called Internal.</span>
                            <input type="number" readonly disabled class="form-control" name="customerID" placeholder="Enter Customer ID:">
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fault Description:</label>
                                    <input type="text" readonly disabled class="form-control" name="description" placeholder="Enter Fault Description:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause:</label>
                                    <input type="text" readonly disabled class="form-control" name="rootCause" placeholder="Enter Root Cause:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Immediate Corrective Action:</label>
                                    <input type="text" readonly disabled class="form-control" name="immediateCorp" placeholder="Enter Immediate Corrective Action:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Action to Prevent Recurrence:</label>
                                    <input type="text" readonly disabled class="form-control" name="actionPrevent" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness of Action to Prevent Recurrence:</label>
                                    <input type="text" readonly disabled class="form-control" name="ActionRecurnce" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness Review Date (YYY/MM/DD):</label>
                                    <input type="date" class="form-control" name="effectiveDate" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review Performed By:</label>
                                    <input type="text" readonly disabled class="form-control" name="reviewdBy" placeholder="Enter Review Performed:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Processed (YYY/MM/DD):</label>
                                    <input type="date" readonly disabled class="form-control" name="dateNcP" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Received (YYY/MM/DD):</label>
                                    <input type="date" readonly disabled class="form-control" name="dateNcR" placeholder="Enter Review Performed:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Response Expected Time (Days):</label>
                                    <input type="number" readonly disabled class="form-control" name="CRE" placeholder="Enter Time:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Product Impact (Yes or No):</label>
                                    <input type="date" readonly disabled class="form-control" name="PI" placeholder="Enter Product Impact:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause Category:</label>
                                    <input type="text" name="root_cause_category" readonly disabled id="" value="" class="form-control" >

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
{{-- edit modal  editConfirm--}}

<div class="modal fade" id="editConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Non Confirmities</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <div class="form-row">
                <div class="col-md-12 p-3">
                    <form action="{{route('editnonConfirm')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="editid">
                        {{-- <div class="form-group">
                            <label>Customer ID Number:</label><br>
                            <span>Select a customer ID from the table. For an internal non-conformity, select Internal as a Customer. If this is the first internal non-conformity, click here to add a customer called Internal.</span>
                            <input type="number"  class="form-control" name="customerID" placeholder="Enter Customer ID:">
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fault Description:</label>
                                    <input type="text"  class="form-control" name="description" placeholder="Enter Fault Description:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause:</label>
                                    <input type="text"  class="form-control" name="rootCause" placeholder="Enter Root Cause:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Immediate Corrective Action:</label>
                                    <input type="text"  class="form-control" name="immediateCorp" placeholder="Enter Immediate Corrective Action:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Action to Prevent Recurrence:</label>
                                    <input type="text"  class="form-control" name="actionPrevent" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness of Action to Prevent Recurrence:</label>
                                    <input type="text"  class="form-control" name="ActionRecurnce" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness Review Date (YYY/MM/DD):</label>
                                    <input type="date" class="form-control" name="effectiveDate" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review Performed By:</label>
                                    <input type="text"  class="form-control" name="reviewdBy" placeholder="Enter Review Performed:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Processed (YYY/MM/DD):</label>
                                    <input type="date"  class="form-control" name="dateNcP" placeholder="Enter Prevent Recurrence:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Received (YYY/MM/DD):</label>
                                    <input type="date"  class="form-control" name="dateNcR" placeholder="Enter Review Performed:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Response Expected Time (Days):</label>
                                    <input type="number"  class="form-control" name="CRE" placeholder="Enter Time:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Product Impact (Yes or No):</label>
                                    <input type="date"  class="form-control" name="PI" placeholder="Enter Product Impact:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause Category:</label>
                                    <input type="text" name="root_cause_category"  id="" value="" class="form-control" >

                                </div>
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
			<form action="{{route('deleteNonConfrm')}}" method="POST">
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
         $("#id_feild").val(data.id);
         $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
         $("input[name='CRE']").val(data.CRE);
         $("input[name='PI']").val(data.PI);
         $("input[name='customerID']").val(data.customerID);
         $("input[name='dateNcP']").val(data.dateNcP);
         $("input[name='dateNcR']").val(data.dateNcR);
         $("input[name='description']").val(data.description);
         $("input[name='effectiveDate']").val(data.effectiveDate);
         $("input[name='immediateCorp']").val(data.immediateCorp);

         $("input[name='reviewdBy']").val(data.reviewdBy);
         $("input[name='rootCause']").val(data.rootCause);
         $("input[name='actionPrevent']").val(data.actionPrevent);
         $("input[name='root_cause_category']").val(data.root_cause_category);

         $("input[name='rootCause']").val(data.rootCause);


         $("#nonconfirmDetail").modal('show');

     }
     function EditData(data){
        console.log(data);
        $("#editid").val(data.id);
         $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
         $("input[name='CRE']").val(data.CRE);
         $("input[name='PI']").val(data.PI);
         $("input[name='customerID']").val(data.customerID);
         $("input[name='dateNcP']").val(data.dateNcP);
         $("input[name='dateNcR']").val(data.dateNcR);
         $("input[name='description']").val(data.description);
         $("input[name='effectiveDate']").val(data.effectiveDate);
         $("input[name='immediateCorp']").val(data.immediateCorp);
         $("input[name='reviewdBy']").val(data.reviewdBy);
         $("input[name='rootCause']").val(data.rootCause);
         $("input[name='actionPrevent']").val(data.actionPrevent);
         $("input[name='root_cause_category']").val(data.root_cause_category);
         $("input[name='rootCause']").val(data.rootCause);
         $("#editConfirm").modal('show');

     }
     function removeinfo(data){
         $("#re_id").val(data.id);
         $("#deleteRequirment").modal('show');

     }
 </script>
