@extends('admin.dashboard.layouts.app')
@section('content')


    <!-- begin:: Content -->
    <style>
        .new-file-upload {
            display: block;
            width: 91px;
            height: 34px;
            position: absolute;
            top: 23px;
            font-size: 12px;
            background: #FFF;
            border-radius: 4px;
            border: 1px solid #2E3B9A;
        }

        /* Modern add-user form styling */
        .am-form .form-group.row { margin-bottom: 22px; }
        .am-form label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6c757d;
            margin-bottom: 6px;
            text-align: left !important;
        }
        .am-form .form-group.row > [class*="col-"] { text-align: left; }
        .am-form .form-control {
            border: 1px solid #e2e6ee;
            border-radius: 8px;
            background: #f9fafc;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #212529;
            transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
        }
        .am-form .form-control:focus {
            outline: none;
            background: #fff;
            border-color: #5560C4;
            box-shadow: 0 0 0 3px rgba(46, 59, 154, 0.10);
        }
        .am-form textarea.form-control { min-height: 80px; }
        .am-form input[type="file"].form-control { padding: 8px 12px; background: #fff; }
        .am-section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #2E3B9A;
            margin: 8px 0 18px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eef1f5;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .am-section-title:not(:first-of-type) { margin-top: 30px; }
    </style>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

        {{-- Modern page header --}}
        <div class="am-page-header">
            <div>
                <h2>Add New User</h2>
                <p>Register a new client account with company profile and certifications.</p>
            </div>
            <div>
                <a href="{{ url('/view_user') }}" class="am-btn am-btn-outline">
                    <i class="fa fa-arrow-left"></i> Back to Users
                </a>
            </div>
        </div>

        @if ($message = Session::get('Success') ? Session::get('Success') : Session::get('Error') )
            @php $class = Session::get('Success') ? 'success' :'danger' @endphp
            <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:{{ $class === 'success' ? '#1a8a5c' : '#b83432' }};background:{{ $class === 'success' ? 'rgba(38,194,129,0.08)' : 'rgba(235,77,75,0.08)' }};">
                <i class="fa fa-{{ $class === 'success' ? 'check-circle' : 'exclamation-circle' }}"></i> {{ $message }}
            </div>
        @endif

        {{-- Form card --}}
        <div class="am-card am-form">
            <div class="row" style="margin:0;"><div class="col-lg-12" style="padding:0;">
                <div class="kt-portlet" style="background:transparent;box-shadow:none;border:none;margin:0;">
                    <div class="kt-portlet__head kt-portlet__head--lg" style="display:none;"></div>
                    @php
                        $usertypes = \App\UserType::get();
                    @endphp
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="POST" action="{{route('add_user')}}" id="add_user"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body" style="padding:26px;">
                            <input type="hidden" id="user_type" name="user_type" value="0">

                            <h4 class="am-section-title"><i class="fa fa-key"></i> Account Access</h4>

                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label for="address2">Company ID</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="order_number" name="order_number" class="form-control"
                                               placeholder="Enter Company ID Number" required>
                                        <span id="numbererror" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label for="name">Email Address:</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                           placeholder="Enter email address" required>
                                    <!---<span class="form-text text-muted">Please enter Email Address</span>--->
                                </div>

                                <div class="col-lg-3">
                                    <label for="name">Username:</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           placeholder="Enter Username" required>
                                    <!---<span class="form-text text-muted">Please enter the client's Username</span>---->
                                </div>
                              
                                <div class="col-lg-3">
                                    <label for="password">Password:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="password" id="password" name="password" class="form-control"
                                               placeholder="Enter password" required>
                                        <!--//pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$"-->
                                        <!---<span class="form-text text-muted">Minimum 6 characters, at least 1 number & at least 1 Capital letter</span>--->

                                    </div>
                                </div>
                            </div>

                            <h4 class="am-section-title"><i class="fa fa-building"></i> Company Details</h4>

                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control"
                                           placeholder="Enter Company Name" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="company_address">Company Address:</label>
                                    <textarea id="company_address" name="company_address" class="form-control"
                                              placeholder="Enter Company Address" required></textarea>
                                </div>
                                <div class="col-lg-4">
                                    <label for="phone">Company Phone Number:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="phone" name="phone" class="form-control"
                                               placeholder="Phone" required>
                                        <input type="hidden" name="phonecode" id="phonecode">
                                        <input type="hidden" name="phoneflag" id="phoneflag">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="country">Country:</label>
                                    <input type="text" id="country" name="country" class="form-control"
                                           placeholder="Enter Country" required>
                                </div>

                                <div class="col-lg-6">
                                    <label for="director">Managing Director:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="director" name="director" class="form-control"
                                               placeholder="Enter a Name" required>
                                    </div>

                                </div>
                            </div>

                            <h4 class="am-section-title"><i class="fa fa-user-shield"></i> ISO Contact Person</h4>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="person_iso">Person responsible for ISO</label>
                                    <input type="text" id="person_iso" name="person_iso" class="form-control"
                                           placeholder="Iso Person Name" required>
                                    <!--<span class="form-text text-muted">Please enter the ISO contact person's name</span>-->
                                </div>
                                <div class="col-lg-4">
                                    <label for="contact_iso" style="text-align:left;">Contact number of the person
                                        responsible for ISO:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="contact_iso" name="contact_iso" class="form-control"
                                               placeholder="Enter Contact Number" required>
                                        <input type="hidden" name="isophonecode" id="isophonecode">
                                        <input type="hidden" name="isophoneflag" id="isophoneflag">
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <label for="email_iso text-left" style="text-align:left;">Email Address of the
                                        person responsible for ISO:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="email" id="email_iso" name="email_iso" class="form-control"
                                               placeholder="Enter Email Address" required>
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                        class="la la-bookmark-o"></i></span></span>
                                        <!--<span class="form-text text-muted">Please enter the Iso Email</span>-->

                                    </div>
                                </div>


                            </div>

                            <h4 class="am-section-title"><i class="fa fa-users-cog"></i> Process Owners</h4>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="sales_process">Sales Process Owner</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="sales_process" name="sales_process" class="form-control"
                                               placeholder="Enter a Name." required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="purchasing_process">Purchasing Process Owner:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="purchasing_process" name="purchasing_process"
                                               class="form-control" placeholder="Enter a Name." required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="servicing_process">Servicing of Contract Process Owner:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="servicing_process" name="servicing_process"
                                               class="form-control" placeholder="Enter a Name." required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="address1">Competency Process Owner:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="competency_process" name="competency_process"
                                               class="form-control" placeholder="Enter a Name." required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="address2">Company Profile / Business Overview:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="file" id="company_profile" name="company_profile"
                                               class="form-control" placeholder="Company Profile" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="scope">Business Scope:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <textarea id="scope" name="scope" class="form-control" required></textarea>
                                    </div>
                                </div>


                            </div>

                            {{-- 	<div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="lastlogin">Last login:</label>
                                    <input type="file" id="lastlogin" name="lastlogin" class="form-control" placeholder="" value="" required>
                                </div>
                                <div class="col-lg-4">

                                </div>
                                <div class="col-lg-4">

                                </div>
                            </div>


                                    <div class="form-group form-row">



                            </div>
                            <div class="form-group row">



                    </div>
                             --}}

                            <h4 class="am-section-title"><i class="fa fa-image"></i> Company Description &amp; Logo</h4>

                            <div class="form-group row">

                                <div class="col-lg-9">
                                    <label for="user_image">Company Description</label>
                                    <div class="kt-input-icon kt-input-icon--right">

                                        <textarea id="Company_overview" name="Company_overview" class="form-control"
                                                  placeholder="Enter Company Overview" style="height: 190px;"
                                                  required></textarea>

                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <label for="user_image">Company Logo:</label>
                                    <div class="kt-input-icon kt-input-icon--right">

                                        <div id="image-preview">
                                            <label for="image-upload" id="image-label"></label>

                                            <input type="file" accept="image/*" name="user_image" id="file"
                                                   onchange="loadFile(event)" required>
                                            <p><label for="file" style="cursor: pointer;">Attach JPEG file only</label>
                                            </p>
                                            <p><img id="output" width="200px" height="200px"/></p>
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <h4 class="am-section-title"><i class="fa fa-certificate"></i> ISO Certifications</h4>

                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label for="iso9001_certificate">ISO9001 Certificate</label>
                                    <input type="file" id="iso9001_certificate" accept=".pdf"
                                           name="iso9001_certificate">
                                    <!--<button type="button" class="new-file-upload" onclick="document.getElementById('iso9001_certificate').click()">Attach File</button>-->

                                </div>

                                <div class="col-lg-4">
                                    <label for="iso9001_expirydate">Expiry date:</label>
                                    <div class="input-group">
                                        <input type="text" id="iso9001_expirydate" name="iso9001_expirydate" class="form-control specialInput" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="iso9001_description">Description:</label>
                                    <textarea id="iso9001_description" name="iso9001_description" class="form-control"
                                              placeholder="Description for ISO9001 Certificate"></textarea>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label for="iso14001_certificate">ISO14001 Certificate:</label>
                                    <input type="file" id="iso14001_certificate" accept=".pdf"
                                           name="iso14001_certificate">
                                    <!--<button type="button" class="new-file-upload" onclick="document.getElementById('iso14001_certificate').click()">Attach File</button>-->
                                </div>
                                
                                <div class="col-lg-4">
                                    <label for="iso14001_expirydate">Expiry date:</label>
                                    <div class="input-group">
                                        <input type="text" id="iso14001_expirydate" name="iso14001_expirydate" class="form-control specialInput" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label for="iso14001_description">Description:</label>
                                    <textarea id="iso14001_description" name="iso14001_description" class="form-control"
                                              placeholder="Description for ISO14001 Certificate"></textarea>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label for="iso45001_certificate">ISO45001 Certificate:</label>
                                    <input type="file" id="iso45001_certificate" accept=".pdf"
                                           name="iso45001_certificate">
                                    <!--<button  type="button"  class="new-file-upload" onclick="document.getElementById('iso45001_certificate').click()">Attach File</button>-->
                                </div>
                                
                                <div class="col-lg-4">
                                    <label for="iso45001_expirydate">Expiry date:</label>
                                    <div class="input-group">
                                        <input type="text" id="iso45001_expirydate" name="iso45001_expirydate" class="form-control specialInput" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="iso45001_description">Description:</label>
                                    <textarea id="iso45001_description" name="iso45001_description" class="form-control"
                                              placeholder="Description for ISO45001 Certificate"></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="iso45001_certificate">Audit Report</label>
                                    <input type="file" id="audit_report" accept=".pdf"
                                           name="audit_report">
                                </div>
                                <div class="col-lg-4">
                                    <label for="iso45001_certificate">Audit Comment</label>
                                    <textarea id="audit_comment" name="audit_comment" class="form-control"
                                              placeholder="Audit Comment"></textarea>
                                </div>
                            </div>
                            <h4 class="am-section-title"><i class="fa fa-file-signature"></i> Additional Documents</h4>

                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="iso45001_certificate">QA Certification Agreement</label>
                                    <input type="file" id="qa_certification" accept=".pdf"
                                           name="qa_certification">
                                </div>
                            </div>
                            
                           
                            <div class="kt-portlet__foot" style="background:transparent;border-top:1px solid var(--am-border);padding:18px 22px;display:flex;justify-content:flex-end;gap:10px;">
                                <button type="reset" class="am-btn am-btn-outline" onclick="window.location.href='{{url('/view_user')}}'">
                                    <i class="fa fa-times"></i> Cancel
                                </button>
                                <button type="submit" id="submit" class="am-btn am-btn-primary">
                                    <i class="fa fa-check"></i> Submit
                                </button>
                            </div>

                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->

            </div></div>{{-- /.row --}}
        </div>{{-- /.am-card --}}
    </div>{{-- /.kt-content --}}

    <!-- end:: Content -->

    <script>
        var loadFile = function (event) 
        {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

    <script>
        $(document).ready(function() 
        {
            $('#iso9001_expirydate').datepicker({
                dateFormat: 'mm/dd/yyyy',
                autoclose: true,
                onSelect: function(dateText, inst) {
                    $(inst).val(dateText); // Write the value in the input
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#iso14001_expirydate').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#iso45001_expirydate').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true
            });
        });
    </script>

@endsection
@section('myscript')
	@include('layouts.intlTelInput_scripts')
    <script>
        // $('#add_user').submit(function(event) {

        //     event.preventDefault();



        //     grecaptcha.ready(function() {

        //         grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'add_user'}).then(function(token) {

        //             $('#add_user').prepend('<input type="hidden" name="token" value="' + token + '">');

        //             $('#add_user').unbind('submit').submit();

        //         });;

        //     });

        //     });
        //By assad yaqoob

        var phone_input = document.querySelector("#phone");
		var phone_input_intel = window.intlTelInput(phone_input, {
			separateDialCode: true,
			customPlaceholder: function (
				selectedCountryPlaceholder,
				selectedCountryData
			) {
				return "e.g. " + selectedCountryPlaceholder;
			},
		});

	 	var contact_iso_input = document.querySelector("#contact_iso");
		var contact_iso_input_intel = window.intlTelInput(contact_iso_input, {
			separateDialCode: true,
			customPlaceholder: function (
				selectedCountryPlaceholder,
				selectedCountryData
			) {
				return "e.g. " + selectedCountryPlaceholder;
			},
		});

        $("#order_number").bind('blur', function () {
            number = $("#order_number").val();
            $.ajax({
                method: 'get',
                url: '{{url("/check-order-number")}}',
                data: {number: number},
                success: function (res) {
                    //  console.log(res);
                    if (res == "exists") {
                        $("#order_number").val("");
                        $("#numbererror").html("Company ID is Already taken!");
                        $('#submit').attr('disabled', 'disabled');
                    } else {
                        $("#numbererror").html("");
                        $('#submit').removeAttr('disabled');
                    }
                }
            })
        });

        //By assad yaqoob
        $("form").submit(function () 
        {
            let intel_phone_data = phone_input_intel.getSelectedCountryData();
            let intel_iso_phone_data = contact_iso_input_intel.getSelectedCountryData();

            //For flags
            $("#phonecode").val(intel_phone_data.dialCode);
            $("#isophonecode").val(intel_iso_phone_data.dialCode);

            //For country code
            $("#phoneflag").val(intel_phone_data.iso2);
            $("#isophoneflag").val(intel_iso_phone_data.iso2);
        });
    </script>
@endsection