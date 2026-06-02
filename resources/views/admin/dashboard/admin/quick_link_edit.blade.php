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
                    Edit Quck link
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
                    <h3>Update Qick link</h3>
										
                    <form action="{{url('/quick_link_update/'.$quick_link->id) }}" method="POST">
                                 @csrf 
								 <input type="hidden" name="id" value="{{$quick_link->id}}">
								 <div class="form-group">
									<label for="title">Quick Link Title:</label>
		<input type="text" id="title" name="title" class="form-control" placeholder="Title:" required="required" value="{{ $quick_link->title }}"/>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="answer">URL</label>
											<input type="text" name="link" id="link" class="form-control" placeholder="http://" required="required" value="{{ $quick_link->link }}">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="category">Category:</label>
											<select name="category" id="category" class="form-control">
                                                <option value="">Select Category</option>
@foreach($all_cate as $cate)                                           
		<option value="{{$cate->id}}" {{ $quick_link->category == $cate->id ? ' selected ':'' }}>{{$cate->name}}</option>
@endforeach                                           
                                            </select>
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
								
                    </form>
                    
<div class="clearfix mb-4">&nbsp;</div>

                </div>
            </div>
 
        </div>

        
    </div>
</div>
@endsection