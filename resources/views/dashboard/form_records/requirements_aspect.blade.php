@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Requirements Due</h2>
            <p>Track recurring requirements and get reminded when they are due.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="requirementFrom()">
                <i class="fa fa-plus"></i> Add a Requirement
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible">{{ session('message') }}</div>
    @endif

    <p>This section can be considered as a diary shown on your MyISOOnline control panel. Simply add items that need to be recalled on a regular basis, such as when management reviews are due, or calibration audits are required.</p>
    <p>To add a requirement, click on the "Add a Requirement" then enter the information you would like to be reminded of and set the reminder date using the calendar.</p>

    {{-- Add Form --}}
    <div class="am-card requirments_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">Add a Requirement</h6>
            <form action="{{ route('requiemntform') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Requirement:</label>
                        <input type="text" name="requirement" class="form-control" placeholder="Enter Requirement:" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Requirement Completion Date of the Activity (DD/MM/YYYY):</label>
                        <input type="date" max="2999-12-31" name="completiondate" class="form-control" required>
                    </div>
                    <div class="form-col">
                        <label>Periodicity (Months):</label>
                        <input type="number" name="month" id="month" oninput="this.value = Math.abs(this.value)" min="1" max="12" class="form-control" placeholder="Enter Months:" required>
                    </div>
                </div>
                <div style="display:flex; gap:8px; margin-top:12px;">
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                    <button type="reset" onclick="requirementFrom()" class="am-btn am-btn-outline">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Requirements</th>
                        <th>Date Completed</th>
                        <th>Periodicity (Months)</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 0; @endphp
                    @forelse ($requirement as $data)
                        @php $counter++; @endphp
                        @php $d = strtotime("+$data->periods months", strtotime($data->completion_date)); @endphp
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $data->requirment_title }}</td>
                            <td>{{ date("d/m/Y", strtotime($data->completion_date)) }}</td>
                            <td>{{ $data->periods }}</td>
                            <td>{{ date("d/m/Y", $d) }}</td>
                            <td>
                                <button class="am-btn am-btn-outline am-btn-sm" title="Edit"
                                    onclick="getEid({{ json_encode($data) }});">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="am-btn am-btn-danger am-btn-sm am-confirm-delete"
                                    data-action="{{ url('deleteRequirement/' . $data->id) }}"
                                    data-type="Requirement"
                                    data-label="{{ $data->requirment_title }}">
                                    <i class="fa fa-trash"></i>
                                </button>
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

</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editRequirment" tabindex="-1" role="dialog" aria-labelledby="editRequirmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRequirmentLabel">Amend a Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updaterequiremnt') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="requirment_id" value="" id="id_feild">
                    <div class="form-group">
                        <label>Requirement:</label>
                        <input type="text" class="form-control" value="" name="requirment_title" placeholder="Enter Requirement:" required>
                    </div>
                    <div class="form-group">
                        <label>Requirement Completion Date of the Activity (DD/MM/YYYY):</label>
                        <input type="date" max="2999-12-31" class="form-control" value="" name="completion_date" required>
                    </div>
                    <div class="form-group">
                        <label>Periodicity (Months):</label>
                        <input type="number" class="form-control" oninput="this.value = Math.abs(this.value)" min="1" max="12" value="" name="periods" placeholder="Enter Months:" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function getEid(data) {
        $("#id_feild").val(data.id);
        $("input[name='periods']").val(data.periods);
        $("input[name='requirment_title']").val(data.requirment_title);
        $("input[name='completion_date']").val(data.completion_date);
        $("#editRequirment").modal('show');
    }

    function deleteModal(data) {
        $("#re_id").val(data.id);
        $("#deleteRequirment").modal('show');
    }
</script>
