<div class="am-dl-grid">
    @forelse ($all_downloads as $download)
        <div class="am-dl-card">
            <div class="am-dl-card__thumb">
                @if ($download->thumb_nail)
                    <img src="{{ asset('uploads/downloads/' . $download->thumb_nail) }}" alt="{{ $download->name }}"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="am-dl-card__placeholder" style="display:none;">
                        <i class="fa fa-image"></i>
                    </div>
                @else
                    <div class="am-dl-card__placeholder">
                        <i class="fa fa-image"></i>
                    </div>
                @endif
            </div>
            <div class="am-dl-card__body">
                <h4 class="am-dl-card__title">{{ $download->name }}</h4>
                <span class="am-chip info">{{ $download->category }}</span>

                <div class="am-dl-card__files">
                    @if ($download->download_file)
                        <a href="{{ asset('uploads/downloads/' . $download->download_file) }}" target="_blank" class="am-dl-file-chip">
                            <i class="fa fa-file-pdf"></i> A4
                        </a>
                    @endif
                    @if ($download->download_file2)
                        <a href="{{ asset('uploads/downloads/' . $download->download_file2) }}" target="_blank" class="am-dl-file-chip">
                            <i class="fa fa-file-pdf"></i> A5
                        </a>
                    @endif
                </div>
            </div>
            <div class="am-dl-card__actions">
                <button type="button" class="am-icon-btn danger am-confirm-delete"
                        title="Delete"
                        data-action="{{ url('/download_delete/'.$download->id) }}"
                        data-label="{{ $download->name }}"
                        data-type="Download">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    @empty
        <div class="am-empty" style="grid-column:1/-1;">
            <i class="fa fa-cloud-download-alt"></i>
            <p>No downloads found in this category.</p>
        </div>
    @endforelse
</div>

@if($all_downloads->hasPages() || $all_downloads->total() > 0)
<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $all_downloads->firstItem() ?? 0 }}–{{ $all_downloads->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($all_downloads->total()) }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($all_downloads->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $all_downloads->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif

        @php
            $current = $all_downloads->currentPage();
            $last = $all_downloads->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            $start = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($all_downloads->hasMorePages())
            <button data-page="{{ $all_downloads->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
@endif
