<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>SCAISO - TAQEEM | ISO Portal</title> --}}
	<title>MyISOOnline.com</title>
    <meta name="description" content="Tailwind CSS Saas HTML Template Is A Multi Purpose Landing Page Template, Corporate, Authentication, Launching Web, Agency or Business Startup, Clean, Modern, Creative, Multipurpose and Tailwind CSS Tailwind v3 etc."/>
    <meta name="author" content="Zoyothemes"/>
    <!-- Main Css -->
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <link href="{{asset("assets/style.css")}}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- =========== Main Section Start =========== -->
    <section class="relative h-screen w-full flex items-center justify-center bg-[conic-gradient(at_top_right,_var(--tw-gradient-stops))] from-[#ccf9df] to-[#d1d6ff]">
        <div class="relative max-w-lg md:mx-auto mx-6 w-full flex flex-col justify-center bg-white rounded-lg p-6">
            <div class="text-start mb-7">
                <a href="#" class="grow block mb-8">
                     <img class=" mx-auto" src="{{asset("/assets/media/logos/MyISOOnline-Logo.png")}}" alt="images"  style="width: 450px">
                </a>

                {{-- <div class="text-center">
                  
                    <p class="text-base font-semibold text-light">In partnership with The Saudi Contractors Authority</p>
                </div> --}}
            </div>
			@if($errors->any())
				<div class="alert" style="background: red !important;color:#fff !important;">
					{{ implode('', $errors->all(':message')) }}
				</div>
			@endif
            <form class="text-start w-full" action="{{route('login')}}" method="POST">
				@csrf
                    {{-- <div class="flex md:justify-between justify-center items-center mb-8 md:gap-9 gap-2">
                        <a href="javascript:;" class="w-full inline-flex items-center justify-center px-6 gap-4 py-2.5 font-medium backdrop-blur-2xl border border-gray-300 bg-primary text-white rounded-md transition-all duration-500">
                            <img src="{{asset("assets/img/google.png")}}" alt="" class="max-w-5 h-5 text-dark ">English
                        </a>
                        <a href="https://myisoonline.me/" lang="ar" dir="rtl"   class="w-full inline-flex items-center justify-center px-6 gap-4 py-2.5 font-medium backdrop-blur-2xl border border-gray-300 bg-white text-dark rounded-md transition-all duration-500 group"><img src="{{asset("assets/img/facebook.png")}}" alt="" class="max-w-5 h-5 text-dark">العربية</a>
                    </div>    --}}

                    <div class="mb-4">
                        
                        <input id="email-addon" class="block w-full rounded-md py-2.5 px-4 text-dark text-base font-medium border-gray-300 focus:gray-300 focus:border-primary focus:outline-0 focus:ring-0 placeholder:text-light placeholder:text-base" type="email" name="email" placeholder="Enter your email">
                    </div>

                    <div class="mb-4">
                       
                        <div class="flex">
                            <input type="password" id="password-addon" class="form-password text-dark text-base font-medium block w-full rounded-s-md py-2.5 px-4 border border-gray-300 focus:gray-300 focus:border-primary focus:outline-0 focus:ring-0 placeholder:text-light placeholder:text-base" placeholder="Enter your password" name="password">
                            <button type="button" data-hs-toggle-password='{"target": "#password-addon"}' class="inline-flex items-center justify-center py-2.5 px-4 border rounded-e-md -ms-px border-gray-300">
                                <i class="hs-password-active:hidden h-5 w-5 text-dark" data-lucide="eye"></i>
                                <i data-lucide="eye-off" class="hidden hs-password-active:block h-5 w-5 text-dark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center flex-wrap gap-x-1 gap-y-2 mb-6 mt-3">
                        <div class="inline-flex items-center">
                            <input type="checkbox" id="firstCheckbox" class="h-4 w-4 text-base rounded border-gray-300 text-dark focus:ring focus:ring-default-950/30 focus:ring-offset-0">
                            {{-- <label class="text-base ms-2 text-light font-medium align-middle select-none" id="firstCheckbox" for="checkbox-signin">Remember me</label> --}}
                            {{-- <input class="form-check-input agreeInput mt-0 mr-1" id="firstCheckbox" type="checkbox" value=""> --}}
                            <button type="button" class="btn p-0 modal_btn" data-toggle="modal" data-target="#exampleModal" style="position: absolute;left:42px;">
								<label class=" text-base ms-2 text-light font-medium align-middle select-none" style="cursor: pointer; padding-top: 7px !important;">
									<small>I Agree to the Terms and Conditions.</small>
								</label>
							</button>
                        </div>
                        <a href="{{route('password.request')}}" class="text-base text-dark"><small>Forgot your password?</small></a>
                    </div>

                    <div class="text-center mb-7">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-2.5 bg-primary font-bold text-base text-white rounded-md transition-all duration-500 btn-brand" type="submit"  id="SignIN" disabled>Log In</button>
                    </div>

                   
                </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-scrollable">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel"> TERMS & CONDITIONS</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<h6>Agreement to Terms</h6>
												<p>This document governs your relationship with  Myisoonline™  J M Enterprises owns
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
													remains the property of J M Enterprises and are protected by copyright laws and
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
													the contrary to the fullest extent permitted by law J M Enterprises and its suppliers,
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
													affiliated with J M Enterprises, and you should not rely on the existence of such a
													connection   or   affiliation.   The   respective   trademark   owners   own   any trademarks/names featured on this Website. Where a trademark or brand
													name is referred to, it is used solely to describe or identify the products and
													services and is in no way an assertion that such products or services are
													endorsed by or connected to J M Enterprises. </p>
													<h6>Indemnity</h6>
													<p>You agree to indemnify, defend and hold harmless J M Enterprises, its directors,
													officers, employees, consultants, agents, and affiliates, from any third-party
													claims, liability, damages, and costs (including, but not limited to, legal fees)
													arising from your use this Website or your breach of the Terms of Service.</p>
													<h6>Variation</h6>
													<p>J M Enterprises shall have the right in its absolute discretion at any time and without
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
													and J M Enterprises. Any waiver of any provision of the Terms of Service will be
													effective only if in writing and signed by a Director of J M Enterprises.</p>
													<h6>CONTACT US</h6>
													<p>If you have questions or comments about this Terms and Conditions, please
													get in touch with us at: <br>
													J M Enterprises, <br>
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
        
    </section>
    <script>
    $('#firstCheckbox').on("change",function(){
			// $('#firstCheckbox').prop('checked', false);
			if(this.checked){
				document.querySelector('#SignIN').removeAttribute('disabled');
			}else{
				document.querySelector('#SignIN').setAttribute('disabled', '');
			}
		});    
    </script>
    <!-- =========== Main Section End =========== -->
    
    <!-- Preline Js -->
    <script src="{{asset("js/en/js/preline.js")}}" ></script>

    <!-- Lucide Js -->
    <script src="{{asset("js/en/js/lucide.min.js")}}" ></script>

    <!-- Main App Js -->
    <script src="{{asset("js/en/js/app.js")}}" ></script>

    </body>
</html>