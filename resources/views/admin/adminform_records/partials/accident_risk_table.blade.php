<div class="am-table-wrap">
    <table class="am-table" id="amArTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Scenario</th>
                <th>Initial Risk</th>
                <th>Revised Risk</th>
                <th>Prevention</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riskassesment as $index => $data)
                @php
                    $initial = ((int)$data->risklikehood) * ((int)$data->riskseverity);
                    $revised = ((int)$data->revisedrisk) * ((int)$data->reviseRiskSever);
                    $initClass = $initial >= 24 ? 'danger' : ($initial >= 12 ? 'warning' : 'success');
                    $revClass  = $revised >= 24 ? 'danger' : ($revised >= 12 ? 'warning' : 'success');
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $riskassesment->firstItem() + $index }}</span></td>
                    <td>
                        <span class="am-cell-primary">{{ Str::limit($data->activityscenario, 60) }}</span>
                        <span class="am-cell-sub">{{ Str::limit($data->consequences, 60) }}</span>
                    </td>
                    <td><span class="am-chip {{ $initClass }}">{{ $data->risklikehood }} × {{ $data->riskseverity }} = {{ $initial }}</span></td>
                    <td><span class="am-chip {{ $revClass }}">{{ $data->revisedrisk }} × {{ $data->reviseRiskSever }} = {{ $revised }}</span></td>
                    <td>{{ Str::limit($data->reducerisk, 50) }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amArView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amArEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteRisk') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ Str::limit($data->activityscenario, 40) }}"
                                    data-type="Accident Risk Assessment">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6"><div class="am-empty"><i class="fa fa-first-aid"></i><p>No accident risk assessments recorded yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $riskassesment->firstItem() ?? 0 }}–{{ $riskassesment->lastItem() ?? 0 }}</strong> of <strong>{{ $riskassesment->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($riskassesment->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $riskassesment->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $riskassesment->currentPage();
            $last    = $riskassesment->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($riskassesment->hasMorePages())
            <button data-page="{{ $riskassesment->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
