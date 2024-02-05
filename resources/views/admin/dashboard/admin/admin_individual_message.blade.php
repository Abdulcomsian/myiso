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

        .text-right {
            text-align: right;
        }

        /* Custom CSS FOR REPLY BUTTON*/
        .reply-link {
            position: relative;
            text-decoration: none;
            /* Remove default underline */
            color: #007bff;
            /* Blue color for the link */
        }

        .reply-link:hover {
            color: #007bff;
        }

        .reply-link::before {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            /* Underline thickness */
            background-color: #007bff;
            left: 0;
            bottom: -2px;
            /* Position it below the text */
            transition: width 0.3s;
            /* Add a smooth transition to the width */
        }

        .reply-link:hover::before {
            width: 100%;
            /* Underline expands from left to right on hover */
        }

        .height-900{
		    height: 900px;
        }

        .height-500{
            height: 500px;
        }

        .height-400{
            height: 400px;
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
                        {{$other_user_detail->name}}
                    </h3>
                </div>

            </div>
            <div class="kt-portlet__body">
                <h2 class="col-md-12 mb-0 mt-2">
                    <a href="{{ route('receiveNotification') }}">
                        <button class="btn btn-primary mb-3" type="button"><i class="fa fa-arrow-left"
                                aria-hidden="true"></i>Back</button>
                    </a>
                    {{-- <button class="btn btn-primary mb-3" type="button" onclick="replyBox()">Reply</button> --}}
                </h2>
                {{-- Old Reply Box - Backup --}}
                {{-- @foreach ($message_information as $item)
                    <form action="{{ route('storeReplyMessageAdmin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="replyContainer" style="display: none; margin-top: 5px; margin-bottom: 5px;">

                            <input type="hidden" name="messageId" value="{{ $message_information[0]->unique_id }}">
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
                            <div class="text-right">
                                <button type="button" class="btn btn-primary mt-2" id="cancelReplyButton">Cancel</button>
                                <button type="submit" class="btn btn-primary mt-2" id="sendReplyButton">Send <i
                                        class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                @endforeach --}}


                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($message_information as $item)
                                @if (Auth::user()->id == $item->send_by)
                                    <div class="card mb-3 ml-5">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <strong>From - ISOOnline Admin</strong>
                                                </div>
                                                <div class="text-muted">
                                                    {{ date('d/m/Y H:i:sA', strtotime($item->created_at)) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if ($item->title)
                                                <h5 class="card-title">Subject: {{ $item->title }}</h5>
                                            @else
                                                <h5 class="card-title">(no subject)</h5>
                                            @endif

                                            @if($item->total_days >= 90 && $item->total_days < 180)
                                            <iframe src="{{ url('/three-month-email') }}" class="w-100 height-900"></iframe>
                                            @elseif($item->total_days >= 180 && $item->total_days < 300)
                                            <iframe src="{{ url('/six-month-email') }}" class="w-100 height-500"></iframe>
                                            @elseif($item->total_days >= 300)
                                            <iframe src="{{ url('/ten-month-email') }}" class="w-100 height-400"></iframe>
                                            @else   
                                                <p class="card-text">{{ $item->message }}</p>
                                            @endif
                                            @if ($item->attachement)
                                                <a href="{{ asset($item->attachement) }}" download>
                                                    <i class="fa fa-paperclip"></i> Attachment
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="card mb-3">
                                        {{-- using modal reply popup  --}}
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <strong>From - {{ $item->name }}</strong>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <span
                                                        class="text-muted">{{ date('d/m/Y H:i:sA', strtotime($item->created_at)) }}</span>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for the reply -->
                                        <div class="modal fade" id="replyModal" tabindex="-1" role="dialog"
                                            aria-labelledby="replyModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">                                                                                      
                                                        <h5 class="modal-title" id="replyModalLabel">Replying to
                                                            {{ $item->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('storeReplyMessageAdmin') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div>
                                                                    <input type="hidden" name="messageId" id="messageIdField" value="">
                                                                    <input type="hidden" name="title" id="messageSubject" value="">
                                                                    <input type="hidden" name="receiver" value="{{ $item->send_to }}">
                                                                    <input type="hidden" name="sender" value="{{ $item->send_by }}">
                                                                    <input type="hidden" name="parentId" id="parentMessageId" value="">
                                                                    <textarea class="form-control" name="replyMessage" rows="4" id="replyTextarea" placeholder="Write your reply here"></textarea>
                                                                    <label class="form-label mt-2" for="attachment">Add Attachment (If Any)</label>
                                                                    <div class="kt-input-icon kt-input-icon--right">
                                                                        <input type="file" name="attachment"
                                                                            class="form-control" id="attachment">
                                                                    </div>                                                                   
                                                                </div>
                                                                <div class="text-right mt-2">
                                                                    <button type="submit" class="btn btn-primary mt-2" id="sendReplyButton">Send <i
                                                                            class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                                </div>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php
                                            $user_id = Auth::user()->id;
                                            $parent_message_id = App\SendNotifications::where('unique_id', $item->unique_id)
                                            ->where('send_by', $user_id)
                                            ->first(['id']);                                        
                                            
                                        ?>
                                        <div class="card-body">
                                            @if ($item->title)
                                                <h5 class="card-title">Subject: {{ $item->title }}</h5>
                                            @else
                                                <h5 class="card-title">(no subject)</h5>
                                            @endif
                                            <p class="card-text">{{ $item->message }}</p>
                                            @if ($item->attachement)
                                            <a href="{{ asset($item->attachement) }}" download>
                                                <i class="fa fa-paperclip"></i> Attachment
                                            </a>
                                            @endif
                                            <br><button class="btn btn-primary mt-2 reply-button" 
                                            data-message-subject="{{ $item->title }}" 
                                            data-unique-id="{{ $item->unique_id }}"
                                            data-parent-id="{{ $parent_message_id }}" 
                                            type="button"
                                            data-toggle="modal" 
                                            data-target="#replyModal">Reply</button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>


                {{-- old one the first one is open and other all are closed  --}}
                {{-- @foreach ($message_information as $key => $item)
			<div class="accordion" id="accordionExample">
				@if (Auth::user()->id == $item->send_by)
				<div class="card">
					<div class="card-header" id="heading{{ $item->id }}">
						<h2 class="mb-0">
							<button class="btn btn-link" type="button" data-toggle="collapse"
								data-target="#collapse{{ $item->id }}" aria-expanded="true"
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
			@endforeach			 --}}
            </div>
        </div>
    </div>
    <script>
        // const accordionItems = document.querySelectorAll('.card');

        // accordionItems.forEach((item) => {
        //     const button = item.querySelector('button');

        //     button.addEventListener('click', () => {
        //         const collapse = item.querySelector('.collapse');
        //         const expanded = button.getAttribute('aria-expanded') === 'true';

        //         if (expanded) {
        //             collapse.classList.remove('show');
        //             button.setAttribute('aria-expanded', 'false');
        //         } else {
        //             collapse.classList.add('show');
        //             button.setAttribute('aria-expanded', 'true');
        //         }
        //     });
        // });

        // Add a click event listener to the "Reply" button
        document.querySelectorAll('.reply-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var uniqueId = this.getAttribute('data-unique-id');
                var messageSubject = this.getAttribute('data-message-subject');
                var parentMessageId = this.getAttribute('data-parent-id');
                document.getElementById('messageIdField').value = uniqueId;
                document.getElementById('messageSubject').value = messageSubject;
                document.getElementById('parentMessageId').value = parentMessageId;
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
        // function replyBox() {
        //     const replyBox = document.getElementById('replyButton');
        //     const replyContainer = document.getElementById('replyContainer');
        //     if (replyContainer.style.display === 'block') {
        //         replyContainer.style.display = 'none';
        //         replyBox.style.display = 'block';
        //     } else {
        //         replyContainer.style.display = 'block';
        //         replyBox.style.display = 'none';
        //     }
        //     document.getElementById('cancelReplyButton').addEventListener('click', function() {
        //         replyContainer.style.display = 'none';
        //         replyBox.style.display = 'block';
        //     });

        // }

        //  am trying to click on the whole row but its not working as expected
        // $('tr[data-href]').on('click', function(){
        //     // console.log('you clicked')
        //     var target = $(this).data('href');
        //     window.location.href = target;
        // })
        // data-href="{{ route('individualMessage') }}"
    </script>
@endsection
