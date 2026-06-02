@extends('admin.dashboard.layouts.app')

@section('content')
    <style>
        tr.New>td {
            color: #000 !important;
            font-weight: 800;
            cursor: pointer;
        }

        tr.New>button {
            color: #FFF !important;
            font-weight: 800;
            cursor: pointer;
        }

        .read {
            font-weight: normal;
            cursor: pointer !important;
        }

        .td-item-inbox {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        @if ($message = Session::get('success'))
            <div class="alert alert-light alert-elevate" role="alert">
                <!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->
                <!-- <div class="alert-text">
           DataTables has the ability to read data from virtually any JSON data source that can be obtained by Ajax. This can be done, in its most simple form, by setting the ajax option to the address of the JSON data source.
           See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/data_sources/ajax.html" target="_blank">here</a>.
          </div> -->

                <!-- <div class="alert alert-success"> -->
                <p>{{ $message }}</p>
                <!-- </div> -->
            </div>
        @endif


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Inbox
                    </h3>

                </div>
                {{-- <div class="procedure_div">
				<div class="row">
					<div class="col-lg-12 text-right">
						<a onclick="requirementFrom()" class="addBtn">Send a Message</a>
					</div>
				</div>
				<div class="requirments_from_div">
		
					<form action="{{route('requiemntform')}}" method="POST">
						 @csrf
						<div class="form-group">
							<label>Requirement:</label>
							<input type="text" name="requirement" class="form-control"  placeholder="Enter Requirement:" required>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Requirement Completion Date of the Activity (DD/MM/YYYY):</label>
									<input type="date" max="2999-12-31" name="completiondate" max="2999-12-31" class="form-control" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Periodicity (Months):</label>
									<input type="number" name="month" id="month" oninput="this.value = Math.abs(this.value)" min="1" max="12" class="form-control" placeholder="Enter Months:" required>
								</div>
							</div>
						</div>
						
						<button type="submit" class="submitBtn">SUBMIT</button>
						<button onclick="requirementFrom()" style="float: right;margin-right: 6px;border: none;background: #646c9a;color: #fff;padding: 8px 47px;border-radius: 5px;" type="reset"> Cancel </button>
					</form>
				</div>
			</div> --}}



                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                {{-- <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-download"></i> Export
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">Choose an option</span>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">Print</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">Copy</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-excel-o"></i>
											<span class="kt-nav__link-text">Excel</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">PDF</span>
										</a>
									</li>
								</ul>
							</div> --}}
                            </div>
                            &nbsp;
                            {{-- <button data-toggle="modal" data-target="#MessageModal"  class="btn btn-brand btn-elevate btn-icon-sm" >
							<i class="la la-plus"></i>
							New Message
						</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive"
                    id="kt_table_user">
                    {{-- <thead>
					<tr>
						<th>No.</th>
						<th>From</th>
						<th>Subject</th>
						<td>Received at</td>
					</tr>
				</thead> --}}
                    <tbody>
                        {{-- @dd($message_info) --}}
                        <?php $count = 0; ?>
							@foreach ($message_info as $item)
                            <tr data-item-id="{{ $item->unique_id }}"
                                data-href="{{ route('individualMessage', ['id' => $item->id]) }}"
                                class="{{ $item->status == 0 ? 'New' : 'read' }}">
                                <td class="td-item-inbox">										
                                   <p class="mb-0">{{ $item->name }}</p>
                                   @php
                                    $lastMessageDate = App\SendNotifications::where('send_to', $item->send_to)->where('send_by', $item->send_by)->orderBy('created_at', 'desc')->first();
                                   @endphp
                                   <p class="mb-0">{{ date('d/m/Y H:i:sA', strtotime($lastMessageDate['created_at'])) }}</p>
                                </td>
                             </tr>                             
							@endforeach					
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function deleteUser(id) {
        var userid = id;
        $("#userid").val(userid);
        $("#deleteUser").modal('show');
    }

    function editDetails(data) {
        console.log(data);
        $("#editvalue").val(data.id);
        $("input[name='idnumber']").val(data.idnumber);
        $("input[name='name']").val(data.name);
        $("input[name='email']").val(data.email);
        $("input[name='phone']").val(data.phone);
        $("input[name='director']").val(data.director);
        $("input[name='sales_process']").val(data.sales_process);
        $("input[name='company_profile']").val(data.company_profile);
        $("input[name='company_name']").val(data.company_name);
        $("input[name='company_address']").val(data.company_address);
        $("input[name='purchasing_process']").val(data.purchasing_process);
        $("input[name='servicing_process']").val(data.servicing_process);
        $("input[name='competency_process']").val(data.competency_process);
        $("input[name='order_number']").val(data.order_number);
        $("input[name='scope']").val(data.scope);
        $("#editModal").modal('show');
    }

    // $(document).ready(function() {
    // 	// Add a click event listener to the table rows with the data-href attribute
    // 	$('tr[data-href]').click(function() {
    // 		var row = $(this);

    // 		// Check if the row has the 'New' class (or any other class that indicates unread status)
    // 		if (row.hasClass('New')) {
    // 			// Remove the 'New' class
    // 			row.removeClass('New');

    // 			// Redirect to the link specified in data-href
    // 			window.location.href = row.attr('data-href');
    // 		}
    // 	});
    // });

    $(document).ready(function() {
        // Add a click event listener to the table rows with the data-href attribute
        $('tr[data-href]').click(function(event) {
            event.preventDefault();
            let row = $(this);
            let isUnread = row.hasClass('New');
            if (isUnread) {
                row.removeClass('New');
            //     var itemID = row.data('item-id');
            //     $.ajax({
            //         type: 'POST',
            //         url: '{{ route('markasread') }}',
            //         data: {
            //             item_id: itemID,
            //             _token: $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function() {
            //             console.log("hello");
            //         },
            //     });
            }
            // Redirect to the link specified in data-href
            window.location.href = row.attr('data-href');
        });
    });
</script>
