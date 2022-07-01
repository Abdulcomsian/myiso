
<?php $__env->startSection('title'); ?>
Fix Price Service
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<main>
    <div class="profileDiv fixedDiv">
        <h5>Fixed Services</h5>
        <div class="fixedServiceDiv">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner">
                        <img src="<?php echo e(asset('fixed_service/'.$fixed_service->image)); ?>" alt="" style="width:1106px; height:399px;" class="img-fluid">
                        <div class="tagLine">
                            <div class="textDiv">
                                <p><?php echo e($fixed_service->title); ?></p>
                                <span><?php echo e($fixed_service->expertise->name); ?></span>
                            </div>
                            <div class="priceText">
                                <h4><?php echo e($fixed_service->price); ?> <span>USD</span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="operationDiv">
                        <p>30 Fixed Services Sold</p>
                        <div class="multiOption">
                            <span>
                                <?php if($fixed_service->status == 0): ?>
                                Pending
                                <?php else: ?>
                                Active
                                <?php endif; ?>
                            </span>
                            <a href="<?php echo e(route('lawyer.edit-fixed-service',$fixed_service->id)); ?>"><button style="cursor: pointer;border-color: transparent;">
                                <span>Edit</span>
                            </button></a>
                        </div>
                    </div>
                    <div class="contentDiv"><br>
                        <p>Time: <?php echo e($fixed_service->time_limit); ?></p>
                        <div class="line">
                            <img src="../../assets/img/line.png" alt="" class="img-fluid">
                        </div>
                        <h4>SERVICE DESCRIPTION</h4>
                        <?php echo $fixed_service->description; ?>

                        <div class="line">
                            <img src="../../assets/img/line.png" alt="" class="img-fluid">
                        </div>
                        <h4>WHAT’S INCLUDED</h4>
                        <?php echo $fixed_service->included; ?>

                        <div class="line">
                            <img src="../../assets/img/line.png" alt="" class="img-fluid">
                        </div>
                        <h4>WHAT’S NOT INCLUDED</h4>
                        <?php echo $fixed_service->not_included; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/fixed_service/detail.blade.php ENDPATH**/ ?>