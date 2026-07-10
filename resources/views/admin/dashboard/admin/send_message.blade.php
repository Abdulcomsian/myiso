@extends('admin.dashboard.layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<style>
    .select2-search__field { padding-left: 10px !important; }
    .multiselect-native-select .btn-group { width: 100%; }
    .ms-options ul { padding: 8px; list-style-type: none; }
    .ms-options ul label { text-align: left !important; line-height: 12px; }
    .ms-options-wrap button {
        border: 1px solid var(--am-border) !important;
        background: #fff !important;
        border-radius: 8px !important;
        padding: 10px 12px !important;
        font-size: 13px !important;
        color: var(--am-text) !important;
        width: 100%;
        text-align: left !important;
    }
    .attachment-ext { font-size: 10px; color: var(--am-text-muted); font-weight: 400; margin-left: 4px; }
    #message + .cke { border-radius: 8px !important; border-color: var(--am-border) !important; }
</style>
@endsection

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Create Message</h2>
            <p>Send a new notification message to one or more clients.</p>
        </div>
        <div>
            <a href="{{ route('receiveNotification') }}" class="am-btn am-btn-outline"><i class="fa fa-inbox"></i> Inbox</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
        <i class="fa fa-check-circle"></i> {{ $message }}
    </div>
    @elseif($message = Session::get('error'))
    <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#b83432;background:rgba(235,77,75,0.08);">
        <i class="fa fa-exclamation-circle"></i> {{ $message }}
    </div>
    @endif

    <div class="am-card am-form">
        <div class="am-card__header">
            <h3><i class="fa fa-paper-plane" style="color:var(--am-primary);margin-right:8px;"></i> Compose Message</h3>
        </div>
        <div style="padding:26px;">

            <form action="{{ route('sendNotifications') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="id" id="editvalue" value="">

                <div class="form-row" style="grid-template-columns: 2fr 1fr;">
                    <div>
                        <label for="title">Subject</label>
                        <input type="text" id="title" name="title" placeholder="Enter message subject">
                    </div>
                    <div>
                        <label for="attachment">Attachment <span class="attachment-ext">(doc, docx, xls, xlsx, pdf, txt, jpeg, jpg, png, gif)</span></label>
                        <input type="file" name="attachment" id="attachment">
                    </div>
                </div>

                <div class="form-row">
                    <div style="grid-column:1/-1;">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" placeholder="Please enter your message"></textarea>
                        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('message', { versionCheck: false });
                        </script>
                    </div>
                </div>

                <div style="border-top:1px solid var(--am-border);padding-top:18px;margin-top:18px;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:12px;">
                        <i class="fa fa-filter"></i> Recipient Filters
                    </div>

                    <div class="form-row">
                        <div>
                            <label for="start_date">Last Login — Start Date</label>
                            <input type="text" name="startdate" id="start_date" class="startdate" placeholder="mm/dd/yyyy" autocomplete="off">
                        </div>
                        <div>
                            <label for="end_date">Last Login — End Date</label>
                            <input type="text" name="enddate" id="end_date" class="enddate" placeholder="mm/dd/yyyy" autocomplete="off">
                        </div>
                        <div>
                            <label for="filter_by_certificate">Filter by Certificate</label>
                            <select id="filter_by_certificate">
                                <option value="">Select Certificate</option>
                                <option value="iso9001_certificate">ISO 9001 Certificate</option>
                                <option value="iso14001_certificate">ISO 14001 Certificate</option>
                                <option value="iso45001_certificate">ISO 45001 Certificate</option>
                                <option value="ims">IMS</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>

                    @php $usertypes = \App\UserType::get(); @endphp

                    <div class="form-row">
                        <div style="grid-column:1/-1;">
                            <label>Send To</label>
                            <input type="hidden" id="showusers" name="user_type" value="0">
                            <div class="users_dropdown">
                                <div id="select_dropdown">
                                    <select name="userid[]" id="langOpt3" multiple>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;border-top:1px solid var(--am-border);padding-top:18px;margin-top:18px;">
                    <a href="{{ route('receiveNotification') }}" class="am-btn am-btn-outline"><i class="fa fa-times"></i> Cancel</a>
                    <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-paper-plane"></i> Send Message</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('myscript')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/jquery.multiselect.js') }}"></script>
<script src="http://demos.codexworld.com/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>

<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = mm + '/' + dd + '/' + yyyy;

    $('.startdate').datepicker({
        todayHighlight: true,
        format: 'mm/dd/yyyy',
        startDate: '01/01/2017',
        endDate: today,
        setDate: today,
        autoclose: true,
    }).on('changeDate', function () {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var filter_by_certificate = $("#filter_by_certificate").val();
        $('.enddate').datepicker('setStartDate', start_date);
        $.ajax({
            type: "get",
            url: "{{ url('/send_message') }}",
            data: { 'start_date': start_date, 'end_date': end_date, 'filter_by_certificate': filter_by_certificate, 'type': 'month' },
            success: function (response) {
                var res = JSON.parse(response);
                $("#langOpt3").html(res[1]);
                $(".ms-options ul").html(res[0]);
            },
        });
    });

    $('.enddate').datepicker({
        todayHighlight: true,
        format: 'mm/dd/yyyy',
        endDate: today,
        setDate: today,
        autoclose: true,
    }).on('changeDate', function () {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var filter_by_certificate = $("#filter_by_certificate").val();
        $.ajax({
            type: "get",
            url: "{{ url('/send_message') }}",
            data: { 'start_date': start_date, 'end_date': end_date, 'filter_by_certificate': filter_by_certificate, 'type': 'month' },
            success: function (response) {
                var res = JSON.parse(response);
                $("#langOpt3").html(res[1]);
                $(".ms-options ul").html(res[0]);
            },
        });
    });

    $(document).on("change", "#showusers", function () {
        var selectVal = $(this).val();
        $.ajax({
            type: "get",
            url: `{{ route('fetch.users') }}?id=${selectVal}`,
            success: function (response) {
                if (response.success == true) {
                    $("#select_dropdown").hide();
                    $(".users_dropdown").html(response.html);
                    $('#langOpt3').multiselect({
                        columns: 1,
                        placeholder: 'Select Users',
                        search: true,
                        selectAll: true,
                    });
                }
            },
        });
    });

    $('#langOpt3').multiselect({
        columns: 1,
        placeholder: 'Select Users',
        search: true,
        selectAll: true,
    });

    $("#filter_by_certificate").change(function () {
        var filter_by_certificate = $(this).val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        $.ajax({
            type: "get",
            url: "{{ url('/send_message') }}",
            data: { 'start_date': start_date, 'end_date': end_date, 'filter_by_certificate': filter_by_certificate, 'type': 'month' },
            success: function (response) {
                var res = JSON.parse(response);
                $("#langOpt3").html(res[1]);
                $(".ms-options ul").html(res[0]);
            },
        });
    });

    var x = 0;
    $('.ms-selectall.global').click(function () {
        if (x == 0) {
            $(this).text('Unselect All');
            x = 1;
            return;
        }
        $(this).text($(this).text() == 'select All' ? 'Unselect All' : 'select All');
    });
</script>
@endsection
