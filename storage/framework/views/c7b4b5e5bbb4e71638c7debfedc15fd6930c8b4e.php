
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
          integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
          crossorigin="anonymous"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>#procedure_section .procedure_div ul li::before {
            display: none;
        }

        a:hover, #procedure_section .procedure_div ul li a:hover {
            text-decoration: none !important;
        }</style>
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid view_user_content" id="kt_content">

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
                    <p>To add a record, click on the “Add Customer” button. To amend a record, click on the edit icon of
                        the entry that needs to be modified.</p>
                    <?php if(Session::has('Error')): ?><h5 class="text-danger">  <?php echo e(Session::get('Error')); ?> </h5><?php endif; ?>
                    <div class="procedure_div">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <a onclick="customerForm()" class="addBtn">ADD CUSTOMER</a>
                            </div>
                        </div>
                        <div class="customer_from_div">
                            <form action="<?php echo e(route('customerform')); ?>" id="add_form" method="POST" name="add_form">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3> Add Customer</h3>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer ID
                                                Number:</label>
                                            <input type="number" min="1" max="100000" required
                                                   class="form-control validate_number" name="idNumber" id="idNumber"
                                                   placeholder="Enter Customer ID Number.">
                                            <span id="numbererror" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Name:</label><br>
                                            <input type="text" class="form-control" required name="name" id="name"
                                                   placeholder="Enter Customer Name:">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Business Address:</label>
                                            <input type="text" class="form-control" required name="address"
                                                   placeholder="Enter customer’s full business address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label style="display:block;">Customer Telephone:</label>
                                            <input type="text" class="form-control" required name="create_phone_number"
                                                   id="create_phone_number" placeholder="Enter customer phone number starting with the country code.">
                                            <input type="hidden" name="create_phone_number_country_code" id="create_phone_number_country_code">
                                            <input type="hidden" name="create_phone_number_flag" id="create_phone_number_flag">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Email Address:</label>
                                            <input type="email" class="form-control" required name="Email"
                                                   placeholder="Enter Customer Email:">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Contact Name:</label>
                                            <input type="text" class="form-control" required name="contactName"
                                                   placeholder="Enter customer contact person’s name.">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $urlparam = request()->route()->parameters;
                                ?>
                                <input type="hidden" name="user_id" value="<?php echo e($urlparam['userid']); ?>">
                                <input type="hidden" name="is_admin" value="admin">
                                <button class="submitBtn" id="add_customer_submit_button">SUBMIT</button>
                                <button onclick="customerForm()" type="reset" class="submitBtn"
                                        style="margin-right: 8px;">Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="procedure_div">
                        <div class="requirments_table_div">
                            <div class="d-flex justify-content-between">
                                <h4>Total Customers Listed</h4>
                                <a href="/edit_user/<?php echo e($urlparam['userid']); ?>" class="btn btn-clean btn-icon-sm back_icon" style="float: right;">
                                    <i class="la la-long-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                            <!--<button>Add an entry</button>-->

                            <div class="kt-portlet__body table-responsive">
                                <!--begin: Datatable -->
                                <table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive"
                                       id="kt_table_agent2">
                                    <thead>
                                    <tr>
                                        <th>Customer ID Number</th>
                                        <th>Customer Name</th>
                                        <th>Business Address</th>
                                        <th>Customer Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Contact
                                            Person
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i=1
                                    ?>
                                    <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($item->idNumber); ?> <!----$i++----></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php echo e($item->address); ?></td>
                                            <td><?php echo e($item->phonecode); ?> <?php echo e($item->phoneNumber); ?></td>
                                            <td><?php echo e($item->Email); ?></td>
                                            <td><?php echo e($item->contactName); ?></td>
                                            <td class="d-flex">
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"
                                                        value="" onclick="viewEid(<?php echo e($item); ?>);"><i
                                                        class="la la-info"></i>
                                                </button>
                                                <button data-toggle="modal" onclick="getEid(<?php echo e($item); ?>);"
                                                        class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"
                                                        value=""><i class="la la-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="delete"
                                                        value="" onclick="deletethisitem(<?php echo e($item); ?>);"><i
                                                        class="la la-trash"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <!--end: Datatable -->
                            </div>

                        </div>

                    </div>
                </div>
        </section>
        <div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
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
                        <form action="<?php echo e(route('deletecustomeradmin')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="re_id" value="" name="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End::Section-->
    </div>

    <div class="modal fade" id="EditCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('editCustomers')); ?> " id="edit_form" name="edit_form" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php
                            $urlparam = request()->route()->parameters;
                        ?>


                        <input type="hidden" name="user_id" value="<?php echo e($urlparam['userid']); ?>">

                        <input type="hidden" name="id" id="id_feild" value="">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer ID Number:</label><br>
                                    <input type="number" class="form-control" name="idNumber" id"editidNumber"
                                    placeholder="Enter ID:" required>
                                    <span id="editnumbererror" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label><br>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Enter Customer Name:" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Business
                                        Address:</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter customer’s full business
								address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label style="display:block;">Customer Telephone:</label>
                                    <div id="edit_phone_div">
                                    </div>
                                </div>
                                <input type="hidden" name="edit_phone_code" id="edit_phone_code">
                                <input type="hidden" name="edit_phone_flag" id="edit_phone_flag">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Email Address</label>
                                    <input type="email" class="form-control" name="Email"
                                           placeholder="Enter Customer Email:" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Contact Name:</label>
                                    <input type="text" class="form-control" name="contactName"
                                           placeholder="Enter Customer Contact Number:" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"
                                style="margin-right:20px;">Cancel
                        </button>
                        <button type="submit" class="submitBtn" id="update_customer_button">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--VIEW-->
    <div class="modal fade" id="ViewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('editCustomers')); ?> " method="POST">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" id="id_feild" value="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer ID Number:</label><br>
                                    <input type="number" readonly class="form-control" name="idNumber"
                                           placeholder="Enter ID:">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name:</label><br>
                                    <input type="text" readonly class="form-control" name="name"
                                           placeholder="Enter Customer Name:">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Business Address:</label>
                                    <input type="text" readonly class="form-control" name="address"
                                           placeholder="Enter customer’s full business address.">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Telephone:</label>
                                    <div id="view_phone_div">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Email Address:</label>
                                    <input type="email" readonly class="form-control" name="Email"
                                           placeholder="Enter Customer Email:">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Contact Name:</label>
                                    <input type="text" readonly class="form-control" name="contactName"
                                           placeholder="Enter Customer Contact Number:">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"
                                style="margin-right:20px;">Close
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/VIEW-->
<?php $__env->stopSection(); ?>

