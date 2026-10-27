{{-- Print / Save as PDF for the three policy pages.

     The screen is left exactly as it was: the block at the bottom is
     display:none until the page is printed, and the rules are pushed from
     here, so no other page in the site ever loads them.

     Printing hands the browser the same document the client is reading -
     the policy text, the additional policies, their signatures and dates -
     with the portal chrome taken off and the client's own logo put at the
     top in its place. "Save as PDF" in the browser's own print dialog is
     what turns it into a file, which is why no PDF package is involved.

     Takes $title: the document's name, worded as the page heading words it. --}}
@push('styles')
<style>
.am-print-head { display: none; }

@media print {
    /* Two separate things are being overruled here.

       The Metronic bundle carries a print block of its own that asks for A3
       paper and holds the body at 1024px. This stylesheet is pushed after it,
       so the last word on both is here rather than a change over there.

       And the page margin is uneven on purpose. The browser draws its own
       header and footer inside it, so a top margin of zero leaves the date
       and the page title nowhere to print, while the bottom margin stays so
       that the page number still does. The two at the bottom cannot be
       separated - the address of the page prints beside the page number, and
       taking one off takes the other with it. The top margin the document
       needs is carried below instead; the side margins are real, so every
       sheet gets them, not just the first. */
    @page { size: A4 portrait; margin: 0 12mm 14mm; }
    html, body { min-width: 0 !important; width: auto !important; background: #fff !important; }

    /* the portal around the document - and the theme's own loading dialog,
       which the demo script in foot.blade.php shows on every page for the
       first four seconds, long enough to land on a printout */
    .am-sidebar, .am-header, .am-backdrop,
    .am-page-header, .quality_add_div,
    .kt-dialog, .kt-page-loader { display: none !important; }

    /* ... and the frame it sits in, so the policy starts at the paper margin */
    .am-main { margin-left: 0 !important; margin-right: 0 !important;
               padding-top: 0 !important; min-height: 0 !important; }
    /* the top margin, which the page itself no longer has */
    .am-content { padding: 14mm 0 0 !important; }
    .am-card { box-shadow: none !important; border: 0 !important;
               border-radius: 0 !important; overflow: visible !important; }
    .am-card__body { padding: 0 !important; }

    .am-print-head { display: block !important; page-break-after: avoid; }
    .am-print-head__row {
        display: flex; align-items: center; gap: 18px;
        border-bottom: 2px solid #2E3B9A;
        padding-bottom: 10px; margin-bottom: 18px;
    }
    .am-print-head__logo { max-height: 60px; max-width: 180px; width: auto; object-fit: contain; }
    .am-print-head__title { font-size: 15px; font-weight: 600; line-height: 1.3; }
    /* written in logical properties, so the Arabic site mirrors it unaided */
    .am-print-head__doc { margin-inline-start: auto; text-align: end; }
    .am-print-head__meta { font-size: 11px; color: #555; margin-top: 2px; }

    /* a policy and the signature under it belong on the same sheet */
    .am-policy-entry { page-break-inside: avoid; break-inside: avoid; }
}
</style>
@endpush

<div class="am-print-head">
    <div class="am-print-head__row">
        @if (Auth::user()->profile_image)
            <img class="am-print-head__logo" src="{{ asset(Auth::user()->profile_image) }}" alt="">
        @endif
        <div class="am-print-head__doc">
            <div class="am-print-head__title">{{ $title }}</div>
            <div class="am-print-head__meta">Printed: {{ now()->format('d-M-Y g:i A') }}</div>
        </div>
    </div>
</div>
