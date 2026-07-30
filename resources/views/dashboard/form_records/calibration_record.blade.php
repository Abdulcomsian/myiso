@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Calibration Records</h2>
            <p>Add or amend calibration records for equipment and instruments.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="calibrationForm()">
                <i class="fa fa-plus"></i> Add Calibration Record
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible">{{ session('message') }}</div>
    @endif

    <p>Calibration is the testing and/or parameter settings of machinery or instruments to ensure they are working correctly. Depending on the environment this could be heavy machinery or a desktop printer.</p>
    <p>To add a record, click on the "Add Calibration Record" button. All Calibration Records created require a frequency of calibration, this is shown on your MyISOOnline control panel as a reminder.</p>

    {{-- Add Form --}}
    <div class="am-card calibration_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">New Calibration Record</h6>
            <form action="{{ route('calibration') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Equipment Name:</label>
                        <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name:" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Serial Number:</label>
                        <input type="text" class="form-control" name="serialNum" placeholder="Enter Serial Number:" required>
                    </div>
                    <div class="form-col">
                        <label>Location:</label>
                        <input type="text" class="form-control" name="locaction" placeholder="Enter Location:" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Test Method Reference:</label>
                        <input type="text" class="form-control" name="testMethod" placeholder="Enter Test Method Reference:" required>
                    </div>
                    <div class="form-col">
                        <label>Acceptance Criteria:</label>
                        <input type="text" class="form-control" name="acceptance" placeholder="Enter Acceptance Criteria:" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Date Calibrated:</label>
                        <input type="date" max="2999-12-31" class="form-control" name="calibratedDate" required>
                    </div>
                    <div class="form-col">
                        <label>Certificate Number:</label>
                        <input type="text" class="form-control" name="certificatenumber" placeholder="Enter Certificate Number:" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Frequency (Months):</label>
                        <input type="number" oninput="this.value = Math.abs(this.value)" min="1" max="12" name="freq" class="form-control" required>
                    </div>
                    <div class="form-col">
                        <label>Report Reviewer:</label>
                        <input type="text" class="form-control" name="reportRev" placeholder="Enter report reviewer's name:" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Pass or Fail:</label>
                        <select name="sentence" class="form-control" required>
                            <option value="">Select One</option>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Attach Evidence: <small style="color:#888;">(jpeg, mp3, mp4, .xls, doc)</small></label>
                        <input name="attach_evidence" type="file" class="form-control" accept="all">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Any other issues or points to note:</label>
                        <input type="text" name="issues_points" placeholder="Any other issues or points to note" class="form-control">
                    </div>
                </div>

                <div style="display:flex; gap:8px; margin-top:16px;">
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                    <button type="reset" onclick="calibrationForm()" class="am-btn am-btn-outline">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Calibration Due Table --}}
    <div class="am-card">
        <h6 class="dash-section-title" style="padding:16px 16px 0;">Calibration Due</h6>
        <div class="am-table-wrap">
            <table class="am-table">
                <thead>
                    <tr>
                        <th>Equipment ID</th>
                        <th>Equipment Name</th>
                        <th>Serial Number</th>
                        <th>Date Calibrated</th>
                        <th>Date Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 0; @endphp
                    @forelse ($calibration as $data)
                        @php $counter++; @endphp
                        @php $d = strtotime("+$data->freq months", strtotime($data->calibratedDate)); @endphp
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $data->equipment }}</td>
                            <td>{{ $data->serialNum }}</td>
                            <td>{{ date('d/m/Y', strtotime($data->calibratedDate)) }}</td>
                            <td>{{ date("d/m/Y", $d) }}</td>
                            <td>
                                <button class="am-btn am-btn-outline am-btn-sm" title="Edit"
                                    onclick="getEid({{ $data }});">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="am-btn am-btn-outline am-btn-sm" title="View"
                                    onclick="viewRecord({{ json_encode($data) }});">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button data-toggle="modal" data-target="#deleteCalibrat_{{ $data->id }}"
                                    class="am-btn am-btn-danger am-btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>

                                {{-- Per-row delete modal --}}
                                <div class="modal fade" id="deleteCalibrat_{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Deleting Entry</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <strong>{{ $data->equipment }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ url('/calibration_delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">No</button>
                                                    <button type="submit" class="am-btn am-btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="am-empty">
                                    <i class="fa fa-database"></i>
                                    <p>No records found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Total Items Listed Table --}}
    <div class="am-card" style="margin-top:24px;">
        <h6 class="dash-section-title" style="padding:16px 16px 0;">Total Items Listed</h6>
        <div class="am-table-wrap">
            <table class="am-table">
                <thead>
                    <tr>
                        <th>Equipment ID</th>
                        <th>Equipment Name</th>
                        <th>Serial Number</th>
                        <th>Location</th>
                        <th>Test Method</th>
                        <th>Acceptance Criteria</th>
                        <th>Date Calibrated</th>
                        <th>Certificate Number</th>
                        <th>Frequency (M)</th>
                        <th>Reviewer</th>
                        <th>Sentence</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 0; @endphp
                    @forelse ($calibration as $data)
                        @php $counter++; @endphp
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $data->equipment }}</td>
                            <td>{{ $data->serialNum }}</td>
                            <td>{{ $data->locaction }}</td>
                            <td>{{ $data->testMethod }}</td>
                            <td>{{ $data->acceptance }}</td>
                            <td>{{ date('d/m/Y', strtotime($data->calibratedDate)) }}</td>
                            <td>{{ $data->certificatenumber }}</td>
                            <td>{{ $data->freq }}</td>
                            <td>{{ $data->reportRev }}</td>
                            <td>
                                <span class="am-chip {{ $data->sentence == 'Pass' ? 'success' : 'danger' }}">
                                    {{ $data->sentence }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11">
                                <div class="am-empty">
                                    <i class="fa fa-database"></i>
                                    <p>No records found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- View Modal --}}
