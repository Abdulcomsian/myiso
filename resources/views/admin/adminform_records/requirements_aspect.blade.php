@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>Requirements Due</h2>
            <p>A compliance diary — track items that need periodic action (reviews, audits, calibrations).</p>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$urlparam['userid']) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    {{-- Flash messages --}}
    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Info card --}}
    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;">
                <i class="fa fa-info-circle"></i>
            </span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                Add items that need to be recalled on a regular basis, such as when management reviews are due, or calibration audits are required.
                Click <strong>Add a Requirement</strong>, enter the information you'd like to be reminded of, and set the reminder date using the calendar.
            </div>
        </div>
    </div>

    {{-- Toolbar + Add form --}}
    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/requiremntCheck/' . $urlparam['userid']) }}" class="am-search" id="amReqSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amReqSearch" value="{{ $search ?? '' }}" placeholder="Search requirements…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleReqForm">
                <i class="fa fa-plus"></i> Add a Requirement
            </button>
        </div>

        <div class="am-inline-form" id="newReqForm" style="margin:16px 20px;">
            <form action="{{ route('addRequirementadmin') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div style="grid-column:1/-1;">
                        <label>Requirement</label>
                        <input type="text" name="requirement" placeholder="Enter requirement" required>
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Completion Date</label>
                        <input type="date" max="2999-12-31" name="req_date" required>
                    </div>
                    <div>
                        <label>Periodicity (Months, 1–12)</label>
                        <input type="number" min="1" max="12" name="period" placeholder="e.g. 3" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelReqForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table card --}}
    <div class="am-card">
        <div id="amReqContainer">
            @include('admin.adminform_records.partials.requirements_table')
        </div>
    </div>

</div>

{{-- View Modal --}}
<div class="am-modal" id="amReqView" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:520px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Requirement Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="margin-bottom:14px;">
                <p style="font-size:11.5px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 4px 0;font-weight:600;">Requirement</p>
                <p style="font-size:14px;color:var(--am-text);margin:0;font-weight:600;" id="vReqTitle">—</p>
            </div>
            <div style="margin-bottom:14px;">
                <p style="font-size:11.5px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 4px 0;font-weight:600;">Completion Date</p>
                <p style="font-size:13.5px;color:var(--am-text);margin:0;" id="vReqDate">—</p>
            </div>
            <div>
                <p style="font-size:11.5px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 4px 0;font-weight:600;">Periodicity</p>
                <p style="font-size:13.5px;color:var(--am-text);margin:0;" id="vReqPeriod">—</p>
            </div>
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="am-modal" id="amReqEdit" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:560px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Requirement</h4>
        </div>
        <form action="{{ route('updaterequiremntadmin') }}" method="POST" style="display:contents;">
            @csrf
            <div class="am-modal__body">
                <input type="hidden" name="requirment_id" id="eReqId">
                <div style="margin-bottom:16px;">
                    <label>Requirement</label>
                    <input type="text" class="form-control" name="requirment_title" id="eReqTitle" required>
                </div>
                <div style="margin-bottom:16px;">
                    <label>Completion Date</label>
                    <input type="date" class="form-control" name="completion_date" id="eReqDate" required>
                </div>
                <div>
                    <label>Periodicity (Months, 1–12)</label>
                    <input type="number" class="form-control" min="1" max="12" name="periods" id="eReqPeriod" required>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="am-modal" id="amConfirmDelete" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete <span id="amConfirmType">Requirement</span>?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete <strong id="amConfirmLabel">this item</strong>. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form id="amConfirmForm" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="amConfirmId">
                <button type="submit" class="am-btn" style="background:var(--am-danger);color:#fff;">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // ---- Modern modal helpers ----
    function openAmModal(id) { var m = document.getElementById(id); m && m.classList.add('open'); }
    document.addEventListener('click', function(e) {
        var close = e.target.closest('.am-modal-close');
        if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
        if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
    });

    // ---- Add form toggle ----
    (function() {
        var btn = document.getElementById('toggleReqForm');
        var cancel = document.getElementById('cancelReqForm');
        var form = document.getElementById('newReqForm');
        btn && btn.addEventListener('click', function() { form.classList.toggle('open'); });
        cancel && cancel.addEventListener('click', function() { form.classList.remove('open'); });
    })();

    // ---- View / Edit fillers ----
    function amReqView(data) {
        document.getElementById('vReqTitle').textContent = data.requirment_title || '—';
        document.getElementById('vReqDate').textContent = data.completion_date ? new Date(data.completion_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : '—';
        document.getElementById('vReqPeriod').textContent = 'Every ' + data.periods + ' months';
        openAmModal('amReqView');
    }
    function amReqEdit(data) {
        document.getElementById('eReqId').value    = data.id || '';
        document.getElementById('eReqTitle').value = data.requirment_title || '';
        document.getElementById('eReqDate').value  = data.completion_date || '';
        document.getElementById('eReqPeriod').value = data.periods || '';
        openAmModal('amReqEdit');
    }

    // ---- Delete confirm ----
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-confirm-delete');
        if (!btn) return;
        e.preventDefault();
        document.getElementById('amConfirmForm').setAttribute('action', btn.getAttribute('data-action') || '');
        document.getElementById('amConfirmId').value = btn.getAttribute('data-id') || '';
        document.getElementById('amConfirmType').textContent = btn.getAttribute('data-type') || 'Item';
        document.getElementById('amConfirmLabel').textContent = btn.getAttribute('data-label') || 'this item';
        openAmModal('amConfirmDelete');
    });

    // ---- Server-side search + pagination (AJAX) ----
    (function() {
        var input     = document.getElementById('amReqSearch');
        var form      = document.getElementById('amReqSearchForm');
        var container = document.getElementById('amReqContainer');
        if (!container) return;
        var baseUrl = '{{ url('/requiremntCheck/' . $urlparam['userid']) }}';

        function debounce(fn, wait) { var t; return function(){ var ctx=this,args=arguments; clearTimeout(t); t=setTimeout(function(){ fn.apply(ctx,args); }, wait); }; }
        function showLoading() { container.style.opacity='0.5'; container.style.pointerEvents='none'; }
        function hideLoading() { container.style.opacity=''; container.style.pointerEvents=''; }

        function fetchPage(page) {
            var q = input ? input.value.trim() : '';
            var url = baseUrl + '?q=' + encodeURIComponent(q) + '&page=' + page;
            showLoading();
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r){ return r.text(); })
                .then(function(html) { container.innerHTML = html; hideLoading(); })
                .catch(function() { hideLoading(); });
        }

        input && input.addEventListener('input', debounce(function() { fetchPage(1); }, 350));
        form  && form.addEventListener('submit', function(e) { e.preventDefault(); fetchPage(1); });

        container.addEventListener('click', function(e) {
            var btn = e.target.closest('.am-page-link');
            if (!btn || btn.disabled) return;
            e.preventDefault();
            var p = parseInt(btn.getAttribute('data-page'), 10);
            if (!isNaN(p) && p > 0) fetchPage(p);
        });
    })();
</script>
@endsection
