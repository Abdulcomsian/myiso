@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
<style> .new-file-upload{display: block;width: 91px;height: 34px;position: absolute;top: 23px;font-size: 12px;background: #FFF;border-radius: 4px;border: 1px solid #0d47b3;}.has_file{font-size: 0px !important;position: relative !important;left: -124px !important;top: 25px !important;}</style>
    <!--Begin::Dashboard 1-->
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Your Account Details
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
                    <button onclick="editDetails({{Auth::user()}})" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-edit"></i>
                       Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

	<!--Begin::Section-->
	
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<table class="common_table table table-sm table-striped table-responsive" style="width:100%">
                        <tr>
                            <td style="padding-right:200px;width:270px;">Username</td>
                    
                    <td>{{Auth::user()->name}} </td>
                            
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td>{{Auth::user()->email}} </td>

                            
                        </tr>
                        <tr>
                            <td>Company Name</td>
                            <td>{{Auth::user()->company_name}} </td>

                            
                        </tr>
                        <tr>
                            <td>Company Phone Number</td>
                    <td>{{Auth::user()->phonecode." ".Auth::user()->phone}} </td>
                            
                            
                        </tr>
                        <tr>
                            <td>Managing Director / CEO</td>
                    <td>{{Auth::user()->director}} </td>

  
                        </tr>
                        <tr>
                            <td>Company Profile</td>
                    <td><a href="https://myisoonline.com/public/{{Auth::user()->company_profile}}" target="blank">View Company Profile</a> </td>
                            
                        </tr>
                        <tr>
                            <td>Company Address</td>
                    <td>{{Auth::user()->company_address}} </td>
                            
                        </tr>
                        <tr>
                            <td>Servicing Process Owner</td>
                    <td>{{Auth::user()->servicing_process}} </td>

                        </tr>
                        <tr>
                            <td>Competency Process Owner</td>
                    <td>{{Auth::user()->competency_process}} </td>


                        </tr>
                         <tr>
                            <td>Person responsible for ISO</td>
                            <td>{{Auth::user()->persone_iso}} </td>
                        </tr>
                        <tr>
                            <td>Contact number for ISO</td>
                            <td>{{Auth::user()->iso_phone_code." ".Auth::user()->contact_number_iso}} </td>
                        </tr>
                        <tr>
                            <td>Email Address for ISO</td>
                            <td>{{Auth::user()->emailaddress_iso}} </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{Auth::user()->country}} </td>
                        </tr>
                        <tr>
                            <td>Sales Process Owner</td>
                            <td>{{Auth::user()->sales_process}} </td>
                        </tr>
                        <tr>
                            <td>Purchasing Process Owner</td>
                            <td>{{Auth::user()->purchasing_process}} </td>
                        </tr>
                        <tr>
                            <td>Business Scope</td>
                            <td>{{Auth::user()->scope}} </td>
                        </tr>
                        <tr>
                            <td>Company Overview</td>
                            <td>{{Auth::user()->Company_overview}} </td>
                        </tr>
                    </table>
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
                    <form class="kt-form kt-form--label-right" method="POST" action="{{route('UpdateUserInfo')}}" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        
                            <div class="kt-portlet__body">
                                <input type="hidden" name="id" id="editvalue" value="">
                                <div class="form-group row">
                                     <div class="col-lg-4">
                                        <label for="address2">Company ID:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="number" id="order_number" name="order_number" required class="form-control" placeholder="Enter Company ID Number" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="name">Username:</label>
                                        <input type="text" id="name" required name="name" class="form-control" placeholder="Enter name" readonly>
                                        <!--<span class="form-text text-muted">Please enter your Username</span>-->
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="name">Email Address:</label>
                                        <input type="text" required  id="name" name="email" class="form-control" placeholder="Enter email" readonly>
                                        <!--<span class="form-text text-muted">Please enter your Email Address</span>-->
                                    </div>
                                   
                                </div>
                                    
                               
                                
                                
                        <div class="form-group row">
                             <div class="col-lg-4">
                                <label for="password">Password:</label>
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" readonly>
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                                </div>
                            </div>
                             <div class="col-lg-4">
                                <label for="phone">Company Name:</label>
                                <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter Company Name" readonly>
                                <!-- <span class="form-text text-muted">Please enter your email</span> -->
                            </div>
                             <div class="col-lg-4">
                                <label for="phone">Company Address:</label>
                                <textarea id="company_address" name="company_address"  required class="form-control" placeholder="Enter Company Address" readonly></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                             <div class="col-lg-4">
                                    <label for="state">Company Phone:</label>
                                    <div class="kt-input-icon kt-input-icon--right" id='edit_phone'>
    						</div>
    								<input type="hidden" name="phonecode" id="phonecode">
    							<input type="hidden" name="phoneflag" id="phoneflag">
    						
                            </div>
                            	<div class="col-lg-4">
								<label for="country">Country:</label>
								<input type="text" id="country" name="country"  required class="form-control" placeholder="Enter Country">
							</div>
                            <div class="col-lg-4">
                                <label for="city">Managing Director:</label>
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" id="director"  required name="director" class="form-control" placeholder="Enter a Name">
                                </div>
                            </div>
                        </div>    
                        <div class="form-group row">
                        	<div class="col-lg-4">
								<label for="person_iso">Person Responsible for ISO:</label>
								<input type="text" id="person_iso" name="person_iso" class="form-control" placeholder="Iso Person Name" required>
								<!--<span class="form-text text-muted">Please enter the ISO contact person's name</span>-->
							</div>
							<div class="col-lg-4">
								<label for="contact_iso" style="text-align:left !important">Contact number of the Person Responsible for ISO:</label>
								<div class="kt-input-icon kt-input-icon--right" id='edit_iso'>
									
							</div>
								<input type="hidden" name="isophonecode" id="isophonecode">
									<input type="hidden" name="isophoneflag" id="isophoneflag">
								
							</div>
							<div class="col-lg-4">
								<label style="text-align:left !important;" for="email_iso">Email Address of the Person Responsible for ISO.:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<input type="email" id="email_iso" name="email_iso"   class="form-control" placeholder="Enter Email Address" required>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
								<!--<span class="form-text text-muted">Please enter the email address of ISO contact person</span>-->

								</div>
							</div>
						</div>
						<div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="zip">Sales Process Owner:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text" id="sales_process"  required name="sales_process" class="form-control" placeholder="Enter Sales Process">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="password">Purchasing Process Owner:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text" id="purchasing_process" required  name="purchasing_process" class="form-control" placeholder="Purchasing Process Owner">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Servicing of Contract Process Owner:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text" id="servicing_process" required  name="servicing_process" class="form-control" placeholder="Servicing of Contract Process Owner">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="address1">Competency Process Owner:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text" id="competency_process" required  name="competency_process" class="form-control" placeholder="Enter address1">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="address2">Company Profile: </label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="file" id="company_profile"  name="company_profile" class="form-control" placeholder="Company Profile">
                                            <div class="downloadlink">
                                               <a target="_blank" href="https://myisoonline.com/public/{{Auth::user()->company_profile}}" target="blank">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
								<div class="col-lg-12">
								<label for="scope">Business Scope:</label>
								<div class="kt-input-icon kt-input-icon--right">
									<textarea id="scope" row="6" style="height:200px;"  required name="scope" class="form-control"></textarea>
								</div>
							</div></div>
							
							 <div class="form-group row">
        
                                    <div class="col-lg-8">
                                        <label for="user_image">Company Description</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                     <!--<input type="text" id="Company_overview" name="Company_overview" class="form-control" placeholder="" style="height: 30px;">-->

                                        <textarea rows="4" cols="80" name="Company_overview" required id="Company_overview" class="form-control"  placeholder=""></textarea>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">

								<label for="user_image">Company Logo</label>

								<div class="kt-input-icon kt-input-icon--right">

							

									<div id="image-preview">

									   <label for="image-upload" id="image-label"></label>


									  <!------<input type="file" accept="image/*" name="user_image" id="image-upload" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])>--->
									  <input type="file" accept="image/*" name="user_image" id="image-upload" onchange="loadFile(event)">

									   <p><label for="file" style="cursor: pointer;">Attach JPEG file only</label></p>

									  <p><img id="output" width="200px" height="200px"></p>

									</div>

								</div>

								

							</div>
							</div>
						<div class="form-group row">
							
							<div class="col-lg-4">
								<label for="iso9001_certificate">ISO9001 Certificate:</label>
								<!--<input type="file" id="iso9001_certificate" accept=".pdf" name="iso9001_certificate" >-->
								<span id="view_9001"> </span>&nbsp;
								<!--<a href="#" data-handle="iso9001" class="delete-certificate">Delete</a>-->
								  <!--<button type="button" class="new-file-upload" onclick="document.getElementById('iso9001_certificate').click()">Attach File</button>-->
  
							</div>
							<div class="col-lg-4">
								<label for="iso9001_expirydate">Expiry date:</label>
								<input type="date" readonly id="iso9001_expirydate" max="2999-12-31"  name="iso9001_expirydate" class="form-control" placeholder="Expiry Date" >
							</div>
							<div class="col-lg-4">
								<label for="iso9001_description">Description:</label>
								<textarea id="iso9001_description" readonly name="iso9001_description" class="form-control" placeholder="Description for ISO9001 Certificate" ></textarea>
							</div>					

						</div>
						
						<div class="form-group row">
							
							<div class="col-lg-4">
								<label for="iso14001_certificate">ISO14001 Certificate:</label>
								<!--<input type="file" id="iso14001_certificate" accept=".pdf" name="iso14001_certificate" >-->
								<span id="view_14001"> </span>&nbsp;
								<!--<a href="#" data-handle="iso14001" class="delete-certificate">Delete</a>-->
								  <!--<button type="button" class="new-file-upload" onclick="document.getElementById('iso14001_certificate').click()">Attach File</button>-->
							</div>
							<div class="col-lg-4">
								<label for="iso14001_expirydate">Expiry date:</label>
								<input type="date" readonly id="iso14001_expirydate" max="2999-12-31"  name="iso14001_expirydate" class="form-control" placeholder="Expiry Date" >
							</div>
							<div class="col-lg-4">
								<label for="iso14001_description">Description:</label>
								<textarea id="iso14001_description" readonly name="iso14001_description" class="form-control" placeholder="Description for ISO14001 Certificate" ></textarea>
							</div>					

						</div>
						
						<div class="form-group row">
							
							<div class="col-lg-4">
								<label for="iso45001_certificate">ISO45001 Certificate:</label>
								<!--<input type="file" id="iso45001_certificate" accept=".pdf" name="iso45001_certificate" >-->
								<span id="view_45001"> </span>&nbsp;
								<!--<a href="#" data-handle="iso45001" class="delete-certificate">Delete</a>-->
								  <!--<button  type="button"  class="new-file-upload" onclick="document.getElementById('iso45001_certificate').click()">Attach File</button>-->
							</div>
							<div class="col-lg-4">
								<label for="iso45001_expirydate">Expiry date:</label>
								<input type="date" readonly id="iso45001_expirydate" max="2999-12-31"  name="iso45001_expirydate" class="form-control" placeholder="Expiry Date" >
							</div>
							<div class="col-lg-4">
								<label for="iso45001_description">Description:</label>
								<textarea id="iso45001_description" readonly name="iso45001_description" class="form-control" placeholder="Description for ISO45001 Certificate" ></textarea>
							</div>					

						</div>
                                
                                
                                
                        
                                
        
                                    
                                   
                                    
                                
                               
                                </div> 
                            </div>
                            
                        
        
                    
                     
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                    
                    
                </form>
                </div>
            </div>
        </div>
	</section>

	<!--End::Section-->
