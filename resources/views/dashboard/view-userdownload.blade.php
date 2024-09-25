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
            <table style="width:100%" class="table table-striped- table-bordered table-hover table-sm table-checkable table-responsive" id="kt_table_user">

                <thead>

                    <tr>

                        <th style="text-align:center">S No.</th>

                        <th>Name</th>
                        <th>Downloaded File</th>
						<th>Date</th>

                        

                      

                    </tr>

                </thead>

                <tbody>
				<?php $count=0;?>
				@foreach($view_downloads as $userdownload)
				<?php $count++; 
                
                ?>
                    <tr>
                        
                        <td style="text-align:center; width:100px;">{{$count}}</td>
                        
                        
                        <td style="width:200px">{{$userdownload->downloads->name ?? ''}}</td>
                        
                        
                        <td style="width:200px">{{$userdownload->downloads->download_file ?? ''}}</td>
                    
                        
                        <td style="width:200px">{{$userdownload->dated ?? ''}}</td>
                       
                        

                        

                    </tr>
				@endforeach	
                </tbody>
            </table>
            <!--end: Video -->


        </div>
	
	</div>
	</div>
	
	</section>
	<!--End::Section-->
</div>
@endsection
<!-- end:: Content --''