@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<style>
    .select2-search__field {
        padding-left: 10px !important;
    }
    .multiselect-native-select .btn-group {
        width: 100%;
    }
    .ms-options ul {
        padding: 8px;
        list-style-type: none;
    }
    .ms-options ul label {
        text-align: left !important;
        line-height: 12px;
    }
    .ms-options-wrap button {
        border: 1px solid #0d47b3;
    }
    .attachment-ext {
        font-size: 9px;
        color: black;
    }
</style>
@endsection

@section('content')
<div class="am-content">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="am-page-header">
        <div>
            <h2>Create Message</h2>
            <p>Compose and send a new message</p>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body am-form">
            <form action="{{ route('storeNotification') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="id" id="editvalue" value="">

                <div class="form-row">
                    <div class="form-col">
                        <label for="title">Subject</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Please enter Message Subject" required>
                    </div>
                    <div class="form-col">
                        <label for="attachment">Attachment <span class="attachment-ext">(doc, docx, xls, xlsx, .pdf, txt, jpeg, jpg, png, gif)</span></label>
                        <input type="file" name="attachment" class="form-control" id="attachment">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="20" rows="5" class="form-control" placeholder="Please enter your Message"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col" style="flex:1 1 100%;">
                        <label for="address1">Send To</label>
                        <input name="userid" class="form-control" value="Admin" disabled>
                    </div>
                </div>

                <div class="form-row" style="margin-top:16px;">
                    <div class="form-col">
                        <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
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
    //  $('input[name="date"]').daterangepicker();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    $('.startdate').datepicker({
        todayHighlight: true,
        "format": 'mm/dd/yyyy',
        "startDate": '01/01/2017',
        "endDate": today,
        "setDate": today
    }).on('changeDate', function (e) {
        start_date = $("#start_date").val();
        end_date = $("#end_date").val();
        filter_by_certificate = $("#filter_by_certificate").val();
        console.log(filter_by_certificate);
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
        "format": 'mm/dd/yyyy',
        "endDate": today,
        "setDate": today
    }).on('changeDate', function (e) {
        start_date = $("#start_date").val();
        end_date = $("#end_date").val();
        filter_by_certificate = $("#filter_by_certificate").val();
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

    $(function () {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = dd + '-' + mm + '-' + yyyy;
        $('input[name="daterange"]').daterangepicker({
            showDropdowns: true,
            changeYear: true,
            maxDate: today,
            minDate: '01-01-2017',
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear',
            }
        }, function (start, end, label) {
            start_date = start.format('YYYY-MM-DD');
            end_date = end.format('YYYY-MM-DD');
            console.log(start_date);
            console.log(end_date);
            $.ajax({
                type: "get",
                url: "{{ url('/send_message') }}",
                data: { 'start_date': start_date, 'end_date': end_date, 'type': 'month' },
                success: function (response) {
                    var res = JSON.parse(response);
                    $("#langOpt3").html(res[1]);
                    $(".ms-options ul").html(res[0]);
                },
            });
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    $('#langOpt3').multiselect({
        columns: 1,
        placeholder: 'Select Users',
        search: true,
        selectAll: true,
    });

    $("#filter_by_certificate").change(function () {
        let filter_by_certificate = $(this).val();
        start_date = $("#start_date").val();
        end_date = $("#end_date").val();

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

    let x = 0;
    $('.ms-selectall.global').click(function () {
        // toggle select and unselect text of this
        if (x == 0) {
            $(this).text('Unselect All');
            x = 1;
            return;
        }
        $(this).text($(this).text() == 'select All' ? 'Unselect All' : 'select All');
    });
</script>
@endsection
