@extends('admin.dashboard.layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
        integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
        integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
        crossorigin="anonymous"></script>
@section('content')
<!-- begin:: Content -->

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-lg-12">


	    @if(session()->get('message'))
		<div class="row">
            <div class="col-md-12">
	            <div class="alert alert-success alert-dismissible">{{ session()->get('message') }} &nbsp; <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
	        </div>
    	</div>
    	@endif


			<!--begin::Portlet-->
			<div class="kt-portlet">
				<div class="kt-portlet__head kt-portlet__head--lg">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Add Images for Organization Structure
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<a href="{{url('admin')}}" class="btn btn-clean btn-icon-sm">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							&nbsp;
							
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form class="kt-form kt-form--label-right" method="POST" action="{{route('organization-structure')}}" enctype="multipart/form-data">
					@csrf
					<div class="kt-portlet__body">
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="address1">Management Organogram:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="file" id="Organization Image:" name="Organization_Image" class="form-control" placeholder="Enter a Name.">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="address2">Sales Process</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="file" id="Sales_Process" name="Sales_Process" class="form-control" placeholder="Company Profile" >
								</div>
							</div>
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="address1">Purchasing Process:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="file" id="Purchasing_Process" name="Purchasing_Process" class="form-control" placeholder="Enter a Name.">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="address2">Servicing a Contract Process</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="file" id="Servicing_Contract_Process" name="Servicing_Contract_Process" class="form-control" placeholder="Company Profile" >
								</div>
							</div>
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="address1">Competency Process:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="file" id="Competency_Process" name="Competency_Process" class="form-control" placeholder="Enter a Name.">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="address2">Process Interaction:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="file" id="Process_Interaction" name="Process_Interaction" class="form-control" placeholder="Company Profile" >
								</div>
							</div>
							
						</div>

					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
						    
								<div class="row" style="margin-top:20px">
								<div class="col-lg-8">
									<button type="submit" class="btn btn-primary" style="margin-right: -308px;
									margin-top: -39px;
									border-radius: 17px;" >Submit</button>
									
								</div>
								
							</div>
						</div>
					</div>
					
				</form>
				
				<!--end::Form-->
			</div>

			<!--end::Portlet-->

			
		</div>
				<div class="kt-portlet__body">

<div class="table-responsive">

			<!--begin: Datatable -->

			<table class="table table-striped- table-bordered table-hover table-sm table-checkable" id="kt_table_user">

				<thead>

					<tr>

						<!----  style="width:5%">ID</th------->

						<th style="width:15%">Management Organogram</th>

						<th style="width:15%">Sales Process</th>

						<th style="width:15%">Purchasing Process</th>

						<th style="width:15%">Servicing a Contract Process</th>

						<th style="width:15%">Competency Process</th>

						<th style="width:15%">Process Interaction</th>

					</tr>

				</thead>

				<tbody>
                <tr>
                    <!----td>1</td------->
                   <td><img src='{{$images[0]->management_organogram}}' width="100" height="100"></td>
                   <td><img src='{{$images[0]->sales_process}}' width="100" height="100"></td>
                   <td><img src='{{$images[0]->purchasing_process}}' width="100" height="100"></td>
                   <td><img src='{{$images[0]->servicing_contract}}' width="100" height="100"></td>
                   <td><img src='{{$images[0]->competency_process}}' width="100" height="100"></td>
                   <td><img src='{{$images[0]->process_interaction}}' width="100" height="100"></td>
                </tr>
				</tbody>

			</table>
	</div>
			<!--end: Datatable -->

		</div>
	</div>
	
</div>


<!-- end:: Content -->
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        separateDialCode: true,
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });
     var input = document.querySelector("#contact_iso");
    window.intlTelInput(input, {
        separateDialCode: true,
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });
</script>
<script>
	var loadFile = function(event) {
		var image = document.getElementById('output');
		image.src = URL.createObjectURL(event.target.files[0]);
	};
</script>
@endsection
@section('myscript')
        <script>
       $("form").submit(function() {
           var i=1;
           var j=1;
           $('.iti__selected-dial-code').each(function(){
              if(i==1)
              {
                var code=$(this).text();
                $("#isophonecode").val(code);
                
              }else{
                  var code=$(this).text();
                 $("#phonecode").val(code);
              }
              i++;
          });
          $(".iti__selected-flag").each(function(){
              if(j==1)
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#isophoneflag").val(result);
              }
              else
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#phoneflag").val(result);
              }
              j++;
          });
          
  
     });
        </script>
@endsection