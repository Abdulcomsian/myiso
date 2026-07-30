@extends('dashboard.layouts.app')

@section('content')
<style>
    .height-900 { height: 900px; }
    .height-500 { height: 500px; }
    .height-400 { height: 400px; }
    .message-accordion .accordion-item {
        border: 1px solid #e2e6ea;
        border-radius: 6px;
        margin-bottom: 8px;
        overflow: hidden;
    }
    .message-accordion .accordion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background: #f8f9fa;
        cursor: pointer;
    }
    .message-accordion .accordion-header .btn-link {
        background: none;
        border: none;
        font-size: 15px;
        font-weight: 600;
        color: #2e3b9a;
        padding: 0;
        text-align: left;
    }
    .message-accordion .accordion-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: #888;
    }
    .message-accordion .accordion-body {
        padding: 16px;
        background: #fff;
    }
</style>

<div class="am-content">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="am-page-header">
        <div>
            <h2>Message Thread</h2>
            <p>Subject &mdash; {{ $message_information[0]->title }}</p>
        </div>
        <div class="am-page-header__actions">
            <a href="javascript:history.back()" class="am-btn am-btn-outline"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body">
            <div class="message-accordion accordion" id="accordionExample">
                @foreach ($message_information as $key => $item)
                    @if($item->total_days >= 90 && $item->total_days < 180)
                        <iframe src="{{ url('/three-month-email') }}" class="w-100 height-900"></iframe>
                    @elseif($item->total_days >= 180 && $item->total_days < 300)
                        <iframe src="{{ url('/six-month-email') }}" class="w-100 height-500"></iframe>
                    @elseif($item->total_days >= 300)
                        <iframe src="{{ url('/ten-month-email') }}" class="w-100 height-400"></iframe>
                    @else
                        @if (Auth::user()->id == $item->send_by)
                        <div class="accordion-item card">
                            <div class="card-header accordion-header" id="heading{{ $item->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse{{ $item->id }}"
                                        aria-expanded="{{ $key === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $item->id }}">
                                        From &mdash; Me
                                    </button>
                                </h2>
                                <div class="accordion-meta">
                                    @if ($item->attachement)
                                        <a href="{{ asset($item->attachement) }}" download><i class="fa fa-download"></i> Attachment</a>
                                    @endif
                                    <span>{{ date("d/m/Y H:i:sA", strtotime($item->created_at)) }}</span>
                                </div>
                            </div>
                            <div id="collapse{{ $item->id }}"
                                class="collapse {{ $key === 0 ? 'show' : '' }}"
                                aria-labelledby="heading{{ $item->id }}"
                                data-parent="#accordionExample">
                                <div class="accordion-body card-body">
                                    {!! $item->message !!}
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="accordion-item card">
                            <div class="card-header accordion-header" id="heading{{ $item->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse{{ $item->id }}"
                                        aria-expanded="{{ $key === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $item->id }}">
                                        From &mdash; {{ $item->name }}
                                    </button>
                                </h2>
                                <div class="accordion-meta">
                                    @if ($item->attachement)
                                        <a href="{{ asset($item->attachement) }}" download><i class="fa fa-download"></i> Attachment</a>
                                    @endif
                                    <span>{{ date("d/m/Y H:i:sA", strtotime($item->created_at)) }}</span>
                                </div>
                            </div>
                            <div id="collapse{{ $item->id }}"
                                class="collapse {{ $key === 0 ? 'show' : '' }}"
                                aria-labelledby="heading{{ $item->id }}"
                                data-parent="#accordionExample">
                                <div class="accordion-body card-body">
                                    {!! $item->message !!}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-top:16px;">
        <div class="am-card__body">
            <button class="am-btn am-btn-outline" type="button" onclick="replyBox()" id="replyButton">
                <i class="fa fa-reply"></i> Reply
            </button>

            @foreach ($message_information as $item)
            <form action="{{ route('storeReplyMessageUser') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="replyContainer" style="display: none; margin-top: 16px;">
                    <input type="hidden" name="messageId" value="{{ $item->unique_id }}">
                    <input type="hidden" name="title" value="{{ $item->title }}">
                    <input type="hidden" name="receiver" value="{{ $item->send_to }}">
                    <input type="hidden" name="sender" value="{{ $item->send_by }}">
                    <input type="hidden" name="parentId" value="{{ $parent_message_id }}">

                    <div class="am-form">
                        <div class="form-row">
                            <div class="form-col" style="flex:1 1 100%;">
                                <label>Reply</label>
                                <textarea class="form-control" name="replyMessage" rows="4" id="replyTextarea"
                                    placeholder="Write your reply here"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col" style="flex:1 1 100%;">
                                <label for="attachment">Add Attachment (If Any)</label>
                                <input type="file" name="attachment" class="form-control" id="attachment">
                            </div>
                        </div>
                        <div class="form-row" style="margin-top:12px; gap:8px;">
                            <button type="submit" class="am-btn am-btn-primary" id="sendReplyButton">
                                <i class="fa fa-paper-plane"></i> Send
                            </button>
                            <button type="button" class="am-btn am-btn-outline" id="cancelReplyButton">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>

</div>

<script>
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
        document.getElementById('cancelReplyButton').addEventListener('click', function () {
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
@endsection
