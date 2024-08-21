	<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="{{ url('/home')}}">
					{{-- {{Auth::user()->profile_image}} --}}
					<img alt="Logo" src="{{Auth::user()->profile_image}}" width="120"/>

				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->
						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
								<ul class="kt-menu__nav ">
									<li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active"><a href="{{ url('/home')}}" class="kt-menu__link"><span class="kt-menu__link-text">My ISO Online</span></a>
										<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
											
										</div>
									</li>
									<!--<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">DashBoard</span></a>-->
									<!--</li>-->
									{{-- <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Home</span></a>
									</li> --}}
								</ul>
							</div>
						</div>

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">

							<!--begin: Search -->

							<!--begin: Search -->
							<div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
									<div class="kt-quick-search kt-quick-search--inline" id="kt_quick_search_inline">
										<form method="get" class="kt-quick-search__form">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
												<input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
												<div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
											</div>
										</form>
										<div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
										</div>
									</div>
								</div>
							</div>

							<!--end: Search -->

							<!--end: Search -->

							
							
							<div class="kt-header__topbar-item dropdown">
								<div class="kt-header__topbar-wrapper" data-offset="30px,0px" aria-expanded="true">
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
										
										@if (Auth::user()->member_scaiso==1)
										<span class="kt-subheader__desc"><img src="{{asset('assets/media/logos/caiso.jpeg')}}" width="180px"> </span>	
										@endif
									
									</span>

           
								</div>
								
							</div>
							

							<!--end: Notifications -->


							<!--begin: My Cart -->
							<div class="kt-header__topbar-item ">
								<a href="{{route('userprofile') }}">
								<div class="kt-header__topbar-wrapper">
										<span class="kt-header__topbar-icon my_account_text">
											My Account
										 </span>
									
								</div>
							</a>
								
							</div>

							<!--end: My Cart -->


							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										{{-- <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span> --}}
										<span class="kt-header__topbar-username kt-hidden-mobile">Sign Out</span>
										<img class="kt-hidden" alt="Pic" src="../assets/media/users/300_25.jpg" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<!--<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>-->
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

									<!--begin: Head -->
									<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(../assets/media/misc/bg-1.jpg)">
										<div class="kt-user-card__avatar">
											<img class="kt-hidden" alt="Pic" src="{{ asset(Auth::user()->user_image) }}" />

											<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
											<!--<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>-->
										</div>
										<div class="kt-user-card__name">
											{{ Auth::user()->name }}
										</div>
										
									</div>

									<!--end: Head -->

									<!--begin: Navigation -->
									<div class="kt-notification">
					<div class="kt-notification__custom">
					<form action="{{route('logout')}}" method="GET">
					<input type="submit" class="btn btn-label-brand btn-sm btn-bold" value="Sign Out">
					</form>

											{{-- <a href="custom_user_login-v2.html" target="_blank" class="btn btn-label-brand btn-sm btn-bold">Sign Out</a> --}}
											
										</div>
									</div>

									<!--end: Navigation -->
								</div>
							</div>

							<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

						<!-- begin:: Content Head -->
						<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-subheader__main">
								<h3 class="kt-subheader__title">{{Auth::user()->company_name}}</h3>
								<span class="kt-subheader__separator kt-subheader__separator--v"></span>
								<span class="kt-subheader__desc"><b>Company ID:</b> {{Auth::user()->order_number}} </span>
								{{-- @if (Auth::user()->member_scaiso==1)
								<span class="kt-subheader__desc"><img src="{{asset('assets/media/logos/caiso.jpeg')}}" width="150px"> </span>	
								@endif --}}
								
								<div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
									<input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
									<span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span><i class="flaticon2-search-1"></i></span>
									</span>
								</div>
							</div>
							<div class="kt-subheader__toolbar">
								<div class="kt-subheader__wrapper">
									<span class="kt-subheader__separator kt-subheader__separator--v">
										<p class="kt-subheader__title">
										    <b>Expiry Date:</b>
												@php
												$iso9001 = Auth::user()->iso9001_expirydate;
												$iso14001 = Auth::user()->iso14001_expirydate;
												$iso45001 = Auth::user()->iso45001_expirydate;

												$x = strtotime($iso9001);
												$y = strtotime($iso14001);
												$z = strtotime($iso45001);

												if ($iso9001 == null && $iso14001 == null && $iso45001 == null) {
													$minValue = date('d/m/Y', strtotime('+3 years'));
												} else if ($iso9001 != null && $iso14001 == null && $iso45001 == null) {
													$minValue = $x;
													$minValue = date('d/m/Y', $minValue);
												} else if ($iso9001 == null && $iso14001 != null && $iso45001 == null) {
													$minValue = $y;
													$minValue = date('d/m/Y', $minValue);
												} else if ($iso9001 == null && $iso14001 == null && $iso45001 != null) {
													$minValue = $z;
													$minValue = date('d/m/Y', $minValue);
												} else if ($iso9001 != null && $iso14001 != null && $iso45001 == null) {
													$minValue = min($x, $y);
													$minValue = date('d/m/Y', $minValue);
												} else if ($iso9001 != null && $iso14001 == null && $iso45001 != null) {
													$minValue = min($x, $z);
													$minValue = date('d/m/Y', $minValue);
												} else if ($iso9001 == null && $iso14001 != null && $iso45001 != null) {
													$minValue = min($y, $z);
													$minValue = date('d/m/Y', $minValue);
												} else {
													$minValue = min($x, min($y, $z));
													$minValue = date('d/m/Y', $minValue);
												}
												@endphp
										    {{ $minValue }}
{{--  @if(Auth::user()->iso9001_expirydate)										    -->
  <!--{{ date('d/m/Y', strtotime(Auth::user()->iso9001_expirydate)) }}-->
  <!--{{ date('d/m/Y', $minValue) }}-->
<!--    {{ $minValue }}-->
<!--  @else-->
<!--  @php -->
<!--  $cus_date = strtotime('+3 years', strtotime(Auth::user()->created_at));-->
<!--   $new_date = date('d/m/Y', $cus_date);-->
<!--   echo $new_date;-->
<!--@endphp-->
<!--  @endif--> --}}
  </p>
									</span>
								</div>
							</div>
						</div>

						<!-- end:: Content Head -->



						<!-- end:: Content -->
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->
