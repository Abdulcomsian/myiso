<?php error_reporting(0);?>
<!-- Loader -->
<?php if(Route::is(['map-grid','map-list'])): ?>
<div id="loader">
		<div class="loader">
			<span></span>
			<span></span>
		</div>
	</div>
	<?php endif; ?>
	<!-- /Loader  -->
	<!-- Header -->
	<header class="profileHeader">
        <div class="userDiv">
            <div class="userProfile">
                <img src="<?php echo e(asset('assets/img/userIcon.svg')); ?>" alt="" class="img-fluid">
                <span class="downIcon">
                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </span>
                <div class="dropDownMenu">
                    <ul>
                    	<li>
                        	<span><?php echo e(Auth::user()->name); ?></span>
                        </li>
                        <div class="line"></div>
                        <li>
                            <img src="<?php echo e(asset('assets/img/myOrder.png')); ?>" alt="" class="img-fluid">
                            <span>
                                <a href="<?php echo e(route('lawyer.orders')); ?>">My Orders</a>
                            </span>
                        </li>
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
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="<?php echo e(url('/lawyer/profile')); ?>">
                <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <?php if($lawyer->status == '1'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('lawyer.profile')); ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('create.blog')); ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./earning.html">Earnings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('lawyer.fixed-service')); ?>">Fixed Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./publicQuestion.html">Public Questions & Call Requests</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <!-- <div class="subHeader">
            <nav class="navbar navbar-expand-md">

               
            </nav>
        </div> -->
    </header>
<div class="main-wrapper position-relative">
    <div class="pre_loader">
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
          </div>
    </div>
<?php /**PATH C:\wamp64\www\expertgateway\resources\views/layout/partials/lawyer_header.blade.php ENDPATH**/ ?>