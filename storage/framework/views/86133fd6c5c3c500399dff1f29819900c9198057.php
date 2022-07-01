
<?php $__env->startSection('styles'); ?>
	<style>
		.select2-search__field{
			padding-left: 10px !important;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>tr.New>td {    color: #000 !important;    font-weight: 800;    cursor: pointer;}tr.New>button {    color: #FFF !important;    font-weight: 800;    cursor: pointer;}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<?php if($message = Session::get('success')): ?>
	<div class="alert alert-light alert-elevate" role="alert">
		<!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->
		<!-- <div class="alert-text">
			DataTables has the ability to read data from virtually any JSON data source that can be obtained by Ajax. This can be done, in its most simple form, by setting the ajax option to the address of the JSON data source.
			See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/data_sources/ajax.html" target="_blank">here</a>.
		</div> -->

	        <!-- <div class="alert alert-success"> -->
	            <p><?php echo e($message); ?></p>
	        <!-- </div> -->
	</div>
	<?php endif; ?>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					New Message
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							
						</div>
						&nbsp;


					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

            <form class="kt-form kt-form--label-right"  action="<?php echo e(route('sendNotifications')); ?>" enctype="multipart/form-data" method="POST">
    	<?php echo csrf_field(); ?>
    	<div class="modal-body">
    
    			<div class="kt-portlet__body">
    				<input type="hidden" name="id" id="editvalue" value="">
    				<div class="form-group row">
    					<div class="col-lg-8">
    						<label for="title">Subject:</label>
    						<input type="text" id="title" name="title" class="form-control" placeholder="Please enter Message Subject">
    					</div>
                        <div class="col-md-4">
    						<label for="attachment">Attachment</label>
    						<div class="kt-input-icon kt-input-icon--right">
    						<input type="file" name="attachment" class="form-control" id="attachment">
    						</div>
    					</div>
    
    
    
    					<div class="col-lg-12">
    						<label for="message">Message:</label>
    						<textarea name="message" id="message" cols="20" rows="5" class="form-control" placeholder="Please enter your Message"></textarea>
    					</div>
    
    
    					<div class="col-lg-12">
    						<label for="address1">Send to:</label>
    						<div class="kt-input-icon kt-input-icon--right">
    							<select name="userid[]" id="user" class="form-control select2" multiple>
    								<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    							        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?> </option>
    								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    							</select>
    						</div>
    					</div>
    					<div class="col-lg-2">
    
    						<div class="kt-input-icon kt-input-icon--right">
    
    						</div>
    					</div>
    
    				</div>
    
    			</div>
    
    
    
    	</div>
    
    	<div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    		<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-paper-plane"></i>  Send </button>
    	</div>
    
    </form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('myscript'); ?>
	<script>
		$('.select2').select2({
			placeholder: "Select users",
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/admin/dashboard/admin/send_message.blade.php ENDPATH**/ ?>