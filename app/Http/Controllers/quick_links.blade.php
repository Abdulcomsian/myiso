@extends('dashboard.layouts.app')

@section('content')
<style>section#procedure_section{padding:30px 20px;background-color:#FFF;}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::Dashboard 1-->
	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Quick links</h2>
		</div>
	</div>
	<section id="procedure_section" class="mt-3">
		
	<div class="container">
	<!--links--->
	<div class="row">
	@foreach($links as $link)
	<div class="col-md-6 mt-2 mb-2">
<h4>{{$link->id}}</h4>

<ul>


	<li><a target="blank" href="{{$link->link}}">{{$link->title}}</a></li>


</ul>
	</div>
	
@endforeach
	
	
	</div>
	</section>
	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''