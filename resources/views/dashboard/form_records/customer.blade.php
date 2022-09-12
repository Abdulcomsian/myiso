@extends('dashboard.layouts.app')

@section('content')
    <!-- begin:: Content -->
    <style>#procedure_section .procedure_div ul li::before{display:none !important;}</style>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--Begin::Dashboard 1-->


        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <h2>Customers</h2>
            </div>
        </div>
        <section id="procedure_section">

            <div class="row">
                <div class="col-lg-12">
                    <p>To add a record, click on the “Add
                        Customer” button. To amend a record, click on the edit icon of the
                        entry that needs to be modified.</p>
                    @if(Session::has('Error'))<h5 class="text-danger">  {{ Session::get('Error') }} </h5>@endif
                    <div class="procedure_div">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <a onclick="customerForm()" class="addBtn">ADD CUSTOMER</a>
                            </div>
                        </div>
                        <div class="customer_from_div">
                            <form action="{{route('customerform')}} " id="addcust" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3> Add Customer:</h3>
                                    </div>
                                    <!--	<div class="form-group">-->
                                    <!--		<label>Add Customer Details</label>-->
                                    <!--		<input type="text" class="form-control" name="address" placeholder="Enter Add Customer Details.">-->
                                    <!--	</div>-->
                                    <!--</div>-->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer ID
                                                Number:</label>
                                            <input type="number" min="1" max="100000" required class="form-control validate_number" name="idNumber" id="idNumber" placeholder="Enter Customer ID Number.">
                                            <span id="numbererror" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Name:</label><br>
                                            <input type="text" class="form-control" required name="name" id="name" placeholder="Enter Customer Name:">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <!--          				{{-- <div class="col-lg-6">-->
          <!--          					<div class="form-group">-->
										<!--	<label>ID Number:</label><br>-->
										<!--	<input type="number" class="form-control" name="idNumber" placeholder="Enter ID:">-->
										<!--</div>-->
          <!--          				</div> --}}-->

                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Business Address:</label>
                                            <input type="text" class="form-control" required name="address" placeholder="Enter customer’s full business address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Telephone:</label>
                                            <input type="text" class="form-control" required name="create_phone_number" id="phoneNumber" pattern="\d*" placeholder="Enter customer phone number starting with the country code.">
                                            <input type="hidden" name="create_phone_number_country_code" id="phonecode">
                                            <input type="hidden" name="create_phone_number_flag" id="phoneflag">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Email Address:</label>
                                            <input type="email" class="form-control" required name="Email" placeholder="Enter Customer Email:">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Contact Name:</label>
                                            <input type="text" class="form-control" required name="contactName" placeholder="Enter customer contact person’s name.">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="submitBtn">SUBMIT</button>
                                <button  onclick="customerForm()" type="reset" class="submitBtn"style="margin-right: 8px;">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <div class="procedure_div">
                        <div class="requirments_table_div">
                            <h4>Total Customers Listed</h4>
                            <div class="kt-portlet__body table-responsive">
                                <!--begin: Datatable -->
                                <table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="">
                                    <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Business Address</th>
                                        <th>Customer Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Contact
                                            Person</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($customers as $item)

                                        <tr>
                                            <td>{{$item->idNumber}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->phonecode}} {{$item->phoneNumber}}</td>
                                            <td>{{$item->Email}}</td>
                                            <td>{{$item->contactName}}</td>
                                            <td>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View" value="" onclick="viewEid({{$item}});"><i class="la la-eye"></i>
                                                </button>
                                                <button  data-toggle="modal" onclick="getEid({{$item}});" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit" value=""><i class="la la-edit"></i>
                                                </button>
                                                <button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete" value="" onclick="deletethisitem({{$item}});"><i class="la la-trash"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--end: Datatable -->
                            </div>

                        </div>

                    </div>
                </div>
        </section>

        <!--End::Section-->
    </div>

    <div class="modal fade" id="EditCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('editCustomers')}} " id="editcust" method="POST">
                        @csrf

                        <input type="hidden" name="id" id="id_feild" value="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer ID Number:</label><br>
                                    <input type="number" class="form-control validate_number" name="idNumber" id="editidNumber" placeholder="Enter ID:" required>
                                    <span id="editnumbererror" class="text-dagner"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label><br>
                                    <input type="text" class="form-control" name="name"  placeholder="Enter Customer Name:" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Business Address:</label>
                                    <input type="text" class="form-control" name="address"required placeholder="Enter customer’s full business address." required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Telephone:</label>
                                    <div id='edit_phone'>
                                    </div>
                                    <input type="hidden" name="edit_phone_code" id="editphonecode">
                                    <input type="hidden" name="edit_phone_flag" id="editphoneflag">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Email Address:</label>
                                    <input type="email" class="form-control" name="Email" placeholder="Enter Customer Email:" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Contact Name:</label>
                                    <input type="text" class="form-control" name="contactName" placeholder="Enter Customer Contact Number:" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="submitBtn">Update</button>
                        <button type="button" class="submitBtn btn-secondary"  data-dismiss="modal" aria-label="Close" style="margin-right:20px;">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ViewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('editCustomers')}} " method="POST">
                        @csrf

                        <input type="hidden" name="id" id="id_feild" value="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer ID Number:</label><br>
                                    <input type="number" readonly class="form-control" name="idNumber" placeholder="Enter ID:">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label><br>
                                    <input type="text" readonly class="form-control" name="name"  placeholder="Enter Customer Name:">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Business Address:</label>
                                    <input type="text" readonly  class="form-control" name="address" placeholder="Enter customer’s full business address.">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Telephone:</label>

                                    <div id='view_phone'>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Email Address:</label>
                                    <input type="email" readonly  class="form-control" name="Email" placeholder="Enter Customer Email:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Contact Name:</label>
                                    <input type="text" readonly class="form-control" name="contactName" placeholder="Enter Customer Contact Number:">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary"  data-dismiss="modal" aria-label="Close" style="margin-right:20px;">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deleting an entry.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this entry?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('deletecustomeradmin')}}" method="POST">
                        @csrf
                        <input type="hidden" id="re_id" value="" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


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




        function deletethisitem(data){
            $("#re_id").val(data.id);
            $("#deleteRequirment").modal('show');

        }

        var input = document.querySelector("#phoneNumber");
        window.intlTelInput(input, {
            separateDialCode: true,
            // initialCountry: '{{Auth::user()->phoneflag}}',
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });



        $("#addcust").submit(function() {

            var i=1;
            var j=1;
            $('.iti__selected-dial-code').each(function(){
                if(i==1)
                {
                    var code=$(this).text();
                    $("#phonecode").val(code);
                    console.log(code);
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
                    $("#phoneflag").val(result);
                    console.log(result);
                }
                //   else
                //   {
                //       var str=$(this).attr('aria-activedescendant');
                //       var n = str.lastIndexOf('-');
                //       var result = str.substring(n + 1);
                //       $("#phoneflag").val(result);
                //   }
                j++;
            });

        });
        $("#editcust").submit(function() {

            var i=1;
            var j=1;
            $('.iti__selected-dial-code').each(function(){
                //   if(i==2)
                //   {
                var code=$(this).text();
                console.log(code);

                $("#editphonecode").val(code);

                //   }

                //   i++;
            });
            $(".iti__selected-flag").each(function(){
                //   if(j==2)
                //   {
                var str=$(this).attr('aria-activedescendant');
                var n = str.lastIndexOf('-');
                var result = str.substring(n + 1);
                $("#editphoneflag").val(result);
                //   }
                //   else
                //   {
                //       var str=$(this).attr('aria-activedescendant');
                //       var n = str.lastIndexOf('-');
                //       var result = str.substring(n + 1);
                //       $("#phoneflag").val(result);
                //   }
                j++;
            });


        });

        $("#idNumber").blur(function(){
            number=$("#idNumber").val();
            $.ajax({
                method:'get',
                url:'{{url("/check-customer-number")}}',
                data:{number:number},
                success:function(res)
                {
                    if(res=="exist")
                    {
                        $("#idNumber").val("");
                        $("#numbererror").html("Number is Already taken x");
                    }
                    else
                    {
                        $("#numbererror").html("");
                    }
                }
            })
        })

        $("#editidNumber").blur(function(){
            number=$("#editidNumber").val();
            $.ajax({
                method:'get',
                url:'{{url("/check-customer-number")}}',
                data:{number:number},
                success:function(res)
                {
                    if(res=="exist")
                    {
                        $("#editidNumber").val("");
                        $("#editnumbererror").html("Number is Already taken x");
                    }
                    else
                    {
                        $("#editnumbererror").html("");
                    }
                }
            })
        })
    </script>
