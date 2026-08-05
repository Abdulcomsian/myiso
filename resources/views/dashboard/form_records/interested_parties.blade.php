@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Interested Parties</h2>
            <p>Section 4.2 — Needs and expectations of interested parties.</p>
        </div>
    </div>

    @if(session('message'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('message') }}
        </div>
    @endif

    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;">
                <i class="fa fa-info-circle"></i>
            </span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                Section 4.2 of the ISO 9001:2015 standard requires understanding the needs and expectations of interested parties.
                This register is a place where these can be documented. The Quality Manual in section 4.2.2 defines who the interested parties are.
            </div>
        </div>
    </div>

    {{-- Toolbar + Add form --}}
    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/interesting_parties') }}" class="am-search" id="amIpSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amIpSearch" value="{{ $search ?? '' }}" placeholder="Search parties…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleIpForm">
                <i class="fa fa-plus"></i> Add Interested Party
            </button>
        </div>

        <div class="am-inline-form" id="newIpForm" style="margin:16px 20px;">
            <form action="{{ route('interestedform') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div style="grid-column:1/-1;">
                        <label>Interested Party</label>
                        <input type="text" name="interestedparty" placeholder="e.g. Customers, Suppliers, Employees" required>
                    </div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;">
                        <label>Needs and Expectations</label>
                        <input type="text" name="needs" placeholder="Enter needs and expectations" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelIpForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table card --}}
    <div class="am-card">
        <div id="amIpContainer">
            @include('dashboard.form_records.partials.interested_parties_table')
        </div>
    </div>

</div>

{{-- View Modal --}}
<div class="am-modal" id="amIpView" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:520px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Interested Party Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="margin-bottom:14px;">
                <p style="font-size:11.5px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 4px 0;font-weight:600;">Interested Party</p>
                <p style="font-size:14px;color:var(--am-text);margin:0;font-weight:600;" id="vIpParty">—</p>
            </div>
            <div style="margin-bottom:14px;">
                <p style="font-size:11.5px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 4px 0;font-weight:600;">Needs and Expectations</p>
                <p style="font-size:13.5px;color:var(--am-text);margin:0;" id="vIpNeeds">—</p>
            </div>
            <div>
                <p style="font-size:11.5px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 4px 0;font-weight:600;">Created At</p>
                <p style="font-size:13.5px;color:var(--am-text);margin:0;" id="vIpDate">—</p>
            </div>
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="am-modal" id="amIpEdit" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:560px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Interested Party</h4>
        </div>
        <form action="{{ route('interestedUpdate') }}" method="POST" style="display:contents;">
            @csrf
            <div class="am-modal__body">
                <input type="hidden" name="id" id="eIpId">
                <div style="margin-bottom:16px;">
                    <label>Interested Party</label>
                    <input type="text" class="form-control" name="interestedparty" id="eIpParty" required>
                </div>
                <div>
                    <label>Needs and Expectations</label>
                    <input type="text" class="form-control" name="needs" id="eIpNeeds" required>
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
            <h4 class="am-modal__title">Delete <span id="amConfirmType">Interested Party</span>?</h4>
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
    // ---- Modal helpers ----
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
        var btn    = document.getElementById('toggleIpForm');
        var cancel = document.getElementById('cancelIpForm');
        var form   = document.getElementById('newIpForm');
        btn    && btn.addEventListener('click', function() { form.classList.toggle('open'); });
        cancel && cancel.addEventListener('click', function() { form.classList.remove('open'); });
    })();

    // ---- View / Edit fillers ----
    function amIpView(data) {
        document.getElementById('vIpParty').textContent = data.interested_party || '—';
        document.getElementById('vIpNeeds').textContent = data.needs || '—';
        document.getElementById('vIpDate').textContent  = data.created_at ? new Date(data.created_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : '—';
        document.getElementById('amIpView').classList.add('open');
    }
    function amIpEdit(data) {
        document.getElementById('eIpId').value    = data.id || '';
        document.getElementById('eIpParty').value = data.interested_party || '';
        document.getElementById('eIpNeeds').value = data.needs || '';
        document.getElementById('amIpEdit').classList.add('open');
    }

    // ---- Delete confirm ----
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-confirm-delete');
        if (!btn) return;
        e.preventDefault();
        document.getElementById('amConfirmForm').setAttribute('action', btn.getAttribute('data-action') || '');
        document.getElementById('amConfirmId').value = btn.getAttribute('data-id') || '';
        document.getElementById('amConfirmType').textContent  = btn.getAttribute('data-type') || 'Item';
        document.getElementById('amConfirmLabel').textContent = btn.getAttribute('data-label') || 'this item';
        document.getElementById('amConfirmDelete').classList.add('open');
    });

    // ---- Server-side search + pagination (AJAX) ----
    (function() {
        var input     = document.getElementById('amIpSearch');
        var form      = document.getElementById('amIpSearchForm');
        var container = document.getElementById('amIpContainer');
        if (!container) return;
        var baseUrl = '{{ url('/interesting_parties') }}';

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
