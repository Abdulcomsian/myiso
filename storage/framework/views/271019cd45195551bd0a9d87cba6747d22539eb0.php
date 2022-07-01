
<?php $__env->startSection('title'); ?>
Contact Us Detail
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
                                <form action="<?php echo e(route('contact_us.store')); ?>" method="post" >
                                <?php echo csrf_field(); ?>
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start flex-xxl-row">

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Enter invoice number">
                                            <span class="fs-2x fw-bolder text-gray-800">Add Contact Us Detail</span>
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
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Address</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" name="address" value="<?php echo e(old('address')); ?>" placeholder="Enter Address" />
                                                    <div style="color:red;"><?php echo e($errors->first('address')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Email</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="email" class="form-control form-control-solid" value="<?php echo e(old('email')); ?>" placeholder="Enter Email" name="email">
                                                    <div style="color:red;"><?php echo e($errors->first('email')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Phone Number </label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="number" class="form-control form-control-solid" value="<?php echo e(old('phone')); ?>" placeholder="Enter Phone Number" name="phone">
                                                    <div style="color:red;"><?php echo e($errors->first('phone')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Phone Number (optional)</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="number" class="form-control form-control-solid" value="<?php echo e(old('phone_1')); ?>" placeholder="Enter Phone Number" name="phone_1">
                                                    <div style="color:red;"><?php echo e($errors->first('phone_1')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Facebook Link</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="url" class="form-control form-control-solid" value="<?php echo e(old('facebook_link')); ?>" placeholder="Enter Facebook Link" name="facebook_link">
                                                    <div style="color:red;"><?php echo e($errors->first('facebook_link')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Instagram Link</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="url" class="form-control form-control-solid" value="<?php echo e(old('instagram_link')); ?>" placeholder="Enter Instagram Link" name="instagram_link">
                                                    <div style="color:red;"><?php echo e($errors->first('instagram_link')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Twitter Link</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" value="<?php echo e(old('twitter_link')); ?>" placeholder="Enter Twitter Link" name="twitter_link">
                                                    <div style="color:red;"><?php echo e($errors->first('twitter_link')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Linkedin Link</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" value="<?php echo e(old('linkedin_link')); ?>" placeholder="Enter Linkedin Link" name="linkedin_link">
                                                    <div style="color:red;"><?php echo e($errors->first('linkedin_link')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->

                                            <button type="submit" class="btn btn-primary updateBtn">
                                                Save
                                            </button>
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin_panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/admin/contact_us/add.blade.php ENDPATH**/ ?>