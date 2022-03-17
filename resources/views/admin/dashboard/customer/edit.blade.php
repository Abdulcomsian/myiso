@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Portlet-->
			<div class="kt-portlet">
				<div class="kt-portlet__head kt-portlet__head--lg">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Edit Customer
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<a href="{{ url ('/customer')}}" class="btn btn-clean btn-icon-sm">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							&nbsp;
						</div>
					</div>
				</div>

				@if ($errors->any())
			        <div class="alert alert-danger">
			            <strong>Whoops!</strong> There were some problems with your input.<br><br>
			            <ul>
			                @foreach ($errors->all() as $error)
			                    <li>{{ $error }}</li>
			                @endforeach
			            </ul>
			        </div>
			    @endif
				<!--begin::Form-->
				<form class="kt-form kt-form--label-right" method="POST" action="" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-4">
								<label for="name">Full Name:</label>
								<input type="text" value="" id="name" name="name" class="form-control" placeholder="Enter name">
								<span class="form-text text-muted">Please enter your full name</span>
							</div>
							<div class="col-lg-4">
								<label for="email">Email</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">@</span>
									</div>
									<input type="email" value="" id="email" name="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
								</div>
								<!-- <span class="form-text text-muted">Please enter your email</span> -->
							</div>

							<div class="col-lg-4">
								<label for="phone">Phone</label>
								<input type="text" id="phone" value="" name="phone" class="form-control" placeholder="Enter phone">
								<!-- <span class="form-text text-muted">Please enter your email</span> -->
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label class="">Date Of Birth</label>
								<div class="input-group date">
									<input type="text" name="dob" class="form-control" readonly value="" id="dob" />
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar"></i>
										</span>
									</div>
								</div>
								<!-- <span class="form-text text-muted">Please enter your contact</span> -->
							</div>
							<div class="col-lg-4">
								<label for="state">State</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="state" value="" name="state" class="form-control" placeholder="">
									<!-- <span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span><i class="la la-dollar"></i></span>
									</span> -->
								</div>
								<!-- <span class="form-text text-muted">Please enter fax</span> -->
							</div>
							<div class="col-lg-4">
								<label for="city">City</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="city" name="city" value="" class="form-control" placeholder="">
									<!-- <span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span><i class="la la-dollar"></i></span>
									</span> -->
								</div>
								<!-- <span class="form-text text-muted">Please enter fax</span> -->
							</div>

						</div>
						<div class="form-group row">
							<div class="col-lg-4">
								<label for="zip">ZIP</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="zip" value="" name="zip" class="form-control" placeholder="Enter zip">
									<span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span>
											<i class="la la-bookmark-o"></i>
										</span>
									</span>
								</div>
								<!-- <span class="form-text text-muted">Please enter your postcode</span> -->
							</div>
							<div class="col-lg-4">
								<label for="password">Password</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="password" value="" name="password" class="form-control" placeholder="Enter password">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
								</div>
								<!-- <span class="form-text text-muted">Please enter your postcode</span> -->
							</div>
							<div class="col-lg-4">
								<label class="">User Group:</label>
								<div class="kt-radio-inline">
									<label class="kt-radio kt-radio--solid">
										<input type="radio" name="role_type" checked="true" value="customer"> Customer
										<span></span>
									</label>
								</div>
								<span class="form-text text-muted">Please select user group</span>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<label for="address1">Address 1</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="address1" value="" name="address1" class="form-control" placeholder="Enter address1">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
								</div>
								<!-- <span class="form-text text-muted">Please enter your postcode</span> -->
							</div>
							<div class="col-lg-6">
								<label for="address2">Address 2</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="address2" name="address2" class="form-control" value="" placeholder="Enter address2">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
								</div>
							</div>
							
						</div>
						<div class="form-group row">

							<div class="col-lg-4">
								<label for="user_image">Upload Profile</label>
								<div class="kt-input-icon kt-input-icon--right">
									@if(isset($user->user_image) && !empty($user->user_image))
							        
										<div id="image-preview" style="background-image: url(''); background-size: cover ; background-position: center center;">
							        @else
										<div id="image-preview">

							        @endif
							        
									  <label for="image-upload" id="image-label">Choose File</label>
									  <input type="file" name="user_image" id="image-upload" />
									</div>
								</div>
								
							</div>
							
						</div>
						<hr>
						<div class="kt-portlet__head kt-portlet__head--lg">
							<div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
									<i class="fa fa-sticky-note" aria-hidden="true"></i>
								</span>
								<h3 class="kt-portlet__head-title">
									Edit Cutomer Notes
								</h3>
							</div>
						</div>
						<!--begin: Datatable -->
						<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_customer_plane">
							<thead>
								<tr>
									<th>ID</th>
									<th>Customer Notes</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody id="kt_customer_note_body">
								<tbody>
									<tr>
										<td>1</td>
										<td>Hello World !</td>
										<td>05/05/2020</td>
										<td>
											<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Customer">
				                          		<i class="la la-edit"></i>
				                        	</a>
				                        	<a href="javascript:;" onclick="deletePlane(this)" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Customer">
												<i class="la la-trash"></i>
											</a>
                        				</td>
									</tr>
								</tbody>
							</tbody>
						</table>
						<!--end: Datatable -->
					</div>

					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="reset" onclick="location.href='/users'" class="btn btn-secondary">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>

				<!--end::Form-->
			</div>

			<!--end::Portlet-->

			
		</div>
	</div>
</div>

<!-- end:: Content -->
@endsection