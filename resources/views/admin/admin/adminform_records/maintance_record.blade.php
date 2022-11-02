@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Maintenance Records</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
            <p>Carrying out frequent maintenance checks and repairs are necessary to maintain production and service. Maintenance Reviews within the working environment including equipment should be carried out monthly, quarterly, semiannually, or annually depending on the size and nature of the business.</p>

<p>To add a record, click on the “Add Maintenance Record” button. To amend a record, click on the edit icon of the entry that needs to be modified or deleted.</p>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Records Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Maintenance ID</th>
											<th>Date</th>
											<th>Item</th>
											<th>Activity</th>
											<th>Location</th>
											<th>Observations</th>
											<th>Actions</th>
                                            <th>Performed By</th>
                                            <th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mainrecord as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->mrdate}}</td>
                                                <td>{{$data->mritem}}</td>
                                                <td>{{$data->mractivity}}</td>
                                                <td>{{$data->mlocation}}</td>
                                                <td>{{$data->mrobservation}}</td>
                                                <td>{{$data->mractions}}</td>
                                                <td>{{$data->mractivityperofrmby}}</td>
                                                <td>
                                                    <button onclick="getEid({{json_encode($data)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="fa fa-eye"></i>
													</button>
													<button onclick="deleteModal({{json_encode($data)}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
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
			
					<form action="{{route('deletemaintanceRecAdmin')}}" method="POST">
						@csrf
						<input type="hidden" name="id" id="re_id" value="">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-danger">Yes</button>
						</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
		<form >
            @csrf
			<div class="modal-body">
                <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance ID Number (See table below. For amendments only):</label><br>
                                <input type="number" class="form-control" name="mid">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date:</label><br>
                                <input type="date" class="form-control" name="mrdate">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Item:</label>
                                <input type="text" class="form-control" name="mritem" placeholder="Enter Management Review Meeting:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity:</label>
                                <input type="text" class="form-control" name="mractivity" placeholder="Enter Review Previous Meeting:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Location:</label>
                                <input type="text" class="form-control" name="mlocation">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Observations:</label>
                                <input type="text" class="form-control" name="mrobservation">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Actions:</label>
                                <input type="text" class="form-control" name="mractions">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity Performed By:</label>
                                <input type="text" class="form-control" name="mractivityperofrmby">
                            </div>
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            </div>
        </form>
		</div>
	</div>
</div>



@endsection

<script>
    function getEid(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='mlocation']").val(data.mlocation);
         $("input[name='mractions']").val(data.mractions);
         $("input[name='mractivity']").val(data.mractivity);
         $("input[name='mractivityperofrmby']").val(data.mractivityperofrmby);
         $("input[name='mrdate']").val(data.mrdate);
         $("input[name='mritem']").val(data.mritem);
         $("input[name='mrobservation']").val(data.mrobservation);
         $("input[name='mid']").val(data.mid);
         $("#editepmloyee").modal('show');

     }
	 function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

     }


</script>
