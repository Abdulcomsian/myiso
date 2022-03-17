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
                    FAQs
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">

                        </div>
                        &nbsp;
                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="collapse"
                            data-target="#new_faq">
                            <i class="la la-plus"></i>
                            New FAQ
                        </a>
                        <a href="#" class="btn btn-brand btn-primary btn-icon-sm" data-toggle="collapse"
                            data-target="#new_faq_cate">
                            <i class="la la-plus"></i>
                            New Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
	@if ($message = Session::get('msg'))
		<div class="row">
            <div class="col-md-11 pl-4 ml-4 mt-4">
	<div class="alert alert-success alert-dismissible">{{ $message }} &nbsp; <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
	</div>
	</div>
	@endif
        <div class="row">
            <div class="col-md-6">
                <div id="new_faq" class="collapse p-4">
                    <h3>Add New FAQ</h3>

                    <form action="{{ url('/add_faq') }}" method="POST">
                                 @csrf                 			<div class="form-group">
									<label for="question">Question:</label>
									<input type="text" id="question" name="question" class="form-control" placeholder="Question:" required="required"/>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="answer">Answer</label>
											<textarea name="answer" id="answer" class="form-control"></textarea>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="category">Category:</label>
											<select name="category" id="category" class="form-control">
                                                <option value="">Select Category</option>
@foreach($all_cate as $cate)                                           
										   <option value="{{$cate->id}}">{{$cate->name}}</option>
@endforeach                                           
                                            </select>
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
								<!---- <a href="https://myisoonline.com/requirements_aspect" style="float: right;margin-right: 6px;border: none;background: #646c9a;color: #fff;padding: 8px 47px;border-radius: 5px;"> Cancel </a>---->
                    		</form>
                    


                </div>
            </div>
            <div class="col-md-6">
                <div id="new_faq_cate" class="collapse  p-4">
                    <h3>Add New FAQ Category</h3>
					                    <form action="{{ url('/add_faq_cate') }}" method="POST">
                                 @csrf                 			<div class="form-group">
									<label for="faq_cate">Category for FAQ:</label>
									<input type="text" id="faq_cate" name="faq_cate" class="form-control" placeholder="Category" required="required"/>
								</div>
												
								<button type="submit" class="submitBtn">SUBMIT</button>
								<!--- <a href="https://myisoonline.com/requirements_aspect" style="float: right;margin-right: 6px;border: none;background: #646c9a;color: #fff;padding: 8px 47px;border-radius: 5px;"> Cancel </a>--->
                    		</form>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: faq -->
            <table class="table table-striped- table-bordered table-hover table-sm table-checkable" id="kt_table_user">

                <thead>

                    <tr>

                        <th style="text-align:center">No.</th>

                        <th>FAQ</th>

                        <th>Category</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>
				<?php $count=0;?>
				@foreach($all_faqs as $faq)
				<?php $count++; ?>
                    <tr>

                        <th style="text-align:center">{{$count}}</th>

                        <th>{{$faq->question}}</th>

                        <th>@foreach($all_cate as $cate) @if($faq->category == $cate->id) {{$cate->name}} @endif @endforeach</th>

                        <td>

                            <a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" href="{{url('faq_edit/'.$faq->id)}}">

                                <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#5d78ff" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) ">
                                            </path>
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>

                            </a>
							
							<a href="javascript:;" data-toggle="modal" data-target="#delete-{{$faq->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">	<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
															 </a>
<div class="modal fade" id="delete-{{$faq->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting FAQ</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure? Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
				<form action="{{url('/faq_delete/'.$faq->id)}}" method="POST">
				@csrf
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>									 


                        </td>

                    </tr>
				@endforeach	
                </tbody>
            </table>
            <!--end: faq -->


        </div>
    </div>
    <!--//work for category-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Categories
                </h3>
            </div>
           
        </div>
        <div class="kt-portlet__body">
            <!--begin: faq -->
            <table class="table table-striped- table-bordered table-hover table-sm table-checkable" id="kt_table_user">

                <thead>

                    <tr>

                        <th style="text-align:center">No.</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>

                </thead>
                <tbody>
								<?php $count=0;?>
			@foreach($all_cate as $cat)
				<?php $count++; ?>
				
                    <tr>

                        <th style="text-align:center">{{$count}}</th>
                        <th>{{$cat->name}}</th>
                        <td>

                            <!--<a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" href="{{url('cat_edit/'.$cat->id)}}">-->

                            <!--    <span class="svg-icon svg-icon-md">-->
                            <!--        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
                            <!--            width="18px" height="18px" viewBox="0 0 24 24" version="1.1">-->
                            <!--            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
                            <!--                <rect x="0" y="0" width="24" height="24"></rect>-->
                            <!--                <path-->
                            <!--                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"-->
                            <!--                    fill="#5d78ff" fill-rule="nonzero"-->
                            <!--                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) ">-->
                            <!--                </path>-->
                            <!--                <path-->
                            <!--                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"-->
                            <!--                    fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>-->
                            <!--            </g>-->
                            <!--        </svg>-->
                            <!--    </span>-->

                            <!--</a>-->
							
							<a href="javascript:;" data-toggle="modal" data-target="#delete-category-{{$cat->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">	<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
															 </a>
                                <div class="modal fade" id="delete-category-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
                                	<div class="modal-dialog" role="document">
                                		<div class="modal-content">
                                			<div class="modal-header">
                                				<h5 class="modal-title" id="exampleModalLabel">Deleting Category</h5>
                                				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                				</button>
                                			</div>
                                			<div class="modal-body">
                                				<p>Are you sure? Do you really want to delete this?.</p>
                                			</div>
                                			<div class="modal-footer">
                                				<form action="{{url('/cat_delete/'.$cat->id)}}" method="POST">
                                				@csrf
                                				
                                				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                				<button type="submit" class="btn btn-danger">Yes</button>
                                				</form>
                                			</div>
                                		</div>
                                	</div>
                                </div>									 


                        </td>

                    </tr>
				@endforeach	
                </tbody>
            </table>
            <!--end: faq -->


        </div>
    </div>
</div>
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