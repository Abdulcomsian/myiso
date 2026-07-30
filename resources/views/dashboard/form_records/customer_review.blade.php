@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    @if(session('message'))<div class="alert alert-success">{{ session('message') }}</div>@endif

    <div class="am-page-header">
        <div>
            <h2>Customer Review</h2>
            <p>Customer reviews are a tool to monitor and grade your performance levels provided by your customers.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="customerReview()"><i class="fa fa-plus"></i> Add Customer Review</button>
        </div>
    </div>

    <p>Customer reviews are a tool to monitor and grade your performance levels provided by your customers, this performance indicator can target all areas of contact with the customer. For example: "quality of service or product" "delivery time accuracy" "politeness of our staff" or similar and relivant</p>
    <p>To add a record, click on the "Add Customer Evaluation" button. To amend a record, click on the edit icon of the entry that needs to be modified.</p>

    {{-- Add Customer Review Form --}}
    <div class="am-card customer_review_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <form method="POST" action="{{route('customer_rview')}}" enctype="multipart/form-data">
                @csrf
                <h3 style="margin-bottom:1rem;">Add Customer Review</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label>Customer ID Number:</label>
                        <select class="form-control" name="cus_id" required="required">
                            <option value="" selected disabled>Select Customer Id</option>
                            @foreach($all_customers as $customer)
                            <option value="{{$customer->idNumber}}">{{$customer->idNumber}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Product / Activity / Area being reviewed</label>
                        <input class="form-control" type="text" name="product_activity_area" placeholder="Enter Product / Activity / Area being reviewed">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Quality Score (0-10):</label>
                        <input type="number" min="0" max="10" id="qualityScore" class="form-control" placeholder="Enter Quality Score" name="qualityScore" required="required">
                    </div>
                    <div class="form-col">
                        <label>Price Score (0-10):</label>
                        <input type="number" class="form-control" min="0" max="10" name="priceScore" placeholder="If Applicable" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Delivery Score (0-10):</label>
                        <input type="number" min="0" max="10" class="form-control" name="DScore" required="required" placeholder="Enter Delivery Score">
                    </div>
                    <div class="form-col">
                        <label>Overall Score (0-10):</label>
                        <input type="number" class="form-control" min="0" max="10" name="OveralScore" required="required" placeholder="Enter Overall Score">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Assessment Date (MM/DD/YYYY):</label>
                        <input type="date" class="form-control" max="2999-12-31" name="AssesmentDate" required="required">
                    </div>
                    <div class="form-col">
                        <label>Any Other Issues or points to note?</label>
                        <input type="text" class="form-control" placeholder="Any other issues or point to note?" name="other_issue" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Attach Evidence:</label>
                        <input type="file" class="form-control" name="attach_evidence" required="required">
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button class="am-btn am-btn-primary" type="submit">SUBMIT</button>
                    <button class="am-btn am-btn-secondary" type="reset" onclick="customerReview()" style="margin-left:6px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Customer Reviews Table --}}
    <div class="am-card">
        <div class="am-card__body">
            <h4 style="margin-bottom:1rem;">Customer Review Details</h4>
            <div class="am-table-wrap">
                <table class="am-table common_table">
                    <thead>
                        <tr>
                            <th>Customer Review ID</th>
                            <th>Customer ID Number</th>
                            <th>Customer Name</th>
                            <th>Quality</th>
                            <th>Price</th>
                            <th>Delivery</th>
                            <th>Overall</th>
                            <th>Review Date</th>
                            <th>Other Issues</th>
                            <th>Attached Evidence</th>
                            <th>Product / Activity / Area being reviewed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @forelse ($customers as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->cus_id}}</td>
                            @php
                            $customersName=\App\customers::where('user_id',$userid)->where('idNumber',$data->cus_id)->first();
                            @endphp
                            <td>@if(isset($customersName->name)){{$customersName->name}} @endif</td>
                            <td>{{$data->qualityScore}}</td>
                            <td>{{$data->priceScore}}</td>
                            <td>{{$data->DScore}}</td>
                            <td>{{$data->OveralScore}}</td>
                            <td>{{date('d/m/Y', strtotime($data->AssesmentDate))}}</td>
                            <td>{{$data->other_issues}}</td>
                            <td>
                                @isset($data->attach_evidence)
                                <a href="{{asset('customer_review_evidence/' . $data->attach_evidence)}}" target="_blank">View File</a>
                                @endisset
                            </td>
                            <td>{{$data->product_activity_area}}</td>
                            <td>
                                <button class="am-btn am-btn-sm am-btn-info" onclick="getView({{$data}});" title="View" data-toggle="modal" data-target="#model3"><i class="fa fa-eye"></i></button>
                                <button class="am-btn am-btn-sm am-btn-warning" title="Edit" onclick="getEid({{$data}});"><i class="fa fa-edit"></i></button>
                                <button data-toggle="modal" data-target="#confirm-{{$data->id}}" id="remove_{{$data->id}}" title="Delete" class="am-btn am-btn-sm am-btn-danger"><i class="fa fa-trash"></i></button>

                                {{-- View Modal (shared, inside loop) --}}
                                <div class="modal fade" id="model3" tabindex="-1" role="dialog" aria-labelledby="model3Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                                                <h5 class="modal-title" id="model3Label">Customer Review</h5>
                                                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Customer ID Number:</label>
                                                        <input type="number" class="form-control" required name="cus_id" placeholder="Enter Customer ID:" readonly>
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Product / Activity / Area being reviewed</label>
                                                        <input class="form-control" type="text" name="product_activity_area_id" placeholder="Enter Product / Activity / Area being reviewed" value="" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Quality Score (0-10):</label>
                                                        <input type="number" min="0" max="10" required class="form-control" name="qualityScore">
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Price Score (0-10):</label>
                                                        <input type="number" min="0" max="10" required class="form-control" name="priceScore">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Delivery Score (0-10):</label>
                                                        <input type="number" class="form-control" required min="0" max="10" name="DScore">
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Overall Score (0-10):</label>
                                                        <input type="number" class="form-control" required min="0" max="10" name="OveralScore">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col">
                                                        <label>Assessment Date (MM/DD/YYYY):</label>
                                                        <input type="date" max="2999-12-31" required class="form-control" name="AssesmentDate" required="required">
                                                    </div>
                                                    <div class="form-col">
                                                        <label>Any Other Issues or points to note?</label>
                                                        <input type="text" required class="form-control" placeholder="Any Other Issues or points to note?" name="other_issue" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-col" style="flex:1 1 100%;">
                                                        <label>Attach Evidence:</label>
                                                        <input type="hidden" id="assetUrl" value="{{ asset('customer_review_evidence/') }}">
                                                        <a href="" name="attach_evidence">View Attached Evidence</a>
                                                    </div>
                                                </div>
                                                <div style="margin-top:1rem;">
                                                    <button class="am-btn am-btn-secondary" type="reset" data-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Delete Modal --}}
                                <div class="modal fade modal-mini modal-primary" id="confirm-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{route('delete_customer_review')}}" method="post">
                                                <div class="modal-header" style="background:var(--am-primary);color:#fff;justify-content:center;">
                                                    @csrf
                                                    <div class="modal-profile">Deleting Customer Review Details</div>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Are you sure you want to remove this?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="am-btn am-btn-danger">Yes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="12"><div class="am-empty"><i class="fa fa-database"></i><p>No records found.</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Edit Customer Review Modal --}}
