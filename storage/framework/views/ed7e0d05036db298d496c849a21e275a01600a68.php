<?php $__env->startPush('styles'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?> 

<main>
    <div class="readyToStart">
        <h4 class="commonHeading">Ready to Start Your Journey?</h4>
        <div class="formDiv">
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="inputDiv">
                                <label for="">Full Name</label>
                                <input id="type" type="hidden" name="type" value="lawyer">
                                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" autofocus placeholder="Enter Your Full Name">
                                <div style="color:red;"><?php echo e($errors->first('f_name')); ?></div> <br>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inputDiv">
                                <label for="">Email Address</label>
                                <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" autofocus placeholder="Enter Your Email Address">
                                <div style="color:red;"><?php echo e($errors->first('email')); ?></div> <br>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inputDiv">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" value="<?php echo e(old('password')); ?>">
                                <div style="color:red;"><?php echo e($errors->first('password')); ?></div> <br>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inputDiv">
                                <label for="">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btnDiv">
                    <button class="formBtn" style="cursor: pointer;">Sign Up Now</button>
                </div>
                
            </form>
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
<?php echo $__env->make('layout.registerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/auth/lawyer_register.blade.php ENDPATH**/ ?>