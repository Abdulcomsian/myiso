<div class="am-table-wrap">
    <table class="am-table" id="amCrTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Customer</th>
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
            @forelse ($customer_review as $index => $data)
                @php
                    $customersName = \App\customers::where('user_id', $request)->where('idNumber', $data->cus_id)->first();
                    $customerLabel = $customersName ? $customersName->name : 'Customer #'.$data->cus_id;
                    $overall = (int) $data->OveralScore;
                    $chipCls = $overall >= 8 ? 'success' : ($overall >= 5 ? 'warning' : 'danger');
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $customer_review->firstItem() + $index }}</span></td>
                    <td>
                        <div class="am-user-cell">
                            <span class="am-avatar">{{ strtoupper(substr($customerLabel, 0, 1)) }}</span>
                            <div>
                                <span class="am-cell-primary">{{ $customerLabel }}</span>
                                <span class="am-cell-sub">ID: {{ $data->cus_id }}</span>
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
                        @isset($data->attach_evidence)
                            <a href="{{ asset('customer_review_evidence/'.$data->attach_evidence) }}" target="_blank" style="color:var(--am-primary);"><i class="fa fa-paperclip"></i> View</a>
                        @endisset
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amCrView(@json($data), @json($customerLabel))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amCrEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteCustomerRivewAdmin') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="Review for {{ $customerLabel }}"
                                    data-type="Customer Review">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10"><div class="am-empty"><i class="fa fa-star"></i><p>No customer reviews added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $customer_review->firstItem() ?? 0 }}–{{ $customer_review->lastItem() ?? 0 }}</strong> of <strong>{{ $customer_review->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($customer_review->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $customer_review->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $customer_review->currentPage();
            $last    = $customer_review->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($customer_review->hasMorePages())
            <button data-page="{{ $customer_review->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
