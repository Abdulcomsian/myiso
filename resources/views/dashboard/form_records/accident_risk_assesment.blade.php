@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Accident Risk Assessments</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
				<h5>Scope:</h5>
				<p>This procedure details possible scenarios of potential accidents and compares this with risk and consequence of such an accident occurring. It will also provide details as to what measures have been taken to reduce the risk of such accidents occurring.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="accidentRiskForm()" class="addBtn">Add Accident Risk Assessment</a>
                    		</div>
                    	</div>
                    	<div class="accident_risk_from_div">
                            <form method="POST" action="{{route('accident_risk')}}" enctype="multipart/form-data">
                                @csrf
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Scenario - Describe the activity:</label><br>
											<input type="text" class="form-control" placeholder="Enter Activity" required name="activityscenario">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Risk likelihood of scenario occuring - Enter a number between 1-6 (6 being most likely):</label><br>
											<input type="number" class="form-control" min="1" max="6" required name="risklikehood" placeholder="Enter likelihood"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
										</div>
                                    </div>

                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Risk severity - Enter a number between 1-6 (6 being most severe):</label>
											<input type="number" min="1" max="6" required class="form-control" name="riskseverity" placeholder="Enter severity:" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>If an environmental accident, what gets out and how much:</label>
											<input type="text" class="form-control"  placeholder="Enter Potential Outcome:" required name="envaccident" placeholder="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>If an environmental accident, where does it end up?</label>
											<input type="text" class="form-control" placeholder="Enter Location" required name="envaccidental">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>What are the consequences?:</label>
											<input type="text" class="form-control"  placeholder="Enter Potential Consequences"  required name="consequences">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>What can prevent or reduce the risk?:</label>
											<input type="text" class="form-control" required   placeholder="Enter preventative solutions"  name="reducerisk">
									</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Revised Risk likelihood of scenario occuring following prevention step - A number between 1-6 (6 being most likely):</label>
											<input type="number" class="form-control" required min="1" max="6" name="revisedrisk" placeholder="Enter new reduced risk level" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Revised Risk severity following prevention step - A number between 1-6 (6 being most severe):</label>
											<input type="number" class="form-control" required min="1" max="6"  name="reviseRiskSever" placeholder="Enter new reduced risk severity level" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
										</div>
									</div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                                                <input name="attach_evidence" type="file" class="form-control"
                                                       accept="all">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Any other issues or points to note?</label>
                                            <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
                                        </div>
                                    </div>
								</div>
								<button type="submit" class="submitBtn">SUBMIT</button>
									<button type="reset" onclick="accidentRiskForm()" class="btn btn-secondary submitBtn " style="margin-right:7px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Accident Risk Assessments Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Scenario</th>
											<!--<th>Detail View</th>-->
											<th>Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($audit as $data)
                                        <tr>
                                            <td> {{$data->activityscenario}}</td>
                                            <td> <button
                                                 onclick="getDetails({{json_encode($data)}})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View" value=""><i class="fa fa-eye"></i>
                                            </button>
                                            
                                            <button onclick="Editinfo({{json_encode($data)}})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value=""><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
                                        </button>
                                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="deleteModal({{$data}});"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
											</button>
                                            </td>
                                            <!--<td> </td>-->


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
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Accident Risk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deleteRisk')}}" method="POST">
				@csrf
				<input type="hidden" name="id" value="" id="idform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Accident Risk Assessments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
                <form >

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scenario - Describe the activity:</label><br>
                                <input type="text" class="form-control" required name="activityscenario">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk likelihood of scenario occuring - Enter a number between 1-6 (6 being most likely):</label><br>
                                <input type="number" class="form-control" min="1" max="6" required name="risklikehood" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk severity - Enter a number between 1-6 (6 being most severe):</label>
                                <input type="number" class="form-control" required name="riskseverity" min="1" max="6" placeholder="Enter Management Review Meeting:" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, what gets out and how much:</label>
                                <input type="text" class="form-control" required name="envaccident" placeholder="Enter Review Previous Meeting:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, where does it end up?</label>
                                <input type="text" class="form-control"  required name="envaccidental">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>What are the consequences?:</label>
                                <input type="text" class="form-control" required name="consequences">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>What can prevent or reduce the risk?:</label>
                                <input type="text" class="form-control" required name="reducerisk">
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk likelihood of scenario occuring following prevention step - A number between 1-6 (6 being most likely):</label>
                                <input type="number" class="form-control" min="1" max="6" required name="revisedrisk" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk severity following prevention step - A number between 1-6 (6 being most severe):</label>
                                <input type="number" class="form-control" min="1" required  max="6" name="reviseRiskSever" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span>:</label>
                                <div class="evidence_attachemnt_div"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
                            </div>
                        </div>
                    </div>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </form>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="editmodalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Accident Risk Assessments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form  action="{{route('accidentedit')}}" method="POST" enctype="multipart/form-data">>
                @csrf
			<div class="modal-body">
                <input type="hidden" id="editrisk" name="id" value="">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scenario - Describe the activity:</label><br>
                                <input type="text" class="form-control" required  name="activityscenario">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk likelihood of scenario occuring - Enter a number between 1-6 (6 being most likely):</label><br>
                                <input type="number" class="form-control validate_number" min="1" max="6" required name="risklikehood" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk severity - Enter a number between 1-6 (6 being most severe):</label>
                                <input type="number" class="form-control validate_number" required  min="1" max="6" name="riskseverity" placeholder="Enter Management Review Meeting:" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, what gets out and how much:</label>
                                <input type="text" class="form-control" required  name="envaccident" placeholder="Enter Review Previous Meeting:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, where does it end up?</label>
                                <input type="text" class="form-control" required  name="envaccidental">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>What are the consequences?:</label>
                                <input type="text" class="form-control" required name="consequences">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>What can prevent or reduce the risk?:</label>
                                <input type="text" class="form-control" required  name="reducerisk">
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk likelihood of scenario occuring following prevention step - A number between 1-6 (6 being most likely):</label>
                                <input type="number" class="form-control validate_number" min="1" required max="6" required name="revisedrisk" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk severity following prevention step - A number between 1-6 (6 being most severe):</label>
                                <input type="number" class="form-control validate_number" min="1" required max="6" name="reviseRiskSever" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence: <span class="text-danger" style="color:#000 !important;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                                <input name="attach_evidence" type="file" class="form-control"
                                       accept="all">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
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
{{-- editmodalData --}}
@endsection

