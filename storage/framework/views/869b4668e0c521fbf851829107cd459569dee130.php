

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
					Inbox
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
			<table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_user">
				<thead>
					<tr>
						<th>No.</th>
						<th>From</th>
						<th>Company Name</th>
						<th>Email Address</th>
						<th>Received at</th>
						<th>Subject</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $count=0;?>

					<?php $__currentLoopData = $notif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($item->admin_delete ==0): ?>
						<?php $count++; ?>
						<tr class="<?php echo e(($item->status == 0) ? 'New' : ''); ?>">
							<td><?php echo e($count); ?></td>
							<td><?php echo e($item->name); ?></td>
							<td><?php echo e($item->company); ?></td>
							<td><?php echo e($item->email); ?></td>
							<td><?php echo e(date("d-M-Y H:i:sA", strtotime($item->created_at) )); ?></td>
							<td>

								<a data-id="<?php echo e($item->id); ?>" data-user="admin" class="read_it" title="View Message" href="#" data-toggle="modal" data-target="#view-notification-<?php echo e($item->id); ?>"> <?php echo e($item->subject); ?> </a>

								<div class="modal fade" id="view-notification-<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Message from <?php echo e($item->name); ?></h5>
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
													<a target="_blank" class="btn btn-secondary" href="<?php echo e($item->attachement); ?>">View Attachment</a>
													<?php endif; ?>
<button data-toggle="modal" data-target="#MessageModal-<?php echo e($item->id); ?>" type="button" class="btn btn-brand btn-elevate btn-icon-sm">Reply</button>
<button type="button" class="btn btn-secondary btn-elevate btn-icon-sm" data-dismiss="modal">Cancel</button>
													</div>
												</div>
											</div>
								</div>
								<!--Delete button-->


						</td>
							<td style="width:20%">
							<button data-id="<?php echo e($item->id); ?>" data-user="admin" data-toggle="modal" data-target="#MessageModal-<?php echo e($item->id); ?>" class="btn btn-brand btn-elevate btn-icon-sm read_it">
							Reply
						</button>
						<!--send--->
						<div class="modal fade" id="MessageModal-<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="MessageModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="MessageModal">Sending Message to <?php echo e($item->name); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="kt-form kt-form--label-right"  action="<?php echo e(route('sendNotifications')); ?>" enctype="multipart/form-data" method="POST">
				<?php echo csrf_field(); ?>
			<div class="modal-body">

					<div class="kt-portlet__body">
						<input type="hidden" name="userid" value="<?php echo e($item->user_id); ?>">
						<div class="form-group row">
							<div class="col-lg-12">
								<label for="title">Subject:</label>
								<input type="text" id="title" name="title" class="form-control" placeholder="Please enter Message Subject">
							</div>
							<div class="col-lg-12">
								<label for="name">Message:</label>
								<textarea name="message" id="message" cols="20" rows="5" class="form-control" placeholder="Please enter your Message"></textarea>
							</div>

							<div class="col-md-12">
								<label for="attachment">Attachment</label>
								<div class="kt-input-icon kt-input-icon--right">
								<input type="file" name="attachment" class="form-control" id="attachment">
								</div>
							</div>
							<div class="col-lg-2">
								<label for="">&nbsp;</label>
								<div class="kt-input-icon kt-input-icon--">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-8">

							</div>


						</div>

					</div>



			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
									<i class="fa fa-paper-plane"></i> &nbsp; Send </button>
			</div>
		</form>
		</div>
	</div>
</div>
		<!---send msg--->
		                <button data-id="<?php echo e($item->id); ?>" data-user="admin" data-toggle="modal" data-target="#MessagedeleteModal-<?php echo e($item->id); ?>" class="btn btn-brand btn-elevate btn-icon-sm read_it">
							Delete
						</button>
							<div class="modal fade" id="MessagedeleteModal-<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="MessageModal" aria-hidden="true">
                            	<div class="modal-dialog modal-lg" role="document">
                            		<div class="modal-content">
                            			<div class="modal-header">
                            				<h5 class="modal-title" id="MessageModal">Delete Message</h5>
                            				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            			</div>
                            			<form class="kt-form kt-form--label-right"  action="<?php echo e(route('deleteNotifications')); ?>"  method="POST">
                            				<?php echo csrf_field(); ?>
                            			<div class="modal-body">

                            					<div class="kt-portlet__body">
                            						<input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                            						<h3>Do you want to delete Message?</h3>
                            		         	</div>

                            			<div class="modal-footer">
                            				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            					<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                            									 &nbsp; Delete</button>
                            			</div>
                            		</form>
                            		</div>
                            	</div>
                            </div>

		            	</td>
						</tr>

					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				</tbody>
			</table>
			<!--end: Datatable -->
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/admin/dashboard/admin/receive_notifications.blade.php ENDPATH**/ ?>