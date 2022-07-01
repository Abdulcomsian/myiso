
<?php $__env->startSection('title'); ?>
Fixed Price Service
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Title</th>
                                <th class="min-w-125px">Price</th>
                                <th class="min-w-125px">Time</th>
                                <th class="min-w-125px">Image</th>
                                <th class="min-w-125px">Expertises</th>
                                <th class="min-w-125px">Status</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                            <!--begin::Table row-->
                            <?php if(count($fixed_services) > 0): ?>
                            <tr>
                                <?php $__currentLoopData = $fixed_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fixed_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo e($fixed_service->title); ?></td>
                                <td><?php echo e($fixed_service->price); ?></td>
                                <td><?php echo e($fixed_service->time_limit); ?></td>
                                <td><img src="<?php echo e(asset('fixed_service/'.$fixed_service->image)); ?>" width="100px" height="100px"></td>
                                <td><?php echo e($fixed_service->expertise->name); ?></td>

                                <td>
                                    <?php if($fixed_service->status == 1): ?> 
                                    <form action="<?php echo e(route('update-service-status', $fixed_service->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>                         
                                        <button type="submit" class="btn btn-success" name="status" value="0">Approved</button>
                                    </form>                    
                                    <?php elseif($fixed_service->status == 0): ?>
                                        <form action="<?php echo e(route('update-service-status', $fixed_service->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>                             
                                            <button type="submit" class="btn btn-danger" name="status" value="1">Pending</button>
                                        </form>
                                    <?php endif; ?>


                                </td>
                                <td class="text-end">

                                    <a href="<?php echo e(route('fixed_service.show',$fixed_service->id)); ?>" style="height: 33px; margin-left: 10px" class="btn btn-sm bg-warning edit-quiz"><i class="fa fa-eye"></i></a><br><br>

                                    <a href="<?php echo e(route('admin.edit-fixed-service',$fixed_service->id)); ?>" style="height: 33px; margin-left: 10px" class="btn btn-sm bg-primary edit-quiz"><i class="fa fa-edit"></i></a>
                                    
                                </td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
							<tr>
		                        <td colspan="3" style="text-align: center;"><strong> No Service Created By Any Lawyer</strong></td>
		                      </tr>
		                      <?php endif; ?>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content--> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin_panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/admin/fixed_service/index.blade.php ENDPATH**/ ?>