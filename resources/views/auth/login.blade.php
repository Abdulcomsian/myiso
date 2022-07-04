<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->

<html lang="en">
<style>
    .kt-checkbox > input:checked ~ span {
    border: 1px solid #000;
}
.kt-checkbox > span:after {
    border: 1px solid black;
}
button['disabled']{
	cursor: disable;
}
#TermConditions{
	transform: scale(1.2);
}
label[for="TermConditions"]{
	margin-left: 6px;
	font-size:15px;
}
#kt_login_forgot{
	color: #a7abc3;
}
</style>
	@include('auth.includes.head')

	<!-- begin::Body -->
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(../assets/media/bg/bg-2.jpg);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="../assets/media/logos/logo-5.png" class="img-fluid">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									{{-- <h3 class="kt-login__title">SignIn</h3> --}}
									{{-- To Admin --}}
								</div>
								<form class="kt-form" method="POST" action="{{ route('login') }}">
									@csrf
									<div class="input-group">
										<input class="form-control @error('email') is-invalid @enderror" type="email"  placeholder="Email address" name="email" autocomplete="off" value="{{ old('email') }}" required autocomplete="email" autofocus>
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									</div>
									<div class="row kt-login__extra pl-0 ml-0 mt-3">
										<div class="col p-0">
											<!--<label class="kt-checkbox">-->
											<!--	<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me-->
											<!--	<span style="border: 1px solid #000;"></span>-->
											<!--</label>-->
											<!-- checkbox -->
										<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="TermConditions">
										<label class="form-check-label" for="TermConditions">
											I agree to the terms and conditions.
										</label>
										</div>
										<!-- checkbox -->
										</div>
										<div class="col kt-align-right">
											<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forgot Password?</a>
										</div>
										
										

									</div>
									<div class="kt-login__actions">
										{{-- id="kt_login_signin_submit"  --}}
										<button type="submit" class="btn btn-brand btn-pill kt-login__btn-primary" id="SignIN" disabled>Sign In</button>
									</div>
								</form>
							</div>
							<div class="kt-login__signup">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign Up</h3>
									<div class="kt-login__desc">Enter your details to create your account:</div>
								</div>
								<form class="kt-form" method="POST" action="{{ route('register') }}">
									 @csrf
									<div class="input-group">
										<input placeholder="Fullname" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
									</div>
									<div class="input-group">
										<input  placeholder="Email address"  autocomplete="off" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
									</div>
									<div class="input-group">
										<input  type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation">
									</div>
									<div class="row kt-login__extra">
										<div class="col kt-align-left">
											<label class="kt-checkbox">
												<input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
												<span></span>
											</label>
											<span class="form-text text-muted"></span>
										</div>
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signup_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;
										<button id="kt_login_signup_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
									</div>
								</form>
							</div>
							<div class="kt-login__forgot">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Forgot Password?</h3>
									<div class="kt-login__desc" style="color: #6a6f74;
								">Enter your email address to reset your password.</div>
								</div>
								<form class="kt-form" action="{{ route('password.email') }}" method="POST">
									@csrf
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Email address" name="email" id="kt_email" autocomplete="off">
									</div> 
									<div class="kt-login__actions">
										{{-- <button>g</button> --}}
										<button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary" type='submit'>Send me the link</button>&nbsp;&nbsp;
										<button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
									</div>
								</form>
							</div>
							{{-- <div class="kt-login__account">
								<span class="kt-login__account-msg">
									Don't have an account yet ?
								</span>
								&nbsp;&nbsp;
								<a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->
		@include('auth.includes.foot')
		
	</body>

	<script>
	  document.querySelector('#TermConditions').addEventListener('change', function(e) {
		if(document.querySelector('#TermConditions').checked){
			// remove disabled attributes
			document.querySelector('#SignIN').removeAttribute('disabled');
		}else{
			document.querySelector('#SignIN').setAttribute('disabled', '');
		}
	  })
	</script>
	<!-- end::Body -->


</html>
