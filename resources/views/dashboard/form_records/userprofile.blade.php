@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Your Account Details</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<table class="table table-sm table-striped">
                        <tr>
                            <td>Name</td>
                    
                    <td>{{Auth::user()->name}} </td>
                            
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{Auth::user()->email}} </td>

                            
                        </tr>
                        <tr>
                            <td>Company Name</td>
                            <td>{{Auth::user()->company_name}} </td>

                            
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                    <td>{{Auth::user()->phone}} </td>
                            
                            
                        </tr>
                        <tr>
                            <td>Director</td>
                    <td>{{Auth::user()->director}} </td>

  
                        </tr>
                        <tr>
                            <td>Company Profile</td>
                    <td>{{Auth::user()->company_profile}} </td>
                            
                        </tr>
                        <tr>
                            <td>Company Address</td>
                    <td>{{Auth::user()->company_address}} </td>
                            
                        </tr>
                        <tr>
                            <td>Servicing Process</td>
                    <td>{{Auth::user()->servicing_process}} </td>

                        </tr>
                        <tr>
                            <td>Competency Process</td>
                    <td>{{Auth::user()->competency_process}} </td>


                        </tr>
                    </table>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''