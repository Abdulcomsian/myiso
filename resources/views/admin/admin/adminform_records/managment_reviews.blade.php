@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Management Reviews</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
				<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                   
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Management Review</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>ID Number</th>
											<th>Date</th>
											<th>Attendees</th>
											<th>Planned Objectives</th>
											<th>Detail View</th>
											<th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mgtrev as $item)
                                           <tr>
                                               <td> {{$item->id}}</td>
                                               <td> {{$item->reviewdate}}</td>
                                               <td> {{$item->meetingatt}}</td>
                                               <td> {{$item->newquality}}</td>
                                               <td>
                                                    <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value=""
                                                 onclick="displaydetail({{json_encode($item)}});">
                                                 <i class="la la-eye"></i>
                                               </button>
                                            </td>
                                               <td>
                                                   {{-- <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value="" onclick="getEid({{$item}});"><i class="la la-edit"></i>
                                               </button> --}}
                                           <button  onclick="deleteData({{$item}})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" value=""><i class="la la-trash"></i>
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
</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Management review</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deletemgtreviewadmin')}}" method="POST">
				@csrf
                    <input type="hidden" name="id" id="validid">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form>
                        <div class="row">
                            <input type="hidden" readonly disabled name="id" value="" id="id_feild">
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review ID Number (See table below. For amendments only):</label><br>
                                    <input type="number" readonly disabled class="form-control" name="1mgtreviewId">
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Management Review Date:</label><br>
                                    <input type="date" readonly disabled class="form-control" name="1reviewdate">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review Meeting Attendees:</label>
                                    <input type="text" readonly disabled class="form-control" name="1meetingatt" placeholder="Enter Management Review Meeting:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review previous meeting minutes:</label>
                                    <input type="text" readonly disabled class="form-control" name="1prevmeeting" placeholder="Enter Review Previous Meeting:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                                    <input type="text" readonly disabled class="form-control" name="1recommendedchange">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                                    <input type="text" readonly disabled class="form-control" name="1sammarisecustomr">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on previous objectives:</label>
                                    <input type="text" readonly disabled class="form-control" name="1prevobjectv">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Process performance and conformity of products and services:</label>
                                    <input type="text" readonly disabled class="form-control" name="1conformity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nonconformities and corrective actions:</label>
                                    <input type="text" readonly disabled class="form-control" name="1nonconformities">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Monitoring and measurement results:</label>
                                    <input type="text" readonly disabled class="form-control" name="1monitoringres">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on Audit results:</label>
                                    <input type="text" readonly disabled class="form-control" name="1auditres">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on the performance of external providers:</label>
                                    <input type="text" readonly disabled class="form-control" name="1externalprovider">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The adequacy of resources and changes recommended:</label>
                                    <input type="text" readonly disabled class="form-control" name="1adequacy">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The effectiveness of actions taken to address risks and opportunities:</label>
                                    <input type="text" readonly disabled class="form-control" name="1effectiveness">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
                                    <input type="text" readonly disabled class="form-control" name="1newquality">
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

<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form action="{{route('mgtreviewupdate')}}" method="POST">
                    @csrf

                        <div class="row">
                            <input type="hidden" name="id" value="" id="sdsd">
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review ID Number (See table below. For amendments only):</label><br>
                                    <input type="number" class="form-control" name="mgtreviewId">
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Management Review Date:</label><br>
                                    <input type="date" class="form-control" name="reviewdate">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Management Review Meeting Attendees:</label>
                                    <input type="text" class="form-control" name="meetingatt" placeholder="Enter Management Review Meeting:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review previous meeting minutes:</label>
                                    <input type="text" class="form-control" name="prevmeeting" placeholder="Enter Review Previous Meeting:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Changes in external and internal issues that are relevant to the quality management system and changes recommended:</label>
                                    <input type="text" class="form-control" name="recommendedchange">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Summarise customer satisfaction surveys and feedback from relevant interested parties:</label>
                                    <input type="text" class="form-control" name="sammarisecustomr">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on previous objectives:</label>
                                    <input type="text" class="form-control" name="prevobjectv">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Process performance and conformity of products and services:</label>
                                    <input type="text" class="form-control" name="conformity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nonconformities and corrective actions:</label>
                                    <input type="text" class="form-control" name="nonconformities">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Monitoring and measurement results:</label>
                                    <input type="text" class="form-control" name="monitoringres">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on Audit results:</label>
                                    <input type="text" class="form-control" name="auditres">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Comment on the performance of external providers:</label>
                                    <input type="text" class="form-control" name="externalprovider">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The adequacy of resources and changes recommended:</label>
                                    <input type="text" class="form-control" name="adequacy">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>The effectiveness of actions taken to address risks and opportunities:</label>
                                    <input type="text" class="form-control" name="effectiveness">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Add New Quality Objectives and opportunities for improvement. Consider who is responsible, when they will be completed and what is considered a success:</label>
                                    <input type="text" class="form-control" name="newquality">
                                </div>
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


{{-- deyail modal --}}

@endsection
<script>
    function getEid(data){
        console.log(data);
         $("#sdsd").val(data.id);
         $("input[name='adequacy']").val(data.adequacy);
         $("input[name='mgtreviewId']").val(data.mgtreviewId);
         $("input[name='auditres']").val(data.auditres);
         $("input[name='conformity']").val(data.conformity);
         $("input[name='effectiveness']").val(data.effectiveness);
         $("input[name='externalprovider']").val(data.externalprovider);
         $("input[name='meetingatt']").val(data.meetingatt);
         $("input[name='monitoringres']").val(data.monitoringres);
         $("input[name='newquality']").val(data.newquality);
         $("input[name='nonconformities']").val(data.nonconformities);
         $("input[name='prevmeeting']").val(data.prevmeeting);
         $("input[name='prevobjectv']").val(data.prevobjectv);
         $("input[name='recommendedchange']").val(data.recommendedchange);
         $("input[name='reviewdate']").val(data.reviewdate);
         $("input[name='sammarisecustomr']").val(data.sammarisecustomr);
         $("#editSupplier").modal('show');
     }
     function deleteData(data){
         $("#validid").val(data.id);
         $("#deleteRequirment").modal('show');

     }
   function  displaydetail(data){
         $("input[name='1adequacy']").val(data.adequacy);
         $("input[name='1mgtreviewId']").val(data.mgtreviewId);
         $("input[name='1auditres']").val(data.auditres);
         $("input[name='1conformity']").val(data.conformity);
         $("input[name='1effectiveness']").val(data.effectiveness);
         $("input[name='1externalprovider']").val(data.externalprovider);
         $("input[name='1meetingatt']").val(data.meetingatt);
         $("input[name='1monitoringres']").val(data.monitoringres);
         $("input[name='1newquality']").val(data.newquality);
         $("input[name='1nonconformities']").val(data.nonconformities);
         $("input[name='1prevmeeting']").val(data.prevmeeting);
         $("input[name='1prevobjectv']").val(data.prevobjectv);
         $("input[name='1recommendedchange']").val(data.recommendedchange);
         $("input[name='1reviewdate']").val(data.reviewdate);
         $("input[name='1sammarisecustomr']").val(data.sammarisecustomr);
         console.log("modal here");

        $("#DetailModal").modal('show');
     }

 </script>

