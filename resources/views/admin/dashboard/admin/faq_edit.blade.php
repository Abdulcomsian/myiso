@extends('admin.dashboard.layouts.app')
@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Edit FAQ
                </h3>
            </div>

        </div>
	@if ($message = Session::get('msg'))
		<div class="row">
            <div class="col-md-11 pl-4 ml-4 mt-4">
	<div class="alert alert-success alert-dismissible">{{ $message }} &nbsp; 
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	</div>
	</div>
	</div>
	@endif
        <div class="row">
            <div class="col-md-12">
                <div id="new_faq" class="p-4">
                    <h3>Update FAQ</h3>
										
                    <form action="{{url('/faq_update/'.$faq->id) }}" method="POST">
                                 @csrf 
								 <input type="hidden" name="id" value="{{$faq->id}}">
								 <div class="form-group">
									<label for="question">Question:</label>
									<input type="text" id="question" name="question" class="form-control" placeholder="Question:" required="required" value="{{ $faq->question }}"/>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="answer">Answer</label>
											<textarea required name="answer" id="answer" class="form-control">{{  $faq->answer  }}</textarea>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="category">Category:</label>
											<select name="category" id="category" class="form-control">
                                                <option value="">Select Category</option>
@foreach($all_cate as $cate)                                           
		<option value="{{$cate->id}}" {{$faq->category == $cate->id ? ' selected ':'' }}>{{$cate->name}}</option>
@endforeach                                           
                                            </select>
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
								<!---- <a href="https://myisoonline.com/requirements_aspect" style="float: right;margin-right: 6px;border: none;background: #646c9a;color: #fff;padding: 8px 47px;border-radius: 5px;"> Cancel </a>---->
                    		</form>
                    
<div class="clearfix mb-4">&nbsp;</div>

                </div>
            </div>
 
        </div>

        
    </div>
</div>
<script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'answer' );
</script>
<!---- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>   
    $.noConflict();
jQuery(document).ready(function($){
    console.log('test.....');
$('.close').on('click',function(){
		$(this).closest('.collapse').hide();
});

});
</script>--->
@endsection