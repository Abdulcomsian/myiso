

<?php $__env->startSection('content'); ?>

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
					Sent
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

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Subject</th>
						<td>Sent at</td>
						<th>Message</th>
						
					</tr>
				</thead>
				<tbody>

					<?php $count=0;?>
					<?php $__currentLoopData = $message_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					
						<?php $count++; ?>
						<tr>
							<td><?php echo e($count); ?></td>
							<td><?php echo e($item->subject); ?></td>
							<td><?php echo e(date("d-M-Y H:i:sA", strtotime($item->created_at) )); ?></td>
							<td>
							<a href="#" data-toggle="modal" data-target="#view-notification-<?php echo e($item->id); ?>" title="View Message"> View Message </a>
								
<div class="modal fade" id="view-notification-<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Message To Admin</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														</button>
													</div>
													<div class="modal-body">
														<h5><?php echo e($item->subject); ?></h5>
														<p>&nbsp;</p>
														<p><?php echo e($item->comments); ?></p>
													</div>
													<div class="modal-footer">								
													<?php if($item->attachement != NULL || $item->attachement): ?>
													<a target="_blank" href="<?php echo e($item->attachement); ?>">View Attachment</a>
													<?php endif; ?>
													
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															
													</div>
												</div>
											</div>
										</div>			
							
							</td>
							
							
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</tbody>
			</table>
			<!--end: Datatable -->
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/dashboard/users_messages.blade.php ENDPATH**/ ?>