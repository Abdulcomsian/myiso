@extends('dashboard.layouts.app')

@section('content')
<style>section#procedure_section{padding:30px 20px;background: #fff;}div#faq-tabs a {    padding: 13px 10px;    border-radius: 0;    border-bottom: 6px solid #F1F2F7;}section#procedure_section .col-lg-4 > div, section#procedure_section .col-lg-8 > div {background: #FFF;}div#faq-tabs a.nav-link{display:block;clear:both;position:relative;width:100%}section#procedure_section a,section#procedure_section button{font-weight:500!important}section#procedure_section p{font-weight:300!important}// FAQ .faq-nav{flex-direction:column;margin:0 0 32px;border-radius:2px;border:1px solid #ddd;box-shadow:0 1px 5px rgba(85,85,85,.15);display:block;margin:0;padding:13px 16px;background-color:#fff;border:0;border-bottom:1px solid #ddd;border-radius:0;color:#4580c6 !important;transition:background-color .2s ease;font-weight:700;color:rgba(0,0,0,.87)}&:last-of-type{border-bottom-left-radius:2px;border-bottom-right-radius:2px;border-bottom:0}i.mdi{margin-right:5px;font-size:18px;position:relative}.card-header{padding:15px 16px;border-radius:0;background-color:#f6f6f6;width:100%;padding:0;border:0;font-weight:700;color:rgba(0,0,0,.87);text-align:left;white-space:normal}.card-header .btn.btn-link {color: #4580c6 !important;}a.nav-link.active {background-color: #4580c6 !important;color: #FFF !important;}a.nav-link{color: #4580c6 !important;}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::Dashboard 1-->
	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>FAQ's</h2>
		</div>
	</div>
	
	<section id="procedure_section" class="mt-3">
		
	<div class="container">
    <div class="row">
        <div class="col-lg-4">
		
		
            <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
                @foreach($all_cates as $cate)
<a href="#tab{{$cate->id}}" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab{{$cate->id}}" aria-selected="true">
                    <i class="mdi mdi-help-circle"></i> {{$cate->name}}
                </a>
				@endforeach	
            </div>
	
			
        </div>
        <div class="col-lg-8">
            <div class="tab-content" id="faq-tab-content">
			<?php $x = 1;?>
			@foreach($all_cates as $cate)
			
                <div class="tab-pane {{$x == 1 ? 'show active' : ''}}" id="tab{{$cate->id}}" role="tabpanel" aria-labelledby="tab{{$cate->id}}">
                    <div class="accordion" id="accordion-tab-{{$cate->id}}">
					 @foreach($all_faqs as $faq)
					 @if($faq->category == $cate->id)
					 
                        <div class="card category-{{str_replace(" ","-",$cate->name)}}">
                            <div class="card-header" id="accordion-tab-{{$cate->id}}-heading-{{$faq->id}}">
                                <h5>
                                    <button class="btn btn-link" style="text-align:left;" type="button" data-toggle="collapse" data-target="#accordion-tab-{{$cate->id}}-content-{{$faq->id}}" aria-expanded="false" aria-controls="accordion-tab-{{$cate->id}}-content-{{$faq->id}}">{{$faq->question}}</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-{{$cate->id}}-content-{{$faq->id}}" aria-labelledby="accordion-tab-{{$cate->id}}-content-{{$faq->id}}" data-parent="#accordion-tab-{{$cate->id}}">
                                <div class="card-body">
                                    <!---<p>Category single:{{$cate->id}}</p>
                                    <p>Cate from faq: {{$faq->category}}</p>--->
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
						
					@endif
			<?php $x++;?>					
                    @endforeach	  
             
                    </div>
                </div>
				
            @endforeach	
                				
            </div>
        </div>
    </div>
</div>
	
	</section>
	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''