@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Risk Assessments</h2>
            <p>Assess contract risks covering quality, delivery, price and interested party impacts</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="riskAssessment()">
                <i class="fa fa-plus"></i> Add a Risk Assessment
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="am-card risk_assessment_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">New Risk Assessment</h6>
            <p><strong>Scope:</strong> This procedure details possible scenarios of potential in accepting a contract and compares this with risk and consequence of issues occurring.</p>
            <form action="{{route('assessment')}}" method="POST" class="addForm">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <label>Job Number:</label>
                        <input type="text" min="1" class="form-control validate_number" name="jobNumber" required>
                    </div>
                    <div class="form-col">
                        <label>Date (MM/DD/YYYY):</label>
                        <input type="date" max="2999-12-31" class="form-control" name="date" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Can I meet the quality standard?:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio"><input type="radio" name="qualitySatandard" value="Yes" required> Yes <span></span></label>
                            <label class="kt-radio"><input type="radio" name="qualitySatandard" value="No"> No <span></span></label>
                            <label class="kt-radio"><input type="radio" name="qualitySatandard" value="NA"> NA <span></span></label>
                        </div>
                    </div>
                    <div class="form-col">
                        <label>Comments:</label>
                        <input type="text" class="form-control" placeholder="Enter Comment" name="commentsstandard">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Can I meet the delivery date?:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio"><input type="radio" name="delevryStandard" value="yes" required> Yes <span></span></label>
                            <label class="kt-radio"><input type="radio" name="delevryStandard" value="no"> No <span></span></label>
                            <label class="kt-radio"><input type="radio" name="delevryStandard" value="NA"> NA <span></span></label>
                        </div>
                    </div>
                    <div class="form-col">
                        <label>Comments:</label>
                        <input type="text" class="form-control" placeholder="Enter Comment" name="commentsdelvery">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Can I meet the price?:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio"><input type="radio" name="priceRequiremnt" value="yes" required> Yes <span></span></label>
                            <label class="kt-radio"><input type="radio" name="priceRequiremnt" value="No"> No <span></span></label>
                            <label class="kt-radio"><input type="radio" name="priceRequiremnt" value="NA"> NA <span></span></label>
                        </div>
                    </div>
                    <div class="form-col">
                        <label>Comments:</label>
                        <input type="text" class="form-control" placeholder="Enter Comment" name="commentprice">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Could interested parties be deemed affected?:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio"><input type="radio" name="interestedDeemed" value="Yes" required> Yes <span></span></label>
                            <label class="kt-radio"><input type="radio" name="interestedDeemed" value="No"> No <span></span></label>
                            <label class="kt-radio"><input type="radio" name="interestedDeemed" value="NA"> NA <span></span></label>
                        </div>
                    </div>
                    <div class="form-col">
                        <label>Comments:</label>
                        <input type="text" class="form-control" placeholder="Enter Comment" name="commentsDeemed">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Decision Comment:</label>
                        <input type="text" class="form-control" placeholder="Enter Comment" name="DecisionComment" required>
                    </div>
                    <div class="form-col">
                        <label>Delivery Date (MM/DD/YYYY):</label>
                        <input type="date" max="2999-12-31" class="form-control" name="dateDevelry" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Risk Probability - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
                        <select name="RiskProbability" id="RiskProbability" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Risk Severity - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
                        <select name="riskSeverity" id="riskSeverity" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    <button onclick="riskAssessment()" type="reset" class="am-btn am-btn-sm am-btn-danger" data-dismiss="modal" style="margin-left:8px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Total Risk Assessments Listed</h6>
            <div class="am-table-wrap">
                <table class="am-table" id="kt_table_agent">
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
                        @php $i=1 @endphp
                        @forelse ($assessment as $data)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$data->jobNumber}}</td>
                            <td>{{date('d/m/Y', strtotime($data->date))}}</td>
                            <td>{{ucfirst($data->qualitySatandard)}}</td>
                            <td>{{ucfirst($data->delevryStandard)}}</td>
                            <td>{{ucfirst($data->priceRequiremnt)}}</td>
                            <td>{{ucfirst($data->DecisionComment)}}</td>
                            <td>
                                <button class="am-btn am-btn-sm am-btn-primary" data-toggle="modal" data-target="#viewData-{{$data->id}}" title="View" type="button">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewData-{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                <h5 class="modal-title">View Risk Assessment</h5>
                                                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Job Number:</label>
                                                                <input disabled type="text" class="form-control" name="jobNumber" value="{{$data->jobNumber}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Date (MM/DD/YYYY):</label>
                                                                <input disabled type="date" max="2999-12-31" class="form-control" name="date" value="{{$data->date}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Can I meet the quality standard?:</label>
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio"><input disabled type="radio" name="qualitySatandard" value="Yes" {{$data->qualitySatandard == "Yes" ? 'checked':''}}> Yes <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="qualitySatandard" value="No" {{$data->qualitySatandard == "No" ? 'checked':''}}> No <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="qualitySatandard" value="NA" {{$data->qualitySatandard == "NA" ? 'checked':''}}> NA <span></span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Comments:</label>
                                                                <input disabled type="text" class="form-control" name="commentsstandard" value="{{$data->commentsstandard}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Can I meet the delivery date?:</label>
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio"><input disabled type="radio" name="delevryStandard" value="yes" {{ $data->delevryStandard == "yes" ? 'checked':'' }}> Yes <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="delevryStandard" value="no" {{ $data->delevryStandard == "no" ? 'checked':''}}> No <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="delevryStandard" value="NA" {{ $data->delevryStandard == "NA" ? 'checked':''}}> NA <span></span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Comments:</label>
                                                                <input disabled type="text" class="form-control" name="commentsdelvery" value="{{$data->commentsdelvery}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Can I meet the price?: ({{$data->priceRequiremnt}})</label>
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio"><input disabled type="radio" name="priceRequiremnt" value="yes" {{ $data->priceRequiremnt == "yes" ? 'checked':'' }}> Yes <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="priceRequiremnt" value="No" {{ $data->priceRequiremnt == "No" ? 'checked':'' }}> No <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="priceRequiremnt" value="NA" {{ $data->priceRequiremnt == "NA" ? 'checked':'' }}> NA <span></span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Comments:</label>
                                                                <input disabled type="text" class="form-control" name="commentprice" value="{{$data->commentprice}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Could interested parties be deemed affected?:</label>
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio"><input disabled type="radio" name="interestedDeemed" value="Yes" {{ $data->interestedDeemed == "Yes" ? 'checked':'' }}> Yes <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="interestedDeemed" value="No" {{ $data->interestedDeemed == "No" ? 'checked':'' }}> No <span></span></label>
                                                                    <label class="kt-radio"><input disabled type="radio" name="interestedDeemed" value="NA" {{ $data->interestedDeemed == "NA" ? 'checked':'' }}> NA <span></span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Comments:</label>
                                                                <input disabled type="text" class="form-control" name="commentsDeemed" value="{{$data->commentsDeemed}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Decision Comment:</label>
                                                                <input disabled type="text" class="form-control" name="DecisionComment" value="{{$data->DecisionComment}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Delivery Date (MM/DD/YYYY):</label>
                                                                <input disabled type="date" max="2999-12-31" class="form-control" name="dateDevelry" value="{{$data->dateDevelry}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Risk Probability - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
                                                                <select name="RiskProbability" id="RiskProbability" class="form-control" disabled>
                                                                    <option value="">Select One</option>
                                                                    <option value="4" {{ $data->RiskProbability == "4" ? 'selected="selected"':'' }}>4</option>
                                                                    <option value="3" {{ $data->RiskProbability == "3" ? 'selected="selected"':'' }}>3</option>
                                                                    <option value="2" {{ $data->RiskProbability == "2" ? 'selected="selected"':'' }}>2</option>
                                                                    <option value="1" {{ $data->RiskProbability == "1" ? 'selected="selected"':'' }}>1</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Risk Severity - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
                                                                <select name="riskSeverity" id="riskSeverity" class="form-control" disabled>
                                                                    <option value="">Select One</option>
                                                                    <option value="4" {{ $data->riskSeverity == "4" ? 'selected="selected"':'' }}>4</option>
                                                                    <option value="3" {{ $data->riskSeverity == "3" ? 'selected="selected"':'' }}>3</option>
                                                                    <option value="2" {{ $data->riskSeverity == "2" ? 'selected="selected"':'' }}>2</option>
                                                                    <option value="1" {{ $data->riskSeverity == "1" ? 'selected="selected"':'' }}>1</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button class="am-btn am-btn-sm am-btn-primary" type="button" onclick="EditData({{$data}});" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                <button data-toggle="modal" data-target="#confirm-{{$data->id}}" id="remove_{{$data->id}}" title="Delete" class="am-btn am-btn-sm am-btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade modal-mini modal-primary" id="confirm-{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('delete_assesment') }}" method="post">
                                                <div class="modal-header" style="background:var(--am-primary);color:#fff;"> @csrf
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Are you sure you want to delete this entry?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php $i++ @endphp
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="am-empty">
                                    <i class="fa fa-database"></i>
                                    <p>No records.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Edit Risk Assessment</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('editassessment')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="" id="id_feild">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Job Number:</label>
                                <input type="text" min="1" class="form-control validate_number" name="jobNumber">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date (MM/DD/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Can I meet the quality standard?:</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio"><input type="radio" name="qualitySatandard" value="Yes" required> Yes <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="qualitySatandard" value="No"> No <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="qualitySatandard" value="NA"> NA <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Comments:</label>
                                <input type="text" class="form-control" placeholder="Enter Comment" name="commentsstandard">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Can I meet the delivery date?:</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio"><input type="radio" name="delevryStandard" value="yes" required> Yes <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="delevryStandard" value="no"> No <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="delevryStandard" value="NA"> NA <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Comments:</label>
                                <input type="text" class="form-control" placeholder="Enter Comment" name="commentsdelvery">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Can I meet the price?:</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio"><input type="radio" name="priceRequiremnt" value="yes" required> Yes <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="priceRequiremnt" value="No"> No <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="priceRequiremnt" value="NA"> NA <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Comments:</label>
                                <input type="text" class="form-control" placeholder="Enter Comment" name="commentprice">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Could interested parties be deemed affected?:</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio"><input type="radio" name="interestedDeemed" value="Yes" required> Yes <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="interestedDeemed" value="No"> No <span></span></label>
                                    <label class="kt-radio"><input type="radio" name="interestedDeemed" value="NA"> NA <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Comments:</label>
                                <input type="text" class="form-control" placeholder="Enter Comment" name="commentsDeemed">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Decision Comment:</label>
                                <input type="text" class="form-control" placeholder="Enter Comment" name="DecisionComment" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Delivery Date (MM/DD/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="dateDevelry" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk Probability - 4 = Very likely, 3 = Likely, 2 = Not likely, 1 = Very unlikely:</label>
                                <select name="RiskProbability" id="RiskProbability" class="form-control" required>
                                    <option value="">Select One</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk Severity - 4 = Catastrophic, 3 = Critical, 2 = Marginal, 1 = Negligible:</label>
                                <select name="riskSeverity" id="riskSeverity" class="form-control" required>
                                    <option value="">Select One</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right:20px;">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

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

         $("select[name='RiskProbability']").val(data.RiskProbability);
         $("select[name='riskSeverity']").val(data.riskSeverity);

        $("#editModal").modal('show');
		resetForm();
    }
</script>
