@php
    // One lookup for all rows instead of a query per row
    $supplierNames = \App\Supplier::where('user_id', $request)->pluck('suppliername', 'idnumber');
@endphp
<div class="am-table-wrap">
    <table class="am-table" id="amSrTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Supplier</th>
                <th>Product / Area</th>
                <th>Quality</th>
                <th>Price</th>
                <th>Delivery</th>
                <th>Overall</th>
                <th>Review Date</th>
                <th>Evidence</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($supplier_review as $index => $data)
                @php
                    $supplierLabel = $supplierNames[$data->sup_id] ?? 'Supplier #'.$data->sup_id;
                    $overall = (int) $data->OveralScore;
                    $chipCls = $overall >= 8 ? 'success' : ($overall >= 5 ? 'warning' : 'danger');
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $supplier_review->firstItem() + $index }}</span></td>
                    <td>
                        <div class="am-user-cell">
                            <span class="am-avatar">{{ strtoupper(substr($supplierLabel, 0, 1)) }}</span>
                            <div>
                                <span class="am-cell-primary">{{ $supplierLabel }}</span>
                                <span class="am-cell-sub">ID: {{ $data->sup_id }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $data->product_activity_area }}</td>
                    <td>{{ $data->qualityScore }}</td>
                    <td>{{ $data->priceScore }}</td>
                    <td>{{ $data->DScore }}</td>
                    <td><span class="am-chip {{ $chipCls }}">{{ $data->OveralScore }}/10</span></td>
                    <td>{{ date('d M Y', strtotime($data->AssesmentDate)) }}</td>
                    <td>
                        @if ($data->attach_evidence)
                            <a href="{{ asset('supplier_review_evidence/'.$data->attach_evidence) }}" target="_blank" style="color:var(--am-primary);"><i class="fa fa-paperclip"></i> View</a>
                        @endif
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amSrView(@json($data), @json($supplierLabel))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amSrEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteSupplierReviewAdmin') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="Review for {{ $supplierLabel }}"
                                    data-type="Supplier Review">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10"><div class="am-empty"><i class="fa fa-star"></i><p>No supplier reviews added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $supplier_review->firstItem() ?? 0 }}–{{ $supplier_review->lastItem() ?? 0 }}</strong> of <strong>{{ $supplier_review->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($supplier_review->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $supplier_review->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $supplier_review->currentPage();
            $last    = $supplier_review->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($supplier_review->hasMorePages())
            <button data-page="{{ $supplier_review->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
