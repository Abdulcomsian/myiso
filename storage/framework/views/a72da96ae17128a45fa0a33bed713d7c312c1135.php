
<?php $__env->startSection('title'); ?>
Profile building
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<main>
    <div class="on-boarding-main profileDiv">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="on-boarding-left-bar">
                        <div class="content-div">
                            <h3>Ready to Start<br> Your Journey?</h3>
                            <?php if($lawyer_profile): ?>
                            <?php if($lawyer_profile->complete == 2): ?>
                            <div class="progress-div">
                                <p><span class="percentage-text">100%</span> Complete</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                        aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                        <span class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <?php elseif($lawyer_profile->complete == 1): ?>
                            <div class="progress-div">
                                <p><span class="percentage-text">50%</span> Complete</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                        aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                        <span class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php else: ?>
                            <div class="progress-div">
                                <p><span class="percentage-text">0%</span> Complete</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                        aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                        <span class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="tab-pills-div">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#profile">Profile</a></li>
                                    <div class="imageTab">
                                        <img src="<?php echo e(asset('assets/img/profileTab.svg')); ?>" alt="" class="img-fluid">
                                    </div>
                                    <li><a data-toggle="pill" id="lawyer_info" href="#lawyer">Lawyer Information</a></li>
                                    <div class="imageTab">
                                        <img src="<?php echo e(asset('assets/img/lawyerIcon.svg')); ?>" alt="" class="img-fluid">
                                    </div>
                                    <li><a data-toggle="pill" href="#membership">Membership</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="pills-div-main">
                        <div class="tab-content">
                            <div id="profile" class="tab-pane fade in active show">
                                <div class="profile-div">
                                    <div class="formDiv">
                                        <form id="profile-form">
                                            <?php echo csrf_field(); ?>
                                         
                                            <div class="uploadBanner">
                                                <div class="upload_banner_img">
                                                    <?php if($lawyer_profile): ?>
                                                    <img src="<?php echo e(asset('lawyer_cover_image/' .$lawyer_profile->b_image ?? '')); ?>" alt="" class="img-fluid">
                                                    <?php endif; ?>
                                                </div>
                                                <!-- <?php if($lawyer_profile): ?>
                                                <img src="<?php echo e(asset('lawyer_cover_image/' .$lawyer_profile->b_image ?? '')); ?>" alt="" class="img-fluid">
                                                <?php endif; ?> -->
                                                <div class="uploadImgBanner first_form">
                                                    <p>Upload Cover Image</p>
                                                    <input type="file" id="b_image" name="b_image" value="<?php echo e($lawyer_profile->b_image ??''); ?>" id="b_image" accept="image/*" class="upload_banner_img">
                                                    <span class="text-primary" id="b_imageName"></span>
                                                    <span class="text-danger b_image_valid"></span><br>
                                                    
                                                </div>
                                            </div>
                                            <div class="tabContent">
                                                <div class="uplodProfilePhoto">
                                                    <div class="uploadPhoto first_form">
                                                        <p>Upload <br>Profile Image</p>
                                                        <input type="file" name="image" value="<?php echo e($lawyer_profile->image ?? ''); ?>" id="image" accept="image/*" class="upload_user_img">
                                                        <span class="text-primary" id="imageName"></span>
                                                        <span class="text-danger image_valid"></span>
                                                        <?php if($lawyer_profile): ?>
                                                        <div class="profileAvatar">
                                                            <img style="width: 140px !important; height: 140px !important; border-radius: 84px;" src="<?php echo e(asset('lawyer_profile/' .$lawyer_profile->image)); ?>" alt="" class="img-fluid">
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="formDiv">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="inputDiv first_form">
                                                                <label for="">First Name</label>
                                                                <input type="text" name="f_name" id="f_name" value="<?php echo e($lawyer->f_name); ?>" placeholder="Enter Your First Name">
                                                                <span class="text-danger f_name_valid"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputDiv first_form">
                                                                <label for="">Last Name</label>
                                                                <input type="text" name="l_name" id="l_name" value="<?php echo e($lawyer->l_name); ?>" placeholder="Enter Your Last Name">
                                                                <span class="text-danger l_name_valid"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="inputDiv first_form">
                                                                <label for="">Gender</label>
                                                                <select name="gender" id="gender">
                                                                    <option selected disabled value=""> Select Gender</option>
                                                                    <option value="Male"> Male</option>
                                                                    <option value="Female"> Female</option>
                                                                </select>
                                                                <span class="text-danger gender_valid"></span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $dob = Carbon\Carbon::parse($lawyer_profile->dob ?? '')->format('Y-m-d')
                                                        ?>
                                                        <div class="col-lg-6">
                                                            <div class="inputDiv first_form">
                                                                <label for="">Date of Birth</label>
                                                                <input type="date" name="dob" id="dob" value="<?php echo e($dob); ?>" placeholder="Enter Date of Birth">
                                                                <span class="text-danger dob_valid"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="inputDiv first_form">
                                                                <label for="">LinkedIn url</label>
                                                                <input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo e($lawyer_profile->linkedin_url ?? ''); ?>" placeholder="Enter Your LinkedIn url">
                                                                <span class="text-danger linkedin_url_valid"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="inputDiv first_form">
                                                                <label for="">Profile Description</label>
                                                                <textarea name="description" id="description" class="ckeditor" placeholder="Enter Your Profile Description"><?php echo e($lawyer_profile->description ?? ''); ?></textarea>
                                                                <span class="text-danger description_valid"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 text-center">
                                                            <button type="submit" class="saveButton">SAVE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lawyer" class="tab-pane fade">
                                <div class="profile-div">
                                    <div class="tabContent">
                                        <div class="formDiv lawyerForm">
                                            <form id="profile-form-1">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">Location</label>
                                                            <input type="text" name="address" id="address" value="<?php echo e($lawyer_profile->address ?? ''); ?>" placeholder="Enter Your Location">
                                                            <span class="text-danger address_valid"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="multiSelect second_form">
                                                            <label for="">Select Language</label>
                                                            <select class="js-example-basic-multiple" name="language_id[]" id="language_id" multiple="multiple">
                                                                <option disabled> Select Language</option>
                                                                <?php if($lawyer_language): ?>
                                                                <?php echo e($selected=""); ?>

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
                                                                <?php else: ?>
                                                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($language->id); ?>"><?php echo e($language->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <span class="text-danger language_id_valid"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">Country <i class="fa fa-info-circle" aria-hidden="true"></i></label>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">State <i class="fa fa-info-circle" aria-hidden="true"></i></label>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">City <i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <select name="city" class="" id="city-dropdown">
                                                                <?php if($lawyer_profile): ?>
                                                                <?php if($lawyer_profile->city != null): ?>
                                                                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">Primary Practice Area <i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <select name="partise_area" id="partise_area">
                                                                <option value="">Select Primary Practice Area,</option>
                                                                <option value="1">Rawalpindi Kachari</option>
                                                                <option value="2">Rawalpindi Lower Court</option>
                                                                <option value="3">Rawalpindi High Court</option>
                                                            </select>
                                                            <span class="text-danger partise_area_valid"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">Secondary Practice Area <i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <select name="secondary_partise_area" id="secondary_partise_area">
                                                                <option value="">Select Secondary Practice Area,</option>
                                                                <option value="1">Rawalpindi Kachari</option>
                                                                <option value="2">Rawalpindi Lower Court</option>
                                                                <option value="3">Rawalpindi High Court</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="inputDiv second_form">
                                                            <label for="">Third Practice Area <i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <select name="third_partise_area" id="third_partise_area">
                                                                <option value="">Select Third Practice Area,</option>
                                                                <option value="1">Rawalpindi Kachari</option>
                                                                <option value="2">Rawalpindi Lower Court</option>
                                                                <option value="3">Rawalpindi High Court</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="multiSelect">
                                                            <label for="">Education</label>
                                                            <div class="inputButton second_form flex-column align-items-start" >
                                                                <select class="js-example-basic-multiple" name="education_id[]" id="education_id" multiple="multiple">
                                                                    <?php if($lawyer_educations): ?>
                                                                    <?php echo e($selected=""); ?>

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
                                                                    <?php else: ?>
                                                                    <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($education->id); ?>"><?php echo e($education->education_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                                <span class="text-danger education_id_valid d-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="multiSelect">
                                                            <label for="">Membership & Association</label>
                                                            <div class="inputButton second_form flex-column align-items-start">
                                                                <select class="js-example-basic-multiple" name="membership_id[]" id="membership_id" multiple="multiple">
                                                                    <option disabled> Select Membership & Association</option>
                                                                    <?php if($lawyer_memberships): ?>
                                                                    <?php echo e($selected=""); ?>

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
                                                                    <?php else: ?>
                                                                    <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($membership->id); ?>"><?php echo e($membership->membership_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                                
                                                                <span class="text-danger membership_id_valid d-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-center">
                                                        <button type="submit" class="submitButton">SUBMIT</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="sendApproval">
                                            <img src="<?php echo e(asset('assets/img/approval.png')); ?>" alt="" class="img-fluid">
                                            <p>We need to validate everything here. Please give us some time to respond.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="membership" class="tab-pane fade">
                                <div class="multipleMemberShip">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="commonBox">
                                                <div class="header">
                                                    <img src="<?php echo e(asset('assets/img/starter.svg')); ?>" alt="" class="img-fluid">
                                                    <p>Starter</p>
                                                </div>
                                                <div class="priceDiv">
                                                    <span>Starts at</span>
                                                    <p class="actualPrice">AED 200/mo</p>
                                                    <p class="yearPrice">
                                                        <span>AED 2400</span>
                                                        <span>AED 2160/yr</span>
                                                    </p>
                                                </div>
                                                <div class="packageDetail">
                                                    <p>Lorem ipsum dolor sit amet consectetur adi iscing elit Sed c</p>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="list_div">
                                                    <p>Lorem ipsum dolor sit amet consectetur</p>
                                                    <ul>
                                                        <p>LOREM IPSUM DOLOR SIT</p>
                                                        <li>Lorem ipsum dolor sit</li>
                                                        <li>Lorem ipsum dolor sit amet</li>
                                                        <li>iscing elit Sed aliquam</li>
                                                        <li>aliquam id nibh</li>
                                                    </ul>
                                                    <ul>
                                                        <p>LOREM IPSUM DOLOR SIT</p>
                                                        <li>Lorem ipsum dolor sit</li>
                                                        <li>Lorem ipsum dolor sit amet</li>
                                                        <li>iscing elit Sed aliquam</li>
                                                        <li>aliquam id nibh</li>
                                                    </ul>
                                                </div>
                                                <div class="savePrice">
                                                    <ul>
                                                        <li>
                                                            <p>Pay Monthly</p>
                                                            <span>AED 200/mo</span>
                                                        </li>
                                                        <li class="active">
                                                            <p>Pay Annually Upfront</p>
                                                            <span>
                                                                AED 2160/yr
                                                                <span>SAVE 10%</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <button>BUY NOW</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="commonBox">
                                                <div class="header">
                                                    <img src="<?php echo e(asset('assets/img/starter.svg')); ?>" alt="" class="img-fluid">
                                                    <p>Starter</p>
                                                </div>
                                                <div class="priceDiv">
                                                    <span>Starts at</span>
                                                    <p class="actualPrice">AED 200/mo</p>
                                                    <p class="yearPrice">
                                                        <span>AED 2400</span>
                                                        <span>AED 2160/yr</span>
                                                    </p>
                                                </div>
                                                <div class="packageDetail">
                                                    <p>Lorem ipsum dolor sit amet consectetur adi iscing elit Sed c</p>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="list_div">
                                                    <p>Lorem ipsum dolor sit amet consectetur</p>
                                                    <ul>
                                                        <p>LOREM IPSUM DOLOR SIT</p>
                                                        <li>Lorem ipsum dolor sit</li>
                                                        <li>Lorem ipsum dolor sit amet</li>
                                                        <li>iscing elit Sed aliquam</li>
                                                        <li>aliquam id nibh</li>
                                                    </ul>
                                                    <ul>
                                                        <p>LOREM IPSUM DOLOR SIT</p>
                                                        <li>Lorem ipsum dolor sit</li>
                                                        <li>Lorem ipsum dolor sit amet</li>
                                                        <li>iscing elit Sed aliquam</li>
                                                        <li>aliquam id nibh</li>
                                                    </ul>
                                                </div>
                                                <div class="savePrice">
                                                    <ul>
                                                        <li>
                                                            <p>Pay Monthly</p>
                                                            <span>AED 200/mo</span>
                                                        </li>
                                                        <li class="active">
                                                            <p>Pay Annually Upfront</p>
                                                            <span>
                                                                AED 2160/yr
                                                                <span>SAVE 10%</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <button>BUY NOW</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="commonBox">
                                                <div class="header">
                                                    <img src="<?php echo e(asset('assets/img/starter.svg')); ?>" alt="" class="img-fluid">
                                                    <p>Starter</p>
                                                </div>
                                                <div class="priceDiv">
                                                    <span>Starts at</span>
                                                    <p class="actualPrice">AED 200/mo</p>
                                                    <p class="yearPrice">
                                                        <span>AED 2400</span>
                                                        <span>AED 2160/yr</span>
                                                    </p>
                                                </div>
                                                <div class="packageDetail">
                                                    <p>Lorem ipsum dolor sit amet consectetur adi iscing elit Sed c</p>
                                                    <div class="line"></div>
                                                </div>
                                                <div class="list_div">
                                                    <p>Lorem ipsum dolor sit amet consectetur</p>
                                                    <ul>
                                                        <p>LOREM IPSUM DOLOR SIT</p>
                                                        <li>Lorem ipsum dolor sit</li>
                                                        <li>Lorem ipsum dolor sit amet</li>
                                                        <li>iscing elit Sed aliquam</li>
                                                        <li>aliquam id nibh</li>
                                                    </ul>
                                                    <ul>
                                                        <p>LOREM IPSUM DOLOR SIT</p>
                                                        <li>Lorem ipsum dolor sit</li>
                                                        <li>Lorem ipsum dolor sit amet</li>
                                                        <li>iscing elit Sed aliquam</li>
                                                        <li>aliquam id nibh</li>
                                                    </ul>
                                                </div>
                                                <div class="savePrice">
                                                    <ul>
                                                        <li>
                                                            <p>Pay Monthly</p>
                                                            <span>AED 200/mo</span>
                                                        </li>
                                                        <li class="active">
                                                            <p>Pay Annually Upfront</p>
                                                            <span>
                                                                AED 2160/yr
                                                                <span>SAVE 10%</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <button>BUY NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
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

