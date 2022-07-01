
<?php $__env->startSection('title'); ?>
blog
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div class="mainBanner commonBanner blogBanner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="bannerLeft">
                            <h2 class="commonHeading">Blog</h2>
                            <p class="commonPara">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed<br> aliquam id nibh ut efficitur. Proin congue interdum lacus, sed<br> ornare augue viverra sit amet.</p>
                        </div>

                    </div>
                    <div class="col-lg-6" style="padding: 0px;">
                        <div class="bannerRight">
                            <img src="../../assets/img/blogBanner.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bolgSection">
            <div class="sortingDiv">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="selectDiv">
                                <p>Sort By</p>
                                <select name="" id="">
                                    <option value="Latest">Latest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="multiBlog">
                <div class="row">
                    <?php if(count($blogs) > 0): ?>
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4">
                        <div class="blogCard">
                            <a href="<?php echo e(route('all-blog',$blog->id)); ?>">
                            <img src="<?php echo e(asset('blogs/'.$blog->image)); ?>" alt="" class="img-fluid">
                            <div class="cardContent" style="color: #212529 !important">
                                <div class="date">
                                    <p><?php echo e(date('d M,Y', strtotime($blog->created_at))); ?></p>
                                </div>
                                <div style="color: #212529">
                                <h4><?php echo e($blog->title); ?></h4>
                                <?php echo e($blog->short_description); ?>

                                </div><br>
                                <a href="<?php echo e(route('all-blog',$blog->id)); ?>">Read More <img src="../../assets/img/sliderArrow.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <strong> No Blogs Created Yet </strong>
                    <?php endif; ?>
                </div>
            </div>
            <div class="paginationDiv">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="paginationList">
                                <ul>
                                    <li>
                                        <img src="../../assets/img/leftIcon.png" alt="">
                                    </li>
                                    <li>
                                        <a href="">1</a>
                                    </li>
                                    <li>
                                        <a href="">2</a>
                                    </li>
                                    <li>
                                        <a href="">3</a>
                                    </li>
                                    <li>
                                        <a href="">4</a>
                                    </li>
                                    <li>
                                        <a href="">5</a>
                                    </li>
                                    <li>
                                        <img src="../../assets/img/rightIcon.png" alt="">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="requestInformation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="informationContent">
                            <h2>Request Information</h2>
                            <div class="formDiv">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="inputDiv">
                                                <input type="text" name="first_name" id="first_name"
                                                    placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="inputDiv">
                                                <input type="text" name="last_name" id="last_name"
                                                    placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="inputDiv">
                                                <input type="text" name="email" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="inputDiv">
                                                <input type="text" name="phone" id="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="inputDiv">
                                                <textarea name="message" id="message" placeholder="Message" cols="30"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button>Submit Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="imgText">
                            <img src="../../assets/img/information.png" alt="" class="img-fluid">
                            <div class="imgTextMiddle">
                                <p>Legal Advice<br> Across the<br> Globe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/user/blogs.blade.php ENDPATH**/ ?>