<script>


    function getDetails(data){
        console.log(data);
         $("#id_feild").val(data.id);
         $("input[name='riskseverity']").val(data.riskseverity);
         $("input[name='risklikehood']").val(data.risklikehood);
         $("input[name='revisedrisk']").val(data.revisedrisk);
         $("input[name='reviseRiskSever']").val(data.reviseRiskSever);
         $("input[name='reducerisk']").val(data.reducerisk);
         $("input[name='envaccidental']").val(data.envaccidental);
         $("input[name='envaccident']").val(data.envaccident);
         $("input[name='consequences']").val(data.consequences);
         $("input[name='activityscenario']").val(data.activityscenario);
        $("textarea[name='any_issues']").val(data.any_issues);
        if (data.attach_evidence) {
                $('.evidence_attachemnt_div').empty().append(`<span class="text-dark">Click to view evidence <a target="_blank" href="${data.attach_evidence}">Here</a></span>`);
            } else {
                $('.evidence_attachemnt_div').empty().append('No data found');
            }
         $("#editInfo").modal('show');

     }
     function Editinfo(data){
        $("#editrisk").val(data.id);
         $("input[name='riskseverity']").val(data.riskseverity);
         $("input[name='risklikehood']").val(data.risklikehood);
         $("input[name='revisedrisk']").val(data.revisedrisk);
         $("input[name='reviseRiskSever']").val(data.reviseRiskSever);
         $("input[name='reducerisk']").val(data.reducerisk);
         $("input[name='envaccidental']").val(data.envaccidental);
         $("input[name='envaccident']").val(data.envaccident);
         $("input[name='consequences']").val(data.consequences);
         $("input[name='activityscenario']").val(data.activityscenario);
         $("textarea[name='any_issues']").val(data.any_issues);
         $("#editmodalData").modal('show');
     }
     function deleteModal(data){
         console.log(data);
         $("#idform").val(data.id);
         $("#deleteRequirment").modal('show');

     }


 </script>