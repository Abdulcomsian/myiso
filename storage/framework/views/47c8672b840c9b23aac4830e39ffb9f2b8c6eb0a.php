
<?php $__env->startSection('title'); ?>
Edit Fixed Price Service
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                <form action="<?php echo e(route('admin.update-fixed-service',$fixed_service->id)); ?>" method="post" enctype="multipart/form-data">
                                <?php echo method_field('PUT'); ?>
                                <?php echo csrf_field(); ?>
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start flex-xxl-row">

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Enter invoice number">
                                            <span class="fs-2x fw-bolder text-gray-800">Edit Fixed Price Service </span>
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
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Title</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" name="title" value="<?php echo e($fixed_service->title); ?>" placeholder="Enter Title" />
                                                    <div style="color:red;"><?php echo e($errors->first('title')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Price</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="number" class="form-control form-control-solid" name="price" value="<?php echo e($fixed_service->price); ?>" placeholder="Enter Price" />
                                                    <div style="color:red;"><?php echo e($errors->first('price')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Short Description</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" name="short_des" value="<?php echo e($fixed_service->short_des); ?>" placeholder="Enter Short Description" />
                                                    <div style="color:red;"><?php echo e($errors->first('short_des')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Time</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select name="time_limit" id="time_limit" class="form-select" aria-label="Default select example">
                                                        <option disabled selected>Select Time</option>
                                                        <option value="15 min" <?php echo e($fixed_service->time_limit == '15 min' ? 'selected' : ''); ?>>15 min</option>
                                                        <option value="30 min" <?php echo e($fixed_service->time_limit == '30 min' ? 'selected' : ''); ?>>30 min</option>
                                                        <option value="1 hour" <?php echo e($fixed_service->time_limit == '1 hour' ? 'selected' : ''); ?>>1 hour</option>
                                                        <option value="1.3 hour" <?php echo e($fixed_service->time_limit == '1.3 hour' ? 'selected' : ''); ?>>1.3 hour</option>
                                                        <option value="2 hours"<?php echo e($fixed_service->time_limit == '2 hour' ? 'selected' : ''); ?>>2 hours</option>
                                                        <option value="2.3 hours"<?php echo e($fixed_service->time_limit == '2.3 hour' ? 'selected' : ''); ?>>2.3 hours</option>
                                                        <option value="3 hour"<?php echo e($fixed_service->time_limit == '3 hour' ? 'selected' : ''); ?>>3 hour</option>
                                                        <option value="3.3 hour"<?php echo e($fixed_service->time_limit == '3.3 hour' ? 'selected' : ''); ?>>3.3 hour</option>
                                                        <option value="4 hours"<?php echo e($fixed_service->time_limit == '4 hour' ? 'selected' : ''); ?>>4 hours</option>
                                                        <option value="4.3 hours"<?php echo e($fixed_service->time_limit == '4.3 hour' ? 'selected' : ''); ?>>4.3 hours</option>
                                                    </select>
                                                    <div style="color:red;"><?php echo e($errors->first('time_limit')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Category</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select name="expertise_id" id="expertise_id" class="form-select" aria-label="Default select example">
                                                        <option disabled selected>Select Time</option>
                                                        <?php $__currentLoopData = $expertises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($expertise->id); ?>" <?php echo e($fixed_service->expertise_id == $expertise->id ? 'selected' : ''); ?> ><?php echo e($expertise->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <div style="color:red;"><?php echo e($errors->first('expertise_id')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Image</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="file" class="form-control form-control-solid" name="image" value="<?php echo e($fixed_service->image); ?>" accept="image/*"/>
                                                    <div class="profileAvatar">
                                                        <img style="width: 140px !important; height: 140px !important; border-radius: 84px;" src="<?php echo e(asset('fixed_service/' .$fixed_service->image)); ?>" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Description</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <textarea required class="ckeditor form-control" name="description"><?php echo $fixed_service->description; ?></textarea>
                                                    <div style="color:red;"><?php echo e($errors->first('description')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Whats Included</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <textarea required class="ckeditor form-control" name="included"><?php echo $fixed_service->included; ?></textarea>
                                                    <div style="color:red;"><?php echo e($errors->first('included')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Whats not Included</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <textarea required class="ckeditor form-control" name="not_included"><?php echo $fixed_service->not_included; ?></textarea>
                                                    <div style="color:red;"><?php echo e($errors->first('not_included')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->



                                            
                                            <div class="col-lg-4 offset-md-4">
                                                <button type="submit" class="btn btn-primary ">
                                                    Update
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2 Multiple
        $('.select2-multiple').select2({
            placeholder: "Select",
            allowClear: true
        });

    });

    $(document).ready(function() {
        // Select2 Multiple
        $('#select2MultipleE').select2({
            placeholder: "Select",
            allowClear: true
        });

    });

    $(document).ready(function(){      
      var i=1;  

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field_membership').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="membership[]" placeholder="Enter Membership & Association Law" class="form-control membership_list" /></td><td><button style="padding: 7px !important; margin-top:2px;" type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  

    });

    $(document).ready(function(){      
      var j=1;  


      $('#add_edu').click(function(){  
           j++;  
           $('#dynamic_field').append('<tr id="row'+j+'" class="dynamic-added"><td><input type="text" name="education[]" placeholder="Enter Education" class="form-control education_list" /></td><td><button style="padding: 7px !important; margin-top:2px;" type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove_edu">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove_edu', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  

    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin_panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/admin/fixed_service/edit.blade.php ENDPATH**/ ?>