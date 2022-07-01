<?php error_reporting(0);?>
<!-- Header -->
<header style="background-color: transparent;">
        <div class="userDiv">
            <div class="userProfile">
                <img src="<?php echo e(asset('assets/img/userIcon.svg')); ?>" alt="" class="img-fluid">
                <span class="downIcon">
                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </span>
                <div class="dropDownMenu">
                    <ul>
                        <?php if(Auth::user()->f_name): ?>
                        <li>
                            <span><?php echo e(Auth::user()->f_name); ?></span>
                        </li>
                        <div class="line"></div>
                        <!-- <li>
                            <img src="<?php echo e(asset('assets/img/myOrder.png')); ?>" alt="" class="img-fluid">
                            <span>
                                <a href="./order/index.html">My Orders</a>
                            </span>
                        </li> -->
                        <li>
                            <img src="<?php echo e(asset('assets/img/loginIcon.png')); ?>" alt="" class="img-fluid">
                            <span>
                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </span>
                        </li>
                        <?php else: ?>
                        <li>
                            <img src="<?php echo e(asset('assets/img/loginIcon.png')); ?>" alt="" class="img-fluid">
                            <span>
                                <a href="<?php echo e(route('login')); ?>">User Login</a>
                            </span>
                        </li>
                        <div class="line"></div>
                        <li>
                            <img src="<?php echo e(asset('assets/img/loginIcon.png')); ?>" alt="" class="img-fluid">
                            <span>
                                <a href="<?php echo e(route('lawyer-login')); ?>">Lawyer Login</a>
                            </span>
                        </li>
                        <div class="line"></div>
                        <!-- <li>
                            <img src="<?php echo e(asset('assets/img/myOrder.png')); ?>" alt="" class="img-fluid">
                            <span>
                                <a href="#">My Orders</a>
                            </span>
                        </li> -->
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/about-us')); ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/experts')); ?>">Experts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('services')); ?>">Services</a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Apply</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="<?php echo e(route('lawyer-register')); ?>">Apply as Lawyer </a>
                          <a class="dropdown-item" href="<?php echo e(route('register')); ?>">Apply as Client</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('all-blogs')); ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('contact-us')); ?>">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="<?php echo e(asset('assets/img/searchIcon.png')); ?>" alt="" class="img-fluid">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
<!-- /Header -->
<?php /**PATH C:\wamp64\www\expertgateway\resources\views/layout/partials/login_header.blade.php ENDPATH**/ ?>