<script>
    var edit_phone_number = '';
    var view_phone_number = '';
    function getEid(data) {
        edit_phone_number = '';
        console.log(data);
        $('#add').resetForm();
        $("#id_feild").val(data.id);
        $("input[name='Email']").val(data.Email);
        $("input[name='address']").val(data.address);
        $("input[name='contactName']").val(data.contactName);
        $("input[name='idNumber']").val(data.idNumber);
        $("input[name='name']").val(data.name);
        $("#edit_phone_div").empty().append(`<input type="text" class="form-control" required name="edit_phone_number" id="edit_phone_number" placeholder="Enter customer phone number starting with the country code.">`);
        $("input[name='edit_phone_number']").val(data.phoneNumber);

        let phoneflag = '';
        if(data.phoneflag == 'preferred' || data.phoneflag == null){
            phoneflag = 'us';
        }else{
            phoneflag = data.phoneflag;
        }

        edit_phone_number = window.intlTelInput(document.querySelector("#edit_phone_number"), {
            separateDialCode: true,
            initialCountry: phoneflag,
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });

        $("#EditCustomer").modal('show');
        $('#add_form').resetForm();
    }

    function viewEid(data) {
        view_phone_number = '';
        console.log(data);
        $("#id_feild").val(data.id);
        $("input[name='Email']").val(data.Email);
        $("input[name='address']").val(data.address);
        $("input[name='contactName']").val(data.contactName);
        $("input[name='idNumber']").val(data.idNumber);

        $("input[name='name']").val(data.name);
        $("#view_phone_div").empty().append(` <input type="text" class="form-control" name="view_phone_number" id="view_phone_number"
                                           placeholder="Enter Customer Telephone:" required>`);
        $("input[name='view_phone_number']").val(data.phoneNumber);

        let phoneflag = '';
        if(data.phoneflag == 'preferred' || data.phoneflag == null){
            phoneflag = 'us';
        }else{
            phoneflag = data.phoneflag;
        }

        view_phone_number = window.intlTelInput(document.querySelector("#view_phone_number"), {
            separateDialCode: true,
            initialCountry: phoneflag,
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });


        $("#ViewCustomer").modal('show');
        $('#add_form').resetForm();
    }

    function deletethisitem(data) {
        $("#re_id").val(data.id);
        $("#deleteRequirment").modal('show');
    }
</script>

<?php $__env->startSection('myscript'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
            integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
            crossorigin="anonymous"></script>

    <script>
        create_phone_number = '';
        create_phone_number = window.intlTelInput(document.querySelector("#create_phone_number"), {
            separateDialCode: true,
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });


        $("#add_customer_submit_button").click(function (e) {
            e.preventDefault();
            let create_phone_number_data = create_phone_number.getSelectedCountryData();
            $('#create_phone_number_country_code').val('').val(create_phone_number_data.dialCode);
            $('#create_phone_number_flag').val('').val(create_phone_number_data.iso2);
            $("form[name='add_form']").submit();
        });

        $("#update_customer_button").click(function (e) {
            e.preventDefault();
            let edit_phone_number_data = edit_phone_number.getSelectedCountryData();
            $('#edit_phone_code').val('').val(edit_phone_number_data.dialCode);
            $('#edit_phone_flag').val('').val(edit_phone_number_data.iso2);
            $("form[name='edit_form']").submit();
        });

        $("#idNumber").blur(function () {
            number = $("#idNumber").val();
            $.ajax({
                method: 'get',
                url: '<?php echo e(url("/check-customer-number")); ?>',
                data: {number: number},
                success: function (res) {
                    if (res == "exist") {
                        $("#idNumber").val("");
                        $("#numbererror").html("Number is Already taken");
                    } else {
                        $("#numbererror").html("");
                    }
                }
            })
        });

        $("#editidNumber").blur(function () {
            number = $("#editidNumber").val();
            $.ajax({
                method: 'get',
                url: '<?php echo e(url("/check-customer-number")); ?>',
                data: {number: number},
                success: function (res) {
                    if (res == "exist") {
                        $("#editidNumber").val("");
                        $("#editnumbererror").html("Number is Already taken");
                    } else {
                        $("#editnumbererror").html("");
                    }
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/admin/adminform_records/customer.blade.php ENDPATH**/ ?>