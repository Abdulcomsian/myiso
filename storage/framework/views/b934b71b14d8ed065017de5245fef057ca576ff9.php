
<?php $__env->startSection('title'); ?>
Edit Profile
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<main>
        <div class="profileDiv">
            <h5>My Profile</h5>
            <div class="profileBox">
                <form action="<?php echo e(route('lawyer.update-lawyer-profile',$lawyer_profile->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="profileBoxHeader" style="padding: 100px 41px 144px 140px;">
                            <div class="uploadCover">
                                <input type="file" name="b_image" id="b_image" accept="image/*">
                                <p>Upload Cover Image</p>
                            </div>
                            <div class="profileAvatar" style="bottom:-30px !important;">
                                <img src="<?php echo e(asset('lawyer_cover_image/'.$lawyer_profile->b_image)); ?>" alt="" style="width:160px; height:160px; border-radius:75px;" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="profileBoxHeader" style="padding: 100px 41px 144px 140px;">
                            <div class="uploadCover">
                                <input type="file" name="image" id="image" accept="image/*">
                                <p>Upload Profile Image</p>
                            </div>
                            <div class="profileAvatar" style="bottom:-30px !important;">
                                <img src="<?php echo e(asset('lawyer_profile/'.$lawyer_profile->image)); ?>" alt="" style="width:160px; height:160px; border-radius:75px;" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profileFormDiv">
                    
                        <div class="row">
                            <div class="col-lg-6">
                                <label>First Name</label>
                                <div class="inputDiv">
                                    <input type="text" placeholder="First Name" name="f_name" value="<?php echo e($lawyer_profile->user->f_name); ?>">
                                    <div style="color:red;"><?php echo e($errors->first('f_name')); ?></div> <br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Last Name</label>
                                <div class="inputDiv">
                                    <input type="text" placeholder="Last Name" name="l_name" value="<?php echo e($lawyer_profile->user->l_name); ?>">
                                    <div style="color:red;"><?php echo e($errors->first('l_name')); ?></div> <br>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Email</label>
                                <div class="inputDiv">
                                    <input type="email" readonly placeholder="Email Address" name="email" value="<?php echo e($lawyer_profile->user->email); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Country</label>
                                <div class="inputDiv">
                                    <select name="country" id="country-dropdown">
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
                            </div>
                            <div class="col-lg-6">
                                <label>State</label>
                                <div class="inputDiv">
                                    <select name="state" class="" id="state-dropdown">
                                                                
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
                            </div>
                            <div class="col-lg-6">
                                <label>City</label>
                                <div class="inputDiv">
                                    <select name="city" id="city-dropdown">
                                        <?php if($lawyer_profile): ?>
                                        <?php if($lawyer_profile->city != null): ?>
                                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div style="color:red;"><?php echo e($errors->first('city')); ?></div> <br>
                                </div>
                            </div>
                            
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                            <!-- <div class="col-lg-6">
                                <div class="inputDiv">
                                    <select name="country" id="country">
                                        <option value="Country">Country</option>
                                        <option value="Pakistan">Pakistan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="inputDiv">
                                    <input type="text" placeholder="City" name="city" id="city">
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <label>Address</label>
                                <div class="inputDiv">
                                    <input name="address" type="text" value="<?php echo e($lawyer_profile->address); ?>" placeholder="Address" />
                                    <div style="color:red;"><?php echo e($errors->first('address')); ?></div> <br>
                                </div>
                            </div>
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <label style="margin-bottom: 3.5rem;">Langugae</label>
                                <div class="inputDiv">
                                    <select class="js-example-basic-multiple" name="language_id[]" multiple="multiple">
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
                            </div>
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Profile</label>
                                <div class="aboutProfile">
                                    <textarea required class="form-control" id="editor" name="description"><?php echo $lawyer_profile->description; ?></textarea>
                                    <div style="color:red;"><?php echo e($errors->first('description')); ?></div> <br>
                                </div>
                            </div>
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label style="margin-bottom: 3.5rem;">Eductions</label>
                                <div class="inputDiv">
                                    <select class="js-example-basic-multiple" name="education_id[]" multiple="multiple">
                                        <option disabled> Select Eductions</option>
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
                                        <option value="<?php echo e($education->id); ?>"
                                            <?php echo e($selected); ?> ><?php echo e($education->education_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div style="color:red;"><?php echo e($errors->first('education_id')); ?></div> <br>
                                </div>
                            </div>
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Associations & Memberships</h5>
                                <div class="inputDiv">
                                    <select class="js-example-basic-multiple" name="membership_id[]" multiple="multiple">
                                        <option disabled> Select Eductions</option>
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
                                    <div style="color:red;"><?php echo e($errors->first('membership_id')); ?></div> <br>
                                </div>
                            </div>
                        </div>
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

<script type="text/javascript">

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

    $(document).ready(function () {
        ClassicEditor.create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    });

    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
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
<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/profile/edit_profile.blade.php ENDPATH**/ ?>