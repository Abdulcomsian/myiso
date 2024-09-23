@extends('dashboard.layouts.app')

@section('content')
<style>section#procedure_section{padding:30px 20px;background:#FFF !important;}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::Dashboard 1-->
	<!--Begin::Section-->
	{{-- <div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Download</h2>
		</div>
	</div> --}}
	<section id="procedure_section" class="mt-3">
		
	<div class="container">
	<div class="row">

		<div class="kt-portlet__body" style="width: 100%">
            <!--begin: Video -->
            <table style="width: 100%" class="table table-striped- table-bordered table-hover table-sm table-checkable table-responsive" id="kt_table_user">

                <thead>

                    <tr>

                        <th  style="text-align:center">No.</th>

                        <th  >Name</th>
                        <th >Download File</th>

                        

                       
                    </tr>

                </thead>

                <tbody>
				<?php $count=0;?>
				@foreach($all_downloads as $download)
				<?php $count++; 
               
                ?>
                    <tr>
                        
                        <td style="text-align:center; width:20%">{{$count}}</td>
                        
                        
                        <td style="width:65%">{{$download->name}}</td>
                        
                        
                       
                          
                            <td style="width:100%"><a class="btn-fetch-data" href="{{asset('uploads/downloads/' . $download->download_file)}}" data-id="{{$download->id}}" target="_blank">{{$download->download_file}}</a></td>
                       
                        

                        

                    </tr>
				@endforeach	
                </tbody>
            </table>
            <!--end: Video -->


        </div>
	
	</div>
	</div>
	<script>
		$(document).on('click', '.btn-fetch-data', function(e) {
			e.preventDefault();
			var hrefValue = $(this).attr('href');  // Get the href attribute value
			// Get the data-id from the clicked button
			var dataId = $(this).data('id');
			
			$.ajax({
				url: "{{ route('user.get-data') }}",
				type: 'POST',
				data: {
					id: dataId,
					_token: "{{ csrf_token() }}"
				},
				success: function(response) {
					if (response.status === 'success') {
						// Handle success
						//console.log(response.data);
						//alert("Data fetched successfully!");
						window.open(hrefValue, '_blank');  // Opens the URL in a new tab
						return true;
					} else {
						// Handle error
						console.log(response.message);
						alert("Error: " + response.message);
					}
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
					alert("An error occurred!");
				}
			});
		});
	</script>
	</section>
	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''