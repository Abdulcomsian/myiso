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
							Add New User
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<a href="/view_user" class="btn btn-clean btn-icon-sm">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							&nbsp;
							
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form class="kt-form kt-form--label-right" method="POST" action="{!! route('users.store') !!}" enctype="multipart/form-data">
					@csrf
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-4">
								<label for="name">Username:</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
								<span class="form-text text-muted">Please enter your Username</span>
							</div>
							<div class="col-lg-4">
								<label for="password">Password</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="text" id="password" name="password" class="form-control" placeholder="Enter password">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
								</div>
							</div>

							<div class="col-lg-4">
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
						<div class="form-group row">

							<div class="col-lg-4">
								<label for="user_image">Company Logo</label>
								<div class="kt-input-icon kt-input-icon--right">
							
									<div id="image-preview">
									  <label for="image-upload" id="image-label">Choose File</label>
									  <input type="file" name="user_image" id="image-upload" />
									</div>
								</div>
								
							</div>
							
						</div>
					</div>

					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									<button type="submit" class="btn btn-primary">Submit</button>
									<button onclick="location.href='/products'" type="reset" class="btn btn-secondary">Cancel</button>
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