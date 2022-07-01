<footer>
    <div class="newsLetter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="newLetterContent">
                        <p>Subscribe to</p>
                        <h2>Our Newsletter</h2>
                    </div>
                </div>
                <?php if(session('alert')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('alert')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('failure')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('failure')); ?>

                    </div>
                <?php endif; ?>
                <div class="col-lg-6">
                    <div class="formDiv">
                        <form method="post" action="<?php echo e(url('newsletter')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="inputBtn">
                                <input type="text" name="subscriber_email" id="email" placeholder="Enter Your Email Address">
                                <button type="submit">
                                    <img src="<?php echo e(asset('assets/img/sliderArrow.png')); ?>" alt="" class="img-fluid">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="footerWiget">
                    <div class="logo">
                        <img src="<?php echo e(asset('assets/img/logoFooter.png')); ?>" alt="" class="img-fluid">
                    </div>
                    <div class="socialList">
                        <ul>
                            <li>
                                <a href="<?php echo e($contact_us->facebook_link ?? '#'); ?>">
                                    <img src="<?php echo e(asset('assets/img/facebook.png')); ?>" alt="" class="img-fluid">
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e($contact_us->instagram_link ?? '#'); ?>">
                                    <img src="<?php echo e(asset('assets/img/instagram.png')); ?>" alt="" class="img-fluid">
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e($contact_us->twitter_link ?? '#'); ?>">
                                    <img src="<?php echo e(asset('assets/img/twitter.png')); ?>" alt="" class="img-fluid">
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e($contact_us->linkedin_link ?? '#'); ?>">
                                    <img src="<?php echo e(asset('assets/img/linkdien.png')); ?>" alt="" class="img-fluid">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footerWiget navigationWigets">
                    <h4>Navigation</h4>
                    <div class="navigationList">
                        <ul>
                            <li>
                                <a href="">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Experts
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('lawyer-register')); ?>">
                                    Apply as Lawyer
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('register')); ?>">
                                    Apply as Client
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    News
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footerWiget navigationWigets">
                    <h4>Contact Us</h4>
                    <div class="navigationList">
                        <ul>
                            <li>
                                <a href="">
                                    <?php echo e($contact_us->address ?? ''); ?>

                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <?php echo e($contact_us->phone ?? ''); ?>

                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <?php echo e($contact_us->phone_1 ?? ''); ?>

                                </a>
                            </li>
                            <li>
                                <a href="" style="color: rgb(239, 29, 48);">
                                    <?php echo e($contact_us->email ?? ''); ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="copyRight">
            <ul>
                <li>
                    <a href="">© 2022 <span>Experts Gateway</span>. All Rights Reserved.</a>
                </li>
                <li>
                    <a href="">Privacy Policy</a>
                </li>
                <li>
                    <a href="">Team and Conditions</a>
                </li>
            </ul>
        </div>
    </div>
</footer><?php /**PATH C:\wamp64\www\expertgateway\resources\views/layout/partials/login_footer.blade.php ENDPATH**/ ?>