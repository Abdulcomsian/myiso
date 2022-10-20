@extends('dashboard.layouts.app')

@section('content')
<style>section#procedure_section{padding:30px 20px;background:#FFF !important;}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::Dashboard 1-->
	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Training Videos</h2>
		</div>
	</div>
	<section id="procedure_section" class="mt-3">
		
	<div class="container">
	<div class="row">
	
	@foreach($videos as $video)
	<!--Video--->
	<div class="col-md-4 mt-2 mb-2">
	<a href="{{url('public/uploads/explainer_videos/'.$video->video)}}" target="_blank">
		<img src="{{ asset('assets/media/icons')}}/mp4.png" class="img-thumbnail img-fluid"></a>
	
	<h5 style="text-align: center;margin-top: 10px;">{{$video->title}}</h5>
	</div>
	@endforeach
	
	</div>
	</div>
	</section>
	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''