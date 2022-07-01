
<?php $__env->startSection('title'); ?>
Fixed Price Service
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<main>
    <div class="fixedFreeDetail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profileDiv fixedDiv">
                        <h5>Fixed Services</h5>
                        <div class="fixedServiceDiv">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner">
                                        <img src="<?php echo e(asset('fixed_service/'.$fixed_service->image)); ?>" alt="" style="width:1106px; height:399px;" class="img-fluid">
                                        <div class="tagLine">
                                            <div class="textDiv">
                                                <p><?php echo e($fixed_service->title); ?>

                                                </p>
                                                <span><?php echo e($fixed_service->expertise->name); ?></span>
                                            </div>
                                            <div class="priceText">
                                                <h4><?php echo e($fixed_service->price); ?> <span>USD</span></h4>
                                            </div>
                                        </div>
                                    </div><br>
                                    <!-- <div class="operationDiv">
                                        <p>30 Fixed Services Sold</p>
                                        
                                    </div> -->
                                    <div class="contentDiv">
                                        
                                        <p>Time: <?php echo e($fixed_service->time_limit); ?></p>
                                        <div class="line">
                                            <img src="../assets/img/line.png" alt="" class="img-fluid">
                                        </div>
                                        <h4>SERVICE DESCRIPTION</h4>
                                        <?php echo $fixed_service->description; ?>

                                        <div class="line">
                                            <img src="../assets/img/line.png" alt="" class="img-fluid">
                                        </div>
                                        <h4>WHAT’S INCLUDED</h4>
                                        <?php echo $fixed_service->included; ?>

                                        <div class="line">
                                            <img src="../assets/img/line.png" alt="" class="img-fluid">
                                        </div>
                                        <h4>WHAT’S NOT INCLUDED</h4>
                                        <?php echo $fixed_service->not_included; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3">
                    <div class="buyServiceDiv">
                        <div class="header">
                            <p>Buy Service from</p>
                        </div>
                        <div class="contentDiv">
                            <ul>
                                <li>
                                    <div class="userDetail">
                                        <img src="../assets/img/client1.png" alt="" class="img-fluid">
                                        <div class="nameDesignation">
                                            <h4>Aaron Bourke</h4>
                                            <p>King & Wood Mallesons</p>
                                        </div>
                                    </div>
                                    <div class="priceDiv">
                                        <h4>28 <span>USD</span></h4>
                                    </div>
                                </li>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <li>
                                    <div class="userDetail">
                                        <img src="../assets/img/client3.png" alt="" class="img-fluid">
                                        <div class="nameDesignation">
                                            <h4>Aaron Bourke</h4>
                                            <p>King & Wood Mallesons</p>
                                        </div>
                                    </div>
                                    <div class="priceDiv">
                                        <h4>28 <span>USD</span></h4>
                                    </div>
                                </li>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <li>
                                    <div class="userDetail">
                                        <img src="../assets/img/client1.png" alt="" class="img-fluid">
                                        <div class="nameDesignation">
                                            <h4>Aaron Bourke</h4>
                                            <p>King & Wood Mallesons</p>
                                        </div>
                                    </div>
                                    <div class="priceDiv">
                                        <h4>28 <span>USD</span></h4>
                                    </div>
                                </li>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <li>
                                    <div class="userDetail">
                                        <img src="../assets/img/client2.png" alt="" class="img-fluid">
                                        <div class="nameDesignation">
                                            <h4>Aaron Bourke</h4>
                                            <p>King & Wood Mallesons</p>
                                        </div>
                                    </div>
                                    <div class="priceDiv">
                                        <h4>28 <span>USD</span></h4>
                                    </div>
                                </li>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <li>
                                    <div class="userDetail">
                                        <img src="../assets/img/client3.png" alt="" class="img-fluid">
                                        <div class="nameDesignation">
                                            <h4>Aaron Bourke</h4>
                                            <p>King & Wood Mallesons</p>
                                        </div>
                                    </div>
                                    <div class="priceDiv">
                                        <h4>28 <span>USD</span></h4>
                                    </div>
                                </li>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <li>
                                    <div class="userDetail">
                                        <img src="../assets/img/client2.png" alt="" class="img-fluid">
                                        <div class="nameDesignation">
                                            <h4>Aaron Bourke</h4>
                                            <p>King & Wood Mallesons</p>
                                        </div>
                                    </div>
                                    <div class="priceDiv">
                                        <h4>28 <span>USD</span></h4>
                                    </div>
                                </li>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/frontend/fixed_service/detail.blade.php ENDPATH**/ ?>