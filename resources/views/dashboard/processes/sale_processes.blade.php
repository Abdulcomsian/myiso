@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->
@php
//echo"<pre>";print_r(session());exit;
@endphp
@if(session()->has('message'))

    
      <div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   {{ session()->get('message') }}
  </div>
  
@endif

		@if($errors->has('sales_process_photo'))
    <div class="alert alert-danger alert-dismissible">{{ $errors->first('sales_process_photo') }}   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  </div>
@endif

	<!--Begin::Section-->  

	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Sales Process</h2>
	
		</div>
	</div>
	
	<div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-9 col-xl-10 text-right">
                    		    	@if($img_exist=="Yes")
			<form action="{{url('removesales')}}" method="post">
                            @csrf
  <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>"/>
                         

								
								<button type="submit" class="submitBtn">Remove</button>
                    		</form>
                    		@endif
                    		</div>
                    		<div class="col-lg-3 col-xl-2 text-right">
                    			<a style="position: relative;top: 9px;" onclick="workInstructionFrom()" class="addBtn">ADD ALTERNATIVE PROCESS</a>
                    		</div>
                    	</div>
                    	<div class="work_instruction_from_div">
                    	    
    <form enctype='multipart/form-data' action="{{url('uploadimg')}}" method="post">
                            @csrf
  <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>"/>
                            <div class="row">
                    				<div class="col-lg-6 d-flex align-items-center">
                    					<div class="form-group">
											<label>Upload Photo:</label><br>
		<input type="file" class="form-control" name="sales_process_photo">

										</div>
										<button type="submit" class="submitBtn ml-2">SUBMIT</button>
                    				</div>
                    				
                    			</div>

								
                    		</form>
                    	</div>
                    </div>
	
	
	<section id="procedure_section">
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					@if($img) <img src="{{ $img }}" class="img-fluid"> @endif
					<p class="m-t-20">This process is to be used to begin a contract from customer.</p>
					<p>Input: Request to quote.</p>
					<p>Output: Reception and implementation of a purchase order.</p>
					<p>Process owner is: <span class="authName">{{Auth::user()->sales_process}}</span> </p>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
@endsection
@if(session()->has('message'))
@section('myscript')
<script>
   window.history.forward(1);
</script>
@endsection
@endif
<!-- end:: Content -->