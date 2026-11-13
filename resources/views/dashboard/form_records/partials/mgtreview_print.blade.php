{{-- Print / Save as PDF for one Management Review.

     What is printed is the Details popup the reader already has open: it
     holds the whole review - the meeting, every question with its answer and
     its evidence, the decisions, the objectives, the actions table and the
     meeting files - so printing it needs no second copy of any of that, and
     the two can never drift apart.

     Everything here is held behind "body.mr-printing", a class the Print
     button puts on and takes off again. Without it, these rules would also
     rewrite an ordinary Ctrl+P on this page, which still prints the page.

     The styles are inline rather than pushed to a stack: the client layout
     renders @stack('styles'), the admin layout does not, and this partial is
     included from both.

     Reads $userid when the admin is looking at a client's reviews, so the
     heading names that client rather than the admin. --}}
@php
    $printOwner = (isset($userid) ? App\User::find($userid) : null) ?: Auth::user();
@endphp

<style>
.mr-print-head { display: none; }

@media print {
    body.mr-printing {
        background: #fff !important;
    }

    /* the browser draws its own header and footer in the page margin, so the
       top one is left to it and the document's own top space comes from the
       print heading below */
    body.mr-printing { }

    /* the portal around the popup, and the theme's loading dialog, which the
       demo script shows for the first few seconds of every page */
    body.mr-printing .am-sidebar,
    body.mr-printing .am-header,
    body.mr-printing .am-backdrop,
    body.mr-printing .am-page-header,
    body.mr-printing .kt-dialog,
    body.mr-printing .kt-page-loader { display: none !important; }

    body.mr-printing .am-main {
        margin-left: 0 !important; margin-right: 0 !important;
        padding: 0 !important; min-height: 0 !important;
    }

    /* the list, the form, the banner, the guide - everything that is not the
       popper being printed */
    body.mr-printing .am-main > *:not(.am-modal),
    body.mr-printing .am-modal:not(.open) { display: none !important; }

    /* and any other popup that happens to be open */
    body.mr-printing .am-modal.open:not(#DetailModal) { display: none !important; }

    /* the popup, laid out as a document rather than a dialog */
    body.mr-printing #DetailModal {
        display: block !important;
        position: static !important;
        inset: auto !important;
        background: none !important;
        padding: 0 !important;
        overflow: visible !important;
        z-index: auto !important;
    }
    body.mr-printing #DetailModal .am-modal__box {
        display: block !important;
        max-width: none !important;
        max-height: none !important;
        width: auto !important;
        margin: 0 !important;
        overflow: visible !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        animation: none !important;
    }
    body.mr-printing #DetailModal .am-modal__body {
        display: block !important;
        overflow: visible !important;
        max-height: none !important;
        padding: 0 !important;
        color: #000 !important;
        font-size: 12pt;
    }
    /* the dialog's own title bar and buttons are not part of the document */
    body.mr-printing #DetailModal .am-modal__header,
    body.mr-printing #DetailModal .am-modal__footer { display: none !important; }

    /* the heading this printout gets instead */
    body.mr-printing .mr-print-head { display: block !important; margin: 0 0 14px; }
    .mr-print-head__row { display: flex; align-items: center; gap: 14px;
                          border-bottom: 2px solid #111; padding-bottom: 10px; }
    .mr-print-head__logo { height: 46px; width: auto; }
    .mr-print-head__title { font-size: 17pt; font-weight: 700; color: #000; }
    .mr-print-head__who { font-size: 11pt; color: #000; }
    .mr-print-head__meta { font-size: 9pt; color: #444; }

    /* an answer, its evidence and a table row are all worth keeping whole */
    body.mr-printing .mr-view-block,
    body.mr-printing .mr-view-file,
    body.mr-printing tr { break-inside: avoid; page-break-inside: avoid; }

    /* on paper a link cannot be followed, so the file's name is what counts */
    body.mr-printing .mr-print-only { display: inline !important; }
    body.mr-printing .mr-view-file a { color: #000 !important; text-decoration: none !important; }
    body.mr-printing .mr-view-file a i { display: none !important; }
}

/* the file name beside a link: on paper only */
.mr-print-only { display: none; }
</style>

<div class="mr-print-head">
    <div class="mr-print-head__row">
        @if ($printOwner && $printOwner->profile_image)
            <img class="mr-print-head__logo" src="{{ asset($printOwner->profile_image) }}" alt="">
        @endif
        <div>
            <div class="mr-print-head__title">{{ $L['details_title'] }}</div>
            <div class="mr-print-head__who">{{ $printOwner->company_name ?? '' }}</div>
            <div class="mr-print-head__meta">{{ $L['printed'] }} {{ now()->format('d-M-Y g:i A') }}</div>
        </div>
    </div>
</div>
