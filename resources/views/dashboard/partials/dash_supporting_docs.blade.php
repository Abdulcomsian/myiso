{{-- The Supporting Documents card.

     Each document is one tile you click anywhere on, rather than a heading
     with the name and the icon as two separate links to the same file.

     $docs   the tiles: title, url, and the line shown in its place when
             there is no file --}}
<div class="am-docs">
    @foreach ($docs as $doc)
        @if ($doc['url'])
            <a class="am-doc" href="{{ $doc['url'] }}" target="_blank">
                <span class="am-doc__icon"><i class="far fa-file-pdf"></i></span>
                <span class="am-doc__name">{{ $doc['title'] }}</span>
                <span class="am-doc__go"><i class="fa fa-arrow-right"></i></span>
            </a>
        @else
            <div class="am-doc am-doc--empty">
                <span class="am-doc__icon"><i class="far fa-file-pdf"></i></span>
                <span class="am-doc__name">{{ $doc['title'] }}</span>
                <span class="am-doc__none">{{ $doc['none'] }}</span>
            </div>
        @endif
    @endforeach
</div>
