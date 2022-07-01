
<?php $__env->startSection('title'); ?>
Blog
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<main>
    <div class="profileDiv fixedDiv">
        <div class="mainFixedService">
            <h5>Blog</h5>
            <div class="createFixedService createBlog">
                <h4>Create a new post</h4>
                <div class="formDiv">
                    <form action="<?php echo e(route('blog.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="inputDiv">
                                    <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>"  placeholder="Title" style="border:1px solid #d9d9d9;">
                                    <div style="color:red;"><?php echo e($errors->first('title')); ?></div> <br>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="inputDiv uploadDiv">
                                    <input type="file" name="image" id="image" accept="image/*">
                                    <p>Upload Blog Image</p>
                                    <div style="color:red;"><?php echo e($errors->first('image')); ?></div> <br>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group inputDiv">
                                    <select name="expertise_id" id="expertise_id">
                                        <option> Select Category</option>
                                        <?php $__currentLoopData = $expertises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($expertise->id); ?>"><?php echo e($expertise->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div style="color:red;"><?php echo e($errors->first('expertise_id')); ?></div> <br>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="inputDiv">
                                    <textarea name="short_description" id="short_description" cols="20" rows="5" style="border:1px solid #d9d9d9;" 
                                        placeholder="Short Description"></textarea>
                                        <div style="color:red;"><?php echo e($errors->first('short_description')); ?></div> <br>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="aboutProfile">
                            <textarea class="form-control" id="editor" name="description"></textarea>
                            <div style="color:red;"><?php echo e($errors->first('description')); ?></div> <br>
                        </div>
                            </div>
                        </div>
                        <button style="margin: 0px !important;" class="formBtn">Post</button>
                    </form>
                </div>
            </div>
            <div class="bolgSection">
                <div class="multiBlog">
                    <h4 class="commonHeading text-center">My blog posts</h4>
                    <div class="row">
                        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4">
                            <div class="blogCard">
                                <img src="<?php echo e(asset('blogs/'.$blog->image)); ?>" style="height:213px; width: 347px;" alt="" class="img-fluid">
                                <div class="row cardContent">
                                    <div class="date col-lg-5">
                                        <p><?php echo e(date('d M,Y', strtotime($blog->created_at))); ?></p>
                                    </div>
                                    <div class=" col-lg-1"></div>
                                    
                                    <?php if($blog->status == 1): ?>
                                    <div class="date btn btn-success col-lg-5">
                                        <p style="color:white;">Approved</p>
                                    </div>
                                    <?php else: ?>
                                    <div class="date btn btn-danger col-lg-5">
                                        <p style="color:white;">Pending</p>
                                    </div>
                                    <?php endif; ?>

                                    <h4><?php echo e($blog->title); ?></h4>
                                    <p class="short_description"><?php echo e($blog->short_description); ?></p>
                                    <a href="<?php echo e(route('lawyer.blog',$blog->id)); ?>">Read More <img src="<?php echo e(asset('assets/img/sliderArrow.png')); ?>" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        ClassicEditor.create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/blogs/add_blog.blade.php ENDPATH**/ ?>