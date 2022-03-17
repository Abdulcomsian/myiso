@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Risk Assessments</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
				<h5>Scope:</h5>
				<p>This procedure details possible scenarios of potential in accepting a contract and compares this with risk and consequence of issues occurring.</p>
                   
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Risk Assessments Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>Risk ID Number</th>
											<th>Job Number</th>
											<th>Order Date</th>
											<th>Quality Accepted?</th>
											<th>Delivery Accepted?</th>
											<th>Price Accepted?</th>
                                            <th>Risk Decision</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($riskassesment as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
											<td>{{$data->jobNumber}}</td>
											<td>{{$data->date}}</td>
											<td>{{$data->qualitySatandard}}</td>
											<td>{{$data->delevryStandard}}</td>
											<td>{{$data->priceRequiremnt}}</td>
                                            <td>{{$data->DecisionComment}}</td>
                                            <td>
                                               <button class="btn btn-sm btn-clean btn-icon btn-icon-md" type="button" onclick="EditData({{$data}});">
												<i class="la la-info"></i>
											   </button>
											   <button onclick="deleteModal({{json_encode($data)}})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" value=""><i class="la la-trash"></i>
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
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Assessment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
            <form action="{{route('deleteAssesmnetadmin')}}" method="POST">
				@csrf
				<input type="hidden" name="id" value="" id="idform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Risk Assessments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
            <form >
                    @csrf

			<div class="modal-body ">
                <input type="hidden" name="id"  value="" id="id_feild">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Job Number:</label><br>
								<input type="text" class="form-control" name="jobNumber">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Date (YYY/MM/DD):</label><br>
								<input type="date" class="form-control" name="date">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Can I meet the quality standard?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" name="qualitySatandard" value="Yes" id="yes"> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="qualitySatandard" value="No" id="no"> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="qualitySatandard" value="NA" id="na"> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input type="text" class="form-control"  placeholder="Enter Comment"  name="commentsstandard">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Can I meet the delivery date?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" name="delevryStandard" value="yes"> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="delevryStandard" value="no"> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="delevryStandard" value="NA"> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsdelvery">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Can I meet the price?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" name="priceRequiremnt" value="yes"> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="priceRequiremnt" value="No"> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="priceRequiremnt" value="NA"> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input type="text" class="form-control"  placeholder="Enter Comment" name="commentprice">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Could interested parties be deemed affected?:</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" name="interestedDeemed" value="Yes"> Yes
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="interestedDeemed" value="No"> No
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="interestedDeemed" value="NA"> NA
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Comments:</label>
								<input type="text" class="form-control"  placeholder="Enter Comment" name="commentsDeemed">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Decision Comment:</label>
								<input type="text" class="form-control"  placeholder="Enter Comment" name="DecisionComment">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Delivery Date (YYY/MM/DD):</label>
								<input type="date" class="form-control"  placeholder="Enter Comment" name="dateDevelry">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Risk Probability (see instructions) - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
								<input type="number" class="form-control" name="RiskProbability">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Risk Severity (see instructions) - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
								<input type="number" class="form-control" name="riskSeverity">
							</div>
						</div>
					</div>
            </div>

			<div class="modal-footer">

				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

            </div>
        </form>
		</div>
	</div>
</div>
@endsection
<style>
    .risk_assessment_from_div .row:nth-child(even){
        background:#c4bebe;
        padding: 5px;
    }
</style>

<script>
    function EditData(data){
        console.log(data);

        $("#id_feild").val(data.id);
         $("input[name='DecisionComment']").val(data.DecisionComment);
         $("input[name='RiskProbability']").val(data.RiskProbability);
         $("input[name='commentprice']").val(data.commentprice);
         $("input[name='commentsDeemed']").val(data.commentsDeemed);
         $("input[name='commentsdelvery']").val(data.commentsdelvery);
         $("input[name='commentsstandard']").val(data.commentsstandard);
         $("input[name='date']").val(data.date);
         $("input[name='dateDevelry']").val(data.dateDevelry);
         $("input[name='jobNumber']").val(data.jobNumber);

         $("input[name='delevryStandard'][value="+data.delevryStandard+"]").prop('checked',true);
         $("input[name='interestedDeemed'][value="+data.interestedDeemed+"]").prop('checked',true);
         $("input[name='priceRequiremnt'][value="+data.priceRequiremnt+"]").prop('checked',true);
         $("input[name='qualitySatandard'][value="+data.qualitySatandard+"]").prop('checked',true);

         $("input[name='riskSeverity']").val(data.riskSeverity);

        $("#editModal").modal('show');

    }
	function deleteModal(data){
         console.log(data);
         $("#idform").val(data.id);
         $("#deleteRequirment").modal('show');

     }
</script>
