@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Contact Us</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
 {!! Session::has('msg') ? Session::get("msg") : '' !!}
          @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li> {{ $error }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </li>
                    @endforeach
                </ul>
            </div>
          @endif
</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
                    	<div class="contact_form">
                    		<form action="{{url('/send_msg_to_admin')}}" method="POST" enctype="multipart/form-data">
							@csrf
                    	
						
 <input value="{{ $user['id'] }}" type="hidden" name="user_id">
 <input value="{{ $user['name'] }}" type="hidden" name="name">
 <input value="{{ $user['company_name'] }}" type="hidden" name="company">
<input type="hidden" name="email" value="{{ $user['email'] }}">									
									
                    			
								<div class="row">
									<div class="col-lg-9">
										<div class="form-group">
											<label>Subject</label>
											<input type="text" required class="form-control" placeholder="Enter subject" name="subject" value="{{ old('subject') }}">
										</div>
									</div>
									<div class="col-lg-3">
								<label for="attachment">Attachment</label>
								<div class="kt-input-icon kt-input-icon--right">
								<input type="file" name="attachment" class="form-control" id="attachment" accept=".pdf,.png,.jpg,.mp4,.mp3,.doc,.docx,.jpeg,.csv,.txt,.xlx,.xls," required>

								</div>
							</div>
								</div>	
								<div class="row">
										
									<div class="col-lg-12">
										<div class="form-group">
											<label>Message</label>
<textarea style="min-height: 150px;" required class="form-control" placeholder="Your Message" name="comments">{{ old('comments') }}</textarea>
										</div>
									</div>

								</div>
								<button onclick="supplierForm()" class="submitBtn">SUBMIT</button>
                    		</form>
                    	</div>
                    </div>
	</section>

	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''