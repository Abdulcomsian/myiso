
<?php $__env->startSection('title'); ?>
Edit Lawyer Profile
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('assets/layouts/layout3/css/intlTelInput.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
   <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid mb-10 mb-lg-0">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-12">
                                <!--begin::Form-->
                                <form action="<?php echo e(route('update-user',$user->id)); ?>" method="post">
                                <?php echo method_field('PUT'); ?>
                                <?php echo csrf_field(); ?>
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start flex-xxl-row">

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Enter invoice number">
                                            <span class="fs-2x fw-bolder text-gray-800">Edit User </span>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Top-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-10"></div>
                                    <!--end::Separator-->
                                    <!--begin::Wrapper-->
                                    <div class="mb-0">
                                        <!--begin::Row-->
                                        <div class="row gx-10 mb-5">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">First Name</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" name="f_name" value="<?php echo e($user->f_name); ?>" placeholder="Enter First Name" />
                                                    <div style="color:red;"><?php echo e($errors->first('f_name')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Last Name</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" name="l_name" value="<?php echo e($user->l_name); ?>" placeholder="Enter Last Name" />
                                                    <div style="color:red;"><?php echo e($errors->first('l_name')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Email</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="email" class="form-control form-control-solid" name="email" value="<?php echo e($user->email); ?>" placeholder="Enter Email" />
                                                    <div style="color:red;"><?php echo e($errors->first('email')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Phone No.</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    
                                                    <input type="hidden" class="form-control" id="phone_submit" name="phone" >
                                                    <input id="phone" type="text" class="form-control  form-control-solid" name="phone_input" value="<?php echo e($user->phone); ?>" autocomplete="phone_input">
                                                        <div style="color:red;"><?php echo e($errors->first('phone_input')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <div class="col-lg-6" style="display: none;">
                                                <div class="form-group">
                                                    <select name="country" class="countries order-alpha" id="countryId">
                                                    <option>Select Country</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-4 offset-md-4">
                                                <button type="submit" class="btn btn-primary ">
                                                    Update User
                                                </button>
                                            </div>
                                            <!--end::Col-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Wrapper-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content--> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.0/js/intlTelInput-jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.0/js/intlTelInput.min.js"></script>

<script src="<?php echo e(URL::asset('assets/layouts/layout/scripts/intlTelInputCustom.js')); ?>"></script>

<script src="//geodata.solutions/includes/countrystatecity.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin_panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/admin/user/edit.blade.php ENDPATH**/ ?>