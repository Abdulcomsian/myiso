
<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div class="profileDiv fixedDiv commonCard">
            <div class="mainFixedService">
                <h5>Blog</h5>
                <div class="blogDetailCard">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <img src="<?php echo e(asset('blogs/'.$blog->image)); ?>" style="height:375px !important;" alt="" class="img-fluid">
                                    <div class="cardContent">
                                        <div class="dateLikeDiv">
                                            <div class="dateLike">
                                                <p class="date"><?php echo e(date('d M,Y', strtotime($blog->created_at))); ?></p> <span><i style="color: #ED2456;" class="fa fa-heart" aria-hidden="true"></i> 1,556
                                                    Likes</span>
                                            </div>
                                            <div class="editDiv">
                                                <p>Edit</p>
                                            </div>
                                        </div>
                                        <p class="postedBy">Posted by <b><?php echo e(Auth::user()->name); ?></b></p>
                                        <h4><?php echo e($blog->title); ?></h4>
                                        <?php echo $blog->description; ?>

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

<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/blog.blade.php ENDPATH**/ ?>