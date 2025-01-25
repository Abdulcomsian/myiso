
@forelse($downloads as $download)
<div style="display: flex; justify-content:space-between; margin-left: 2em; margin-right: 2em; background:#f0f4fd; gap:20px; margin-bottom:20px; padding:30px 20px; align-items:center; border-radius:12px; width:95%;">
    <div style="">
        @if ($download->thumb_nail)
        <div>
            <img src="{{ asset('uploads/downloads/' . $download->thumb_nail) }}" width="110" height="156">
        </div>
        @endif
    </div>
    <div style="color:#084f95; font-size: 18px; font-weight:600; text-align:left;align-items:left !important;">{{ $download->name }}</div>
 <div style="display: flex; gap:20px;justify-content:space-between;">
    <div style="display: flex; flex-direction: column;">
        @if ($download->download_file)
        <a href="{{ asset('uploads/downloads/' . $download->download_file) }}" target="_blank"><img src="assets/img/a4-btn.png" style="width: 80%"> </a><br>
        @endif
        @if ($download->download_file2)
        <a href="{{ asset('uploads/downloads/' . $download->download_file2) }}" target="_blank"><img src="assets/img/a5-btn.png"  style="width: 80%"></a><br>
        @endif
    </div>
    <div>
        <button class="footer-button">GET ACCESS</button>
        <a href="javascript:;" data-toggle="modal" data-target="#delete-{{ $download->id }}" title="Delete"><img src="assets/img/delete.png"  style="width: 80%"></a><br>
    </div>
 </div>
</div>
@empty
<div class="row">
    <div class="col-12">
        <p class="text-center " style="color:#084f95; font-size: 18px; font-weight:600;">No Record Found</p>
    </div>
</div>
@endforelse
