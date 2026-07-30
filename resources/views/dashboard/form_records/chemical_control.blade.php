@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>COSHH - Chemical Control</h2>
            <p>Control of Substances Hazardous to Health - maintain a current information log of hazardous substances</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="processinterestedForm()">
                <i class="fa fa-plus"></i> Add COSHH
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="am-card process_interested_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">New COSHH Record</h6>
            <p>Chemical Control or Control of Substances Hazardous to Health (COSHH) is a method that allows employers to control substances that are hazardous to health. Prevent or reduce workers exposure to hazardous substances by maintaining a current information log of these substances.</p>
            <form action="{{route('chemicalform')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <label>Chemical Name:</label>
                        <input type="text" name="chemicalname" class="form-control" required placeholder="Enter Chemical Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Chemical Description (What are the main constituents):</label>
                        <input type="text" name="chemical_desc" class="form-control" required placeholder="Enter Chemical Description">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Chemical Type (Gas, liquid or solid):</label>
                        <input type="text" name="chemical_type" class="form-control" required placeholder="Enter Chemical Type (Gas, liquid or solid)">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Location Used (Consider area or department where the chemical is being used):</label>
                        <input type="text" name="location" class="form-control" required placeholder="Enter Location Used">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Activity Hazard (Consider chemical use, making additions, chemical discarding etc):</label>
                        <input type="text" name="activity_hazard" class="form-control" required placeholder="Enter Activity Hazard">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Identified Chemical Hazard (Consider Corrosive; Very Toxic; Oxidiser etc):</label>
                        <input type="text" name="identified_chazard" class="form-control" required placeholder="Enter Identified Chemical Hazard">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Identified Hazard (Consider Splashes and breathing fume vapour etc):</label>
                        <input type="text" name="identified_hazard" class="form-control" required placeholder="Enter Identified Hazard">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Target Organs:</label>
                        <input type="text" name="target_organs" class="form-control" required placeholder="Enter Target Organs">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Who is at Risk:</label>
                        <input type="text" name="who_risk" class="form-control" required placeholder="Who is at Risk:">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Protection Required (Consider gloves, glasses, overalls or shoes etc):</label>
                        <input type="text" name="protection_required" class="form-control" required placeholder="Enter Protection Required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Is this chemical still used in production or legacy?</label>
                        <div class="kt-radio-list">
                            <label class="kt-radio"><input type="radio" required value="Yes" name="still_used"> Yes, still used <span></span></label>
                            <label class="kt-radio"><input type="radio" required value="No" name="still_used"> No, legacy <span></span></label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Attach Evidence: <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                        <input name="attach_evidence" type="file" class="form-control" accept="all">
                    </div>
                    <div class="form-col">
                        <label>Any other issues or points to note?</label>
                        <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:"></textarea>
                    </div>
                </div>
                <div style="margin-top:1rem; text-align:right;">
                    <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    <button type="reset" onclick="cosh()" class="am-btn am-btn-sm am-btn-danger" style="margin-left:8px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">COSHH Records</h6>
            <div class="am-table-wrap">
                <table class="am-table chemical_table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>S-No</th>
                            <th>Chemical Name</th>
                            <th>Chemical Description</th>
                            <th>Location</th>
                            <th>Activity</th>
                            <th>Still used</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        @php $i=1; @endphp
                        @forelse ($chemical as $data)
                            <?php $counter++; ?>
                            <tr>
                                <td>{{ $i++}}</td>
                                <td>{{ $data->chemical_name}}</td>
                                <td>{{ $data->chemical_desc}}</td>
                                <td>{{ $data->location_used}}</td>
                                <td>{{$data->activity_hazard}}</td>
                                <td>{{$data->still_used}}</td>
                                <td>
                                    <button class="am-btn am-btn-sm am-btn-primary" title="View" onclick="viewinterested({{$data}});">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="am-btn am-btn-sm am-btn-primary" title="Edit" onclick="getEid({{$data}});">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button data-toggle="modal" data-target="#deleteChemechal_id{{$data->id}}" class="am-btn am-btn-sm am-btn-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Delete modal per row -->
                            <div class="modal fade" id="deleteChemechal_id{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                            <h5 class="modal-title">Deleting Chemical Record</h5>
                                            <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this entry?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{url('/chemical_control_delete')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <tr>
                            <td colspan="7">
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
<div class="modal fade" id="editinterestedmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Edit Chemical Control Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('chemicalUpdate')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chemical Control:</label>
                                <input type="text" name="chemical_name" required class="form-control" placeholder="Enter Chemical Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chemical Description (What are the main constituents):</label>
                                <input type="text" name="chemical_desc" required class="form-control" placeholder="Enter Chemical Description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chemical Type (Gas, liquid or solid):</label>
                                <input type="text" name="chemical_type" required class="form-control" placeholder="Enter Chemical Type">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Location Used (Consider area or department where the chemical is being used):</label>
                                <input type="text" name="location" required class="form-control" placeholder="Enter Location">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Activity Hazard (Consider chemical use, making additions, chemical discarding etc):</label>
                                <input type="text" name="activity_hazard" required class="form-control" placeholder="Enter Activity Hazard">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Identified Chemical Hazard (Consider Corrosive; Very Toxic; Oxidiser etc):</label>
                                <input type="text" name="identified_chazard" required class="form-control" placeholder="Enter Identified Chemical Hazard" id="identified_chazard">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Identified Hazard (Consider Splashes and breathing fume vapour etc):</label>
                                <input type="text" name="identified_hazard" required class="form-control" placeholder="Enter Identified Hazard" id="identified_hazard">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Target Organ</label>
                                <input type="text" name="target_hazard" required class="form-control" placeholder="Enter Identified Target Hazard">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Who is at Risk</label>
                                <input type="text" name="who_risk" required class="form-control" placeholder="Enter Who is at Risk">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Protection Required (Consider gloves, glasses, overalls or shoes etc):</label>
                                <input type="text" name="protection_required" required class="form-control" placeholder="Protection Required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Is this chemical still used in production or legacy?</label>
                                <div class="kt-radio-list">
                                    <label class="kt-radio"><input type="radio" value="Yes" name="still_used"> Yes <span></span></label>
                                    <label class="kt-radio"><input type="radio" value="No" name="still_used"> No <span></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Attach Evidence: <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span></label>
                                <input name="attach_evidence" type="file" class="form-control" accept="all">
                            </div>
                        </div>
                        <div class="col-lg-12">
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

<!-- View Modal -->
<div class="modal fade" id="viewinterestedparty" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">View Chemical Control Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form>
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chemical Control</label>
                                <input type="text" name="chemical_name" required class="form-control" placeholder="Enter Chemical Name:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chemical Description (What are the main constituents):</label>
                                <input type="text" name="chemical_desc" required class="form-control" placeholder="Enter Chemical Description:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chemical Type (Gas, liquid or solid):</label>
                                <input type="text" name="chemical_type" required class="form-control" placeholder="Enter Chemical Type:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Location Used (Consider area or department where the chemical is being used):</label>
                                <input type="text" name="location" required class="form-control" placeholder="Enter Location:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Activity Hazard (Consider chemical use, making additions, chemical discarding etc):</label>
                                <input type="text" name="activity_hazard" required class="form-control" placeholder="Enter Activity Hazard:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Identified Chemical Hazard (Consider Corrosive; Very Toxic; Oxidiser etc):</label>
                                <input type="text" name="identified_chazard" required class="form-control" placeholder="Enter Identified Chemical Hazard:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Identified Hazard (Consider Splashes and breathing fume vapour etc):</label>
                                <input type="text" name="identified_hazard" required class="form-control" placeholder="Enter Identified Hazard:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Target Organ</label>
                                <input type="text" name="target_hazard" required class="form-control" placeholder="Enter Identified Target Hazard:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Who is at Risk</label>
                                <input type="text" name="who_risk" required class="form-control" placeholder="Enter Who is at Risk:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Protection Required (Consider gloves, glasses, overalls or shoes etc):</label>
                                <input type="text" name="protection_required" required class="form-control" placeholder="Protection Required:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Is this chemical still used in production or legacy?</label>
                                <div class="kt-radio-list">
                                    <label class="kt-radio"><input type="radio" required value="Yes" name="still_used" disabled> Yes <span></span></label>
                                    <label class="kt-radio"><input type="radio" required value="No" name="still_used" disabled> No <span></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Attach Evidence <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span>:</label>
                                <div class="evidence_attachemnt_div"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <textarea name="any_issues" class="form-control" placeholder="Enter Any other issues:" disabled></textarea>
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
@endsection

<script>
    function getEid(data) {
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='chemical_name']").val(data.chemical_name);
        $("input[name='chemical_desc']").val(data.chemical_desc);
        $("input[name='chemical_type']").val(data.chemical_type);
        $("input[name='location']").val(data.location_used);
        $("input[name='activity_hazard']").val(data.activity_hazard);
        $("input[name='identified_chazard']").val(data.identified_chazard);
        $("input[name='identified_hazard']").val(data.identified_hazard);
        $("input[name='target_hazard']").val(data.target_hazard);
        $("input[name='who_risk']").val(data.who_risk);
        $("input[name='protection_required']").val(data.protection_required);
        $("input[name='still_used'][value=" + data.still_used + "]").prop('checked', true);
        $("textarea[name='any_issues']").val(data.any_issues);
        $("#editinterestedmodal").modal('show');
    }

    function viewinterested(data) {
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='chemical_name']").val(data.chemical_name);
        $("input[name='chemical_desc']").val(data.chemical_desc);
        $("input[name='chemical_type']").val(data.chemical_type);
        $("input[name='location']").val(data.location_used);
        $("input[name='activity_hazard']").val(data.activity_hazard);
        $("input[name='identified_chazard']").val(data.identified_chazard);
        $("input[name='identified_hazard']").val(data.identified_hazard);
        $("input[name='target_hazard']").val(data.target_hazard);
        $("input[name='who_risk']").val(data.who_risk);
        $("input[name='protection_required']").val(data.protection_required);
        $("input[name='still_used'][value=" + data.still_used + "]").prop('checked', true);
        $("textarea[name='any_issues']").val(data.any_issues);
        if (data.attach_evidence) {
            $('.evidence_attachemnt_div').empty().append(`<span class="text-dark">Click to view evidence <a target="_blank" href="${data.attach_evidence}">Here</a></span>`);
        } else {
            $('.evidence_attachemnt_div').empty().append('No data found');
        }
        $("#viewinterestedparty").modal('show');
    }

    function deleteModal(data) {
        $("#re_id").val(data.id);
        $("#deleteRequirment").modal('show');
    }

    function cosh() {
        if ($(".process_interested_from_div").css("display") === "block") {
            $(".process_interested_from_div").css("display", "none");
        } else {
            $(".process_interested_from_div").css("display", "block");
        }
    }

    function processinterestedForm() {
        cosh();
    }
</script>
