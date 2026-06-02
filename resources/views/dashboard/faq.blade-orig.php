@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>FAQ's</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
                    	<div class="contact_form">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Name</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Name">
										</div>
                    				</div>
                    				<div class="col-lg-6">
                    					<div class="form-group">
											<label>Company</label><br>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Company">
										</div>
                    				</div>
                    			</div>
                    			
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Email">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Comments</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comments">
										</div>
									</div>
								</div>
								<button onclick="supplierForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
	</section>

	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''