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
		

	  <!-- Category Dropdown -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group" style="margin-left: 2em">
            <label>Category:</label><br>
            <select id="category-select" name="category" required class="form-control">
                {{-- <option value="" selected disabled>Select Category</option> --}}
                <option value="Emergency Signs" selected>Emergency Signs</option>
				<option value="Prohibition Signs">Prohibition Signs</option>
                <option value="Environmental signs">Environmental signs</option>
                <option value="Mandatory Signs">Mandatory Signs</option>
                <option value="Warning Signs">Warning Signs</option>
            </select>
        </div>
    </div>
</div>

<!-- Default Downloads -->
<div id="default-downloads" style="width: 100%;">
    @foreach($all_downloads as $download)
  
        <div style="display: flex; margin-left: 2em; margin-right: 2em; background:#f0f4fd; gap:80px; margin-bottom:20px; padding:30px 20px; align-items:center; border-radius:12px; ">
            <div style="display:flex; align-items:center; gap:40px">
                @if ($download->thumb_nail)
                <div>
                    <img src="{{ asset('uploads/downloads/' . $download->thumb_nail) }}" width="110" height="156">
                </div>
                @endif
				<div style="color:#084f95; font-size: 18px; font-weight:600; text-align:left;width:170px;">{{ $download->name }}</div>
            </div>
           
         <div style="display: flex; gap:20px;justify-content:space-between;">
            <div style="display: flex; flex-direction: column;">
                @if ($download->download_file)
                <a href="{{ asset('uploads/downloads/' . $download->download_file) }}" target="_blank"><img src="assets/img/a4-btn.png"  style="width: 80%"></a><br>
                @endif
                @if ($download->download_file2)
                <a href="{{ asset('uploads/downloads/' . $download->download_file2) }}" target="_blank"><img src="assets/img/a5-btn.png"  style="width: 80%"></a><br>
                @endif
            </div>
           
         </div>
        </div>
    @endforeach
</div>

<!-- Filtered Downloads -->
<div id="filtered-downloads" style="display: none;">
    <!-- This will be updated dynamically -->
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
	  <script>
		$(document).ready(function() {
			$('#category-select').change(function() {
				let category = $(this).val();
	
				// Make an AJAX request to filter downloads
				$.ajax({
					url: "{{ route('downloads.userfilter') }}", // Define this route in web.php
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
	</section>
	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''