<div class="modal fade" id="editcustomer_rev" tabindex="-1" role="dialog" aria-labelledby="editCustRevLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="editCustRevLabel">Edit Customer Evaluation Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('editCustomerReview')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="editid">
                    <div class="form-row">
                        <div class="form-col">
                            <label>Customer ID Number:</label>
                            <select class="form-control" name="cus_id" required="required">
                                <option value="" selected disabled>Select Customer Id</option>
                                @foreach($all_customers as $customer)
                                <option value="{{$customer->idNumber}}">{{$customer->idNumber}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-col">
                            <label>Product / Activity / Area being reviewed</label>
                            <input class="form-control" type="text" name="product_activity_area_edit" placeholder="Enter Product / Activity / Area being reviewed">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Quality Score (0-10):</label>
                            <input type="number" min="0" max="10" required class="form-control" name="qualityScore">
                        </div>
                        <div class="form-col">
                            <label>Price Score (0-10):</label>
                            <input type="number" min="0" max="10" required class="form-control" name="priceScore">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Delivery Score (0-10):</label>
                            <input type="number" class="form-control" required min="0" max="10" name="DScore">
                        </div>
                        <div class="form-col">
                            <label>Overall Score (0-10):</label>
                            <input type="number" class="form-control" required min="0" max="10" name="OveralScore">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Assessment Date (MM/DD/YYYY):</label>
                            <input type="date" max="2999-12-31" required class="form-control" name="AssesmentDate" required="required">
                        </div>
                        <div class="form-col">
                            <label>Any Other Issues or points to note?</label>
                            <input type="text" required class="form-control" placeholder="Any Other Issues or points to note?" name="other_issue" required="required">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Attach Evidence:</label>
                            <input type="file" class="form-control" name="attach_evidence" required="required">
                        </div>
                    </div>
                    <div style="margin-top:1rem;">
                        <button class="am-btn am-btn-primary" type="submit">Update</button>
                        <button class="am-btn am-btn-secondary" type="reset" data-dismiss="modal" aria-label="Close" style="margin-left:6px;">Cancel</button>
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

        $("#editid").val(data.id);
        $("input[name='AssesmentDate']").val(data.AssesmentDate);
        $("input[name='DScore']").val(data.DScore);
        $("input[name='OveralScore']").val(data.OveralScore);
        $("select[name='cus_id']").val(data.cus_id);
        $("input[name='priceScore']").val(data.priceScore); // product_activity_area_edit
        $("input[name='qualityScore']").val(data.qualityScore);
        $("input[name='product_activity_area_edit']").val(data.product_activity_area);
        $("input[name='revnumber']").val(data.revnumber);
        $("input[name='qualityScore']").val(data.qualityScore);
        $("input[name='other_issue']").val(data.other_issues);
        $("#editcustomer_rev").modal('show');
    }

	function getView(data){
		console.log(data);
        $("input[name='AssesmentDate']").val(data.AssesmentDate);
        $("input[name='DScore']").val(data.DScore);
        $("input[name='OveralScore']").val(data.OveralScore);
        $("input[name='cus_id']").val(data.cus_id);
        $("input[name='product_activity_area_id']").val(data.product_activity_area);
        $("input[name='priceScore']").val(data.priceScore);
        $("input[name='qualityScore']").val(data.qualityScore);
        $("input[name='revnumber']").val(data.revnumber);
        $("input[name='qualityScore']").val(data.qualityScore);
        $("input[name='other_issue']").val(data.other_issues);

		var assetUrl = $("#assetUrl").val();
    	$("a[name='attach_evidence']").attr("href", assetUrl + "/" + data.attach_evidence);
        // $("#editcustomer_rev").modal('show');
	}
</script>
