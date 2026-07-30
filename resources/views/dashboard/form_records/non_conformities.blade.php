@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Non-Conformities</h2>
            <p>Manage and track minor and major non-conformity records.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="nonConformities()">
                <i class="fa fa-plus"></i> Add a Non-Conformity
            </button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible">{{ session('message') }}</div>
    @endif

    <p>A Non-Conformance occurs when something does not meet the specifications or requirements in some way - in a services, product, process, goods from a supplier, or staff. There are two types of Non-Conformities, Minor &amp; Major. An example of a Minor Non-Conformity could be an invoicing mistake. An example of a Major Non-Conformity could be employees stealing company property.</p>
    <p>To create a non-Conformity, click on the "Add Non-Conformity" button and follow the steps outlining the situation in detail.</p>

    {{-- Add Form --}}
    <div class="am-card non_conformities_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <h6 class="dash-section-title">Non-Conformity Details</h6>
            <form action=" {{ route('nonConfromForm') }} " method="POST">
                @csrf
                <input type="hidden" name="user_id2" id="user_id2" value="{{ $userid }}" />

                <div class="form-row">
                    <div class="form-col">
                        <label>Minor or Major Non-Conformity:</label>
                        <select name="minor_major" class="form-control">
                            <option value="">Select Option</option>
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Supplier Name:</label>
                        <input type="text" class="form-control supplier_name" name="supplier_data"
                            placeholder="Enter Supplier Name (if applicable)">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Supplier ID Number:</label>
                        @if($no_customer==1)
                            <select onchange="get_customer(this)" class="form-control" required name="customerID" id="customer_id">
                                <option value="">Enter Supplier ID Number (If Applicable)</option>
                            </select>
                        @else
                            <select onchange="get_customer(this)" class="form-control" name="customerID" id="customer_id">
                                <option value="">Enter Supplier ID Number:</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->idnumber }}">{{ $customer->idnumber }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-col">
                        <label>Employee who reported NCR:</label>
                        <input type="text" class="form-control employee_name" name="employee_name"
                            placeholder="Enter Employee Name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Employee ID Number:</label>
                        @if($no_customer==1)
                            <select onchange="get_employee(this)" class="form-control" required name="employee_id" id="employee_id">
                                <option value="">Enter Employee ID Number:</option>
                            </select>
                        @else
                            <select onchange="get_employee(this)" class="form-control" name="employee_id" id="employee_id">
                                <option value="">Enter Employee ID Number:</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-col">
                        <label>Root Cause Category:</label>
                        <select name="root_cause_category" class="form-control" required>
                            <option value="Other">Other</option>
                            <option value="Planning">Planning</option>
                            <option value="Production">Production</option>
                            <option value="Non-liable">Non-liable</option>
                            <option value="Training">Training</option>
                            <option value="Management">Management</option>
                            <option value="Human Factor">Human Factor</option>
                        </select>
                    </div>
                </div>

                <h6 class="dash-section-title" style="margin-top:16px;">Description &amp; Cause</h6>
                <div class="form-row">
                    <div class="form-col">
                        <label>NCR Description:</label>
                        <input type="text" required class="form-control" name="description"
                            placeholder="Enter Fault Description">
                    </div>
                    <div class="form-col">
                        <label>Root Cause:</label>
                        <input type="text" required class="form-control" name="rootCause"
                            placeholder="Enter Root Cause">
                    </div>
                </div>

                <h6 class="dash-section-title" style="margin-top:16px;">Corrective Actions</h6>
                <div class="form-row">
                    <div class="form-col">
                        <label>Immediate Corrective Action:</label>
                        <input type="text" required class="form-control" name="immediateCorp"
                            placeholder="Enter Immediate Corrective Action">
                    </div>
                    <div class="form-col">
                        <label>Action to Prevent Recurrence:</label>
                        <input type="text" required class="form-control" name="actionPrevent"
                            placeholder="Enter action/s to prevent recurrence.">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Effectiveness of Action to Prevent Recurrence:</label>
                        <input type="text" required class="form-control" name="ActionRecurnce"
                            placeholder="Enter details of the effectiveness of action/s to prevent recurrence">
                    </div>
                    <div class="form-col">
                        <label>Effectiveness Review Date (MM/DD/YYYY):</label>
                        <input type="date" required max="2999-12-31" class="form-control" name="effectiveDate">
                    </div>
                </div>

                <h6 class="dash-section-title" style="margin-top:16px;">Review &amp; Dates</h6>
                <div class="form-row">
                    <div class="form-col">
                        <label>Review performed by:</label>
                        <input type="text" required class="form-control" name="reviewdBy"
                            placeholder="Review performed by">
                    </div>
                    <div class="form-col">
                        <label>Date when NC was processed (MM/DD/YYYY):</label>
                        <input type="date" required max="2999-12-31" class="form-control" name="dateNcP">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Date when NC was received (MM/DD/YYYY):</label>
                        <input type="date" required max="2999-12-31" class="form-control" name="dateNcR">
                    </div>
                    <div class="form-col">
                        <label>Supplier Response Expected Time (Days):</label>
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            required class="form-control validate_number" name="CRE"
                            placeholder="Enter number of days">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Product Impact (Yes or No):</label>
                        <select name="PI" class="form-control" required>
                            <option value="">Product Impact</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>NCR closed (Yes or No):</label>
                        <select name="NCR_closed" class="form-control">
                            <option value=""></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                <div style="display:flex; gap:8px; margin-top:16px;">
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                    <button type="reset" onclick="nonConformities()" class="am-btn am-btn-outline">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="am-card">
        <h6 class="dash-section-title" style="padding:16px 16px 0;">Total Non-Conformities Listed</h6>
        <div class="am-table-wrap">
            <table class="am-table">
                <thead>
                    <tr>
                        <th>NCR ID</th>
                        <th>Minor / Major</th>
                        <th>Supplier Name</th>
                        <th>Supplier ID</th>
                        <th>Employee Reported</th>
                        <th>Employee ID</th>
                        <th>NCR Description</th>
                        <th>Category</th>
                        <th>Date Processed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse($customers_nonconform as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <span class="am-chip {{ $data->non_confirm_status == 'Major' ? 'danger' : 'info' }}">
                                    {{ $data->non_confirm_status }}
                                </span>
                            </td>
                            <td>{{ $data->supplier_data }}</td>
                            <td>{{ $data->customerID }}</td>
                            <td>{{ $data->employee_name }}</td>
                            <td>{{ $data->employee_id }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->root_cause_category }}</td>
                            <td>{{ $data->dateNcR }}</td>
                            <td>
                                <button class="am-btn am-btn-outline am-btn-sm" title="View"
                                    onclick="getEid({{ json_encode($data) }});">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="am-btn am-btn-outline am-btn-sm" title="Edit"
                                    onclick="EditData({{ json_encode($data) }});">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="am-btn am-btn-danger am-btn-sm" title="Delete"
                                    onclick="deleteModal({{ json_encode($data) }});">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
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
<div class="modal fade" id="nonconfirmDetail" tabindex="-1" role="dialog" aria-labelledby="nonconfirmDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nonconfirmDetailLabel">View Non-Conformity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <input type="hidden" name="id" value="" id="id_feild">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Minor or Major Non-Conformity:</label>
                                <input type="text" class="form-control" name="minor_major" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier Name:</label>
                                <input type="text" class="form-control" name="supplier_data" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier ID Number:</label>
                                @if($no_customer==1)
                                    <select readonly disabled class="form-control" name="customerID">
                                        <option value="">Enter Supplier ID Number:</option>
                                    </select>
                                @else
                                    <select readonly disabled class="form-control" name="customerID">
                                        <option value="">Enter Supplier ID Number:</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->idnumber }}">{{ $customer->idnumber }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee who reported NCR:</label>
                                <input type="text" readonly disabled class="form-control employee_name_edit_display" name="employee_name" id="employee_name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee ID Number:</label>
                                <select readonly disabled class="form-control" name="employee_id" id="employee_id">
                                    <option value="">Enter Employee ID Number:</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Root Cause Category:</label>
                                <input type="text" name="root_cause_category" readonly disabled class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NCR Description:</label>
                                <input type="text" readonly disabled class="form-control" name="description">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Root Cause:</label>
                                <input type="text" readonly disabled class="form-control" name="rootCause">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Action to Prevent Recurrence:</label>
                                <input type="text" readonly disabled class="form-control" name="actionPrevent">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Effectiveness of Action to Prevent Recurrence:</label>
                                <input type="text" readonly disabled class="form-control" name="ActionRecurnce">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Immediate Corrective Action:</label>
                                <input type="text" readonly disabled class="form-control" name="immediateCorp">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Effectiveness Review Date (MM/DD/YYYY):</label>
                                <input type="date" max="2999-12-31" class="form-control" name="effectiveDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Review Performed By:</label>
                                <input type="text" class="form-control" name="reviewdBy">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date when NC was processed (MM/DD/YYYY):</label>
                                <input type="date" class="form-control" name="dateNcP">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date NC Received (MM/DD/YYYY):</label>
                                <input type="date" class="form-control" name="dateNcR">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier Response Expected Time (Days):</label>
                                <input type="number" readonly disabled class="form-control validate_number" name="CRE">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product Impact (Yes or No):</label>
                                <select name="PI" class="form-control" readonly disabled>
                                    <option value="">Product Impact</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NCR closed (Yes or No):</label>
                                <select name="NCR_closed" class="form-control">
                                    <option value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editConfirm" tabindex="-1" role="dialog" aria-labelledby="editConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editConfirmLabel">Edit Non-Conformity Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editnonConfirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="editid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Minor or Major Non-Conformity:</label>
                                <select class="form-control" name="minor_major">
                                    <option value="">Select Option</option>
                                    <option value="Minor">Minor</option>
                                    <option value="Major">Major</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier Name:</label>
                                <input type="text" class="form-control" name="supplier_data" id="supplier_name" placeholder="Enter Supplier Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier ID Number:</label>
                                @if($no_customer==1)
                                    <select readonly disabled class="form-control" required name="customerID">
                                        <option value="">Enter Supplier ID Number:</option>
                                    </select>
                                @else
                                    <select readonly class="form-control" name="customerID">
                                        <option value="">Enter Supplier ID Number:</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->idnumber }}">{{ $customer->idnumber }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee who reported NCR:</label>
                                <input type="text" class="form-control employee_name_edit_display employee_name" name="employee_name" id="employee_name" placeholder="Enter Employee Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee ID Number:</label>
                                @if($no_customer==1)
                                    <select onchange="get_employee(this)" class="form-control" required name="employee_id" id="employee_id">
                                        <option value="">Enter Employee ID Number:</option>
                                    </select>
                                @else
                                    <select onchange="get_employee(this)" class="form-control" name="employee_id" id="employee_id">
                                        <option value="">Enter Employee ID Number:</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Root Cause Category:</label>
                                <select name="root_cause_category" class="form-control" required>
                                    <option value="Other">Other</option>
                                    <option value="Planning">Planning</option>
                                    <option value="Production">Production</option>
                                    <option value="Non-liable">Non-liable</option>
                                    <option value="Training">Training</option>
                                    <option value="Management">Management</option>
                                    <option value="Human Factor">Human Factor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NCR Description:</label>
                                <input type="text" required class="form-control" name="description" placeholder="Enter Fault Description">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Root Cause:</label>
                                <input type="text" required class="form-control" name="rootCause" placeholder="Enter Root Cause">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Immediate Corrective Action:</label>
                                <input type="text" required class="form-control" name="immediateCorp" placeholder="Enter Immediate Corrective Action">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Action to Prevent Recurrence:</label>
                                <input type="text" required class="form-control" name="actionPrevent" placeholder="Enter effectiveness of action/s to prevent recurrence.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Effectiveness of Action to Prevent Recurrence:</label>
                                <input type="text" required class="form-control" name="ActionRecurnce" placeholder="Enter details of the effectiveness of action/s to prevent recurrence">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Effectiveness Review Date (MM/DD/YYYY):</label>
                                <input type="date" required max="2999-12-31" class="form-control" name="effectiveDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Review Performed By:</label>
                                <input type="text" class="form-control" name="reviewdBy" placeholder="Review performed by" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date when NC was processed (MM/DD/YYYY):</label>
                                <input type="date" required max="2999-12-31" class="form-control" name="dateNcP">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date NC Received (MM/DD/YYYY):</label>
                                <input type="date" required max="2999-12-31" class="form-control" name="dateNcR">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier Response Expected Time (Days):</label>
                                <input type="number" required min="1" max="9999" class="form-control validate_number" name="CRE" placeholder="Enter number of days">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product Impact (Yes or No):</label>
                                <select name="PI" class="form-control">
                                    <option value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NCR closed (Yes or No):</label>
                                <select name="NCR_closed" class="form-control">
                                    <option value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:12px 0 0;">
                        <button type="reset" class="am-btn am-btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="am-btn am-btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="deleteRequirmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRequirmentLabel">Deleting an entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('deletenonconfimity') }}" method="POST">
                    @csrf
                    <input type="hidden" id="re_id" value="" name="id">
                    <button type="button" class="am-btn am-btn-outline" data-dismiss="modal">No</button>
                    <button type="submit" class="am-btn am-btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function get_customer(obj) {
        $this = $(obj);
        $id = $this.val();
        $user_id = document.getElementById('user_id2').value;
        jQuery.ajax({
            url: "{{ url('/get_customer_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $id,
                user_id: $user_id,
            },
        }).done(function (response) {
            response2 = JSON.parse(response);
            $this.closest(".form-row").find(".supplier_name").val(response2.name);
        });
    }

    function get_employee(obj) {
        $this = $(obj);
        $id = $this.val();
        $user_id = document.getElementById('user_id2').value;
        jQuery.ajax({
            url: "{{ url('/get_employee_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $id,
                user_id: $user_id,
            },
        }).done(function (response) {
            response2 = JSON.parse(response);
            $this.closest(".form-row").find(".employee_name").val(response2.surname);
        });
    }

    function get_customer_name_by_id(the_id, the_class) {
        jQuery.ajax({
            url: "{{ url('/get_customer_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: the_id,
            },
        }).done(function (response) {
            response2 = JSON.parse(response);
            $(the_class).val(response2.name);
        });
    }

    function get_employee_name_by_id(the_id, the_class) {
        jQuery.ajax({
            url: "{{ url('/get_employee_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: the_id,
                user_id: $user_id,
            },
        }).done(function (response) {
            response2 = JSON.parse(response);
            $(the_class).val(response2.surname);
        });
    }

    function getEid(data) {
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
        $("input[name='CRE']").val(data.CRE);
        $("select[name='customerID']").val(data.customerID);
        $("input[name='CustomerName']").val(data.name);
        get_customer_name_by_id(data.customerID, '.customer_name_edit_display');
        $("input[name='dateNcP']").val(data.dateNcP);
        $("input[name='dateNcR']").val(data.dateNcR);
        $("input[name='description']").val(data.description);
        $("input[name='effectiveDate']").val(data.effectiveDate);
        $("input[name='immediateCorp']").val(data.immediateCorp);
        $("input[name='reviewdBy']").val(data.reviewdBy);
        $("input[name='rootCause']").val(data.rootCause);
        $("input[name='actionPrevent']").val(data.actionPrevent);
        $("input[name='minor_major']").val(data.non_confirm_status);
        $("select[name='PI']").val(data.PI);
        $("select[name='NCR_closed']").val(data.NCR_closed);
        $("input[name='root_cause_category']").val(data.root_cause_category);
        $("input[name='supplier_data']").val(data.supplier_data);
        $("select[name='employee_id']").val(data.employee_id);
        $("input[name='employee_name']").val(data.employee_name);
        $("#nonconfirmDetail").modal('show');
    }

    function EditData(data) {
        console.log(data);
        $("#editid").val(data.noid);
        $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
        $("input[name='CRE']").val(data.CRE);
        $("select[name='customerID']").val(data.customerID);
        $("input[name='CustomerName']").val(data.name);
        get_customer_name_by_id(data.customerID, '.customer_name_edit_display');
        $("input[name='dateNcP']").val(data.dateNcP);
        $("input[name='dateNcR']").val(data.dateNcR);
        $("input[name='description']").val(data.description);
        $("input[name='effectiveDate']").val(data.effectiveDate);
        $("input[name='immediateCorp']").val(data.immediateCorp);
        $("input[name='reviewdBy']").val(data.reviewdBy);
        $("input[name='rootCause']").val(data.rootCause);
        $("input[name='actionPrevent']").val(data.actionPrevent);
        $("select[name='root_cause_category']").val(data.root_cause_category);
        $("select[name='minor_major']").val(data.non_confirm_status);
        $("select[name='NCR_closed']").val(data.NCR_closed);
        $("select[name='PI']").val(data.PI);
        $("input[name='supplier_data']").val(data.supplier_data);
        $("input[name='employee_id']").val(data.employee_id);
        $("input[name='employee_name']").val(data.employee_name);
        $("select[name='employee_id']").val(data.employee_id);
        $("#editConfirm").modal('show');
    }

    function deleteModal(data) {
        $("#re_id").val(data.noid);
        $("#deleteRequirment").modal('show');
    }
</script>
