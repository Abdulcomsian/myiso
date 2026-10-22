{{-- The Supporting Documents card.

     Laid out as the ISO Certificates table above it is: the document's name,
     then the red PDF icon that opens it. It was a grid of clickable tiles
     before, which read as a different kind of thing than the table it sits
     under even though both are just a name and a file.

     Every column is given a share of the width, the name included. Pinning
     only the three narrow ones left the name column absorbing all the slack,
     which put a long empty stretch between the name and the icon beside it.
     Action is the narrowest, so the eye sits close to the date with a little
     room after it rather than stranded at the far edge.

     The two site-wide guidance PDFs are shipped with the site rather than
     uploaded for a client, so they carry no date of their own and show a dash.

     $docs   the rows: title, date, url, and the line shown in place of the
             file when there is none --}}
<div class="am-table-wrap">
    <table class="am-table">
        <thead>
            <tr>
                <th style="width:42%;">Document</th>
                <th style="width:20%;">File</th>
                <th style="width:20%;">Date Added</th>
                <th style="width:18%;">Action</th>
            </tr>
        </thead>
        <tbody>
@foreach ($docs as $doc)
            <tr>
                <th>{{ $doc['title'] }}</th>
                <td>
@if ($doc['url'])
                    <a href="{{ $doc['url'] }}" target="_blank">
                        <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                    </a>
@else
                    <span style="color:var(--am-text-soft);">{{ $doc['none'] ?: '—' }}</span>
@endif
                </td>
                <td>
@if (!empty($doc['date']))
                    {{ $doc['date'] }}
@else
                    <span style="color:var(--am-text-soft);">&mdash;</span>
@endif
                </td>
                <td>
@if ($doc['url'])
                    <a class="am-icon-btn" href="{{ $doc['url'] }}" target="_blank" title="View"><i class="fa fa-eye"></i></a>
@endif
                </td>
            </tr>
@endforeach
        </tbody>
    </table>
</div>
