
<?php $__env->startSection('title'); ?>
My Orders
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div class="orderSection">
            <div class="tabDiv">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-pills">
                                <li class="active"><a data-toggle="pill" href="#new_order">New Orders</a></li>
                                <li><a data-toggle="pill" href="#current_order">Current Orders</a></li>
                                <li><a data-toggle="pill" href="#completed">Completed</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabContent">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content">
                                <div id="new_order" class="tab-pane fade in active show">
                                   <div class="orderBox">
                                       <div class="orderHeader">
                                           <p class="newOrder">New Order</p>
                                           <p>Total <br><span>$28</span></p>
                                           <p>Placed On <br><span>27 Dec 2021</span></p>
                                           <p>Order Number <br><span>100918282</span></p>
                                       </div>
                                       <div class="orderContent">
                                           <div class="row">
                                               <div class="col-lg-8">
                                                   <span>Fixed-fee legal services</span>
                                                   <h4>15-minute business advice session on setting up in the <br> UAE</h4>
                                                   <span class="tag">Business</span>
                                                   <hr>
                                                   <div class="orderDescription">
                                                       <span>Order Description</span>
                                                       <p>Hfn pulvinar augue ac urna tristique viverra. Aliquam eu sce lerisque orci. Integer maximus sapien ac erat euismod lacin ia. Maecenas dui leo, auctor eu neqafue vel, aliqufet finibuas odio. Pellentesque efficitur volutpat ex a blandit. Sed vestibu lum pharetra ex id feugiat.</p>
                                                   </div>
                                               </div>
                                               <div class="col-lg-4">
                                                   <div class="postedBy">
                                                       <p>Placed By</p>
                                                       <div class="userDiv">
                                                           <img src="../../assets/img/client1.png" alt="" class="img-fluid">
                                                           <p>John Doe <br><span>UAE, Dubai</span></p>
                                                       </div>
                                                   </div>
                                                   <div class="multiBtn">
                                                       <button class="acceptBtn">ACCEPT</button>
                                                       <button>DECLINE</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="orderBox">
                                    <div class="orderHeader">
                                        <p class="newOrder">New Order</p>
                                        <p>Total <br><span>$28</span></p>
                                        <p>Placed On <br><span>27 Dec 2021</span></p>
                                        <p>Order Number <br><span>100918282</span></p>
                                    </div>
                                    <div class="orderContent">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <span>Fixed-fee legal services</span>
                                                <h4>15-minute business advice session on setting up in the <br> UAE</h4>
                                                <span class="tag">Business</span>
                                                <hr>
                                                <div class="orderDescription">
                                                    <span>Order Description</span>
                                                    <p>Hfn pulvinar augue ac urna tristique viverra. Aliquam eu sce lerisque orci. Integer maximus sapien ac erat euismod lacin ia. Maecenas dui leo, auctor eu neqafue vel, aliqufet finibuas odio. Pellentesque efficitur volutpat ex a blandit. Sed vestibu lum pharetra ex id feugiat.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="postedBy">
                                                    <p>Placed By</p>
                                                    <div class="userDiv">
                                                        <img src="../../assets/img/client1.png" alt="" class="img-fluid">
                                                        <p>John Doe <br><span>UAE, Dubai</span></p>
                                                    </div>
                                                </div>
                                                <div class="multiBtn">
                                                    <button class="acceptBtn">ACCEPT</button>
                                                    <button>DECLINE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div id="current_order" class="tab-pane fade">
                                    <div class="orderBox">
                                        <div class="orderHeader">
                                            <p>Total <br><span>$28</span></p>
                                            <p>Placed On <br><span>27 Dec 2021</span></p>
                                            <p>Order Number <br><span>100918282</span></p>
                                        </div>
                                        <div class="orderContent">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <span>Fixed-fee legal services</span>
                                                    <h4>15-minute business advice session on setting up in the <br> UAE</h4>
                                                    <span class="tag">Business</span>
                                                    <hr>
                                                    <div class="orderDescription">
                                                        <span>Order Description</span>
                                                        <p>Hfn pulvinar augue ac urna tristique viverra. Aliquam eu sce lerisque orci. Integer maximus sapien ac erat euismod lacin ia. Maecenas dui leo, auctor eu neqafue vel, aliqufet finibuas odio. Pellentesque efficitur volutpat ex a blandit. Sed vestibu lum pharetra ex id feugiat.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="postedBy">
                                                        <p>Placed By</p>
                                                        <div class="userDiv">
                                                            <img src="../../assets/img/client1.png" alt="" class="img-fluid">
                                                            <p>John Doe <br><span>UAE, Dubai</span></p>
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                                <a href="">amy.doe@gmail.com</a>
                                                            </li>
                                                            <li>
                                                                <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                                <a href=""> +971 9656 79773</a>
                                                            </li>
                                                        </ul>
                                                        <p class="chatText"><img src="../../assets/img/chatIcon.svg" alt="" class="img-fluid"> CHAT</p>
                                                        <button class="markedCompleted">MARK AS COMPLETE</button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="orderBox">
                                        <div class="orderHeader">
                                            <p>Total <br><span>$28</span></p>
                                            <p>Placed On <br><span>27 Dec 2021</span></p>
                                            <p>Order Number <br><span>100918282</span></p>
                                        </div>
                                        <div class="orderContent">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <span>Fixed-fee legal services</span>
                                                    <h4>15-minute business advice session on setting up in the <br> UAE</h4>
                                                    <span class="tag">Business</span>
                                                    <hr>
                                                    <div class="orderDescription">
                                                        <span>Order Description</span>
                                                        <p>Hfn pulvinar augue ac urna tristique viverra. Aliquam eu sce lerisque orci. Integer maximus sapien ac erat euismod lacin ia. Maecenas dui leo, auctor eu neqafue vel, aliqufet finibuas odio. Pellentesque efficitur volutpat ex a blandit. Sed vestibu lum pharetra ex id feugiat.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="postedBy">
                                                        <p>Placed By</p>
                                                        <div class="userDiv">
                                                            <img src="../../assets/img/client1.png" alt="" class="img-fluid">
                                                            <p>John Doe <br><span>UAE, Dubai</span></p>
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                                <a href="">amy.doe@gmail.com</a>
                                                            </li>
                                                            <li>
                                                                <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                                <a href=""> +971 9656 79773</a>
                                                            </li>
                                                        </ul>
                                                        <p class="chatText"><img src="../../assets/img/chatIcon.svg" alt="" class="img-fluid"> CHAT</p>
                                                        <button class="markedCompleted">MARK AS COMPLETE</button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="completed" class="tab-pane fade">
                                    <div class="orderBox">
                                        <div class="orderHeader">
                                            <p class="newOrder">Completed</p>
                                            <p>Total <br><span>$28</span></p>
                                            <p>Placed On <br><span>27 Dec 2021</span></p>
                                            <p>Order Number <br><span>100918282</span></p>
                                        </div>
                                        <div class="orderContent">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <span>Fixed-fee legal services</span>
                                                    <h4>15-minute business advice session on setting up in the <br> UAE</h4>
                                                    <span class="tag">Business</span>
                                                    <hr>
                                                    <div class="orderDescription">
                                                        <span>Order Description</span>
                                                        <p>Hfn pulvinar augue ac urna tristique viverra. Aliquam eu sce lerisque orci. Integer maximus sapien ac erat euismod lacin ia. Maecenas dui leo, auctor eu neqafue vel, aliqufet finibuas odio. Pellentesque efficitur volutpat ex a blandit. Sed vestibu lum pharetra ex id feugiat.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="postedBy">
                                                        <p>Placed By</p>
                                                        <div class="userDiv">
                                                            <img src="../../assets/img/client1.png" alt="" class="img-fluid">
                                                            <p>John Doe <br><span>UAE, Dubai</span></p>
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                                <a href="">amy.doe@gmail.com</a>
                                                            </li>
                                                            <li>
                                                                <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                                <a href=""> +971 9656 79773</a>
                                                            </li>
                                                        </ul>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/order/index.blade.php ENDPATH**/ ?>