@endsection


<script>
    function getEid(data){
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='Email']").val(data.Email);
        $("input[name='address']").val(data.address);
        $("input[name='contactName']").val(data.contactName);
        $("input[name='idNumber']").val(data.idNumber);

        $("input[name='name']").val(data.name);
        //  var phone = data.phonecode + data.phoneNumber

        $('#edit_phone').empty().append(`<input type="text" class="form-control" id="editphone" name="edit_phone_number" placeholder="Enter Customer Phone Number" required>`);

        $("input[name='edit_phone_number']").val(data.phoneNumber);
        code = data.phonecode;
        //  code = code.replace(/["']/g, '');
        console.log(code);
        var input = document.querySelector("#editphone");
        if(data.phoneflag == "preferred" || data.phoneflag == null){
             window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: 'us',
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
        }else{
            window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: data.phoneflag,
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
        }


        $("#EditCustomer").modal('show');
        $('#addcust').resetForm();
    }

    function viewEid(data){
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='Email']").val(data.Email);
        $("input[name='address']").val(data.address);
        $("input[name='contactName']").val(data.contactName);
        $("input[name='idNumber']").val(data.idNumber);

        $("input[name='name']").val(data.name);
        //  var phone = data.phonecode + data.phoneNumber
        $('#view_phone').empty().append(`<input type="text" class="form-control" id="viewPhoneNumber" name="viewPhoneNumber" placeholder="Enter Customer Phone Number" required>`);
        $("input[name='viewPhoneNumber']").val(data.phoneNumber);
        code = data.phonecode;
        // code = code.replace(/["']/g, '');
        console.log(code);
        var input = document.querySelector("#viewPhoneNumber");
         if(data.phoneflag == "preferred" || data.phoneflag == null){
           window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: 'us',
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });
        }else{
           window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: data.phoneflag,
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });

        }



        $("#ViewCustomer").modal('show');
        $('#addcust').resetForm();
    }
    function checkcustomer()
    {

        ajax_url='<?php echo route('checkcustomer')?>';
        cusid=$("#idNumber").val();
        //console.log(cusid);
        $.ajax({
            type: "GET",
            url: ajax_url,
            data: {cusid:cusid},
            success: function(data){
                if(data)
                {
                    $("#name").val(data);
                }else{
                    $("#name").val('');
                }
            }
        });
    }
</script>

