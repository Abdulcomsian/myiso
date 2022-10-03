@extends('admin.dashboard.layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<style>
		.select2-search__field{
			padding-left: 10px !important;
		}
		.multiselect-native-select .btn-group{
			width: 100%;
		}
		/* .multiselect-native-select .btn-group button{
			text-a
		} */
		.ms-options ul{
			padding: 8px;
			list-style-type: none;
		}
		.ms-options ul label{
			text-align: left !important;
			line-height: 12px;
		}
		.ms-options-wrap button{
			border: 1px solid #0d47b3;
		}
	</style>
@endsection
@section('content')
<style>tr.New>td {    color: #000 !important;    font-weight: 800;    cursor: pointer;}tr.New>button {    color: #FFF !important;    font-weight: 800;    cursor: pointer;}</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	@if ($message = Session::get('success'))
	<div class="alert alert-light alert-elevate" role="alert">
		<!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->
		<!-- <div class="alert-text">
			DataTables has the ability to read data from virtually any JSON data source that can be obtained by Ajax. This can be done, in its most simple form, by setting the ajax option to the address of the JSON data source.
			See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/data_sources/ajax.html" target="_blank">here</a>.
		</div> -->

	        <!-- <div class="alert alert-success"> -->
	            <p>{{ $message }}</p>
	        <!-- </div> -->
	</div>
	@endif
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Login reminder Message
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<div class="dropdown dropdown-inline">
							{{-- <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-download"></i> Export
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">Choose an option</span>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">Print</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">Copy</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-excel-o"></i>
											<span class="kt-nav__link-text">Excel</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">PDF</span>
										</a>
									</li>
								</ul>
							</div> --}}
						</div>
						&nbsp;


					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">

            <form class="kt-form kt-form--label-right"  action="{{route('sendNotifications')}}" enctype="multipart/form-data" method="POST">
    	@csrf
    	<div class="modal-body">
    
    			<div class="kt-portlet__body">
    				<input type="hidden" name="id" id="editvalue" value="">
    				<div class="form-group row">
    					<div class="col-lg-8">
    						<label for="title">Subject:</label>
    						<input type="text" id="title" name="title" class="form-control" placeholder="Please enter Message Subject">
    					</div>
                        <div class="col-md-4">
    						<label for="attachment">Attachment</label>
    						<div class="kt-input-icon kt-input-icon--right">
    						<input type="file" name="attachment" class="form-control" id="attachment">
    						</div>
    					</div>
    
    
    
    					<div class="col-lg-12">
    						<label for="message">Message:</label>
    						<textarea name="message" id="message" cols="20" rows="5" class="form-control" placeholder="Please enter your Message"></textarea>
    					</div>
    					<br>
    					<div class="col-lg-6">
    						<label for="address1">Filter By Last Login:</label>
							<!-- <div class="kt-input-icon kt-input-icon--right"> -->
    							<input type="text" name="daterange" class="form-control" id="last_login">
    						<!-- </div> -->
    						<!-- <div class="kt-input-icon kt-input-icon--right">
    							<select id="last_login" class="form-control">
    								<option value="">Select Month</option>
    								<option value="3">Last 3 Month</option>
    								<option value="6">Last 6 Month</option>
    								<option value="9">Last 9 Month</option>
    							</select>
    						</div> -->
    					</div>
    					<div class="col-lg-6">
    						<label for="address1">Filter By Certificate:</label>
    						<div class="kt-input-icon kt-input-icon--right">
    							<select id="filter_by_certificate" class="form-control">
    								<option value="">Select Certificate</option>
    								<option value="iso9001_certificate">ISO9001 Certificate</option>
    								<option value="iso14001_certificate">ISO14001 Certificate</option>
    								<option value="iso45001_certificate">ISO45001 Certificate</option>
    								<option value="ims">IMS</option>
    								<option value="all">ALL</option>
    							</select>
    						</div>
    					</div>
    					<div class="col-lg-12">
    						<label for="address1">Send to:</label>
    						<div class="kt-input-icon kt-input-icon--right">
    							<select name="userid[]" id="langOpt3" class="form-control" multiple>
    								@foreach ($users as $item)
    							        <option value="{{$item->id}}">{{$item->name}} </option>
    								@endforeach
    							</select>
    						</div>
    					</div>
    					<div class="col-lg-2">
    
    						<div class="kt-input-icon kt-input-icon--right">
    
    						</div>
    					</div>
    
    				</div>
    
    			</div>
    	</div>
    
    	<div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    		<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-paper-plane"></i>  Send </button>
    	</div>
    
    </form>
		</div>
	</div>
@endsection
@section('myscript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- <script type="text/javascript" src="{{asset('assets/jQuery-Multiple-Select/dist/js/bootstrap-multiselect.js')}}"></script> -->
<script type="text/javascript" src="{{asset('assets/jquery.multiselect.js')}}"></script>
	 <script src="http://demos.codexworld.com/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
	 <!-- jquery.multiselect.js -->

	<script>
		//  $('input[name="date"]').daterangepicker();


		 $(function() {
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();

			today  = mm + '-' + dd + '-' + yyyy;
			$('input[name="daterange"]').daterangepicker({
				showDropdowns: true,
				changeYear: true,
				maxDate: today,
				
				
			}, function(start, end, label) {
					start_date = start.format('YYYY-MM-DD');
					end_date = end.format('YYYY-MM-DD');
					console.log(start_date);
					console.log(end_date);
					$.ajax({
						type: "get",
						url: "{{url('/send_message')}}",
						data: 
						{'start_date':start_date, 'end_date':end_date, 'type':'month'},
						success: function (response) {
							var res=JSON.parse(response);
							$("#langOpt3").html(res[1]);
							$(".ms-options ul").html(res[0]);
						},
					});
				// console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
			});


		// $('.select2').select2({
		// 	placeholder: "Select users",
		// });
		// // $(".select2").select2();
		// $("#checkbox").click(function(){
		// 	if($("#checkbox").is(':checked') ){
		// 		$("#user > option").prop("selected","selected");
		// 		$("#user").trigger("change");
		// 	}else{
		// 		$("#user > option").removeAttr("selected");
		// 		$("#user").trigger("change");
		// 		// document.querySelector('.select2-selection__rendered').innerHTML = "";
		// 		// document.getElementById("select2-selection__rendered").innerHTML =  "";
		// 		$('.select2-selection__rendered').html('')
		// 	}
		// });

		// $(function(){
		// 	$('#demo').multiselect({
		// 		// includes Select All Option
		// 			includeSelectAllOption:false,
		// 			selectedClass:'active',

		// 	});
		// });

		$('#langOpt3').multiselect({
			columns: 1,
			placeholder: 'Select Languages',
			search: true,
			selectAll: true,
		});


		// $("#last_login").change(function(){
		// 	let Month=$(this).val();
		// 	console.log($(this).val(););
		// 	$.ajax({
        //     type: "get",
        //     url: "{{url('/send_message')}}",
        //     data: 
        //     {'month':Month,'type':'month'},
        //     success: function (response) {
        //       var res=JSON.parse(response);
        //        $("#langOpt3").html(res[1]);
        //        $(".ms-options ul").html(res[0]);
        //     },
        //    });
		// })


		$("#filter_by_certificate").change(function(){
			let cert=$(this).val();
			// console.log(cert);
			$.ajax({
            type: "get",
            url: "{{url('/send_message')}}",
				data: {'cert':cert,'type':'certificate'},
				success: function (response) {
					var res=JSON.parse(response);
					$("#langOpt3").html(res[1]);
					$(".ms-options ul").html(res[0]);
			
				},
           });
		})

		let x = 0;
		$('.ms-selectall.global').click(function(){
			// toggle select and unselect text of this
			if(x == 0){
				$(this).text('Unselect All');
				x = 1;
				return;
			}
			$(this).text($(this).text() == 'select All' ? 'Unselect All' : 'select All');
		})

	</script>
@endsection