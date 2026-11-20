{{-- One uploaded process image: drawn if it can be, offered if it cannot.

     $img    the stored path, e.g. /uploads/process/sale_processes_1.jpg
     $amImg  optional attributes for the <img>, so each page keeps its own

     The upload form used to accept any file and the page drew it with
     <img src="...">. A PDF or a Word file was stored happily and then showed
     as a broken picture - seventeen Management Organograms are in exactly
     that state. Rather than lose what those clients uploaded, anything that
     is not an image is offered as a link. New uploads are steered to images
     by the form's accept attribute.

     The extension is read off the path only: parse_url drops any query
     string, so a url ending "?v=2" is still recognised. --}}
@php
    $amPath    = parse_url((string) $img, PHP_URL_PATH) ?: (string) $img;
    $amExt     = strtolower(pathinfo($amPath, PATHINFO_EXTENSION));
    $amIsImage = in_array($amExt, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'], true);
@endphp

@if ($amIsImage)
    <img src="{{ $img }}" class="img-fluid" {!! $amImg ?? '' !!}>
@else
    <a href="{{ $img }}" target="_blank" rel="noopener"
       class="am-btn am-btn-outline" style="text-decoration:none;">
        <i class="fa fa-file-arrow-down"></i>
        Open uploaded file{{ $amExt ? ' (' . strtoupper($amExt) . ')' : '' }}
    </a>
    <p style="margin-top:10px;font-size:12px;color:var(--am-text-muted);">
        This file is not an image, so it cannot be shown here. Upload a JPG or PNG to see it on the page.
    </p>
@endif
