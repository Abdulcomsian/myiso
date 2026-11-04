@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="About Interested Parties" aria-label="About Interested Parties">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>Interested Parties</h2>
            </div>
        </div>
    </div>

    @if(session('message'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('message') }}
        </div>
    @endif

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

{{-- Page guide --}}
@include('dashboard.form_records.partials.guides.interested_parties')

{{-- View Modal --}}
<div class="am-modal" id="amIpView" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:520px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Interested Party Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px 18px;">
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Interested Party</div><div id="vIpParty">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Needs and Expectations</div><div id="vIpNeeds">—</div></div>
            </div>
            {{-- the same shape the Objectives Tracker gives its progress history:
                 a rule, a heading, then a row per event --}}
            <div style="border-top:1px solid var(--am-border);padding-top:14px;margin-top:18px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;margin-bottom:10px;">History</div>
                <div id="vIpHistory"></div>
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
    // "2026-05-24 21:52:49" as the portal recorded it, and who did it.
    //
    // Deliberately not new Date(): the app keeps Asia/Dubai time in the
    // column, and a date handed to the browser would be re-read in the
    // reader's own zone and printed hours out. The string is split instead.
    var amIpMonths = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    function amIpWhen(stamp, who) {
        var m = /^(\d{4})-(\d{2})-(\d{2})[ T](\d{2}):(\d{2})/.exec(stamp || '');
        if (!m) return '—';
        var h = parseInt(m[4], 10);
        var half = h < 12 ? 'AM' : 'PM';
        var h12 = h % 12 === 0 ? 12 : h % 12;
        var when = m[3] + ' ' + amIpMonths[parseInt(m[2], 10) - 1] + ' ' + m[1] + ', ' + h12 + ':' + m[5] + ' ' + half;
        return when;
    }

    // One row per thing that has happened to the record. Same grid, border
    // and type size the progress history uses, so the two read alike.
    function amIpHistory(data) {
        var box = document.getElementById('vIpHistory');
        if (!box) return;
        box.innerHTML = '';

        var events = [
            ['Created', data.created_at_raw, data.created_by_name],
            ['Last updated', data.updated_at_raw, data.updated_by_name],
        ].filter(function (e) { return e[1]; });

        if (!events.length) {
            box.innerHTML = '<div style="font-size:13px;color:var(--am-text-muted);">Nothing recorded yet.</div>';
            return;
        }

        events.forEach(function (e, i) {
            var row = document.createElement('div');
            row.style.cssText = 'display:grid;grid-template-columns:120px minmax(0,1fr) minmax(0,160px);'
                + 'gap:12px;align-items:start;padding:10px 0;font-size:13px;'
                + (i < events.length - 1 ? 'border-bottom:1px solid var(--am-border);' : '');
            row.appendChild(amIpCell(e[0], true));
            row.appendChild(amIpCell(amIpWhen(e[1]), false));
            row.appendChild(amIpCell(e[2] || '—', false));
            box.appendChild(row);
        });
    }

    // built as text, never as markup: a name is whatever someone typed
    function amIpCell(text, muted) {
        var d = document.createElement('div');
        if (muted) d.style.color = 'var(--am-text-muted)';
        d.style.minWidth = '0';
        d.style.overflowWrap = 'anywhere';
        d.textContent = text;
        return d;
    }

    function amIpView(data) {
        document.getElementById('vIpParty').textContent = data.interested_party || '—';
        document.getElementById('vIpNeeds').textContent = data.needs || '—';
        amIpHistory(data);
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
