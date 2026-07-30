@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Interested Parties</h2>
            <p>Section 4.2 - Needs and expectations of interested parties.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="processinterestedForm()">
                <i class="fa fa-plus"></i> Add Interested Parties
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible">{{ session('message') }}</div>
    @endif

    <p>Section 4.2 of the ISO9001:2015 standard requires the understanding the needs and expectations of interested parties. This register is a place where these can be documented if you so wish. The Quality Manual in section 4.2.2 defines who the interested parties are.</p>
    <p>To add a record, click on the "Add Interested Parties" button. To amend a record, click on the edit icon of the entry that needs to be modified.</p>

    {{-- Add Form --}}
    <div class="am-card process_interested_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">Add Interested Party</h6>
            <form action="{{ route('interestedform') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Interested Party:</label>
                        <input type="text" name="interestedparty" required class="form-control"
                            placeholder="Enter Interested Parties e.g Customers, Suppliers, Employees:">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Needs and Expectations:</label>
                        <input type="text" name="needs" class="form-control" required
                            placeholder="Enter Need & Expectations:">
                    </div>
                </div>
                <div style="display:flex; gap:8px; margin-top:12px;">
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                    <button type="reset" onclick="processinterestedForm()" class="am-btn am-btn-outline">Cancel</button>
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
                        <th>S-No.</th>
                        <th>Interested Parties</th>
                        <th>Needs and Expectations</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse ($interested as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->interested_party }}</td>
                            <td>{{ $data->needs }}</td>
                            <td>{{ date('d/m/Y h:i', strtotime($data->created_at)) }}</td>
                            <td>
                                <button class="am-btn am-btn-outline am-btn-sm" title="Edit"
                                    onclick="getEid({{ $data }});">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="am-btn am-btn-outline am-btn-sm" title="View"
                                    onclick="viewinterested({{ $data }});">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="am-btn am-btn-danger am-btn-sm" title="Delete"
                                    onclick="deleteModal({{ $data }});">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
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

{{-- Delete Modal --}}
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="deleteRequirmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRequirmentLabel">Deleting Interested Party</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('deleteInterested') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="re_id">
                    <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">No</button>
                    <button type="submit" class="am-btn am-btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editinterestedmodal" tabindex="-1" role="dialog" aria-labelledby="editinterestedmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editinterestedmodalLabel">Edit Interested Party Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('interestedUpdate') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="" id="id_feild" name="id">
                    <div class="form-group">
                        <label>Interested Party:</label>
                        <input type="text" name="interestedparty" required class="form-control"
                            placeholder="Enter Interested Parties e.g Customers, Suppliers, Employees:">
                    </div>
                    <div class="form-group">
                        <label>Needs &amp; Expectations:</label>
                        <input type="text" name="needs" required class="form-control"
                            placeholder="Enter Need & Expectations:">
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

{{-- View Modal --}}
<div class="modal fade" id="viewinterestedparty" tabindex="-1" role="dialog" aria-labelledby="viewinterestedpartyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewinterestedpartyLabel">View Interested Party Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="" id="id_feild_view" name="id">
                    <div class="form-group">
                        <label>Interested Party:</label>
                        <input type="text" name="interestedparty" required
                            placeholder="Enter Interested Parties e.g Customers, Suppliers, Employees:"
                            class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Needs &amp; Expectations:</label>
                        <input type="text" name="needs" required placeholder="Enter Need & Expectations:"
                            class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">Close</button>
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
        $("#editinterestedmodal input[name='interestedparty']").val(data.interested_party);
        $("#editinterestedmodal input[name='needs']").val(data.needs);
        $("#editinterestedmodal").modal('show');
    }

    function viewinterested(data) {
        console.log(data);
        $("#id_feild_view").val(data.id);
        $("#viewinterestedparty input[name='interestedparty']").val(data.interested_party);
        $("#viewinterestedparty input[name='needs']").val(data.needs);
        $("#viewinterestedparty").modal('show');
    }

    function deleteModal(data) {
        $("#re_id").val(data.id);
        $("#deleteRequirment").modal('show');
    }
</script>
