{{-- The Requirements Due card's list. Its own partial so the pager can fetch
     it on its own, the way the Objectives card does.

     The rows are exactly what the card has always shown - the same records,
     the same columns, the same delete button. Only the paging is new. --}}
@if($requirement->isEmpty())
<div class="am-empty">
    <i class="fa fa-database"></i>
    <p>No requirements due.</p>
</div>
@else
<div class="am-table-wrap">
    <table class="am-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Requirements</th>
                <th>Date Completed</th>
                <th>Periodicity (Months)</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requirement as $index => $data)
                <tr>
                    <td>{{ $requirement->firstItem() + $index }}</td>
                    <td>{{ $data->requirment_title}}</td>
                    @php $d = strtotime($data->completion_date); @endphp
                    <td>{{date("d/m/Y", $d) }}</td>
                    <td>{{ $data->periods }}</td>
                    @php $d = strtotime("+$data->periods months",strtotime($data->completion_date)); @endphp
                    <td>{{ date("d/m/Y",$d)}}</td>
                    {{-- red once the due date has gone by. A record with no completion_date behind
                         it has no real due date, so it gets a dash instead of a red flag --}}
                    @php $amDue = !empty($data->completion_date) && strtotime($data->completion_date) && $d; @endphp
                    <td class="am-due-status">
                        @if ($amDue)
                            <span class="am-chip {{ $d < strtotime('today') ? 'danger' : 'success' }}">{{ $d < strtotime('today') ? 'Overdue' : 'On track' }}</span>
                        @else
                            <span class="am-chip neutral">&mdash;</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" data-id="{{$data->id}}" class="delete_requirement am-btn am-btn-sm am-btn-danger" title="Delete">
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
    'paginator'  => $requirement,
    'viewAllUrl' => url('/requirements_aspect'),
])
