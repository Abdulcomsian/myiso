@extends('dashboard.layouts.app')

@section('content')
<style>section#procedure_section{padding:30px 20px}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::Dashboard 1-->
	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Explainer videos</h2>
		</div>
	</div>
	<section id="procedure_section" class="mt-3">
		
	<div class="container">
	<div class="row">
	
	@foreach($videos as $video)
	<!--Video--->
	<div class="col-md-4 mt-2 mb-2">
	  <div class="embed-responsive embed-responsive-4by3">
    <video width="220" height="140" controls>
		<source src="{{url('public/uploads/explainer_videos/'.$video->video)}}" type="video/mp4">
		Your browser does not support the video tag.
	</video>
	</div>
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