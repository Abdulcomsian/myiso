{{-- The Calibration Due card's list. Its own partial so the pager can fetch
     it on its own, the way the Objectives card does.

     The rows are exactly what the card has always shown - the same records,
     the same columns, the same delete button. Only the paging is new. --}}
@if($calibration->isEmpty())
<div class="am-empty">
    <i class="fa fa-database"></i>
    <p>No calibration records due.</p>
</div>
@else
<div class="am-table-wrap">
    <table class="am-table">
        <thead>
            <tr>
                <th>Equipment ID</th>
                <th>Equipment Name</th>
                <th>Serial Number</th>
                <th>Date Calibrated</th>
                <th>Frequency</th>
                <th>Date Due</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calibration as $index => $data)
            <tr>
                <td>{{ $calibration->firstItem() + $index }}</td>
                <td>{{$data->equipment}}</td>
                <td>{{$data->serialNum}}</td>
                <td>{{date('d/m/Y', strtotime($data->calibratedDate))}}</td>
                <td>{{$data->freq}}</td>
                @php $d = strtotime("+$data->freq months",strtotime($data->calibratedDate)); @endphp
                <td>{{ date("d/m/Y", $d) }}</td>
                <td>
                    <a href="javascript:;" data-toggle="modal" data-id="{{$data->id}}" class="calibrationModal am-btn am-btn-sm am-btn-danger" title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@include('dashboard.partials.dash_list_footer', [
    'paginator'  => $calibration,
    'viewAllUrl' => url('/calibration_record'),
])
