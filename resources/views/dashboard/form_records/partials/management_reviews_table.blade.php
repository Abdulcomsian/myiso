{{-- The list of reviews. Every word comes from App\MgtReviewQuestions, so this
     one file serves the user page and the admin page in both languages.

     $userData     the paginator
     $editBase     the page "Edit" goes back to
     $deleteRoute  where the delete form posts
--}}
@php
    $L = App\MgtReviewQuestions::labels();
    $put = function ($text, $pairs) { return strtr($text, $pairs); };
@endphp
<div class="am-table-wrap">
    <table class="am-table" id="amMgtTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>{{ $L['col_date'] }}</th>
                <th>{{ $L['col_chairedby'] }}</th>
                <th>{{ $L['col_open'] }}</th>
                <th>{{ $L['col_nextdue'] }}</th>
                <th style="text-align:right;">{{ $L['col_actions'] }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userData as $index => $item)
                @php
                    $open  = $item->openActions();
                    $total = $item->actions->count();
                    $shown = $item->reviewdate ? date('d M Y', strtotime($item->reviewdate)) : '—';
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $userData->firstItem() + $index }}</span></td>
                    <td><span class="am-chip info">{{ $shown }}</span></td>
                    <td>{{ $item->chairedby ?: '—' }}</td>
                    <td>
                        @if ($total === 0)
                            <span class="am-cell-sub">—</span>
                        @elseif ($open > 0)
                            <span class="am-chip warning">{{ $put($L['chip_open'], [':n' => $open]) }}</span>
                        @else
                            <span class="am-chip success">{{ $put($L['chip_done'], [':n' => $total]) }}</span>
                        @endif
                    </td>
                    <td>{{ $item->nextreviewdue ? date('d M Y', strtotime($item->nextreviewdue)) : '—' }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="{{ $L['view'] }}" onclick='amMgtView(@json($item->viewPayload()))'><i class="fa fa-eye"></i></button>
                            <a class="am-icon-btn" title="{{ $L['edit'] }}" href="{{ $editBase ?? url('/add_management_review') }}?edit={{ $item->id }}"><i class="fa fa-pen"></i></a>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="{{ $L['delete'] }}"
                                    data-action="{{ $deleteRoute ?? route('deletemgtreview') }}"
                                    data-id="{{ $item->id }}"
                                    data-label="{{ $put($L['review_of'], [':date' => $shown]) }}"
                                    data-type="{{ $L['requirement_title'] }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6"><div class="am-empty"><i class="fa fa-chart-line"></i><p>{{ $L['empty'] }}</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        {{ $L['showing'] }} <strong>{{ $userData->firstItem() ?? 0 }}–{{ $userData->lastItem() ?? 0 }}</strong> {{ $L['of'] }} <strong>{{ $userData->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($userData->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $userData->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $userData->currentPage();
            $last    = $userData->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($userData->hasMorePages())
            <button data-page="{{ $userData->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
