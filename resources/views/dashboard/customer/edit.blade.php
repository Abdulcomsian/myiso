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
				                          		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
				                        	</a>
				                        	<a href="javascript:;" onclick="deletePlane(this)" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Customer">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>
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