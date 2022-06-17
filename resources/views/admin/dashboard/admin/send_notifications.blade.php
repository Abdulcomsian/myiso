@extends('admin.dashboard.layouts.app')

@section('content')

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
					Sent Messages
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
						<button data-toggle="modal" data-target="#MessageModal"  class="btn btn-brand btn-elevate btn-icon-sm" >
							<i class="la la-plus"></i>
							New Message
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_user">
				<thead>
					<tr>
						<th>No.</th>
						<th>To</th>
						<th>Company Name</th>
						<th>Email Address</th>
						<th>Message</th>
						<th>Sent at</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

					<?php $count=0;?>
					@foreach ($adminmessage as $item)
					@if($item->admin_delete ==0)
						<?php $count++; ?>
						<tr>
							<td>{{$count}}</td>
							@php
							 $username=\App\User::where('id',$item->send_to)->first();
							@endphp
							<td>{{$username->name}}</td>

							<td>{{$item->company_name}}</td>
							<td>{{$item->email}}</td>
							<td>
							<a href="#" data-toggle="modal" data-target="#view-notification-{{$item->id}}"> View Message </a>

                                <div class="modal fade" id="view-notification-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                											<div class="modal-dialog" role="document">
                                												<div class="modal-content">
                                													<div class="modal-header">
                                														<h5 class="modal-title" id="exampleModalLabel">Message to {{$item->name}}</h5>
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
                                													<a target="_blank" href="isocloud/public/{{$item->attachement}}">View Attachment</a>
                                													@endif
                                											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                													</div>
                                												</div>
                                											</div>
                                										</div>

							</td>
							<td>{{date("d-M-Y H:i:sA", strtotime($item->notification_created_at) )}}</td>
							<td>
							    <button class="btn btn-danger" data-toggle="modal" data-target="#delete-notification-{{$item->notification_id}}">Delete</button>
							    <div class="modal fade" id="delete-notification-{{$item->notification_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete Notification</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												</button>
											</div>
											<div class="modal-body">
												<p>Do you want to delete this notification?</p>
											</div>
											<form action="{{route('deleteMessage')}}" method="post">
											    @csrf
											  <input type="hidden" name="id" value="{{$item->notification_id}}"/>
											<div class="modal-footer">
									         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
											 <button type="submit" class="btn btn-danger">Delete</button>
											</div>
											</form>
										</div>
									</div>
								</div>
							</td>
						</tr>


					@endif
					@endforeach

				</tbody>
			</table>
			<!--end: Datatable -->
		</div>
	</div>
</div>


<div class="modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="MessageModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="MessageModal">Send Message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right"  action="{{route('sendNotifications')}}" enctype="multipart/form-data" method="POST">
				@csrf
			<div class="modal-body">

					<div class="kt-portlet__body">
						<input type="hidden" name="id" id="editvalue" value="">
						<div class="form-group row">
							<div class="col-lg-8">
								<label for="title">Subject:</label>
								<input type="text" id="title" name="title" class="form-control" placeholder="Please enter Message Subject">
							</div>
                            <div class="col-md-4">
								<label for="attachment">Attachment</label>
								<div class="kt-input-icon kt-input-icon--right">
								<input type="file" name="attachment" class="form-control" id="attachment">
								</div>
							</div>



							<div class="col-lg-12">
								<label for="message">Message:</label>
								<textarea name="message" id="message" cols="20" rows="5" class="form-control" placeholder="Please enter your Message"></textarea>
							</div>


							<div class="col-lg-12">
								<label for="address1">Send to:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<select name="userid[]" id="user" class="form-control" multiple>
										@foreach ($users as $item)
									        <option value="{{$item->id}}">{{$item->name}} </option>
										@endforeach

									</select>
								</div>
							</div>
							<div class="col-lg-2">

								<div class="kt-input-icon kt-input-icon--right">

								</div>
							</div>

						</div>

					</div>



			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-paper-plane"></i>  Send </button>
			</div>

		</form>
		</div>
	</div>
</div>


@endsection
