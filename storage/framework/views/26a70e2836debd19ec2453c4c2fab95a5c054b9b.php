<?php $__env->startSection('content'); ?> 

<main>
    <div class="mainBanner registerBanner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bannerLeft registerAuthBox">
                        <p>Login</p>
                        <div class="formDiv">
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="inputDiv">
                                            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>

                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="inputDiv">
                                            <input id="password" type="password" name="password" autocomplete="current-password">

                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php if(Route::has('password.request')): ?>
                                            <a style="color: #EA297A;display: flex;align-items: center; height: 100%;" href="<?php echo e(route('password.request')); ?>">
                                                <?php echo e(__('Forgot Password?')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        
                                        <button type="submit" class="formBtn" style="cursor: pointer;margin: 0px;">
                                            <?php echo e(__('Login')); ?>

                                        </button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="applyForMembership">
                            <span>Don’t have an account?</span>
                            <a href="<?php echo e(route('register')); ?>"><button style="cursor: pointer;">Sign Up</button></a>
                        </div>
                        <p class="applyMemberShip" style="font-size: 18px;text-align: right;margin-top: 55px;">Want to register as a Lawyer? <a href="" style="color: #EA297A;">Apply For Membership</a></p>
                    </div>

                </div>
                <div class="col-lg-6" style="padding: 0px;">
                    <div class="bannerRight registerAuthRightBox">
                        <img src="<?php echo e(asset('assets/img/bannerImg.png')); ?>" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="requestInformation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="informationContent">
                        <h2>Request Information</h2>
                        <div class="formDiv">
                            <form action="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="first_name" id="first_name"
                                                placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="last_name" id="last_name"
                                                placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="email" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="inputDiv">
                                            <textarea name="message" id="message" placeholder="Message" cols="30"
                                                rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button>Submit Now</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="imgText">
                        <img src="<?php echo e(asset('assets/img/information.png')); ?>" alt="" class="img-fluid">
                        <div class="imgTextMiddle">
                            <p>Legal Advice<br> Across the<br> Globe</p>
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
<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/auth/login.blade.php ENDPATH**/ ?>