function loadBannerImg(){
    console.log("here")
    $('.upload_banner').attr('src', URL.createObjectURL(event.target.files[0]));
    $(".upload_banner").css("opacity","1");
    $(".on-boarding-main .pills-div-main .uploadBanner .uploadImgBanner input").css("width","100%");
    $(".on-boarding-main .pills-div-main .uploadBanner .uploadImgBanner input").css("height","100%");
  }
  function loadProfileImg(){
    console.log("here")
    $('.user_profile_img').attr('src', URL.createObjectURL(event.target.files[0]));
    $(".user_profile_img").css("opacity","1");
  }

    ClassicEditor.create( document.querySelector( '#description' ) )
    .catch( error => {
        console.error( error );
    });

    // $('#b_image').input(alert('hello'));
    $('#b_image').on('propertychange input', function (e) { $('#b_imageName').text(this.value.split('\\')[2]
) });

$('#image').on('propertychange input', function (e) { $('#imageName').text(this.value.split('\\')[2]
) });

    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

    $('#profile-form').submit(function(e){
        e.preventDefault();
       $('.main-wrapper').addClass('active')
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data', 
            url: "<?php echo e(route('profile.store_1')); ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                $('.main-wrapper').removeClass('active');
                $('.first_form input:not(#linkedin_url)').val('');
                $('.first_form textarea').val('');   
                $(".ck-editor__editable_inline").val('').trigger('change');
                if(data.complete == 1){
                    $('.progress-bar').css('width', '50%');
                    $('.percentage-text').text('50%');
                }else if(data.complete == 2){
                    $('.sendApproval').css('display', 'flex');
                    $('#profile').css('display', 'none');
                    $('.lawyerForm').css('display', 'none');
                    $('.progress-bar').css('width', '100%');
                    $('.percentage-text').text('100%');
                }
                $('#lawyer_info').trigger('click');
                // scrool to top
                $('html, body').animate({
                    scrollTop: $("#lawyer_info").offset().top
                }, 100);
                
                
            },
            error: function (data) {
                $('.main-wrapper').removeClass('active');
                // convert json to object
                var errors = JSON.parse(data.responseText);
                // var error_message = JSON.parse(errors.message);
                // loop
                console.log('Error:', typeof data.responseText);
                if($('#f_name').val() == ''){
                    $('.f_name_valid').text(errors.message.f_name);
                }
                else{
                    $('.f_name_valid').text('');
                }
                if($('#l_name').val() == ''){
                    $('.l_name_valid').text(errors.message.l_name);
                }
                else{
                    $('.l_name_valid').text('');
                }
                if(!$('#gender').val()){
                    $('.gender_valid').text(errors.message.gender);
                }
                else{
                    $('.gender_valid').text('');
                }
                if($('#dob').val() == ''){
                    $('.dob_valid').text(errors.message.dob);
                }
                else{
                    $('.dob_valid').text('');
                }
                if($('#b_image').val() == ''){ 

                    $('.b_image_valid').text(errors.message.b_image);
                }
                else{
                    $('.b_image_valid').text('');
                }
                if($('#image').val() == ''){
                    $('.image_valid').text(errors.message.image);
                }
                else
                {
                    $('.image_valid').text('');
                }
                if($('#linkedin_url').val() == ''){
                    $('.linkedin_url_valid').text(errors.message.linkedin_url);
                }
                else{
                    $('.linkedin_url_valid').text('');
                }
                if($('#description').val() == ''){
                    $('.description_valid').text(errors.message.description);
                }
                else{
                    $('.description_valid').text('');
                }
            }
        });
    });

    $('#profile-form-1').submit(function(e){
        e.preventDefault();
        $('.main-wrapper').addClass('active');
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('profile.store_2')); ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('.main-wrapper').removeClass('active');
                $('.second_form input').val('');
                $('.second_form textarea').val('');
                $('.second_form select').val('');
                $("#language_id").val('').trigger('change');
                $("#education_id").val('').trigger('change');
                $("#membership_id").val('').trigger('change');
                if(data.complete == 1){
                    
                    $('.progress-bar').css('width', '50%');
                    $('.percentage-text').text('50%');
                }else if(data.complete == 2){
                    $('.sendApproval').css('display', 'flex');
                    $('.lawyerForm').css('display', 'none');
                    $('.progress-bar').css('width', '100%');
                    $('.percentage-text').text('100%');
                }
            },
            error: function (data) {
                $('.main-wrapper').removeClass('active');
                console.log('Error:', data);
                // convert json to object
                var errors = JSON.parse(data.responseText);
                // var error_message = JSON.parse(errors.message);
                // loop
                console.log('Error:', typeof data.responseText);
                if($('#partise_area').val() == ''){
                    $('.partise_area_valid').text(errors.message.partise_area);
                }
                else{
                    $('.partise_area_valid').text('');
                }
                if($('#address').val() == ''){
                $('.address_valid').text(errors.message.address);
                }
                else{
                    $('.address_valid').text('');
                }
                if($('#language_id').val() == ''){
                    $('.language_id_valid').text(errors.message.language_id);
                }
                else{
                    $('.language_id_valid').text('');
                }
                if($('#membership_id').val() == ''){
                    $('.membership_id_valid').text(errors.message.membership_id);
                }
                else{
                    $('.membership_id_valid').text('');
                }

                if($('#education_id').val() == ''){
                    $('.education_id_valid').text(errors.message.education_id);
                }
                else{
                    $('.education_id_valid').text('');
                }
                
            }
        });
    });

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/build_profile.blade.php ENDPATH**/ ?>