@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <!--Begin::Dashboard 1-->


    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <h2>Non-Conformities</h2>
        </div>
    </div>
    <section id="procedure_section">
        <div class="row">
            <div class="col-lg-12">
                <p>To add a record, click on the “Add a non-conformity” button. To amend or delete a record, click on
                    the edit or delete icon of the entry that needs to be modified or deleted.</p>
                <div class="procedure_div">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <a onclick="nonConformities()" class="addBtn">ADD A NON-CONFORMITY</a>
                        </div>
                    </div>
                    <div class="non_conformities_from_div">
                        <form action=" {{ route('nonConfromForm') }} " method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Customer ID Number:</label>
                                        {{--- <input type="number" min="1" max="100000" onclick="javascript:getElementById(the_ids.show());" onkeyup="get_customer(this)" class="form-control" name="customer_id" id="customer_id" placeholder="Enter Customer ID Number:">
                            <div id="the_ids" class="selectoption-div" style="display:none;list-style:none;border:1px solid #EEE;overflow:hidden;">
@foreach($customers as $customer)
                                <div id="{{ $customer->idNumber }}" class="option-div">{{ $customer->idNumber }}
                                    </div>
                                    @endforeach
                                </div>
                                <div id="CI_response"></div> ---}}
                                <select onchange="get_customer(this)" class="form-control" name="customerID"
                                    id="customer_id">
                                    <option value="">Enter Customer ID Number:</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> Customer Name:</label>
                            <input type="text" required class="form-control customer_name" name="rootCause"
                                placeholder="Enter Customer Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Fault Description:</label>
                            <input type="text" required class="form-control" name="description"
                                placeholder="Enter Fault Description" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Root Cause:</label>
                            <input type="text" required class="form-control" name="rootCause" placeholder="Enter Root Cause"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Immediate Corrective Action:</label>
                            <input type="text" required class="form-control" name="immediateCorp"
                                placeholder="Enter Immediate Corrective Action" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Action to Prevent Recurrence:</label>
                            <input type="text" required class="form-control" name="actionPrevent"
                                placeholder="Enter action/s to prevent recurrence." required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Effectiveness of Action to Prevent Recurrence:</label>
                            <input type="text" required class="form-control" name="ActionRecurnce"
                                placeholder="Enter details of the effectiveness of action/s to prevent recurrence" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Effectiveness Review Date (MM/DD/YYYY):</label>
                            <input type="date" required max="2999-12-31" class="form-control" name="effectiveDate"
                                placeholder="Enter Prevent Recurrence" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Review performed by:</label>
                            <input type="text" required class="form-control" name="reviewdBy" placeholder="Review performed by"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date when NC was processed (MM/DD/YYYY):</label>
                            <input type="date" required max="2999-12-31" class="form-control" name="dateNcP"
                                placeholder="Enter Prevent Recurrence" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date when NC was received (MM/DD/YYYY):</label>
                            <input type="date" required max="2999-12-31" class="form-control" name="dateNcR"
                                placeholder="Enter a name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Customer Response Expected Time (Days):</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  required class="form-control validate_number" name="CRE"
                                placeholder="Enter number of days" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Product Impact (Yes or No):</label>

                            <select name="PI" class="form-control" required>
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

                <button type="submit" class="submitBtn">SUBMIT</button>
                <button type="reset" onclick="nonConformities()" class="submitBtn"
                    style="margin-right: 7px;">Cancel</button>
                </form>
            </div>
        </div>
        {{-- <div class="procedure_div">
        <div class="requirments_table_div">
            <h4>Total Customers Listed</h4>
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Tel</th>
                            <th>Email</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>58</td>
                            <td>Block Computing</td>
                            <td>Al Quasais, Unit 5, Dubai</td>
                            <td>0971 56 491 5517</td>
                            <td>B.Cmp@gmail.com</td>
                            <td>Mr Ahmed</td>
                        </tr>
                    </tbody>
                </table>
                <!--end: Datatable -->
        </div>

    </div>

</div> --}}
        <div class="procedure_div m-t-20">
            <div class="requirments_table_div">
                <h4>Total Non-Conformities Listed</h4>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
                        <thead>
                            <tr>
                                <th>NCR ID Number</th>
                                <th>Customer ID Number</th> 
                                <th>Customer Name</th> 
                                <th>Fault Description</th>
                                <th>Category</th>
                                <th>Date NCR was Processed.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($customers_nonconform as $data)

                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>  {{$data->customerID }}</td> 
                                    <td>{{ $data->name }}</td> 
                                    <td> {{ $data->description }}</td>
                                    <td> {{ $data->root_cause_category }}</td>

                                    <td>{{ date('d-M-Y', strtotime($data->dateNcR)) }}</td>
                                    <td> <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"
                                            value="{{ $data->customerID }}"
                                            onclick="getEid({{ json_encode($data) }});">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path
                                                            d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
                                                            fill="#5d78ff" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon--></span>
                                            <!--<i class="la la-info"></i>-->
                                        </button>
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"
                                                    onclick="deleteModal({{ json_encode($data) }});"><i
                                                        class="la la-trash"></i>
                                                </button>
                                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"
                                            onclick="EditData({{ json_encode($data) }});"> <i class="la la-edit"></i>
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

