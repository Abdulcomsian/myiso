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
                    Uploads
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
                            New Upload
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
                    <h3>New Upload</h3>
                    @php
                    $usertypes = \App\UserType::get();
                    @endphp
                    <form action="{{ url('/add_download') }}" method="POST" enctype="multipart/form-data">
                                 @csrf 
                                 <div class="form-group">
                                    <label>Category:</label><br>

                                    <select name="category" required="" class="form-control">
                                        <option value="" selected="selected" disabled="disabled">Select Category</option>
                                        <option value="Emergency Signs" title="Emergency Signs">Emergency Signs</option>
                                        <option value="Environmental signs" title="Environmental signs">Environmental signs</option>
                                        <option value="Mandatory Signs" title="Mandatory Signs">Mandatory Signs</option>
                                        <option value="Warning Signs" title="Warning Signs">Warning Signs</option>
                                    </select>

                                </div>
								<div class="form-group">
									<label for="title">Name:</label>
									<input type="text" id="name" name="name" class="form-control" placeholder="Name:" required="required"/>
								</div>
                                <div class="form-group">
                                    <label for="message">Upload Thumbnail:</label>
                                    <input type="file" name="thumbnail" class="form-control" id="thumbnail" accept=".mp4,.avi, .png, .jpg" required="required">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="message">Description:</label>
                                    <textarea name="description" id="summernote"></textarea>
                                </div> --}}
                                <div class="form-group">
									<select name="user_type" id="showusers">
                                        <option value="0" {{ request('showusers') == 0 ? 'selected' : '' }}>All Users</option>
                                        @foreach ($usertypes as $usertype)
                                        <option value="{{$usertype->id}}" {{ request('showusers') == $usertype->id ? 'selected' : '' }}>{{$usertype->name}}</option> 
                                        @endforeach
                                    </select>
                                
								</div>
                              
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="video">
                                                Upload A4</label>
									<input type="file" name="file" class="form-control" id="file" accept=".mp4,.avi, .png, .jpg" required="required">
										</div>
									</div>
									<div class="col-lg-12">
                                        <div class="form-group">
											<label for="video">Upload A5</label>
									<input type="file" name="file2" class="form-control" id="file2" accept=".mp4,.avi, .png, .jpg" required="required">
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
                    </form>
                    


                </div>
            </div>
            
            <div class="col-md-6">
               
            </div>
          

        </div>
   <!-- Category Dropdown -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group" style="margin-left: 2em">
            <label>Category:</label><br>
            <select id="category-select" name="category" required class="form-control">
                {{-- <option value="" selected disabled>Select Category</option> --}}
                <option value="Emergency Signs" selected>Emergency Signs</option>
                <option value="Environmental signs">Environmental signs</option>
                <option value="Mandatory Signs">Mandatory Signs</option>
                <option value="Warning Signs">Warning Signs</option>
            </select>
        </div>
    </div>
</div>

<!-- Default Downloads -->
<div id="default-downloads" style="width: 95%;">
    @foreach($all_downloads as $download)
  
        <div style="display: flex; justify-content:space-between; margin-left: 2em; margin-right: 2em; background:#f0f4fd; gap:20px; margin-bottom:20px; padding:30px 20px; align-items:center; border-radius:12px; width:100%;">
            <div style="width:130px;"> 
                @if ($download->thumb_nail)
                <div>
                    <img src="{{ asset('uploads/downloads/' . $download->thumb_nail) }}" width="110" height="156">
                </div>
                @endif
            </div>
            <div style="color:#084f95; font-size: 18px; font-weight:600; text-align:left; width:20% ">{{ $download->name }}</div>
         <div style="display: flex; gap:20px;justify-content:space-between;">
            <div style="display: flex; flex-direction: column;">
                @if ($download->download_file)
                <a href="{{ asset('uploads/downloads/' . $download->download_file) }}" target="_blank"><img src="assets/img/a4-btn.png"  style="width: 80%"></a><br>
                @endif
                @if ($download->download_file2)
                <a href="{{ asset('uploads/downloads/' . $download->download_file2) }}" target="_blank"><img src="assets/img/a5-btn.png"  style="width: 80%"></a><br>
                @endif
            </div>
            <div>
                <a href="javascript:;" data-toggle="modal" data-target="#delete-{{ $download->id }}" title="Delete"><img src="assets/img/delete.png"  style="width: 80%"></a><br>
            </div>
            <div class="modal fade" id="delete-{{$download->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Deleting Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure? Do you really want to delete this?.</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{url('/download_delete/'.$download->id)}}" method="POST">
                            @csrf
                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>	
         </div>
        </div>
    @endforeach
</div>

<!-- Filtered Downloads -->
<div id="filtered-downloads" style="display: none;">
    <!-- This will be updated dynamically -->
</div>
	
        {{-- <div class="kt-portlet__body">
          
            <table class="table table-striped- table-bordered table-hover table-sm table-checkable table-responsive" id="kt_table_user">

                <thead>

                    <tr>

                        <th style="text-align:center">No.</th>

                        <th>Name</th>
                        <th>Users</th>
                        <th>Download File</th>

                        

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>
				<?php //$count=0;?>
				@foreach($all_downloads as $download)
				<?php //$count++; 
                ?>
                    <tr>
                        
                        <td style="text-align:center; width:5%">{{$count}}</td>
                        
                        
                        <td style="width:30%"><h5>{{$download->name}}</h5>
                            <br>
                            <div id="summernote">{!!$download->des!!} </div>
                        </td>
                        
                        
                            <td style="width:10%">{{$download->downloadusertype->name ?? 'All'}}</td>
                       
                          
                            <td style="width:30%">
                                @if ($download->thumb_nail)
                                <a href="{{asset('uploads/downloads/' . $download->thumb_nail)}}" target="_blank">Download Thumbnail</a><br>
                                @endif
                                @if ($download->download_file)
                                <a href="{{asset('uploads/downloads/' . $download->download_file)}}" target="_blank">Download File1</a><br>
                                @endif
                                @if ($download->download_file2)
                                <a href="{{asset('uploads/downloads/' . $download->download_file2)}}" target="_blank">Download File2</a><br>
                                @endif
                               
                               
                            </td>
                       
                        

                        <td>

                           
							
							<a href="javascript:;" data-toggle="modal" data-target="#delete-{{$download->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">	<span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#5d78ff" fill-rule="nonzero"></path>											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>
															 </a>
        <div class="modal fade" id="delete-{{$download->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
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
				<form action="{{url('/download_delete/'.$download->id)}}" method="POST">
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
</div> --}}
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: 'Please enter your Details',
        tabsize: 2,
        width:700,
        height: 150,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    });
     </script>

  <script>
    $(document).ready(function() {
        $('#category-select').change(function() {
            let category = $(this).val();

            // Make an AJAX request to filter downloads
            $.ajax({
                url: "{{ route('downloads.filter') }}", // Define this route in web.php
                type: "GET",
                data: { category: category },
                success: function(response) {
                    // Hide the default downloads   
                    $('#default-downloads').hide();

                    // Display the filtered downloads
                    $('#filtered-downloads').html(response).show();
                },
                error: function() {
                    alert('Error loading downloads. Please try again.');
                }
            });
        });
    });
</script>


@endsection