@extends('admin.dashboard.layouts.app')

@section('content')
<style>
	tr.New>td {
		color: #000 !important;
		font-weight: 800;
		cursor: pointer;
	}

	tr.New>button {
		color: #FFF !important;
		font-weight: 800;
		cursor: pointer;
	}
</style>
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
					Subject - {{ $message_information[0]->title }}
				</h3>
			</div>

		</div>
		<div class="kt-portlet__body">
			{{-- @foreach ($message_information as $item)
			<h1>{{ $item->title }}</h1>
			@endforeach --}}
			@foreach ($message_information as $key=>$item)
			<div class="accordion" id="accordionExample">
				@if (Auth::user()->id == $item->send_by)
				<div class="card">
					<div class="card-header" id="heading{{ $item->id }}">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse"
								data-target="#collapse{{ $item->id }}" aria-expanded="{{ $key === 0 ? 'true' : 'false' }}"
								aria-controls="collapse{{ $item->id }}">
								From - Me
							</button>
							<div class="float-right" style="display: flex; font-size: 14px; color: #888; padding-top: 12px; padding-right: 10px;">
								@if ($item->attachement)
									<a href="{{ asset($item->attachement) }}" download><i class="fa fa-download"> Attachment</i></a>
								@endif
								<p class="mx-2">
								{{ date("d/m/Y H:i:sA", strtotime($item->created_at) ) }}
							    </p>
							</div>

						</h2>
					</div>

					<div id="collapse{{ $item->id }}" class="collapse {{ $key === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $item->id }}"
						data-parent="#accordionExample">
						<div class="card-body">
							{{ $item->message }}
						</div>
					</div>
				</div>
				@else
				<div class="card">
					<div class="card-header" id="heading{{ $item->id }}">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse"
								data-target="#collapse{{ $item->id }}" aria-expanded="{{ $key === 0 ? 'true' : 'false' }}"
								aria-controls="collapse{{ $item->id }}">
								From - {{ $item->name }}
							</button>
							
							<div class="float-right" style="display: flex; font-size: 14px; color: #888; padding-top: 12px; padding-right: 10px;">
								@if ($item->attachement)
									<a href="{{ asset($item->attachement) }}" download><i class="fa fa-download"> Attachment</i></a>
								@endif
								<p class="mx-2">
								{{ date("d/m/Y H:i:sA", strtotime($item->created_at) ) }}
							    </p>
							</div>
						</h2>
					</div>

					<div id="collapse{{ $item->id }}" class="collapse {{ $key === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $item->id }}"
						data-parent="#accordionExample">
						<div class="card-body">
							{{ $item->message }}
						</div>
					</div>
				</div>
				@endif
			</div>
			@endforeach



			<h2 class="mb-0 mt-2">
				<button class="btn btn-primary" type="button" onclick="replyBox()" id="replyButton">Reply</button>
			</h2>
			@foreach ($message_information as $item)
			{{-- @dd($message_information) --}}
			<form action="{{ route('storeReplyMessageAdmin') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div id="replyContainer" style="display: none; margin-top: 5px;">
					<input type="hidden" name="messageId" value="{{ $item->unique_id }}">
					<input type="hidden" name="title" value="{{ $item->title }}">
					<input type="hidden" name="receiver" value="{{ $item->send_to }}">
					<input type="hidden" name="sender" value="{{ $item->send_by }}">
					<input type="hidden" name="parentId" value="{{ $parent_message_id }}">
					<textarea class="form-control" name="replyMessage" rows="4" id="replyTextarea"
					placeholder="Write your reply here"></textarea>
					<label class="form-label mt-2" for="attachment">Add Attachment (If Any)</label>
					<div class="kt-input-icon kt-input-icon--right">
						<input type="file" name="attachment" class="form-control" id="attachment">
					</div>
					<button type="submit" class="btn btn-primary mt-2" id="sendReplyButton">Send</button>
					<button type="button" class="btn btn-primary mt-2" id="cancelReplyButton">Cancel</button>
				</div>
			</form>
			@endforeach
		</div>
	</div>
</div>
@endsection
<script>

    const accordionItems = document.querySelectorAll('.card');

    accordionItems.forEach((item) => {
        const button = item.querySelector('button');

        button.addEventListener('click', () => {
            const collapse = item.querySelector('.collapse');
            const expanded = button.getAttribute('aria-expanded') === 'true';

            if (expanded) {
                collapse.classList.remove('show');
                button.setAttribute('aria-expanded', 'false');
            } else {
                collapse.classList.add('show');
                button.setAttribute('aria-expanded', 'true');
            }
        });
    });

	function deleteUser(id) {
        var userid = id;
        $("#userid").val(userid);
        $("#deleteUser").modal('show');
    }

    function editDetails(data) {
        console.log(data);
        $("#editvalue").val(data.id);
        $("input[name='idnumber']").val(data.idnumber);
        $("input[name='name']").val(data.name);
        $("input[name='email']").val(data.email);
        $("input[name='phone']").val(data.phone);
        $("input[name='director']").val(data.director);
        $("input[name='sales_process']").val(data.sales_process);
        $("input[name='company_profile']").val(data.company_profile);
        $("input[name='company_name']").val(data.company_name);
        $("input[name='company_address']").val(data.company_address);
        $("input[name='purchasing_process']").val(data.purchasing_process);
        $("input[name='servicing_process']").val(data.servicing_process);
        $("input[name='competency_process']").val(data.competency_process);
        $("input[name='order_number']").val(data.order_number);
        $("input[name='scope']").val(data.scope);
        $("#editModal").modal('show');
    }

    // function used show or hide the reply box 
    function replyBox() {
		const replyBox = document.getElementById('replyButton');
        const replyContainer = document.getElementById('replyContainer');
        if (replyContainer.style.display === 'block') {
			replyContainer.style.display = 'none';
			replyBox.style.display = 'block';
        } else {
			replyContainer.style.display = 'block';
			replyBox.style.display = 'none';
        }
		document.getElementById('cancelReplyButton').addEventListener('click', function(){
			replyContainer.style.display = 'none';
			replyBox.style.display = 'block';
		});

    }

    //  am trying to click on the whole row but its not working as expected
    // $('tr[data-href]').on('click', function(){
    //     // console.log('you clicked')
    //     var target = $(this).data('href');
    //     window.location.href = target;
    // })
    // data-href="{{ route('individualMessage') }}"
</script>