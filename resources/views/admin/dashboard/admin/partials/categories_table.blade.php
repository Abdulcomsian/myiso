<div class="am-table-wrap">
    <table class="am-table" id="amCategoriesTable">
        <thead>
        <tr>
            <th style="width:60px;">#</th>
            <th>Category Name</th>
            <th>Created</th>
            <th style="text-align:right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($all_cate as $cat)
            <tr>
                <td>
                    <span class="am-cell-sub">#{{ $cat->id }}</span>
                </td>
                <td>
                    <span class="am-cell-primary">{{ $cat->name }}</span>
                </td>
                <td>
                    @if($cat->created_at)
                        <span class="am-cell-sub">{{ date('d M Y', strtotime($cat->created_at)) }}</span>
                    @else
                        <span class="am-cell-sub">—</span>
                    @endif
                </td>
                <td style="text-align:right;white-space:nowrap;">
                    <div class="am-actions">
                        <button type="button" class="am-icon-btn danger am-confirm-delete"
                                title="Delete"
                                data-action="{{ url('/cat_delete/'.$cat->id) }}"
                                data-label="{{ $cat->name }}"
                                data-type="Category">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div class="am-empty">
                        <i class="fa fa-folder-open"></i>
                        <p class="text-center">No categories found.</p>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $all_cate->firstItem() ?? 0 }}–{{ $all_cate->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($all_cate->total()) }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($all_cate->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $all_cate->currentPage() - 1 }}" class="am-page-link am-cats-page">‹</button>
        @endif

        @php
            $current = $all_cate->currentPage();
            $last = $all_cate->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            $start = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link am-cats-page {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($all_cate->hasMorePages())
            <button data-page="{{ $all_cate->currentPage() + 1 }}" class="am-page-link am-cats-page">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
