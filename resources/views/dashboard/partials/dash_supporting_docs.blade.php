{{-- The Supporting Documents card.

     Each document is one tile you click anywhere on, rather than a heading
     with the name and the icon as two separate links to the same file. The
     auditor's comments are not a document, so they sit on their own below.

     $docs      the tiles: title, url (null when there is nothing yet), and
                the line shown in its place when there is not
     $comment   what the auditor wrote, or empty
     $labels    the two bits of wording the comment block needs --}}
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

<div class="am-doc-note">
    <div class="am-doc-note__label">{{ $labels['comments'] }}</div>
    @if (!empty($comment))
        <p>{{ $comment }}</p>
    @else
        <p class="am-doc-note__empty">{{ $labels['no_comments'] }}</p>
    @endif
</div>
