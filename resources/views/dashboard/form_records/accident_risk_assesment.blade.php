@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Accident Risk Assessments</h2>
            <p>Identify potential accident scenarios and assess risk likelihood and severity</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="accidentRiskForm()">
                <i class="fa fa-plus"></i> Add Accident Risk Assessment
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="am-card accident_risk_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">New Accident Risk Assessment</h6>
            <p><strong>Scope:</strong> This procedure details possible scenarios of potential accidents and compares this with risk and consequence of such an accident occurring. It will also provide details as to what measures have been taken to reduce the risk of such accidents occurring.</p>
            <form method="POST" action="{{route('accident_risk')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <label>Scenario - Describe the activity:</label>
                        <input type="text" class="form-control" placeholder="Enter Activity" required name="activityscenario">
                    </div>
                    <div class="form-col">
                        <label>Risk likelihood of scenario occuring - Enter a number between 1-6 (6 being most likely):</label>
                        <input type="number" class="form-control" min="1" max="6" required name="risklikehood" placeholder="Enter likelihood" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Risk severity - Enter a number between 1-6 (6 being most severe):</label>
                        <input type="number" min="1" max="6" required class="form-control" name="riskseverity" placeholder="Enter severity:" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-col">
                        <label>If an environmental accident, what gets out and how much:</label>
                        <input type="text" class="form-control" placeholder="Enter Potential Outcome:" required name="envaccident">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>If an environmental accident, where does it end up?</label>
                        <input type="text" class="form-control" placeholder="Enter Location" required name="envaccidental">
                    </div>
                    <div class="form-col">
                        <label>What are the consequences?:</label>
                        <input type="text" class="form-control" placeholder="Enter Potential Consequences" required name="consequences">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>What can prevent or reduce the risk?:</label>
                        <input type="text" class="form-control" required placeholder="Enter preventative solutions" name="reducerisk">
                    </div>
                    <div class="form-col">
                        <label>Revised Risk likelihood following prevention step - A number between 1-6 (6 being most likely):</label>
                        <input type="number" class="form-control" required min="1" max="6" name="revisedrisk" placeholder="Enter new reduced risk level" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Revised Risk severity following prevention step - A number between 1-6 (6 being most severe):</label>
                        <input type="number" class="form-control" required min="1" max="6" name="reviseRiskSever" placeholder="Enter new reduced risk severity level" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <div class="form-col">
                        <label>Attach Evidence: <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                        <input name="attach_evidence" type="file" class="form-control" accept="all">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Any other issues or points to note?</label>
                        <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    <button type="reset" onclick="accidentRiskForm()" class="am-btn am-btn-sm am-btn-danger" style="margin-left:8px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Total Accident Risk Assessments Listed</h6>
            <div class="am-table-wrap">
                <table class="am-table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>Scenario</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($audit as $data)
                        <tr>
                            <td>{{$data->activityscenario}}</td>
                            <td>
                                <button onclick="getDetails({{json_encode($data)}})" class="am-btn am-btn-sm am-btn-primary" title="View">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button onclick="Editinfo({{json_encode($data)}})" class="am-btn am-btn-sm am-btn-primary" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="am-btn am-btn-sm am-btn-danger" title="Delete" onclick="deleteModal({{$data}});">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Deleting Accident Risk</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
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

<!-- View Modal -->
<div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">View Accident Risk Assessment</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scenario - Describe the activity:</label>
                                <input type="text" class="form-control" required name="activityscenario" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk likelihood of scenario occuring - A number between 1-6:</label>
                                <input type="number" class="form-control" min="1" max="6" required name="risklikehood" disabled onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk severity - A number between 1-6:</label>
                                <input type="number" class="form-control" required name="riskseverity" min="1" max="6" disabled onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, what gets out and how much:</label>
                                <input type="text" class="form-control" required name="envaccident" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, where does it end up?</label>
                                <input type="text" class="form-control" required name="envaccidental" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>What are the consequences?:</label>
                                <input type="text" class="form-control" required name="consequences" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>What can prevent or reduce the risk?:</label>
                                <input type="text" class="form-control" required name="reducerisk" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk likelihood following prevention step - 1-6:</label>
                                <input type="number" class="form-control" min="1" max="6" required name="revisedrisk" disabled onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk severity following prevention step - 1-6:</label>
                                <input type="number" class="form-control" min="1" required max="6" name="reviseRiskSever" disabled onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span>:</label>
                                <div class="evidence_attachemnt_div"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editmodalData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Edit Accident Risk Assessment</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('accidentedit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="editrisk" name="id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Scenario - Describe the activity:</label>
                                <input type="text" class="form-control" required name="activityscenario">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk likelihood of scenario occuring - A number between 1-6:</label>
                                <input type="number" class="form-control validate_number" min="1" max="6" required name="risklikehood" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Risk severity - A number between 1-6:</label>
                                <input type="number" class="form-control validate_number" required min="1" max="6" name="riskseverity" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, what gets out and how much:</label>
                                <input type="text" class="form-control" required name="envaccident">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>If an environmental accident, where does it end up?</label>
                                <input type="text" class="form-control" required name="envaccidental">
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
                                <label>Revised Risk likelihood following prevention step - 1-6:</label>
                                <input type="number" class="form-control validate_number" min="1" required max="6" name="revisedrisk" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Revised Risk severity following prevention step - 1-6:</label>
                                <input type="number" class="form-control validate_number" min="1" required max="6" name="reviseRiskSever" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence: <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                                <input name="attach_evidence" type="file" class="form-control" accept="all">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
