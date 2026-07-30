@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="am-page-header">
        <div>
            <h2>Sent Messages</h2>
            <p>Messages you have sent</p>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="kt_table_user">
                <thead>
                    <tr>
                        <th style="text-align:left;">No.</th>
                        <th style="text-align:left;">To</th>
                        <th style="text-align:left;">Subject</th>
                        <th style="text-align:left;">Sent At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0; ?>
                    @foreach ($users as $item)
                    <?php $count++; $counter = App\SendNotifications::where('unique_id', $item->unique_id)->count(); ?>
                    <tr data-href="{{ route('individualMessageUser', ['id' => $item->unique_id]) }}" class="read" style="cursor:pointer;">
                        <td>{{ $count }}</td>
                        <td>{{ $item->name . ' (' . $counter . ')' }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ date("d/m/Y H:i:sA", strtotime($item->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    $(document).ready(function () {
        // Add a click event listener to the table rows with the data-href attribute
        $('tr[data-href]').click(function (event) {
            event.preventDefault();
            var row = $(this);
            // var isUnread = row.hasClass('New');
            // if (isUnread) {
            //     row.removeClass('New');
            //     var itemID = row.data('item-id');
            //     $.ajax({
            //         type: 'POST',
            //         url: '{{ route('markasread') }}',
            //         data: {
            //             item_id: itemID,
            //             _token: $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function() {
            //             // Optional: You can update the UI further if needed
            //         },
            //     });
            // }
            // Redirect to the link specified in data-href
            window.location.href = row.attr('data-href');
        });
    });
</script>
