@extends('admin.dashboard.layouts.app')





@section('content')



<!-- begin:: Content -->

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    @if ($message = Session::get('success'))

    <div class="alert alert-light alert-elevate" role="alert">

                <!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->

        <!-- <div class="alert-text">

                DataTables has the ability to read data from virtually any JSON data source that can be obtained by Ajax. This can be done, in its most simple form, by setting the ajax option to the address of the JSON data source.

                See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/data_sources/ajax.html" target="_blank">here</a>.

        </div> -->



        <!-- <div class="alert alert-success"> -->

        <p>{{ $message }}</p>

        <!-- </div> -->

    </div>

    @endif

    <div class="kt-portlet kt-portlet--mobile">

        <div class="kt-portlet__head kt-portlet__head--lg">

            <div class="kt-portlet__head-label">

                <span class="kt-portlet__head-icon">

                    <i class="kt-font-brand flaticon2-line-chart"></i>

                </span>

                <h3 class="kt-portlet__head-title">

                    Users Listin

                </h3>

            </div>

            <div class="kt-portlet__head-toolbar">

                <div class="kt-portlet__head-wrapper">

                    <div class="kt-portlet__head-actions">

                        <div class="dropdown dropdown-inline">

                            {{-- <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" ari                            a-expanded="false">

                            <iclass="la la-downl                                oad"></i> Export

                                     </button>

           <div class="dropdown-menu drop                                            down-menu-right">

                                                <ul class="kt-nav">

                                                    <li class="kt-nav__section kt-nav__section--first">

                                                        <span class="kt-nav__section-text">Choose an option</span>

					</li>

									<li class="kt-nav__item">
                                                        
										<a href="#" class="kt-nav__link">

                                                        <i                                                        class="kt-nav__link-icon la la-print"></i>

                                                        <span class="kt-nav__link-text">Print</span>

										</a>

						</li>

									<li class="kt-nav__item">

                                                        <a href="#" class="kt-nav__link">

                                                        <                                                        i class="kt-nav__link-icon la la-copy"></i>

                                                        <span class="kt-nav__link-text">Copy</span>

										</a>

		</li>

									<li class="kt-nav__item                                                        ">

										<a href="#" class="kt-nav__link">

                                                            <i cl                                                            ass="kt-nav__link-icon la la-file-excel-o"></i>

                                                            <span class="kt-nav__link-text">Excel</span>

										</a>

		</li>

									<li class="kt-nav__item                                                            ">

										<a href="#" class="kt-nav__link">

                                                            <i c                                                            lass="kt-nav__link-icon la la-file-text-o"></i>

                                                            <span class="kt-nav__link-text">CSV</span>

										</a>

		</li>

									<li class="kt-nav__item                                                            ">

										<a href="#" class="kt-nav__link">

                                                            <iclass="kt-nav__link-icon la la-file-pdf-o"></i>

                                                            <span class="kt-nav__link-text">PDF</span>

										</a>

									</li>

	</ul>

</div> -                                                            -}}

						</div>

						&nbsp;

						<a href="/add_user" class="btn btn-                                                                brand btn-elevate btn-icon-sm">

                                            <i class="la la-plus"></i>

                                New Record

                                </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="kt-portlet__body">



                <!--begin: Datatable -->

                <table class="table table-striped- table-bordered table-hover table-sm table-checkable" id="kt_table_user">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Order Number</th>

                            <th>User Name</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Address</th>

                            <th>Company Name</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($users as $item)



                        <tr>

                            <td>{{$item->id}}</td>

                            <td>{{$item->order_number}}</td>

                            <td>{{$item->name}}</td>

                            <td>{{$item->email}}</td>

                            <td>{{$item->phone}}</td>

                            <td>{{$item->company_address}}</td>

                            <td>{{$item->company_name}}</td>

                            <td>

                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Customer" onclick="editDetails({{$item}});">

                                    <span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>

                                </button>

                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="deleteUser({{$item->id}})" title="Delete Customer">

                                    <span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>

                                </button>

                                <a  href="/edit_user/{{$item->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  title="Customer Details">

                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-09-29-132851/theme/html/demo1/dist/../src/media/svg/icons/Text/Dots.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1">

                                        <rect x="14" y="9" width="6" height="6" rx="3" fill="#5d78ff"/>

                                        <rect x="3" y="9" width="6" height="6" rx="3" fill="#5d78ff" fill-opacity="0.7"/>

                                        </g>

                                        </svg><!--end::Svg Icon--></span>

                                </a>

                            </td>

                        </tr>

                        @endforeach



                    </tbody>

                </table>

                <!--end: Datatable -->

            </div>

        </div>

    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Deleting User</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    </button>

                </div>

                <div class="modal-body">

                    <p>Are you sure you want to delete this entry?</p>

                </div>

                <div class="modal-footer">

                    <form action="{{route('deleteuserd')}}" method="POST">

                        @csrf

                        <input type="hidden" name="id" id="userid" value="">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-danger">Yes</button>

                    </form>

                </div>

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

                <form class="kt-form kt-form--label-right" method="POST" action="{{route('updateuserinfo')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">



                        <div class="kt-portlet__body">

                            <input type="hidden" name="id" id="editvalue" value="">

                            <div class="form-group row">

                                <div class="col-lg-4">

                                    <label for="name">Username:</label>

                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" >

                                    <span class="form-text text-muted">Please enter your Username</span>

                                </div>

                                <div class="col-lg-4">

                                    <label for="name">Email Address:</label>

                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" >

                                    <span class="form-text text-muted">Please enter your Email</span>

                                </div>

                                <div class="col-lg-4">

                                    <label for="password">Password:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">

                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>

                                    </div>

                                </div>





                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="name">Person responsible for ISO:</label>
                                    <input type="text" id="person_iso" name="person_iso" class="form-control" placeholder="Iso Person Name" required>
                                    <span class="form-text text-muted">Please enter the Iso Username</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="city">Contact number Iso:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="contact_iso" name="contact_iso" class="form-control" placeholder="Iso Contact number" required>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <label for="password">Email Address Iso :</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="email" id="email_iso" name="email_iso" class="form-control" placeholder="Enter Iso Email" required>
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                                        <span class="form-text text-muted">Please enter the Iso Email</span>

                                    </div>
                                </div>


                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="phone">Country:</label>
                                    <input type="text" id="country" name="country" class="form-control" placeholder="Enter Country">
                                </div>


                            </div>
                            <div class="form-group form-row">

                                <div class="col-lg-12">

                                    <label for="phone">Company Name:</label>

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

                                    <label for="state">Company Phone Number.</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" pattern="\d*" id="phone" name="phone" class="form-control" placeholder="Phone">

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

                                        <input type="file" id="company_profile" name="company_profile" class="form-control" placeholder="Company Profile">

                                        <span class="form-text text-muted" id="downloadlink">

                                            {{-- <a href="uploads/user/5f86bde                                        211a21.pdf">Profile<                                    /a> --}}

					</span>



