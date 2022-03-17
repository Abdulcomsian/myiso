@extends('dashboard.layouts.app')

@section('content')
<style>tr.New>td {color: #000 !important;font-weight: 800;cursor: pointer;}tr.New>button{color: #FFF !important;font-weight: 800;cursor: pointer;}</style>
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
						{{-- <button data-toggle="modal" data-target="#MessageModal"  class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							New Message
						</button> --}}
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_user">
				<thead>
					<tr>
						<th>ID</th>
						<th>Subject</th>
						<td>Received at</td>
						<th>Message</th>
						
					</tr>
				</thead>
				<tbody>

					<?php $count=0;?>
					@foreach ($message_info as $item)
					
						<?php $count++; ?>
						<tr class="{{($item->status == 0) ? 'New' : ''}}">
							<td>{{$count}}</td>
							<td>{{$item->title}}</td>
							<td>{{$item->created_at}}</td>
							


							<td>
							<a data-id="{{$item->id}}" data-user="user" class="read_it" href="#" data-toggle="modal" data-target="#view-notification-{{$item->id}}"> View Message </a>
								
<div class="modal fade" id="view-notification-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">{{$item->title}}</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														</button>
													</div>
													<div class="modal-body">
														<h5>{{$item->title}}</h5>
														<p>&nbsp;</p>
														<p>{{$item->message}}</p>
													</div>
													<div class="modal-footer">								
													@if ($item->attachement != NULL || $item->attachement)
													<a target="_blank" href="public/{{$item->attachement}}">View Attachment</a> 
													@endif
													
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															
													</div>
												</div>
											</div>
										</div>			
							
							</td>
							
							
						</tr>
					@endforeach
					
				</tbody>
			</table>
			<!--end: Datatable -->
		</div>
	</div>
</div>
{{-- <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
			<form action="{{route('deleteuserd')}}" method="POST">
				@csrf
				<input type="hidden" name="id" id="userid" value="">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div> --}}

{{-- <div class="modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="MessageModal" aria-hidden="true">	
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="MessageModal">Send Message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right"  action="{{route('sendNotifications')}}" method="POST">
				@csrf
			<div class="modal-body">
				
					<div class="kt-portlet__body">
						<input type="hidden" name="id" id="editvalue" value="">
						<div class="form-group row">
							<div class="col-lg-12">
								<label for="title">Title:</label>
								<input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
								<span class="form-text text-muted">Please enter Message title</span>
							</div>
							<div class="col-lg-12">
								<label for="name">Message:</label>
								<textarea name="message" id="message" cols="20" rows="5" class="form-control"></textarea>
								<span class="form-text text-muted">Please enter your Message</span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-8">
								<label for="address1">Send to:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<select name="userid" id="user" class="form-control">
										@foreach ($users as $item)
										
									<option value="{{$item->id}}">{{$item->name}} </option>
											
										@endforeach

									</select>
								</div>
							</div>
							<div class="col-lg-2">
								<label for="address2">Send</label>
								<div class="kt-input-icon kt-input-icon--right">
									<button type="submit" class="btn btn-danger">Yes</button>
								</div>
							</div>
							
						</div>
						
					</div>
					
				

			</div>
		</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			</div>
		
		</div>
	</div>
</div> --}}


@endsection
<script>
	function deleteUser(id){
		var userid=id;
		$("#userid").val(userid);
		$("#deleteUser").modal('show');
	}
	function editDetails(data){
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
</script>