@extends('dashboard.layouts.app')

@section('content')
<style>#procedure_section .procedure_div ul li::before {display:none !important;}</style>
<div class="am-content">

    @if(session('message'))<div class="alert alert-success">{{ session('message') }}</div>@endif

    <div class="am-page-header">
        <div>
            <h2>Suppliers</h2>
            <p>A Suppliers review is a tool to monitor and grade the performance levels of your suppliers.</p>
        </div>
        <div class="am-page-header__actions">
            <button class="am-btn am-btn-primary" onclick="supplierForm()"><i class="fa fa-plus"></i> Add Supplier</button>
        </div>
    </div>

    <p>A Suppliers review is a tool to monitor and grade the performance levels of your suppliers, this performance indicator can target all areas of contact with the supplier.</p>
    <p>To add a record, click on the "Add Supplier" button. To amend or delete a record, click on the edit or delete icon of the entry that needs to be modified or deleted.</p>

    {{-- Add Supplier Form --}}
    <div class="am-card supplier_from_div" style="display:none;">
        <div class="am-card__body am-form">
            <form action="{{route('supplier')}}" id="addcust" method="post">
                @csrf
                <h3 style="margin-bottom:1rem;">Add Supplier Details</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label>Supplier ID Number:</label>
                        <input type="number" class="form-control validate_number" min="1" name="idnumber" required placeholder="Enter ID:">
                    </div>
                    <div class="form-col">
                        <label>Supplier Name:</label>
                        <input type="text" class="form-control" required name="suppliername" placeholder="Enter Supplier Name:">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Supplier Address:</label>
                        <input type="text" name="supplieraddress" required class="form-control" placeholder="Enter Supplier Address:">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Country:</label>
                        <input type="text" name="suppliercountry" required class="form-control" placeholder="Enter Country">
                    </div>
                    <div class="form-col">
                        <label>Supplier Phone Number:</label>
                        <input type="text" name="supplierphn" required id="supplierphn" class="form-control" placeholder="Enter phone number">
                        <input type="hidden" name="phonecode" id="phonecode">
                        <input type="hidden" name="phoneflag" id="phoneflag">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label>Supplier Email Address:</label>
                        <input type="email" name="supplieremail" required class="form-control" placeholder="Enter Supplier Email address:">
                    </div>
                    <div class="form-col">
                        <label>Supplier Contact Name:</label>
                        <input type="text" name="supplierContactNumber" required class="form-control" placeholder="Enter supplier contact person's name.">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label>Services:</label>
                        <input type="text" name="supplierservc" required class="form-control" placeholder="Enter Supplier Services">
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <button type="submit" class="am-btn am-btn-primary">SUBMIT</button>
                    <button type="reset" onclick="supplierForm()" class="am-btn am-btn-secondary" style="margin-left:7px;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Suppliers Table --}}
    <div class="am-card">
        <div class="am-card__body">
            <h4 style="margin-bottom:1rem;">Total Suppliers Listed</h4>
            <div class="am-table-wrap">
                <table class="am-table common_table" id="kt_table_agent">
                    <thead>
                        <tr>
                            <th>Supplier ID Number</th>
                            <th>Supplier Name</th>
                            <th>Supplier Address</th>
                            <th>Country</th>
                            <th>Supplier Phone Number</th>
                            <th>Email Address</th>
                            <th>Contact Person</th>
                            <th>Services</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @forelse ($supplier as $data)
                        <tr>
                            <td>{{$data->idnumber}}</td>
                            <td>{{$data->suppliername}}</td>
                            <td>{{$data->supplieraddress}}</td>
                            <td>{{$data->suppliercountry}}</td>
                            <td>{{$data->phonecode}} {{$data->supplierphn}}</td>
                            <td>{{$data->supplieremail}}</td>
                            <td>{{$data->supplierContactNumber}}</td>
                            <td>{{$data->supplierservc}}</td>
                            <td>
                                <button class="am-btn am-btn-sm am-btn-info" title="View" onclick="viewEid({{$data}});"><i class="fa fa-eye"></i></button>
                                <button class="am-btn am-btn-sm am-btn-warning" title="Edit" onclick="getEid({{$data}});"><i class="fa fa-edit"></i></button>
                                <button class="am-btn am-btn-sm am-btn-danger" title="Delete" onclick="deleteModal({{$data}});"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9"><div class="am-empty"><i class="fa fa-database"></i><p>No records found.</p></div></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Delete Supplier Modal --}}
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="deleteSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="deleteSupplierLabel">Deleting Supplier</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('deleteSupplier')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="re_id" value="">
                    <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="am-btn am-btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Supplier Modal --}}
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="editSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="editSupplierLabel">Edit Supplier</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('supplieredit')}}" id="editcust" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id_feild" value="">
                    <div class="form-row">
                        <div class="form-col">
                            <label>ID Number:</label>
                            <input type="number" required class="form-control" name="idnumber" placeholder="">
                        </div>
                        <div class="form-col">
                            <label>Supplier Name:</label>
                            <input type="text" required class="form-control" name="suppliername" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Supplier Address:</label>
                            <input type="text" required name="supplieraddress" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Supplier Telephone:</label>
                            <div id="edit_supplier_phone"></div>
                            <input type="hidden" name="phonecode" id="editphonecode">
                            <input type="hidden" name="phoneflag" id="editphoneflag">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Supplier Email Address:</label>
                            <input type="email" required name="supplieremail" class="form-control" placeholder="Enter Supplier Email address">
                        </div>
                        <div class="form-col">
                            <label>Supplier Contact Name:</label>
                            <input type="text" name="supplierContactNumber" required class="form-control" placeholder="Enter supplier contact person's name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Services:</label>
                            <input type="text" name="supplierservc" required class="form-control" placeholder="Enter Supplier Services">
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:1rem 0 0;">
                        <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="am-btn am-btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- View Supplier Modal --}}