<div class="modal fade" id="nonconfirmDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Requirements</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="form-row">
                <div class="col-md-12 p-3">
                    <form>
                        @csrf
                        <input type="hidden" name="id" value="" id="id_feild">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer ID Number:</label>

                                    <select readonly disabled class="form-control" name="customerID"
                                        id="customer_id_{{ $customer->idNumber }}">
                                        <option value="">Enter Customer ID Number:</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label>
                                    <input type="text"  readonly disabled class="form-control customer_name_edit_display"
                                        name="CustomerName" placeholder="Enter Customer Name" id="customer_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fault Description:</label>
                                    <input type="text"  readonly disabled class="form-control" name="customerID"
                                        placeholder="Customer ID">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause:</label>
                                    <input type="text" readonly disabled class="form-control" name="rootCause"
                                        placeholder="Enter Root Cause">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Immediate Corrective Action:</label>
                                    <input type="text" readonly disabled class="form-control" name="immediateCorp"
                                        placeholder="Enter Immediate Corrective Action">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Action to Prevent Recurrence:</label>
                                    <input type="text" readonly disabled class="form-control" name="actionPrevent"
                                        placeholder="Enter Prevent Recurrence">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness of Action to Prevent Recurrence:</label>
                                    <input type="text" readonly disabled class="form-control" name="ActionRecurnce"
                                        placeholder="Enter details of the effectiveness of action/s to prevent recurrence">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness Review Date (MM/DD/YYYY):</label>
                                    <input type="date" required max="2999-12-31" class="form-control" name="effectiveDate"
                                        placeholder="Select Effectiveness Review Date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review Performed By:</label>
                                    <input type="text"  class="form-control" name="reviewdBy"
                                        placeholder="Review performed by">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date when NC was processed (MM/DD/YYYY):</label>
                                    <input type="date"  class="form-control" name="dateNcP"
                                        placeholder="Enter Prevent Recurrence">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Received (MM/DD/YYYY):</label>
                                    <input type="date"  class="form-control" name="dateNcR"
                                        placeholder="Enter a name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Response Expected Time (Days):</label>
                                    <input type="number" readonly disabled class="form-control validate_number"
                                        name="CRE" placeholder="Enter
                    number of days.">
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause Category:</label>
                                    
                                    <input type="text" name="root_cause_category" readonly disabled id="" value=""
                                        class="form-control">

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- edit modal  editConfirm --}}

