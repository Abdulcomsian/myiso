@extends('admin.dashboard.layouts.app')

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
            <p>A Non-Conformity is the failure to meet one or more requirements that are outlined in the quality management system. For example, you received a shipment of untested products from a Supplier, or an employee who failed to take corrective action at the time of an issue.</p>

            <p>To create a non-Conformity, click on the “Add Non-Conformity “button and follow the steps outlining the situation in detail.</p>

                <div class="procedure_div">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <a onclick="nonConformities()" class="addBtn">ADD A NON-CONFORMITY</a>
                        </div>
                    </div>
                    <div class="non_conformities_from_div">
                        <form action="{{ route('nonConfromForm') }}" method="POST">
                            @csrf
                            @php 
                            $urlparam = request()->route()->parameters;
                            @endphp
                            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                            <div class="row" style="margin-top: 6px;">


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Supplier Name:</label>
                                        <input type="text" class="form-control supplier_data" name="supplier_data"
                                            placeholder="Enter Supplier Name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Supplier ID Number:</label>
                                        <select onchange="get_customer(this)" required class="form-control" name="customerID"
                                            id="customer_id">
                                            <option value="" selected="selected" disabled="disabled">Enter Supplier ID Number:</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }}
                                                    {{-- @dd($customer) --}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Customer Name:</label>
                                        <input type="text" class="form-control customer_name" name="CustomerName"
                                            placeholder="Enter Customer Name">
                                   </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Employee who reported NCR</label>
                                        <input type="text" class="form-control Employee_name" name="employee_name"
                                            placeholder="Enter Employee Name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Employee ID Number:</label>
                                        <select onchange="get_employee(this)" required class="form-control" name="employee_id"
                                            id="employee_id">
                                            <option value="" selected="selected" disabled="disabled">Enter Employee ID Number:</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}
                                                    {{-- @dd($customer) --}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                

                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="employeeSelect">Employee Name:</label>
                                        <select class="form-control" name="employee_name" id="employeeSelect">
                                            <option value="">Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                                 --}}


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Root Cause Category:</label>
                                        <select name="root_cause_category" class="form-control">
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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>NCR Description:</label>
                                        <input type="text" class="form-control" name="description"
                                            placeholder="Enter Fault Description">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Root Cause:</label>
                                        <input type="text" class="form-control" name="rootCause"
                                            placeholder="Enter Root Cause">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Immediate Corrective Action:</label>
                                        <input type="text" class="form-control" name="immediateCorp"
                                            placeholder="Enter Immediate Corrective Action">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Action to Prevent Recurrence:</label>
                                        <input type="text" class="form-control" name="actionPrevent" placeholder="Enter action's to prevent recurrence.">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Effectiveness of Action to Prevent Recurrence:</label>
                                        <input type="text" class="form-control" name="ActionRecurnce" placeholder="Enter details of the effectiveness of action/s to prevent recurrence">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Effectiveness Review Date (MM/DD/YYY):</label>
                                        <input type="date" class="form-control" name="effectiveDate"
                                            placeholder="Enter Prevent Recurrence">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Review Performed By:</label>
                                        <input type="text" class="form-control" name="reviewdBy"
                                            placeholder="Enter a name.">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date when NC
                                            was processed (MM/DD/YYY):</label>
                                        <input type="date" class="form-control" name="dateNcP"
                                            placeholder="Enter Prevent Recurrence">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date when NC
                                            was received (MM/DD/YYY):</label>
                                        <input type="date" class="form-control" name="dateNcR"
                                            placeholder="Enter Review Performed">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Customer Response Expected Time (Days):</label>
                                        <input type="number" min="0" class="form-control validate_number" name="CRE"
                                            placeholder="Enter Number of Days">
                                    </div>
                                </div>
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
                            </div>
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>NCR closed (Yes or No):</label>
                                        <select name="NCR_closed" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Supplie Name:</label>
                                        <input type="text" readonly disabled class="form-control customer_name_edit_display"
                                            name="supplier_data" placeholder="Enter Supplie Name" id="customer_name">
                                    </div>
                                </div> --}}

                            </div>

                            

                            <button type="submit" class="submitBtn">SUBMIT</button>
                            <button type="reset" onclick="nonConformities()" class="btn btn-secondary submitBtn" style="margin-right: 7px;">Cancel</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Customers Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
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
                        <a href="/edit_user/{{ $urlparam['userid'] }}" class="btn btn-clean btn-icon-sm mb-2 back_icon" style="float: right;">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                        <h4>Total Non-Conformities Listed</h4>
                        <div class="kt-portlet__body table-responsive">
                            <!--begin: Datatable -->
                            <table class="common_table non_conformities_table table table-striped- table-bordered table-hover table-checkable table-responsive"
                                id="kt_table_agent">
                                <thead>
                                    <tr>
                                        <th>NCR ID Number</th>
                                        <th>Supplier Name</th>
                                        <th>Supplier ID Number</th>
                                        <th>Employee who reported NCR</th> 
                                        <th>Employee ID Number</th> 
                                        <th>NCR Description</th>
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
                                            <td> {{ $data->supplier_data }}</td>
                                            <td> {{ $data->customerID }}</td>
                                            <td>{{ $data->employee_name }}</td> 
                                            <td>{{ $data->employee_id }}</td> 
                                            <td> {{ $data->description }}</td>
                                            <td> {{ $data->root_cause_category }}</td>
                                            <td> {{ $data->dateNcR }}</td>
                                           
                                            <td> <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="view"
                                                    value="{{ $data->customerID }}"
                                                    onclick="getEid({{ json_encode($data) }});"> <i
                                                        class="fa fa-eye"></i>
                                                </button>
                                                
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"
                                                    onclick="removeinfo({{ $data->noid}});">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
                                                </button>
                                                
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"
                                                    onclick="EditData({{ json_encode($data) }});">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) ">
                                            </path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                    </svg>
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
                <h5 class="modal-title" id="exampleModalLabel">View Non-Conformity Details.</h5>
                <div class="row" style="margin-left: 43px;">


                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="form-row">
                <div class="col-md-12 p-3">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier Name:</label>
                                    <input type="text" readonly disabled class="form-control" name="supplier_data"
                                        placeholder="Enter Supplier">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier ID Number:</label>

                                    <select readonly disabled class="form-control" name="customerID"
                                        id="customer_id_">
                                        <option value="">Enter Supplier ID Number:</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label>
                                    <input type="text" readonly disabled class="form-control customer_name_edit_display"
                                        name="CustomerName" placeholder="Enter Customer Name" id="customer_name">
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Employee who reported NCR</label>
                                    <input type="text" readonly disabled class="form-control employee_name_edit_display"
                                        name="employee_name" placeholder="Enter Employee Name" id="employee_name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Employee ID Number:</label>
                                    <select readonly disabled class="form-control" name="employee_id"
                                        id="employee_id">
                                        <option value="">Enter Employee ID Number:</option>
                                        @foreach($employees as $employee)
                                                <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}
                                                    {{-- @dd($customer) --}}
                                                </option>
                                        @endforeach
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NCR Description:</label>
                                    <input type="text" readonly disabled class="form-control" name="description"
                                        placeholder="Enter Fault Description">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause:</label>
                                    <input type="text" readonly disabled class="form-control" name="rootCause"
                                        placeholder="Enter Root Cause">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Immediate Corrective Action:</label>
                                    <input type="text" readonly disabled class="form-control" name="immediateCorp"
                                        placeholder="Enter Immediate Corrective Action">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Action to Prevent Recurrence:</label>
                                    <input type="text" readonly disabled class="form-control" name="actionPrevent"
                                        placeholder="Enter Prevent Recurrence">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness of Action to Prevent Recurrence:</label>
                                    <input type="text" readonly disabled class="form-control" name="ActionRecurnce"
                                        placeholder="Enter details of the effectiveness of action/s to prevent recurrence">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness Review Date (MM/DD/YYY):</label>
                                    <input type="date" class="form-control" name="effectiveDate"
                                        placeholder="Enter Prevent Recurrence">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review Performed By:</label>
                                    <input type="text" readonly disabled class="form-control" name="reviewdBy"
                                        placeholder="Enter Review Performed">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date when NC
                                        was processed (MM/DD/YYY):</label>
                                    <input type="date" readonly disabled class="form-control" name="dateNcP"
                                        placeholder="Enter Prevent Recurrence">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date when NC
                                        was received (MM/DD/YYY):</label>
                                    <input type="date" readonly disabled class="form-control" name="dateNcR"
                                        placeholder="Enter Review Performed">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Response Expected Time (Days):</label>
                                    <input type="number" readonly disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  class="form-control validate_number" name="CRE"
                                        placeholder="Enter Number of Days">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Product Impact (Yes or No):</label>

                                        <select readonly disabled name="PI" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            

                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>NCR closed (Yes or No):</label>
                                        <select name="NCR_closed" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier Name:</label>
                                    <input type="text" readonly disabled class="form-control"
                                        name="Supplier_data" placeholder="Enter Supplier Name" id="supplier_name">
                                </div>
                            </div> --}}
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Non Confirmities</h5>
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
                                    <label>Supplier Name:</label>
                                    <input type="text" readonly class="form-control"
                                        name="supplier_data" placeholder="Enter Supplier Name" id="supplier_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Supplier ID Number:</label>

                                    <select readonly class="form-control" name="customerID"
                                        id="customer_id_">
                                        <option value="">Enter Supplier ID Number:</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label>
                                    <input type="text" readonly disabled class="form-control customer_name_edit_display"
                                        name="CustomerName" placeholder="Enter Customer Name" id="customer_name">
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Employee who reported NCR</label>
                                    <input type="text" readonly disabled class="form-control employee_name_edit_display"
                                        name="employee_name" placeholder="Enter Employee Name" id="employee_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Employee ID Number:</label>

                                    <select readonly class="form-control" name="employee_id"
                                        id="employee_id_">
                                        <option value="">Enter Employee ID Number:</option>
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}
                                            {{-- @dd($customer) --}}
                                        </option>
                                @endforeach
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
                                    <!--<input type="text" name="root_cause_category" id="" value="" class="form-control" required>-->

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NCR Description:</label>
                                    <input type="text" class="form-control" name="description"
                                        placeholder="Enter Fault Description" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Root Cause:</label>
                                    <input type="text" class="form-control" name="rootCause"
                                        placeholder="Enter Root Cause" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Immediate Corrective Action:</label>
                                    <input type="text" class="form-control" name="immediateCorp"
                                        placeholder="Enter Immediate Corrective Action" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Action to Prevent Recurrence:</label>
                                    <input type="text" class="form-control" name="actionPrevent"
                                        placeholder="Enter Prevent Recurrence" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness of Action to Prevent Recurrence:</label>
                                    <input type="text" class="form-control" name="ActionRecurnce"
                                        placeholder="Enter details of the effectiveness of action/s to prevent recurrence" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Effectiveness Review Date (MM/DD/YYY):</label>
                                    <input type="date" class="form-control" name="effectiveDate"
                                        placeholder="Enter Prevent Recurrence" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Review Performed By:</label>
                                    <input type="text" class="form-control" name="reviewdBy"
                                        placeholder="Enter Review Performed" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Processed (MM/DD/YYY):</label>
                                    <input type="date" class="form-control" name="dateNcP"
                                        placeholder="Enter Prevent Recurrence" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date NC Received (MM/DD/YYY):</label>
                                    <input type="date" class="form-control" name="dateNcR"
                                        placeholder="Enter Review Performed" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Response Expected Time (Days):</label>
                                    <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  class="form-control validate_number" name="CRE" placeholder="Enter Number of Days" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Product Impact (Yes or No):</label>
     
                                        <select  name="PI" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>NCR closed (Yes or No):</label>
                                        <select name="NCR_closed"  class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                @php 
                                    $urlparam = request()->route()->parameters;
                                @endphp
								<input type="hidden" name="is_admin" value="admin"/>
								<input type="hidden" name="user_id" id="user_id" value="{{ $urlparam['userid'] }}"/>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                <form action="{{ route('deleteNonConfrm') }}" method="POST">
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
    function get_customer(obj) 
    {
        $this = $(obj);
        $id = $this.val();
        $user_id = document.getElementById('user_id').value;
        console.log($user_id);

        jQuery.ajax({
            url: "{{ url('/get_customer_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $id,
                user_id: $user_id,
            },
        }).done(function (response) {
            // console.log(response);
            response2 = JSON.parse(response);

            $this.closest(".row").find(".customer_name").val(response2.name);

        });

    }


    function get_employee(obj) 
    {
        $this = $(obj);
        $id = $this.val();
        $user_id = document.getElementById('user_id').value;
        console.log($user_id);

        jQuery.ajax({
            url: "{{ url('/get_employee_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $id,
                user_id: $user_id,
            },
        }).done(function (response) 
        {
            // console.log(response);
            response2 = JSON.parse(response);
            $this.closest(".row").find(".employee_name").val(response2.surname);

        });
    }

    function get_customer_name_by_id(the_id, the_class) 
    {
        $user_id = document.getElementById('user_id').value;
        jQuery.ajax({
            url: "{{ url('/get_customer_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: the_id,
                user_id: $user_id,
            },
        }).done(function (response) {
            response2 = JSON.parse(response);
            $(the_class).val(response2.name);
        });
    }


    function get_employee_name_by_id(the_id, the_class) 
    {
        $user_id = document.getElementById('user_id').value;
        jQuery.ajax({
            url: "{{ url('/get_employee_name_by_id') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id: the_id,
                user_id: $user_id,
            },
        }).done(function (response) 
        {
            response2 = JSON.parse(response);
            $(the_class).val(response2.surname);
        });
    }




    function getEid(data) 
    {
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
        $("input[name='CRE']").val(data.CRE);
        // $("input[name='PI']").val(data.PI);
        $("select[name='PI']").val(data.PI);
        $("select[name='customerID']").val(data.customerID);
        $("input[name='CustomerName']").val(data.CustomerName);
        $("select[name='NCR_closed']").val(data.NCR_closed);
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
        $("input[name='supplier_data']").val(data.supplier_data);

        $("select[name='employee_id']").val(data.employee_id);
        get_employee_name_by_id(data.employee_id, '.employee_name_edit_display');
        $("input[name='employee_name']").val(data.employee_name);
        // $("input[name='rootCause']").val(data.rootCause);
        $("#nonconfirmDetail").modal('show');

    }

    function EditData(data) 
    {
        console.log(data);
        $("#editid").val(data.noid);
        $("input[name='ActionRecurnce']").val(data.ActionRecurnce);
        $("input[name='CRE']").val(data.CRE);
       
        $("select[name='customerID']").val(data.customerID);
        $("input[name='CustomerName']").val(data.CustomerName);

        $("select[name='NCR_closed']").val(data.NCR_closed);
        $("select[name='PI']").val(data.PI);
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
        // $("input[name='rootCause']").val(data.rootCause);
        $("input[name='supplier_data']").val(data.supplier_data);

        $("input[name='employee_id']").val(data.employee_id);
        $("input[name='employee_name']").val(data.employee_name);
        get_employee_name_by_id(data.employee_name, '.employee_name_edit_display');
        // get_supplier_name_by_id(data.supplier_data, '.supplier_name_edit_display');
        $("#editConfirm").modal('show');

    }

    function removeinfo(id) 
    {
        $("#re_id").val(id);
        $("#deleteRequirment").modal('show');

    }

</script>
