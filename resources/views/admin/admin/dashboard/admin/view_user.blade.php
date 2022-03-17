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
					Users Listing
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
						<a href="/add_user" class="btn btn-brand btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							New Record
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-sm table-checkable" id="kt_table_user">
				<thead>
					<tr>
						<th>ID</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Company Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $item)
						
						<tr>
							<td>{{$item->id}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->email}}</td>
							<td>{{$item->phone}}</td>
							<td>{{$item->company_address}}</td>
							<td>{{$item->company_name}}</td>
							<td>
								<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Customer" onclick="editDetails({{$item}});">
								  <i class="la la-edit"></i>
								</button>
								<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="deleteUser({{$item->id}})" title="Delete Customer">
									<i class="la la-trash"></i>
								</button>
								<a  href="/edit_user/{{$item->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
									<i class="la la-user"></i>
								</a>
							</td>
						</tr>
					@endforeach
					
				</tbody>
			</table>
			<!--end: Datatable -->
		</div>
	</div>
</div>
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting User</h5>
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
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" method="POST" action="{{route('updateuserinfo')}}" enctype="multipart/form-data">
				@csrf
			<div class="modal-body">
				
					<div class="kt-portlet__body">
						<input type="hidden" name="id" id="editvalue" value="">
						<div class="form-group row">
							<div class="col-lg-4">
								<label for="name">Username:</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
								<span class="form-text text-muted">Please enter your Username</span>
							</div>
							<div class="col-lg-4">
								<label for="name">Email:</label>
								<input type="text" id="name" name="email" class="form-control" placeholder="Enter email">
								<span class="form-text text-muted">Please enter your Email</span>
							</div>
							<div class="col-lg-4">
								<label for="password">Password</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
								</div>
							</div>

							
						</div>
						<div class="form-group form-row">
							<div class="col-lg-12">
								<label for="phone">Company Name</label>
								<input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter Company Name">
								<!-- <span class="form-text text-muted">Please enter your email</span> -->
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label for="phone">Company Address:</label>
								<input type="text" id="company_address" name="company_address" class="form-control" placeholder="Enter Company Address">
							</div>
							<div class="col-lg-4">
								<label for="state">Company Phone:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="number" id="phone" name="phone" class="form-control" placeholder="Phone">
								</div>
							</div>
							<div class="col-lg-4">
								<label for="city">Managing Director:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="director" name="director" class="form-control" placeholder="Managing Director">
								</div>
							</div>

						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label for="zip">Sales Process Owner:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="sales_process" name="sales_process" class="form-control" placeholder="Enter Sales Process">
								</div>
							</div>
							<div class="col-lg-4">
								<label for="password">Purchasing Process Owner:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="purchasing_process" name="purchasing_process" class="form-control" placeholder="Purchasing Process Owner">
								</div>
							</div>
							<div class="col-lg-4">
								<label class="">Servicing of Contract Process Owner:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="servicing_process" name="servicing_process" class="form-control" placeholder="Servicing of Contract Process Owner">
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<label for="address1">Competency Process Owner:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="competency_process" name="competency_process" class="form-control" placeholder="Enter address1">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="address2">Company Profile:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="company_profile" name="company_profile" class="form-control" placeholder="Company Profile">
								</div>
							</div>
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="address1">Scope:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="scope" name="scope" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="address2">Order Number (Just the number - You do not need to include the hash etc:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="number" id="order_number" name="order_number" class="form-control" placeholder="">
								</div>
							</div>
							
						</div>
						{{-- <div class="form-group row">

							<div class="col-lg-4">
								<label for="user_image">Company Logo</label>
								<div class="kt-input-icon kt-input-icon--right">
							
									<div id="image-preview">
									  <label for="image-upload" id="image-label">Choose File</label>
									  <input type="file" name="user_image" id="image-upload" />
									</div>
								</div>
								
							</div>
							
						</div> --}}
					</div>
					
				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
			</div>
		</form>
		</div>
	</div>
</div>


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