</div>

@endsection

<script>
	function deleteUser(id){
		var userid=id;
		$("#userid").val(userid);
		$("#deleteUser").modal('show');
	}
	
</script>
@section('myscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
        integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
        integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
        crossorigin="anonymous"></script>
        <script>
        
        
        $('.delete-certificate').on('click',function(){
    
    let _this = $(this),
    user_id = $('#editvalue').val();
    
     _this.closest('.form-group.row').find('.form-control').val(''); 
     _this.closest('.form-group.row').find('a').remove(); 
    
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        
            let AjaxUrl = "{{ url('/remove_iso')}}";
            $.ajax({
                url: AjaxUrl,
                type: "Post",
                //dataType: "json",
                //async: false,
                data: {'handle':_this.data('handle'), 'user_id': user_id }
            }).done(function (response) {
                console.log(response);
            });
 });
 
 function editDetails(data){
		console.log(data);
		$("#editvalue").val(data.id);
         $("input[name='idnumber']").val(data.idnumber);
		 $("input[name='name']").val(data.name);
		 $("input[name='email']").val(data.email);
		 $('#edit_phone').empty().append(`<input type="text" id="phone" required  name="phone" class="form-control" placeholder="Phone">`);
		 $("input[name='phone']").val(data.phone);
		 $("input[name='director']").val(data.director);
		 $("input[name='sales_process']").val(data.sales_process);
		//  $("input[name='company_profile']").val(data.company_profile);
		 if(data.company_profile!=null){
		 $('#downloadlink').html('<a target="_blank" href="public/' + data.company_profile + '">View Profile</a>');
}

		 $("input[name='company_name']").val(data.company_name);
		 //
		  $("input[name='person_iso']").val(data.persone_iso);
		  	 $('#edit_iso').empty().append(`<input type="text" id="contact_iso"   name="contact_iso" class="form-control" placeholder="Enter Contact Number" required>`);
		  $("input[name='contact_iso']").val(data.contact_number_iso);
		  $("input[name='email_iso']").val(data.emailaddress_iso);
		  $("input[name='country']").val(data.country);
		  //
		 $("#company_address").val(data.company_address);
		 $("input[name='purchasing_process']").val(data.purchasing_process);
		 $("input[name='servicing_process']").val(data.servicing_process);
		 $("input[name='competency_process']").val(data.competency_process);
		 $("input[name='order_number']").val(data.order_number);
		 $("textarea[name='scope']").val(data.scope);
		 //let logo_src = data.profile_image;
		 let logo_src = "https://myisoonline.com/public/"+data.profile_image;
		 $("#output").attr("src", logo_src);
		 $("textarea[name='Company_overview']").val(data.Company_overview);
		 
		 
		 if(data.iso9001_certificate!=null){
		     $('#iso9001_certificate').addClass('has_file');
    $("#view_9001").append( "<a target='_blank' href='https://myisoonline.com/public/"+data.iso9001_certificate+"'>View</a>" );
}
if(data.iso14001_certificate!=null){
    $('#iso14001_certificate').addClass('has_file');
    $("#view_14001").append( "<a target='_blank' href='https://myisoonline.com/public/"+data.iso14001_certificate+"'>View</a>" );
}
if(data.iso45001_certificate!=null){
    $('#iso45001_certificate').addClass('has_file');
    $("#view_45001").append( "<a target='_blank' href='https://myisoonline.com/public/"+data.iso45001_certificate+"'>View</a>" );
}

		 $("input[name='iso9001_expirydate']").val(data.iso9001_expirydate);
		  $("textarea[name='iso9001_description']").val(data.iso9001_description);
		  
		 $("input[name='iso14001_expirydate']").val(data.iso14001_expirydate);
		  $("textarea[name='iso14001_description']").val(data.iso14001_description);

		 $("input[name='iso45001_expirydate']").val(data.iso45001_expirydate);
		  $("textarea[name='iso45001_description']").val(data.iso45001_description);
		  
		  
		    var contact_iso = document.getElementById("contact_iso");

        
        // var input = document.querySelector("#contact_iso");
       window.intlTelInput(contact_iso, {
        separateDialCode: true,
        initialCountry: '{{Auth::user()->iso_phone_flag}}',
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
       });
               var phone = document.getElementById("phone");

    // var input = document.querySelector("#phone");
    window.intlTelInput(phone, {
        separateDialCode: true,
        initialCountry: '{{Auth::user()->phoneflag}}',
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });
    
		  
		 $("#editModal").modal('show');
	}
        
        
      
    
    $("form").submit(function() {
        
           var i=1;
           var j=1;
           $('.iti__selected-dial-code').each(function(){
              if(i==1)
              {
                var code=$(this).text();
                $("#phonecode").val(code);
                
              }else{
                  var code=$(this).text();
                 $("#isophonecode").val(code);
              }
              i++;
          });
          $(".iti__selected-flag").each(function(){
              if(j==1)
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#phoneflag").val(result);
              }
              else
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#isophoneflag").val(result);
              }
              j++;
          });
  
     });

</script>

@endsection