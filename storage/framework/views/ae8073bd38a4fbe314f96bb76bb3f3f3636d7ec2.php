<?php $__env->startPush('styles'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?> 

<main>
    <div class="mainBanner registerBanner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bannerLeft registerAuthBox">
                        <p>Register</p>
                        <div class="formDiv">
                            <form method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input id="type" type="hidden" name="type" value="user">
                                            <input id="f_name" type="text" name="f_name" value="<?php echo e(old('f_name')); ?>" autofocus placeholder="First Name">

                                            <div style="color:red;"><?php echo e($errors->first('f_name')); ?></div> <br>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input id="l_name" type="text" name="l_name" value="<?php echo e(old('l_name')); ?>" placeholder="Last Name">

                                            <div style="color:red;"><?php echo e($errors->first('l_name')); ?></div> <br>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email Address">

                                            <div style="color:red;"><?php echo e($errors->first('email')); ?></div> <br>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="hidden" class="form-control" id="phone_submit" name="phone" >
                                            <input id="phone" type="text" class="form-control  <?php $__errorArgs = ['phone_input'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone_input" value="<?php echo e(old('phone_input')); ?>" autocomplete="phone_input">
                                                <div style="color:red;"><?php echo e($errors->first('phone_input')); ?></div> <br>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="display: none;">
                                            <div class="form-group">
                                                <select name="country" class="countries order-alpha" id="countryId">
                                                <option>Select Country</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="password" name="password" id="password" placeholder="Password" value="<?php echo e(old('password')); ?>">
                                            <div style="color:red;"><?php echo e($errors->first('password')); ?></div> <br>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                placeholder="Re-enter Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right">
                                        <button class="formBtn" style="cursor: pointer;;margin: 0px;margin-top: 20px;">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="line">
                            <img src="<?php echo e(asset('assets/img/line.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="applyForMembership">
                            <span>Want to register as a Lawyer?</span>
                            <a href="<?php echo e(route('lawyer-register')); ?>"><button style="cursor: pointer;">Apply For Membership</button></a>
                        </div>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.0/js/intlTelInput-jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.0/js/intlTelInput.min.js"></script>

        <script src="<?php echo e(URL::asset('assets/layouts/layout/scripts/intlTelInputCustom.js')); ?>"></script>

        <script src="//geodata.solutions/includes/countrystatecity.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/auth/register.blade.php ENDPATH**/ ?>