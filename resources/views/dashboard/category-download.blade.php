
@forelse($downloads as $download)
<div class="col-6 col-sm-4 col-lg-3 mb-4">
    <div class="am-card" style="text-align:center;padding:16px;">
        @if ($download->thumb_nail)
        <img src="{{ asset('uploads/downloads/' . $download->thumb_nail) }}" width="90" height="128" style="display:block;margin:0 auto 12px;object-fit:contain;">
        <div style="color:#084f95;font-size:14px;font-weight:600;margin-bottom:12px;">{{ $download->name }}</div>
        @endif
        <div style="display:flex;flex-direction:column;gap:6px;align-items:center;">
            @if ($download->download_file)
            <a href="{{ asset('uploads/downloads/' . $download->download_file) }}" class="btn-fetch-data" data-id="{{ $download->id }}" target="_blank"><img src="assets/img/a4-btn.png" style="width:80px;"></a>
            @endif
            @if ($download->download_file2)
            <a href="{{ asset('uploads/downloads/' . $download->download_file2) }}" class="btn-fetch-data" data-id="{{ $download->id }}" target="_blank"><img src="assets/img/a5-btn.png" style="width:80px;"></a>
            @endif
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <p class="text-center" style="color:#084f95;font-size:18px;font-weight:600;">No Record Found</p>
</div>
@endforelse