<div class="modal fade" id="viewSupplier" tabindex="-1" role="dialog" aria-labelledby="viewSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title" id="viewSupplierLabel">View Supplier Details</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <input type="hidden" name="id" id="id_feild" value="">
                    <div class="form-row">
                        <div class="form-col">
                            <label>Supplier ID number:</label>
                            <input type="number" class="form-control" name="idnumber" placeholder="Enter ID:" readonly>
                        </div>
                        <div class="form-col">
                            <label>Supplier Name:</label>
                            <input type="text" class="form-control" name="suppliername" placeholder="Enter Supplier Name:" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Supplier Address:</label>
                            <input type="text" name="supplieraddress" class="form-control" placeholder="Enter Supplier Address:" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Country:</label>
                            <input type="text" name="suppliercountry" class="form-control" placeholder="Enter Country" readonly>
                        </div>
                        <div class="form-col">
                            <label style="display:block;">Supplier Telephone:</label>
                            <div id="view_phone_div"></div>
                            <input type="hidden" name="phonecode" id="phonecode2">
                            <input type="hidden" name="phoneflag" id="phoneflag2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label>Supplier Email Address:</label>
                            <input type="email" name="supplieremail" class="form-control" placeholder="Enter Supplier Email:" readonly>
                        </div>
                        <div class="form-col">
                            <label>Supplier Contact Name:</label>
                            <input type="text" name="supplierContactNumber" class="form-control" placeholder="Enter Supplier Contact Number:" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col" style="flex:1 1 100%;">
                            <label>Services:</label>
                            <input type="text" name="supplierservc" class="form-control" placeholder="Enter Supplier Service:" readonly>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:1rem 0 0;">
                        <button type="button" class="am-btn am-btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function getEid(data){
        console.log(data);
        $("#edit_supplier_phone").empty().append(`<input type="text" required name="editsupplierphn" id="editphone" class="form-control" placeholder="">`);

            $("#id_feild").val(data.id);
         $("input[name='idnumber']").val(data.idnumber);
         $("input[name='supplierContactNumber']").val(data.supplierContactNumber);
         $("input[name='supplieraddress']").val(data.supplieraddress);
         $("input[name='suppliercity']").val(data.suppliercity);
         $("input[name='suppliercountry']").val(data.suppliercountry);
         $("input[name='supplieremail']").val(data.supplieremail);
         $("input[name='suppliername']").val(data.suppliername);
         $("input[name='editsupplierphn']").val(data.supplierphn);
         $("input[name='supplierservc']").val(data.supplierservc);
         $("input[name='supplierstate']").val(data.supplierstate);
         $("input[name='supplierzip']").val(data.supplierzip);

        let phoneflag = '';
        if(data.phoneflag == 'preferred' || data.phoneflag == null){
            phoneflag = 'us';
        }else{
            phoneflag = data.phoneflag;
        }
        var input = document.querySelector("#editphone");
         window.intlTelInput(input, {
        separateDialCode: true,
        initialCountry: phoneflag,
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });
         $("#editSupplier").modal('show');
        $('#addcust').resetForm();
    }
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');
     }

     function viewEid(data) {
        console.log(data);
        $('#view_phone_div').empty().append(`<input type="text" name="supplierphn" class="form-control" id="editphone2" placeholder="Enter Supplier Telephone:"/>`);
        $("#id_feild").val(data.id);
        $("input[name='idnumber']").val(data.idnumber);
        $("input[name='supplierContactNumber']").val(data.supplierContactNumber);
        $("input[name='supplieraddress']").val(data.supplieraddress);
        $("input[name='suppliercity']").val(data.suppliercity);
        $("input[name='suppliercountry']").val(data.suppliercountry);
        $("input[name='supplieremail']").val(data.supplieremail);
        $("input[name='suppliername']").val(data.suppliername);
        $("input[name='supplierphn']").val(data.supplierphn);
        $("input[name='supplierservc']").val(data.supplierservc);
        $("input[name='supplierstate']").val(data.supplierstate);
        $("input[name='supplierzip']").val(data.supplierzip);
        var input = document.querySelector("#editphone2");
        let phoneflag = '';

        if(data.phoneflag == 'preferred' || data.phoneflag == null){
            phoneflag = 'us';
        }else{
            phoneflag = data.phoneflag;
        }

        window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: phoneflag ,
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });
        $("#viewSupplier").modal('show');
        $('#addcust').resetForm();
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

    var input = document.querySelector("#supplierphn");
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
              }
              j++;
          });
     });

    $("#editcust").submit(function() {
            var i=1;
           var j=1;
           $('.iti__selected-dial-code').each(function(){
              if(i==2)
              {
               var code=$(this).text();
                console.log(code);
               $("#editphonecode").val(code);
              }
              i++;
          });
            $(".iti__selected-flag").each(function(){
              if(j==2)
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#editphoneflag").val(result);
              }
              j++;
          });
     });
</script>
@endsection
