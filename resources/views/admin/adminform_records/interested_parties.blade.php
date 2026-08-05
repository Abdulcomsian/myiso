@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Interested Parties</h2>
            <p>Section 4.2 — Needs and expectations of interested parties.</p>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$urlparam['id']) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
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


    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/interested_parties/'.$urlparam['id']) }}" class="am-search" id="amIpSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amIpSearch" value="{{ $search ?? '' }}" placeholder="Search interested parties…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleIpForm">
                <i class="fa fa-plus"></i> Add Interested Party
            </button>
        </div>

        <div class="am-inline-form" id="newIpForm" style="margin:16px 20px;">
            <form action="{{ route('interestedform') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['id'] }}">
                <div class="form-row">
                    <div><label>Interested Party</label><input type="text" name="interestedparty" placeholder="e.g. Customers, Suppliers, Employees" required></div>
                    <div><label>Needs &amp; Expectations</label><input type="text" name="needs" placeholder="e.g. On-time delivery" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelIpForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amIpContainer">
            @include('admin.adminform_records.partials.interested_parties_table')
        </div>
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

{{-- View modal --}}
<div class="am-modal" id="amIpViewModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:560px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Interested Party</h4>
        </div>
        <div class="am-modal__body">
            <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Interested Party</div>
            <div id="v-ip-party" style="font-size:14px;color:var(--am-text);margin-bottom:16px;"></div>
            <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Needs &amp; Expectations</div>
            <div id="v-ip-needs" style="font-size:14px;color:var(--am-text);"></div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="amIpEditModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:600px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Interested Party</h4>
        </div>
        <form action="{{ route('interestedUpdate') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['id'] }}">
            <input type="hidden" name="id" id="e-ip-id">
            <div class="am-modal__body" style="padding:22px;">
                <div class="form-group row"><div class="col-lg-12"><label>Interested Party</label><input type="text" class="form-control" name="interestedparty" id="e-ip-party" required></div></div>
                <div class="form-group row"><div class="col-lg-12"><label>Needs &amp; Expectations</label><input type="text" class="form-control" name="needs" id="e-ip-needs" required></div></div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
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
        var t = document.getElementById('toggleIpForm');
        var f = document.getElementById('newIpForm');
        var c = document.getElementById('cancelIpForm');
        t && t.addEventListener('click', function() { f.classList.toggle('open'); });
        c && c.addEventListener('click', function() { f.classList.remove('open'); });
    })();

    // ---- View / Edit ----
    function amIpView(d) {
        document.getElementById('v-ip-party').textContent = d.interested_party || '—';
        document.getElementById('v-ip-needs').textContent  = d.needs || '—';
        document.getElementById('amIpViewModal').classList.add('open');
    }
    function amIpEdit(d) {
        document.getElementById('e-ip-id').value    = d.id || '';
        document.getElementById('e-ip-party').value = d.interested_party || '';
        document.getElementById('e-ip-needs').value  = d.needs || '';
        document.getElementById('amIpEditModal').classList.add('open');
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
        var baseUrl = '{{ url('/interested_parties/'.$urlparam['id']) }}';

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