<div class="modal fade" id="viewCalibration" tabindex="-1" role="dialog" aria-labelledby="viewCalibrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCalibrationLabel">View Calibration Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Equipment Name:</label>
                            <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name:" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Serial Number:</label>
                            <input type="text" class="form-control" name="serialNum" placeholder="Enter Serial Number:" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Location:</label>
                            <input type="text" class="form-control" name="locaction" placeholder="Enter Location:" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Test Method Reference:</label>
                            <input type="text" class="form-control" name="testMethod" placeholder="Enter Test Method Reference:" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Acceptance Criteria:</label>
                            <input type="text" class="form-control" name="acceptance" placeholder="Enter Acceptance Criteria:" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date Calibrated:</label>
                            <input type="date" max="2999-12-31" class="form-control" name="calibratedDate" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Certificate Number:</label>
                            <input type="text" class="form-control" name="certificatenumber" placeholder="Enter Certificate Number:" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Frequency (Months):</label>
                            <input type="number" name="freq" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Report Reviewer:</label>
                            <input type="text" class="form-control" name="reportRev" placeholder="Enter report reviewer's name:" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Pass or Fail:</label>
                            <select name="sentence" class="form-control" readonly>
                                <option value="">Select One</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Attach Evidence <small style="color:#888;">(jpeg, mp3, mp4, .xls, doc)</small>:</label>
                            <div class="evidence_attachemnt_div"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Any other issues or points to note:</label>
                            <input type="text" name="issues_points" placeholder="Any other issues or points to note" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editcustomer_rev" tabindex="-1" role="dialog" aria-labelledby="editcustomer_revLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcustomer_revLabel">Edit Calibration Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('calibrationedit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Equipment Name:</label>
                                <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Serial Number:</label>
                                <input type="text" class="form-control" name="serialNum" placeholder="Enter Serial Number:" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Location:</label>
                                <input type="text" class="form-control" name="locaction" placeholder="Enter Location:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Test Method Reference:</label>
                                <input type="text" class="form-control" name="testMethod" placeholder="Enter Test Method Reference:" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Acceptance Criteria:</label>
                                <input type="text" class="form-control" name="acceptance" placeholder="Enter Acceptance Criteria:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date Calibrated:</label>
                                <input type="date" max="2999-12-31" class="form-control" name="calibratedDate" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Certificate Number:</label>
                                <input type="text" class="form-control" name="certificatenumber" placeholder="Enter Certificate Number:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Frequency (Months):</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="1" max="12" name="freq" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Report Reviewer:</label>
                                <input type="text" class="form-control" name="reportRev" placeholder="Enter Report Reviewer:" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Pass or Fail:</label>
                                <select name="sentence" class="form-control" required id="sentence">
                                    <option value="">Select One</option>
                                    <option value="Pass">Pass</option>
                                    <option value="Fail">Fail</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Attach Evidence: <small style="color:#888;">(jpeg, mp3, mp4, .xls, doc)</small></label>
                                <input name="attach_evidence" type="file" class="form-control" accept="all">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Any other issues or points to note:</label>
                                <input type="text" id="issues_points" name="issues_points" placeholder="Any other issues or points to note" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div style="display:flex; gap:8px; margin-top:8px;">
                        <button type="submit" class="am-btn am-btn-primary">Update</button>
                        <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function getEid(data) {
        console.log(data);
        $("#editproject").val(data.id);
        $("input[name='testMethod']").val(data.testMethod);
        $("input[name='serialNum']").val(data.serialNum);
        $("input[name='issues_points']").val(data.issues_points);
        $("select[name='sentence']").val(data.sentence);
        $("#sentence").val(data.sentence);
        $("#issues_point").val(data.issues_point);
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

    function viewRecord(data) {
        console.log(data);
        $("#editproject").val(data.id);
        $("input[name='testMethod']").val(data.testMethod);
        $("input[name='serialNum']").val(data.serialNum);
        $("input[name='issues_points']").val(data.issues_points);
        $("select[name='sentence']").val(data.sentence);
        $("#sentence").val(data.sentence);
        $("input[name='reportRev']").val(data.reportRev);
        $("input[name='locaction']").val(data.locaction);
        $("input[name='freq']").val(data.freq);
        $("input[name='equipment']").val(data.equipment);
        $("input[name='certificatenumber']").val(data.certificatenumber);
        $("input[name='calibrationid']").val(data.calibrationid);
        $("input[name='calibratedDate']").val(data.calibratedDate);
        $("input[name='acceptance']").val(data.acceptance);
        if (data.attach_evidence) {
            $('.evidence_attachemnt_div').empty().append(`<span class="text-dark">Click to view evidence <a target="_blank" href="${data.attach_evidence}">Here</a></span>`);
        } else {
            $('.evidence_attachemnt_div').empty().append('No data found');
        }
        $("#viewCalibration").modal('show');
    }

    function calibration() {
        if ($(".calibration_from_div").css("display") === "block") {
            $(".calibration_from_div").css("display", "none");
        } else {
            $(".calibration_from_div").css("display", "block");
        }
    }
</script>