</                            div>

							<                            /div>

							

						</div>

					<div class="form-group row">

<div class="col-lg-6">

								<label for="addre                                    ss1">Business Scope:</label>

								<div class="kt-input                                        -icon kt-input-icon--right">

                                        <input type="text" id="scope" name="business scopes" class="form-control" placeholder="">

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <label for="address2">Company ID</label>

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

                                            <label for="image-upload" id="image-label"></label>

                                            <input type="file" accept="image/*" name="user_image" id="image-upload" onchange="loadFile(event)"/>

                                            <p><label for="file" style="cursor: pointer;">Attach JPEG file only</label></p>

                                            <p><img id="output" width="200px" height="200px" /></p>

                                        </div>

                                    </div>



                                </div>



                            </div>

                            <div class="form-group row">



                                <div class="col-lg-12">

                                    <label for="user_image">Company Description:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <textarea rows="8" class="form-control" id="Company_overview" name="Company_overview"></textarea>

                                                        <!-- <input type="text" id="Company_overview" name="Company_overview" class="form-control" > -->



                                    </div>



                                </div>

                            </div>

                        </div>







                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-danger">Update</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

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
    </script>



    @endsection

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

        function deleteUser(id){

        var userid = id;
        $("#userid").val(userid);
        $("#deleteUser").modal('show');
        }

        function editDetails(data){

        console.log(data);
        $("#editvalue").val(data.id);
        $("input[name='idnumber']").val(data.idnumber);
        $("input[name='name']").val(data.name);
        $("input[name='email']").val(data.email);
        $("input[name='person_iso']").val(data.persone_iso);
        $("input[name='contact_iso']").val(data.contact_number_iso);
        $("input[name='email_iso']").val(data.emailaddress_iso);
        $("input[name='country']").val(data.country);
        $("input[name='phone']").val(data.phone);
        $("input[name='director']").val(data.director);
        $("input[name='sales_process']").val(data.sales_process);
        $('#downloadlink').html('<a target="_blank" href="isocloud/public/' + data.company_profile + '">View Profile</a>');
        //  $("input[name='company_profile']").val(data.company_profile);

        $("input[name='company_name']").val(data.company_name);
        $("input[name='company_address']").val(data.company_address);
        $("input[name='purchasing_process']").val(data.purchasing_process);
        $("input[name='servicing_process']").val(data.servicing_process);
        $("input[name='competency_process']").val(data.competency_process);
        $("input[name='order_number']").val(data.order_number);
        $("input[name='business scopes']").val(data.scope);
        $("textarea[name='Company_overview']").val(data.Company_overview);
        $("#editModal").modal('show');
        }

    </script>

    <script>

        var loadFile = function(event) {

        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
