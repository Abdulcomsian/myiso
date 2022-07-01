
<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div class="profileDiv">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="editBar">
                            <h5>My Profile</h5>
                            <a href="<?php echo e(route('lawyer.edit-profile',$lawyer_profile->id)); ?>"><button style="cursor: pointer; margin-left:25px;padding:10px 30px; font-family:MoskauMedium;border:2px solid hsl(0deg 0% 0% / 15%); font-size:16px;">Edit Profile </button></a>
                        </div>
                        <div class="editProfileBox">
                            <div class="profileImg">
                                <img src="<?php echo e(asset('lawyer_cover_image/'.$lawyer_profile->b_image)); ?>" style="width: 790px !important; height: 230px !important;" alt="" class="img-fluid">

                            </div>
                            <div class="editProfile">
                                <div class="userDetail">
                                    <div class="avatar">
                                        <img src="<?php echo e(asset('lawyer_profile/'.$lawyer_profile->image)); ?>" alt="" style="width:160px; height:160px; border-radius:75px;" class="img-fluid">
                                    </div>
                                    <div class="userProfile">
                                        <h4><?php echo e($lawyer->f_name); ?> <?php echo e($lawyer->l_name); ?></h4>
                                        
                                    </div>
                                </div>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <div class="listDiv">
                                    <ul>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/locationIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span><?php echo e($lawyer_profile->address); ?> , <?php echo e($country->name); ?> , <?php echo e($state->name); ?> , <?php echo e($city->name); ?></span>
                                        </li>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/languageIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span>
                                                <?php $__currentLoopData = $lawyer_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($language->language->name); ?>

                                                    <?php if(!($loop->last)): ?>
                                                    ,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
                                        </li>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/consultantIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span><?php $__currentLoopData = $lawyer_educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($education->education->education_name); ?>

                                                    <?php if(!($loop->last)): ?>
                                                    ,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
                                        </li>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/lawIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span>Corporate Law</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <div class="editProfileContent">
                                    <h4>profile</h4>
                                    <?php echo $lawyer_profile->description; ?>

                                    <div class="line">
                                        <img src="../assets/img/line.png" alt="" class="img-fluid">
                                    </div>
                                    <h4>Education</h4>
                                    <ul>
                                        <?php $__currentLoopData = $lawyer_educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>-<?php echo e($education->education->education_name); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="line">
                                        <img src="../assets/img/line.png" alt="" class="img-fluid">
                                    </div>
                                    <h4>Associations & Memberships
                                    </h4>
                                    <ul>
                                        <?php $__currentLoopData = $lawyer_memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>-<?php echo e($membership->membership->membership_name); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/profile.blade.php ENDPATH**/ ?>