<div class="modal fade" id="editConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Non-Conformity Details.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="form-row">
                <div class="col-md-12 p-3">
                    <form action="{{ route('editnonConfirm') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="editid">
                        {{-- <div class="form-group">
            <label>Customer ID Number:</label><br>
            <span>Select a customer ID from the table. For an internal non-conformity, select Internal as a Customer. If this is the first internal non-conformity, click here to add a customer called Internal.</span>
            <input type="number"  class="form-control validate_number" name="customerID" placeholder="Enter Customer ID:">
        </div> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer ID Number:</label>
                                    <select readonly  class="form-control" name="customerID"
                                        id="customer_id_{{ $customer->idNumber }}">
                                        <option value="">Enter Customer ID Number:</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label>
                                    <input type="text" readonly disabled class="form-control customer_name_edit_display"
                                        name="CustomerName" placeholder="Enter Customer Name" id="customer_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fault Description:</label>
                                    <input type="text" required class="form-control" name="description"
                                        placeholder="Enter Fault Description" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause:</label>
                                    <input type="text" required class="form-control" name="rootCause"
                                        placeholder="Enter Root Cause" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Immediate Corrective Action:</label>
                                    <input type="text" required class="form-control" name="immediateCorp"
                                        placeholder="Enter Immediate Corrective Action" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Action to Prevent Recurrence:</label>
                                    <input type="text" required class="form-control" name="actionPrevent"
                                        placeholder="Enter effectiveness of action/s to prevent recurrence." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness of Action to Prevent Recurrence:</label>
                                    <input type="text" required class="form-control" name="ActionRecurnce"
                                        placeholder="Enter details of the effectiveness of action/s to prevent recurrence" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness Review Date (MM/DD/YYYY):</label>
                                    <input type="date" required max="2999-12-31" class="form-control" name="effectiveDate"
                                        placeholder="Enter Prevent Recurrence" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review Performed By:</label>
                                    <input type="text"  class="form-control" name="reviewdBy"
                                        placeholder="Review performed by" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date when NC was processed (MM/DD/YYYY):</label>
                                    <input type="date" required max="2999-12-31" class="form-control" name="dateNcP"
                                        placeholder="Date when NC was processed" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Received (MM/DD/YYYY):</label>
                                    <input type="date" required max="2999-12-31" class="form-control" name="dateNcR"
                                        placeholder="Enter a name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Response Expected Time (Days):</label>
                                    <input type="number" required min="1" max="9999" class="form-control validate_number"
                                        name="CRE" placeholder="Enter number of days" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Product Impact (Yes or No):</label>
       
                                        <select name="PI"  class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>   
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>NCR closed (Yes or No):</label>
                                        <select name="NCR_closed"  class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
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
                                    <!--<input type="text" name="root_cause_category" id="" value="" class="form-control"-->
                                    <!--    required>-->

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

	<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Deleting an entry.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this entry?</p>
				</div>
				<div class="modal-footer">
				<form action="{{route('deletenonconfimity')}}" method="POST">
					@csrf
				<input type="hidden" id="re_id" value="" name="id">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-danger">Yes</button>
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

        jQuery.ajax({
            url: "{{ url('/get_customer_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $id,
            },
        }).done(function (response) {
            //let ids = array();
            response2 = JSON.parse(response);

            $this.closest(".row").find(".customer_name").val(response2.name);

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

    function getEid(data) {
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
        $("input[name='CRE']").val(data.CRE);
        
        $("select[name='customerID']").val(data.customerID);

        get_customer_name_by_id(data.customerID, '.customer_name_edit_display');

        $("input[name='dateNcP']").val(data.dateNcP);
        $("input[name='dateNcR']").val(data.dateNcR);
        $("input[name='description']").val(data.description);
        $("input[name='effectiveDate']").val(data.effectiveDate);
        $("input[name='immediateCorp']").val(data.immediateCorp);

        $("input[name='reviewdBy']").val(data.reviewdBy);
        $("input[name='rootCause']").val(data.rootCause);
        $("input[name='actionPrevent']").val(data.actionPrevent);
        $("input[name='root_cause_category']").val(data.root_cause_category);

        $("input[name='rootCause']").val(data.rootCause);

        $("select[name='NCR_closed']").val(data.NCR_closed);
        $("select[name='PI']").val(data.PI);

        $("#nonconfirmDetail").modal('show');

    }

    function EditData(data) {
        console.log(data);
        $("#editid").val(data.noid);
        $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
        $("input[name='CRE']").val(data.CRE);
        
        $("select[name='customerID']").val(data.customerID);

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
        $("input[name='rootCause']").val(data.rootCause);

        $("select[name='NCR_closed']").val(data.NCR_closed);
        $("select[name='PI']").val(data.PI);

        $("#editConfirm").modal('show');

    }

    function deleteModal(data) {
        $("#re_id").val(data.noid);
        $("#deleteRequirment").modal('show');

    }

</script>
