@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Add or Amend a Calibration Record</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
                  
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Calibration Due</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Equipment ID</th>
											<th>Equipment</th>
											<th>Serial Number</th>
											<th>Date Calibrated</th>
                                            <th>Date Due</th>
                                            <th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caliber as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->equipment}}</td>
                                            <td>{{$data->serialNum}}</td>
                                            <td>{{$data->calibratedDate}}</td>
                                            <td>{{$data->calibratedDate}}</td>
                                            <td> <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Info" value="" onclick="getEid({{$data}});"><i class="la la-eye"></i>
											</button>
											<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" value="" onclick="DeleteModal({{$data}});"><i class="la la-trash"></i>
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
                    		<h4>Total Items Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Equipment ID</th>
											<th>Equipment</th>
											<th>Serial Number</th>
											<th>Location</th>
											<th>Test Method</th>
											<th>Acceptance Criteria</th>
											<th>Date Calibrated</th>
											<th>Certificate</th>
											<th>Frequency (M)</th>
											<th>Reviewer</th>
											<th>Sentence</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caliber as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->equipment}}</td>
                                            <td>{{$data->serialNum}}</td>
                                            <td>{{$data->locaction}}</td>
                                            <td>{{$data->testMethod}}</td>
                                            <td>{{$data->acceptance}}</td>
                                            <td>{{$data->calibratedDate}}</td>
                                            <td>{{$data->certificatenumber}}</td>

                                            <td>{{$data->freq}}</td>
                                            <td>{{$data->reportRev}}</td>
                                            <td>{{$data->sentence}}</td>
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
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
			<form action="{{route('deletecaliberinfo')}}" method="POST">
				@csrf
				<input type="hidden" name="id" value="" id="re_id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>ID Number:</label><br>
											<input type="number" class="form-control"  placeholder="Enter ID:">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Supplier Name:</label><br>
											<input type="text" class="form-control"  placeholder="Enter Supplier Name:">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Address:</label>
											<input type="text" class="form-control"  placeholder="Enter Supplier Address:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>City:</label>
											<input type="text" class="form-control"  placeholder="Enter City:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>County or State:</label>
											<input type="text" class="form-control"  placeholder="Enter Country or State:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Post Code or Zip Code:</label>
											<input type="text" class="form-control"  placeholder="Enter Customer Contact Number:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Country:</label>
											<input type="text" class="form-control"  placeholder="Enter Country">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Telephone:</label>
											<input type="text" class="form-control"  placeholder="Enter Supplier Telephone:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Email::</label>
											<input type="email" class="form-control"  placeholder="Enter Supplier Email:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Contact Name:</label>
											<input type="text" class="form-control"  placeholder="Enter Supplier Contact Number:">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Supplier Service:</label>
											<input type="email" class="form-control"  placeholder="Enter Supplier Service:">
										</div>
									</div>
									</div>
                    		</form>
			</div>
			<div class="modal-footer">
				<form action="" method="POST">
				@csrf
				@method('DELETE')
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
				<button type="submit" class="btn btn-danger">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editcustomer_rev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Calibration Informations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form action="{{route('calibrationedit')}} " method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Calibration ID Number (See table below. For amendments only):</label><br>
                                <input type="number" class="form-control" name="calibrationid">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Equipment Name:</label><br>
                                <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name:">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Serial Number:</label>
                                <input type="text" class="form-control" name="serialNum"  placeholder="Enter Serial Number:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Location:</label>
                                <input type="text" class="form-control" name="locaction"  placeholder="Enter Location:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Test Method Reference:</label>
                                <input type="text" class="form-control" name="testMethod"  placeholder="Enter Test Method Reference:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Acceptance Criteria:</label>
                                <input type="text" class="form-control" name="acceptance"  placeholder="Enter Acceptance Criteria:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date Calibrated:</label>
                                <input type="date" class="form-control" name="calibratedDate">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Certificate Number:</label>
                                <input type="text" class="form-control" name="certificatenumber"  placeholder="Enter Certificate Number:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Frequency (Months):</label>
                                <input type="number" name="freq" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Report Reviewer:</label>
                                <input type="text" class="form-control" name="reportRev"  placeholder="Enter Report Reviewer:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Sentence (Pass or Fail):</label>
                                <select name="sentence" class="form-control">
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                                </select>
                            </div>
                        </div>
                        </div>
                    <button type="button" class="submitBtn"  data-dismiss="modal" aria-label="Close">Cancel</button>
                </form>
		</div>
	</div>
</div>
</div>
@endsection
<script>
    function getEid(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='testMethod']").val(data.testMethod);
         $("input[name='serialNum']").val(data.serialNum);
         $("input[name='sentence']").val(data.sentence);
         $("input[name='reportRev']").val(data.reportRev);
         $("input[name='locaction']").val(data.locaction);
         $("input[name='freq']").val(data.freq);
         $("input[name='equipment']").val(data.equipment);
         $("input[name='certificatenumber']").val(data.certificatenumber);
         $("input[name='calibrationid']").val(data.calibrationid);
         $("input[name='calibratedDate']").val(data.calibratedDate);
         $("input[name='acceptance']").val(data.acceptance);
         $("#editcustomer_rev").modal('show');
     }
	 function DeleteModal(data){
		$("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

	 }
</script>
