
<?php $__env->startPush('styles'); ?>
<script src="https://js.pusher.com/7.1/pusher.min.js"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Contact Us</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
 <?php echo Session::has('msg') ? Session::get("msg") : ''; ?>

          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li> <?php echo e($error); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          <?php endif; ?>
</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
                    	<div class="contact_form">
                    		<form action="<?php echo e(url('/send_msg_to_admin')); ?>" method="POST" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
                    	
						
 <input value="<?php echo e($user['id']); ?>" type="hidden" name="user_id">
 <input value="<?php echo e($user['name']); ?>" type="hidden" name="name">
 <input value="<?php echo e($user['company_name']); ?>" type="hidden" name="company">
<input type="hidden" name="email" value="<?php echo e($user['email']); ?>">									
									
                    			
								<div class="row">
									<div class="col-lg-9">
										<div class="form-group">
											<label>Subject</label>
											<input type="text" required class="form-control" placeholder="Enter subject" name="subject" value="<?php echo e(old('subject')); ?>">
										</div>
									</div>
									<div class="col-lg-3">
								<label for="attachment">Attachment</label>
								<div class="kt-input-icon kt-input-icon--right">
								<input type="file" name="attachment" class="form-control" id="attachment" accept=".pdf,.png,.jpg,.mp4,.mp3,.doc,.docx,.jpeg,.csv,.txt,.xlx,.xls,">

								</div>
							</div>
								</div>	
								<div class="row">
										
									<div class="col-lg-12">
										<div class="form-group">
											<label>Message to Admin</label>
<textarea style="min-height: 150px;" required class="form-control" placeholder="Your Message" name="comments"><?php echo e(old('comments')); ?></textarea>
										</div>
									</div>

								</div>
							
								<button onclick="supplierForm()" class="submitBtn">SUBMIT</button>&nbsp;&nbsp;
								<a href="/home" class="submitBtn" style="margin-right:10px">Cancel</a>
                    		</form>
                    	</div>
                    </div>
	</section>

	<!--End::Section-->
</div>

<?php $__env->stopSection(); ?>
<!-- end:: Content --''
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/dashboard/contact_us.blade.php ENDPATH**/ ?>