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
		color: #6d728b;
	}
	.AgreeUl{
		margin-left: 18px;
	}
	@media screen and (max-width: 1300px){
		.modal_btn{
			left:-10px !important;
		}
		#kt_login_forgot{
			font-size:14px !important;
		}
		#login_box{
			left: 10px;position: relative;
		}
	}
	@media screen and (max-width: 480px){
		#firstCheckoxDev{
			margin-top:30px !important;
        }
	}
	@media screen and (min-width: 1300px){
		#firstCheckboxDev{
			transform: translate(-10px,-46px);
		}
		.kt-form{
			width: 456px;
		}
		.form-check-label{
			font-size: 15px;
			cursor: pointer;
		}
		.form-check-label:hover{
			text-decoration: underline;
		}
		.agreeInput{
			margin-left: -2px !important;
			position: relative !important;
		}
	}
	/* this styling is for model btn */
	.modal_btn{
		color: #a7abc3 !important;
		font-size: 14px !important;
		font-weight: 300 !important;
		cursor: pointer;
	}
	.agreeInput{
		transform: scale(1.2);
	}
	.form-check-label{
		color: #6d728b;
		opacity: 1;
	}
	.form-check-label:hover {
		text-decoration: underline;
		cursor: pointer;
    	color: #5867dd
	}

	@media (max-width: 768px){
		.kt-login.kt-login--v4 .kt-login__wrapper .kt-login__container {
			width: 74% !important;
		}
		.img-fluid{
			width: 80%;
		}
	}

