<div class="am-table-wrap">
    <table class="am-table" id="amFaqsTable">
        <thead>
        <tr>
            <th style="width:60px;">#</th>
            <th>Question</th>
            <th>Category</th>
            <th style="text-align:right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($all_faqs as $faq)
            <tr>
                <td>
                    <span class="am-cell-sub">#{{ $faq->id }}</span>
                </td>
                <td>
                    <span class="am-cell-primary">{{ Str::limit($faq->question, 90) }}</span>
                    <span class="am-cell-sub">{{ Str::limit(strip_tags($faq->answer), 100) }}</span>
                </td>
                <td>
                    @if($faq->category && isset($categoryMap[$faq->category]))
                        <span class="am-chip info">{{ $categoryMap[$faq->category] }}</span>
                    @elseif($faq->category)
                        <span class="am-chip warning">Unknown</span>
                    @else
                        <span class="am-cell-sub">—</span>
                    @endif
                </td>
                <td style="text-align:right;white-space:nowrap;">
                    <div class="am-actions">
                        <a href="{{ url('/faq_edit/'.$faq->id) }}" class="am-icon-btn" title="Edit"><i class="fa fa-pen"></i></a>
                        <button type="button" class="am-icon-btn danger am-confirm-delete"
                                title="Delete"
                                data-action="{{ url('/faq_delete/'.$faq->id) }}"
                                data-label="{{ Str::limit($faq->question, 60) }}"
                                data-type="FAQ">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div class="am-empty text-center">
                        <i class="fa fa-question-circle"></i>
                        <p class="text-center">No FAQs found.</p>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $all_faqs->firstItem() ?? 0 }}–{{ $all_faqs->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($all_faqs->total()) }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($all_faqs->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $all_faqs->currentPage() - 1 }}" class="am-page-link am-faqs-page">‹</button>
        @endif

        @php
            $current = $all_faqs->currentPage();
            $last = $all_faqs->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            $start = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link am-faqs-page {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($all_faqs->hasMorePages())
            <button data-page="{{ $all_faqs->currentPage() + 1 }}" class="am-page-link am-faqs-page">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
