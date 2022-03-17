@extends('admin.dashboard.layouts.app')

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
							User Forms
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
				<div class="kt-portlet__body">

					<!--begin: Datatable -->
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						
						<thead>
					<tr class="odd gradeX">
								<th>ID</th>
								<th>Forms and Records</th>
								<th>Actions</th>
							</tr>
							<tr class="odd gradeX">
								
								<td>1</td>
								<td>Requirements Due</td>
								<td>
								<a  href="/requiremntCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
							<tr class="odd gradeX">
								<td>2</td>
								<td>Process Audits</td>

								<td>
									<a  href="/ProcessCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
						<tr class="odd gradeX">
								<td>3</td>
								<td>Interested Parties</td>
								
								<td>
									<a  href="/interested_parties/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details: Interested Parties">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
						<tr class="odd gradeX">
								<td>4</td>
								<td>QMS Audits</td>
								
								<td>
									<a  href="/AuditsCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
							<tr class="odd gradeX">
								<td>5</td>
								<td>Non-Conformities</td>
								
								<td>
									<a  href="/nonConformCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>6</td>
								<td>Customers</td>
								
								<td>
									<a  href="/customerCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>7</td>
								<td>Customer Review</td>
								
								<td>
									<a  href="/customerReviewad/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>8</td>
								<td>Suppliers</td>
								
								<td>
									<a href="/supplierCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>9</td>
								<td>Calibration</td>
								
								<td>
									<a href="/calibrationcheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
							<!--new work for chemical control-->

				<tr class="odd gradeX">
								<td>10</td>
								<td>Employees</td>
								
								<td>
									<a  href="/EmployeCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>11</td>
								<td>Management Reviews</td>
								
								<td>
									<a href="/managementCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>12</td>
								<td>Maintenance Records</td>
								
								<td>
									<a href="/maintainRecCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>13</td>
								<td>Accident Risk Assessments</td>
								
								<td>
									<a href="/AccidentCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
				<tr class="odd gradeX">
								<td>14</td>
								<td>Risk Assessments</td>
								
								<td>
									<a href="/riskAssesmntCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
												<tr class="odd gradeX">
					<td>15</td>
					<td>Chemical Control</td>
					
					<td>
						<a href="/chemicalcheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
							<i class="fa fa-eye"></i>
						</a>
					</td>
				</tr>
				<tr class="odd gradeX">
								<td>16</td>
								<td>Work Instructions</td>
								<td>
									<a  href="/workinstructionCheck/{{ request()->route('id') }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">
										<i class="fa fa-eye"></i>
									</a>
								</td>
							</tr>
								
							
						</thead>
						<tbody>
							
							
						</tbody>
					</table>
					<!--end: Datatable -->
				</div>

				<!--end::Form-->
			</div>

			<!--end::Portlet-->

			
		</div>
	</div>
</div>

<!-- end:: Content -->
@endsection