</style>
	@include('auth.includes.head')

	<!-- begin::Body -->
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background:#fff" >
				<!-- style="background-image: url(../assets/media/bg/bg-2.jpg);" -->
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="../assets/media/logos/MyISOOnline-Logo.png" class="img-fluid">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									{{-- <h3 class="kt-login__title">SignIn</h3> --}}
									{{-- To Admin --}}
								</div>
								
									@if($errors->any())
										<div class="alert" style="background: red !important;color:#fff !important;">
											{{ implode('', $errors->all(':message')) }}
										</div>
									@endif
								
								<form class="kt-form" method="POST" action="{{ route('login') }}">
									@csrf
									<div class="input-group">
										<input class="form-control @error('email') is-invalid @enderror" type="email"  placeholder="Email Address" name="email" autocomplete="off" value="{{ old('email') }}" required autocomplete="email" autofocus>
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									</div>
									<div class="d-flex justify-content-between kt-login__extra pl-0 ml-0 mt-3" style="" id="login_box">
										<div class="">

											<div class="form-check AgreeUl pl-0 ml-2 mt-4 d-flex align-items-center" id="firstCheckoxDev">
													<!-- Button trigger modal -->
													<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> -->
													<input class="form-check-input agreeInput mt-0 mr-1" id="firstCheckbox" type="checkbox" value="">
													<button type="button" class="btn p-0 modal_btn" data-toggle="modal" data-target="#exampleModal" style="position: absolute;left:10px;">
														<label class="form-check-label" style="width:300px;">
															I Agree to the Terms and Conditions.
														</label>
													</button>
		
												<!-- Modal -->
												</div>
										</div>
										<div class="">
											<a href="javascript:;" id="kt_login_forgot" style="font-size:15px;" class="kt-login__link">Forgot Password?</a>
										</div>
										
										

									</div>
									<div class="row kt-login__extra pl-0 ml-0 mt-3">
										<div class="col p-0">
											<!--<label class="kt-checkbox">-->
											<!--	<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me-->
											<!--	<span style="border: 1px solid #000;"></span>-->
											<!--</label>-->
											<!-- checkbox --> 
										
									<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-scrollable">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">ME FZE TERMS & CONDITIONS</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<h6>Agreement to Terms</h6>
												<p>This document governs your relationship with  Myisoonline™  JME FZE owns
													and   operates   this   website.   Access   to   and   use   of   this   website   and   the
													products   and   services   available   through   this   website   (collectively,   the
													"Services") are subject to the following terms, conditions, and notices (the
													"Terms   of   Service")   By   checking   the   "Terms   and   Conditions,"   you
													acknowledge that you understand and are agreeable with these Terms and
													Conditions. By using the Services, you agree to all the Terms of Service, as
													may   be   updated   by   us   from   time   to   time.   You   should   check   this   page
													regularly to take notice of any changes we may have made to the Terms of
													Service. We will not be liable if, for any reason, this Website is unavailable at
													any time or for any period. From time to time, we may restrict access to
													some parts or all this Website.</p>
												<h6>Prohibitions</h6>
												<p>You   must   not   misuse   this   Website.   You   will   not:   commit   or   encourage   a
													criminal offense; transmit or distribute a virus or any other material which is
													malicious, technologically harmful, in breach of confidence, or in any way
													offensive or obscene. Breaching this provision  would  constitute  a criminal
													offense,   and   JME   FZE   will   report   any   such   breach   to   the   relevant   law
													enforcement authorities and disclose your identity to them.</p>
													<h6>Intellectual Property, Software, and Content</h6>
													<p>The   intellectual   property   rights   in   all   software   and   content   (including
													photographic   images)   made   available   to   you   on   or   through   this   Website
													remains the property of JME FZE and are protected by copyright laws and
													treaties worldwide. You may store, print, and display the content supplied
													solely   for   personal   use.   You   are   not   permitted   to   publish,   manipulate,
													distribute,   or   otherwise   reproduce,   in   any   format,   any   of   the   content   or
													copies of the content supplied to you or which appears on this Website, nor
													may   you   use   any   such   content   in   connection   with   any   business   or
													commercial enterprise.</p>
													<h6>Terms of Service</h6>
													<p>We collaborate with outside Independent Auditors and Certification Bodies
													who can provide to users of Myisoonline™ ISO certification upon completion
													of a successful audit.  Myisoonline™ cannot award certificates to users as is
													not an Accreditation Body nor Certification Body. Each Myisoonline™ software license is valid for three years, subject to three
													successful annual audits. After purchasing our system and should you wish
													to gain ISO Certification, you must continue to use it and demonstrate usage
													by passing each annual audit; otherwise, your Certificate will be revoked. If
													your Certificate is revoked, Myisoonline will not be held responsible.</p>
													<h6>Returns</h6>
													<p>Since we deal in online certification and it's a digital service, we only offer a
													refund within 7 days during service purchase. We request you to check out
													the  demo video,   our  free  blogs,  or  chat  with our  agent, available  on  our
													Website.</p>
													<h6>Refunds (if applicable)</h6>
													<p>We don't accept refund claims. Due to the nature of digital products and
													services, we cannot honour refund claims after seven days.</p>
													<h6>Disclaimer of Liability</h6>
													<p>The material displayed on this Website is provided without any guarantees,
													conditions, or warranties regarding its accuracy. Unless expressly stated to
													the contrary to the fullest extent permitted by law JME FZE and its suppliers,
													content providers, and advertisers hereby expressly exclude all conditions,
													warranties, and other terms which might otherwise be implied by statute,
													common law, or the law of equity and shall not be liable for any damages
													whatsoever, including but without limitation to any direct, indirect, special,
													consequential, punitive or incidental damages, or damages for loss of use,
													profits, data or other intangibles, damage to goodwill or reputation, or the
													cost   of   procurement   of   substitute   goods   and   services,   arising   out   of   or
													related to the use, inability to use, performance or failures of this Website or
													the Linked Sites and any materials posted thereon, irrespective of whether
													such damages were foreseeable or arise in contract, tort, equity, restitution,
													by statute, at common law or otherwise.</p>
													<h6>Disclaimer as to ownership of trademarks, images of personalities,
													and third-party copyrigh</h6>
													<p>Except where expressly stated to the contrary, all persons (including their
													names   and   images),   third-party   trademarks   and   content,   services,   and
													locations   featured   on   this   Website   are   in   no   way   associated,   linked,   or
													affiliated with JME FZE, and you should not rely on the existence of such a
													connection   or   affiliation.   The   respective   trademark   owners   own   any trademarks/names featured on this Website. Where a trademark or brand
													name is referred to, it is used solely to describe or identify the products and
													services and is in no way an assertion that such products or services are
													endorsed by or connected to JME FZE. </p>
													<h6>Indemnity</h6>
													<p>You agree to indemnify, defend and hold harmless JME FZE, its directors,
													officers, employees, consultants, agents, and affiliates, from any third-party
													claims, liability, damages, and costs (including, but not limited to, legal fees)
													arising from your use this Website or your breach of the Terms of Service.</p>
													<h6>Variation</h6>
													<p>JME FZE shall have the right in its absolute discretion at any time and without
													notice to amend, remove or vary the Services and any page of this Website.</p>
													<h6>Invalidity</h6>
													<p>If any part of the Terms of Service is unenforceable (including any provision
													in which we exclude our liability to you), the enforceability of any other part
													of the Terms of Service will not be affected by all other clauses remaining in
													full force and effect. So far as possible, where any clause/sub-clause or part
													of a clause/sub-clause can be severed to render the remaining part valid, the
													clause   shall   be   interpreted   accordingly.   Alternatively,   you   agree   that   the
													clause shall be rectified and interpreted in a way that closely resembles the
													original meaning of the clause /sub-clause as permitted by law.</p>
													<h6>Governing Law/Jurisdiction</h6>
													<p>These terms and conditions and the transactions contemplated hereby shall
													be governed by, and construed and interpreted under, the laws of the United
													Arab Emirates. Any action seeking legal or equitable relief arising out of or
													relating to these Terms will be brought only in the courts of the United Arab
													Emirates.</p>
													<h6>Entire Agreement</h6>
													<p>The  above  Terms  of  Service  constitute   the  parties'   entire  agreement and
													supersede  any preceding and contemporaneous  agreements between you
													and JME FZE. Any waiver of any provision of the Terms of Service will be
													effective only if in writing and signed by a Director of JME FZE.</p>
													<h6>CONTACT US</h6>
													<p>If you have questions or comments about this Terms and Conditions, please
													get in touch with us at: <br>
													JME FZE, <br>
													UG13-A5, RAKEZ Amenity Center. <br>
													Al Hamra Industrial Zone-FZ, <br>
													United Arab Emirates. <br>
													[Email]</p>
													<!-- <div class="ml-2">
															<input class="form-check-input agreeInput" type="checkbox" value="" id="TermConditions">
															<label class="form-check-label" for="TermConditions">
																	I agree to the Terms and Conditions.
															</label>
													</div> -->
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
											</div>
										</div>
									</div>
										<!-- checkbox -->
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
										<input  placeholder="Email Address"  autocomplete="off" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
								<form class="kt-form" action="{{ route('password.reset.email') }}" method="POST">
									@csrf
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Email Address" name="email" id="kt_email" autocomplete="off">
									</div>
									<div class="kt-login__actions">
										{{-- <button>g</button> --}}
{{--										<button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary" type='submit'>Submit</button>&nbsp;&nbsp;--}}
										<button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary" type='submit'>Submit</button>&nbsp;&nbsp;
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
		// jkjkj


	$('#firstCheckbox').on("change",function(){
			// $('#firstCheckbox').prop('checked', false);
			if(this.checked){
				document.querySelector('#SignIN').removeAttribute('disabled');
			}else{
				document.querySelector('#SignIN').setAttribute('disabled', '');
			}
		});

	//   document.querySelector('#TermConditions').addEventListener('change', function(e) {
	// 	if(document.querySelector('#TermConditions').checked){
	// 		// remove disabled attributes
	// 		document.querySelector('#SignIN').removeAttribute('disabled');
	// 		// checked the checkbox in jquery
	// 		$('.agreeInput').prop('checked', true);
	// 	}else{
	// 		$('.agreeInput').prop('checked', false);
	// 		document.querySelector('#SignIN').setAttribute('disabled', '');
	// 	}
	//   })

	 



	</script>
	<!-- end::Body -->


</html>
