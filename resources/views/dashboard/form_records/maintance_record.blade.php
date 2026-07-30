@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Maintenance Records</h2>
            <p>Track and manage equipment and facility maintenance activities</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="maintanceRecordForm()">
                <i class="fa fa-plus"></i> Add Maintenance Record
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="am-card maintance_record_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">New Maintenance Record</h6>
            <p>Carrying out frequent maintenance checks and repairs are necessary to maintain production and service. Maintenance Reviews within the working environment including equipment should be carried out monthly, quarterly, semiannually, or annually depending on the size and nature of the business.</p>
            <form action="{{route('maintain_rec')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <label>Maintenance Record Date (MM/DD/YYYY):</label>
                        <input type="date" max="2999-12-31" class="form-control" name="mrdate" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Maintenance Record Item:</label>
                        <input type="text" class="form-control" placeholder="Enter Object name:" name="mritem" required>
                    </div>
                    <div class="form-col">
                        <label>Maintenance Record Activity:</label>
                        <input type="text" class="form-control" placeholder="Enter Activity:" name="mractivity" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Maintenance Location:</label>
                        <input type="text" class="form-control" placeholder="Enter Location" name="mlocation" required>
                    </div>
                    <div class="form-col">
                        <label>Maintenance Record Observations:</label>
                        <input type="text" class="form-control" placeholder="Enter Observation" name="mrobservation" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Maintenance Record Actions:</label>
                        <input type="text" class="form-control" placeholder="Enter Action Taken" name="mractions" required>
                    </div>
                    <div class="form-col">
                        <label>Maintenance Record Activity Performed By:</label>
                        <input type="text" class="form-control" placeholder="Enter Name of person carrying out maintenance" name="mractivityperofrmby" required>
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
                <div style="margin-top:1rem;">
                    <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    <button type="reset" onclick="maintanceRecordForm()" class="am-btn am-btn-sm am-btn-danger" style="margin-left:8px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Total Records Listed</h6>
            <div class="am-table-wrap">
                <table class="am-table" id="kt_table_agent">
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
                        @php $number = 1; @endphp
                        @forelse ($userinfo as $data)
                            <tr>
                                <td>{{$number}}</td>
                                <td>{{date('d/m/Y', strtotime($data->mrdate))}}</td>
                                <td>{{$data->mritem}}</td>
                                <td>{{$data->mractivity}}</td>
                                <td>{{$data->mlocation}}</td>
                                <td>{{$data->mrobservation}}</td>
                                <td>{{$data->mractions}}</td>
                                <td>{{$data->mractivityperofrmby}}</td>
                                <td>
                                    <button onclick="getEid({{json_encode($data)}});" class="am-btn am-btn-sm am-btn-primary" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button onclick="viewRecord({{json_encode($data)}});" class="am-btn am-btn-sm am-btn-primary" title="View">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    @php
                                        $number++;
                                        $d_id = intval($data->id);
                                    @endphp
                                    <button data-toggle="modal" data-target="#confirm-{{$d_id}}" id="remove_{{$d_id}}" title="Delete" class="am-btn am-btn-sm am-btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="confirm-{{$d_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('delete_m_r')}}" method="post">
                                                    <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this entry?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="{{$d_id}}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
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
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Edit Maintenance Record Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('editmentainance')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date (DD/MM/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="mrdate">
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
                    <div class="row">
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

<!-- View Modal -->
<div class="modal fade" id="viewEpmloyee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">View Maintenance Record Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('editmentainance')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date (DD/MM/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="mrdate" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Item:</label>
                                <input type="text" class="form-control" name="mritem" placeholder="Enter Management Review Meeting:" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity:</label>
                                <input type="text" class="form-control" name="mractivity" placeholder="Enter Review Previous Meeting:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Location:</label>
                                <input type="text" class="form-control" name="mlocation" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Observations:</label>
                                <input type="text" class="form-control" name="mrobservation" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Actions:</label>
                                <input type="text" class="form-control" name="mractions" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity Performed By:</label>
                                <input type="text" class="form-control" name="mractivityperofrmby" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Attach Evidence <span style="color:#666;">(jpeg, mp3, mp4, .xls, doc)</span>:</label>
                                <div class="evidence_attachemnt_div"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Any other issues or points to note?</label>
                                <input type="text" name="any_issues" disabled class="form-control" placeholder="Enter Any other issues:">
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
         $("textarea[name='any_issues']").val(data.any_issues);
    }

    function viewRecord(data){
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
        $("input[name='any_issues']").val(data.any_issues);
        if (data.attach_evidence) {
            $('.evidence_attachemnt_div').empty().append(`<span class="text-dark">Click to view evidence <a target="_blank" href="${data.attach_evidence}">Here</a></span>`);
        } else {
            $('.evidence_attachemnt_div').empty().append('No data found');
        }
         $("#viewEpmloyee").modal('show');
     }
</script>
