
<?php $__env->startSection('title'); ?>
Edit Lawyer Profile
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
                                <form action="<?php echo e(route('update-lawyer-profile',$lawyer_profile->id)); ?>" method="post" enctype="multipart/form-data">
                                <?php echo method_field('PUT'); ?>
                                <?php echo csrf_field(); ?>
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start flex-xxl-row">

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Enter invoice number">
                                            <span class="fs-2x fw-bolder text-gray-800">Edit Lawyer Profile </span>
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
                                                    <input type="text" class="form-control form-control-solid" name="f_name" value="<?php echo e($lawyer_profile->user->f_name); ?>" placeholder="Enter First Name" />
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
                                                    <input type="text" class="form-control form-control-solid" name="l_name" value="<?php echo e($lawyer_profile->user->l_name); ?>" placeholder="Enter Last Name" />
                                                    <div style="color:red;"><?php echo e($errors->first('l_name')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Country</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select name="country" class="form-control" id="country-dropdown">
                                                        <option value="">Select Country</option>
                                                        
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($lawyer_profile): ?>
                                                        <?php if($country->id == $lawyer_profile->country): ?>
                                                        <option value="<?php echo e($country->id); ?>" selected>
                                                        <?php echo e($country->name); ?>

                                                        </option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <div style="color:red;"><?php echo e($errors->first('country')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">State</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select class="form-control" name="state" class="" id="state-dropdown">
                                                                
                                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($lawyer_profile): ?>
                                                        <?php if($state->id == $lawyer_profile->state): ?>
                                                        <option value="<?php echo e($state->id); ?>" selected>
                                                        <?php echo e($state->name); ?>

                                                        </option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </select>
                                                    <div style="color:red;"><?php echo e($errors->first('state')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">City</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select name="city" class="form-control" id="city-dropdown">
                                                        <?php if($lawyer_profile): ?>
                                                        <?php if($lawyer_profile->city != null): ?>
                                                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <div style="color:red;"><?php echo e($errors->first('city')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Address</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="text" class="form-control form-control-solid" name="address" value="<?php echo e($lawyer_profile->address); ?>" placeholder="Enter Address" />
                                                    <div style="color:red;"><?php echo e($errors->first('address')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Profile Detail</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <textarea required class="ckeditor form-control" name="description"><?php echo e($lawyer_profile->description); ?></textarea>
                                                    <div style="color:red;"><?php echo e($errors->first('description')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <div class="multiSelect">
                                                    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Expertise</label>
                                                    <!--begin::Input group-->
                                                    <div class="mb-5">
                                                        <select class="select2-multiple form-control" multiple="multiple" id="select2Multiple" name="education_id[]" >
                                                            <option disabled> Select Education</option>
                                                            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $lawyer_educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l_education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php 
                                                            $selected="";
                                                            if($l_education->education_id == $education->id ){
                                                                $selected="selected";
                                                                break;
                                                            }
                                                            ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($education->id); ?>" <?php echo e($selected); ?>><?php echo e($education->education_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <div style="color:red;"><?php echo e($errors->first('expertise_id')); ?></div> <br>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Language</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select class="select2-multiple_ form-control" multiple="multiple" id="select2MultipleE" name="language_id[]">
                                                        <option disabled> Select Language</option>
                                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $lawyer_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l_language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php 
                                                            $selected="";
                                                            if($l_language->language_id == $language->id ){
                                                                $selected="selected";
                                                                break;
                                                            }
                                                            ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($language->id); ?>"
                                                            <?php echo e($selected); ?> ><?php echo e($language->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <div style="color:red;"><?php echo e($errors->first('language_id')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Profile Image</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="file" class="form-control form-control-solid" name="image" value="<?php echo e($lawyer_profile->image); ?>" accept="image/*"/>
                                                    <div class="profileAvatar">
                                                        <img style="width: 140px !important; height: 140px !important; border-radius: 84px;" src="<?php echo e(asset('lawyer_profile/' .$lawyer_profile->image)); ?>" alt="" class="img-fluid">
                                                    </div>
                                                    <div style="color:red;"><?php echo e($errors->first('image')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Cover Image</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <input type="file" class="form-control form-control-solid" name="b_image" value="<?php echo e($lawyer_profile->b_image); ?>" accept="image/*"/>
                                                    <div class="profileAvatar">
                                                        <img style="width: 140px !important; height: 140px !important; border-radius: 84px;" src="<?php echo e(asset('lawyer_cover_image/' .$lawyer_profile->b_image)); ?>" alt="" class="img-fluid">
                                                    </div>
                                                    <div style="color:red;"><?php echo e($errors->first('b_image')); ?></div> <br>
                                                </div>
                                                <!--end::Input group-->
                                            </div><br>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Membership</label>
                                                <!--begin::Input group-->
                                                <div class="mb-5">
                                                    <select class="select2-multiple_ form-control" multiple="multiple" id="select2MultipleE1" name="membership_id[]">
                                                        <option disabled> Select Language</option>
                                                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $lawyer_memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l_membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php 
                                                            $selected="";
                                                            if($l_membership->membership_id == $membership->id ){
                                                                $selected="selected";
                                                                break;
                                                            }
                                                            ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($membership->id); ?>"
                                                            <?php echo e($selected); ?> ><?php echo e($membership->membership_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                <!--end::Input group-->
                                                </div><br>
                                            </div>
                                            <!--end::Col-->

                                            
                                            <div class="col-lg-4 offset-md-4">
                                                <button type="submit" class="btn btn-primary ">
                                                    Update Lawyer Profile
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
        $('#country-dropdown').on('change', function() {
        var country_id = this.value;
        $("#state-dropdown").html('');
        $.ajax({
        url:"<?php echo e(url('get-states-by-country')); ?>",
        type: "POST",
        data: {
        country_id: country_id,
        _token: '<?php echo e(csrf_token()); ?>' 
        },
        dataType : 'json',
        success: function(result){
        $('#state-dropdown').html('<option value="">Select State</option>'); 
        $.each(result.states,function(key,value){
        $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
        });
        $('#city-dropdown').html('<option value="">Select State First</option>'); 
        }
        });
        });    
        $('#state-dropdown').on('change', function() {
        var state_id = this.value;
        $("#city-dropdown").html('');
        $.ajax({
        url:"<?php echo e(url('get-cities-by-state')); ?>",
        type: "POST",
        data: {
        state_id: state_id,
        _token: '<?php echo e(csrf_token()); ?>' 
        },
        dataType : 'json',
        success: function(result){
        $('#city-dropdown').html('<option value="">Select City</option>'); 
        $.each(result.cities,function(key,value){
        $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
        });
        }
        });
        });
        });


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

        $('#select2MultipleE1').select2({
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

<?php echo $__env->make('layout.admin_panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/admin/lawyer/edit.blade.php ENDPATH**/ ?>