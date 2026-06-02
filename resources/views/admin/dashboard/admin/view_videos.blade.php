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
                    Videos
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">

                        </div>
                        &nbsp;
                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="collapse"
                            data-target="#new_video">
                            <i class="la la-plus"></i>
                            New Video
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
                <div id="new_video" class="collapse p-4">
                    <h3>Add New Video</h3>

                    <form action="{{ url('/add_video') }}" method="POST" enctype="multipart/form-data">
                                 @csrf 
								<div class="form-group">
									<label for="title">Title:</label>
									<input type="text" id="title" name="title" class="form-control" placeholder="Title:" required="required"/>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="video">Video</label>
									<input type="file" name="video" class="form-control" id="video" accept=".mp4,.avi" required="required">
									<em style="    margin-top: 6px;    display: block;"> Allowed file types: .mp4 and .avi. Max size: 40MB</em>
										</div>
									</div>
									<div class="col-lg-12">

									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
                    </form>
                    


                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Video -->
            <table class="table table-striped- table-bordered table-hover table-sm table-checkable table-responsive" id="kt_table_user">

                <thead>

                    <tr>

                        <th style="text-align:center">No.</th>

                        <th>Image</th>
                        <th>Video</th>

                        

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>
				<?php $count=0;?>
				@foreach($all_videos as $video)
				<?php $count++; ?>
                    <tr>

                        <th style="text-align:center">{{$count}}</th>

                        {{-- <th>{{$video->title}}</th> --}}
                        <th><img src="{{ asset('assets/media/video_images/' . $video->video_image)}}"></th>
                        <th>
<video width="440" height="180" controls>
  <source src="{{url('public/uploads/explainer_videos/'.$video->video)}}" type="video/mp4">
  Your browser does not support the video tag.
</video>
						</th>

                        

                        <td>

                            <!----- <a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" href="{{url('video_edit/'.$video->id)}}">

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

                            </a>----------->
							
							<a href="javascript:;" data-toggle="modal" data-target="#delete-{{$video->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">	<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
															 </a>
<div class="modal fade" id="delete-{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure? Do you really want to delete this?.</p>
			</div>
			<div class="modal-footer">
				<form action="{{url('/video_delete/'.$video->id)}}" method="POST">
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
            <!--end: Video -->


        </div>
    </div>
</div>
@endsection