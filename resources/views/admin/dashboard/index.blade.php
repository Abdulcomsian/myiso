@extends('admin.dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->

							<!--Begin::Section-->
							<div class="row">
								<div class="col-xl-4">

									<!--begin:: Widgets/Activity-->
									<div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
										<div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Welcome to the Admin Panel.
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body kt-portlet__body--fit">
											<div class="kt-widget17">
												<div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #002c60;    border-bottom-left-radius: 0.42rem;border-bottom-right-radius: 0.42rem;">
													<div class="kt-widget17__chart" style="height:250px;">
														
													</div>
												</div>
												<div class="kt-widget17__stats">
													<div class="kt-widget17__items">
													    <a class="customLink" href="{{ url('/add_user') }}">
														<div class="kt-widget17__item newColor textColor">
															<span class="kt-widget17__icon">
																<i style="font-size: 24px" class="fa fa-user-plus text-warning" aria-hidden="true"></i>
															</span>
															<span class="kt-widget17__subtitle text-warning">
																Add User
															</span>
														</div>
														</a>
														 <a class="customLink" href="{{ url('/view_user') }}">
														<div class="kt-widget17__item newColor textColor">
															<span class="kt-widget17__icon">
																<i style="font-size: 24px" class="fa fa-eye text-success" aria-hidden="true"></i> </span>
															<span class="kt-widget17__subtitle text-success">
																View User
															</span>
														</div>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end:: Widgets/Activity-->
								</div>
							</div>

							<!--End::Section-->
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Requirements Due</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
				<form action="" method="POST">
				@csrf
				@method('DELETE')
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="calibrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Calibration Due</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
				<form action="" method="POST">
				@csrf
				@method('DELETE')
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
<!-- end:: Content -->
<style>
	.newColor{
		background: #4580c6 !important;
	}
</style>