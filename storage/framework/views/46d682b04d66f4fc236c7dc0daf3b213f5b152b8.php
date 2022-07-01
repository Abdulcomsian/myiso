
<?php $__env->startSection('title'); ?>
Experts
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<main>
    <div class="profileDiv expertDetailProfile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
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
                                    <h4><?php echo e($lawyer_profile->user->f_name); ?> <?php echo e($lawyer_profile->user->l_name); ?></h4>
                                    
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
                                        <span><?php echo e($lawyer_profile->address); ?></span>
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
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                    </li>
                                    <li>
                                        <div class="imgDiv">
                                            <img src="../assets/img/consultantIcon.png" alt="" class="img-fluid">
                                        </div>
                                        <span>
                                            
                                            Corporate Law
                                        </span>
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
                    <div class="recentQuestionDiv">
                        <h4><img src="../assets/img/recentQuestionIcon.png" alt="" class="img-fluid"> RECENT
                            QUESTIONS ANSWERED</h4>
                        <div class="accordiansDiv">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                How to know the labor contract details if the employer never gave a
                                                copy?
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Some placeholder content for the first accordion panel. This panel is
                                            shown by default, thanks to the <code>.show</code> class.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                How to know the labor contract details if the employer never gave a
                                                copy?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            Some placeholder content for the second accordion panel. This panel is
                                            hidden by default.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                How to renew a tenancy contract while the landlord is abroad?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            And lastly, the placeholder content for the third and final accordion
                                            panel. This panel is hidden by default.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                When to leave work after submitting a notice of non-renewal of an
                                                unlimited contract?
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="headingFour" class="collapse" aria-labelledby="headingFour"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            And lastly, the placeholder content for the third and final accordion
                                            panel. This panel is hidden by default.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="recentBlog">
                        <h4><img src="../assets/img/recentBlogIcon.png" alt="" class="img-fluid"> RECENT BLOG POSTS
                        </h4>
                        <div class="bolgSection">
                            <div class="recentBlogSlider">
                                <?php if(count($blogs) > 0): ?>
                                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="blogCard">
                                    <img src="<?php echo e(asset('blogs/'.$blog->image)); ?>" style="width: 208px; height: 128px;" alt="" class="img-fluid">
                                    <div class="cardContent">
                                        <div class="date">
                                            <p><?php echo e(date('d M,Y', strtotime($blog->created_at))); ?></p>
                                        </div>
                                        <h4><?php echo e($blog->title); ?></h4>
                                        <p><?php echo e(Illuminate\Support\Str::limit($blog->short_description,60)); ?></p>
                                        <a href="<?php echo e(route('all-blog', $blog->id)); ?>">Read More <img src="../assets/img/sliderArrow.png" alt=""></a>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hireDiv">
                        <ul>
                            <li>
                                <img src="../assets/img/recentQuestionIcon.png" alt="" class="img-fluid">
                                <span>ASK A QUESTION</span>
                            </li>
                            <li>
                                <img src="../assets/img/chatIcon.svg" alt="" class="img-fluid">
                                <span>CHAT</span>
                            </li>
                            <li>
                                <img src="../assets/img/request.png" alt="" class="img-fluid">
                                <span>REQUEST CALLBACK</span>
                            </li>
                        </ul>
                        <div class="btnDiv text-center">
                            <button>Hire</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixedFreeService">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="freeServicesSlider">
                                <div class="relatedService">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <h2 class="commonHeading">Fixed-fee services</h2>
                                            </div>
                                        </div>
                                        <div class="multiRelatedService fixedServiceSliderDiv">
                                            <?php if(count($fixed_services) > 0): ?>
                                            <?php $__currentLoopData = $fixed_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fixed_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card">
                                                <img src="<?php echo e(asset('fixed_service/'.$fixed_service->image)); ?>" style="width: 360px; height: 235px;" alt="" class="img-fluid">
                                                <div class="cardContent">
                                                    <h4><?php echo e($fixed_service->time_limit); ?> <?php echo e($fixed_service->title); ?></h4>
                                                    <p class="tag"><?php echo e($fixed_service->expertise->name); ?></p>
                                                    <p class="line">
                                                        .................................................................................
                                                    </p>
                                                    <p><?php echo e(Illuminate\Support\Str::limit($fixed_service->short_des,150)); ?>

                                                    </p>
                                                    <div class="cardFooter">
                                                        <h4><?php echo e($fixed_service->price); ?> <span>USD</span></h4>
                                                        <a href="<?php echo e(route('fixed_service_detail',$fixed_service->id)); ?>" class="learnMore">Learn More <img
                                                                src="../assets/img/sliderArrow.png" alt=""
                                                                class="img-fluid"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
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

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/frontend/expert_detail.blade.php ENDPATH**/ ?>