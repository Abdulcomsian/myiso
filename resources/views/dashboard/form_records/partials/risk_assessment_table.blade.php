<div class="am-table-wrap">
    <table class="am-table" id="amRaTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Job Number</th>
                <th>Date</th>
                <th>Quality</th>
                <th>Delivery</th>
                <th>Price</th>
                <th>Risk Score</th>
                <th>Decision</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($assessment as $index => $data)
                @php
                    $risk = ((int)$data->RiskProbability) * ((int)$data->riskSeverity);
                    $riskCls = $risk >= 12 ? 'danger' : ($risk >= 6 ? 'warning' : 'success');
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $assessment->firstItem() + $index }}</span></td>
                    <td><span class="am-cell-primary">{{ $data->jobNumber }}</span></td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($data->date)) }}</span></td>
                    <td>{{ ucfirst($data->qualitySatandard) }}</td>
                    <td>{{ ucfirst($data->delevryStandard) }}</td>
                    <td>{{ ucfirst($data->priceRequiremnt) }}</td>
                    <td><span class="am-chip {{ $riskCls }}">{{ $data->RiskProbability }} × {{ $data->riskSeverity }} = {{ $risk }}</span></td>
                    <td>{{ Str::limit(ucfirst($data->DecisionComment), 40) }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amRaView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amRaEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('delete_assesment') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="Job #{{ $data->jobNumber }}"
                                    data-type="Risk Assessment">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9"><div class="am-empty"><i class="fa fa-user-shield"></i><p>No risk assessments recorded yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $assessment->firstItem() ?? 0 }}–{{ $assessment->lastItem() ?? 0 }}</strong> of <strong>{{ $assessment->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($assessment->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $assessment->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $assessment->currentPage();
            $last    = $assessment->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($assessment->hasMorePages())
            <button data-page="{{ $assessment->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
