<div class="am-table-wrap">
    <table class="am-table" id="amVideosTable">
        <thead>
        <tr>
            <th style="width:60px;">#</th>
            <th style="width:120px;">Thumbnail</th>
            <th>Title</th>
            <th>Uploaded</th>
            <th style="text-align:right;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($all_videos as $video)
            <tr>
                <td>
                    <span class="am-cell-sub">#{{ $video->id }}</span>
                </td>
                <td>
                    <div style="position:relative;width:110px;height:66px;border-radius:8px;overflow:hidden;background:#0f172a;">
                        @if(!empty($video->video_image))
                            <img src="{{ asset('assets/media/video_images/'.$video->video_image) }}" alt=""
                                 style="width:100%;height:100%;object-fit:cover;"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div style="display:none;position:absolute;inset:0;align-items:center;justify-content:center;color:#94a3b8;">
                                <i class="fa fa-video"></i>
                            </div>
                        @else
                            <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#94a3b8;">
                                <i class="fa fa-video"></i>
                            </div>
                        @endif
                        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;">
                            <span style="width:28px;height:28px;border-radius:50%;background:rgba(0,0,0,0.55);color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:11px;">
                                <i class="fa fa-play"></i>
                            </span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="am-cell-primary">{{ $video->title ?? '—' }}</span>
                    <span class="am-cell-sub">{{ $video->video ?? '' }}</span>
                </td>
                <td>
                    @if($video->created_at)
                        <span class="am-chip info">{{ date('d M Y', strtotime($video->created_at)) }}</span>
                    @else
                        <span class="am-cell-sub">—</span>
                    @endif
                </td>
                <td style="text-align:right;white-space:nowrap;">
                    <div class="am-actions">
                        <a href="{{ asset('uploads/explainer_videos/'.$video->video) }}" target="_blank" class="am-icon-btn" title="Preview"><i class="fa fa-play"></i></a>
                        <button type="button" class="am-icon-btn danger am-confirm-delete"
                                title="Delete"
                                data-action="{{ url('/video_delete/'.$video->id) }}"
                                data-label="{{ $video->title }}"
                                data-type="Video">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <div class="am-empty">
                        <i class="fa fa-video"></i>
                        <p>No videos found.</p>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $all_videos->firstItem() ?? 0 }}–{{ $all_videos->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($all_videos->total()) }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($all_videos->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $all_videos->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif

        @php
            $current = $all_videos->currentPage();
            $last = $all_videos->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            $start = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($all_videos->hasMorePages())
            <button data-page="{{ $all_videos->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
