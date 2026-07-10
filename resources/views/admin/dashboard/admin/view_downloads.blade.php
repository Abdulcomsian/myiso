@extends('admin.dashboard.layouts.app')

@section('content')
@php
    $usertypes = \App\UserType::get();
@endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>Downloads Management</h2>
            <p>Manage the downloadable resources available to clients.</p>
        </div>
    </div>

    {{-- Flash message --}}
    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Category filter pills --}}
    <div class="am-pills">
        @foreach ($categories as $cat)
            <a href="{{ url('/upload?cat='.urlencode($cat)) }}" class="am-pill {{ $category === $cat ? 'active' : '' }}" data-cat="{{ $cat }}">
                <i class="fa fa-tag"></i>
                {{ $cat }}
                <span class="am-pill__count">{{ $categoryCounts[$cat] ?? 0 }}</span>
            </a>
        @endforeach
    </div>

    {{-- Toolbar + inline form --}}
    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form id="amDownloadsSearchForm" class="am-search" style="margin:0;flex:1;max-width:340px;" onsubmit="return false;">
                <i class="fa fa-search"></i>
                <input type="text" id="amDownloadsSearch" name="q" value="{{ $search }}" placeholder="Search by name…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleUploadForm">
                <i class="fa fa-plus"></i> New Upload
            </button>
        </div>

        <div class="am-inline-form" id="newUploadForm" style="margin:16px 20px;">
            <form action="{{ url('/add_download') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" placeholder="e.g. Emergency Exit" required>
                    </div>
                    <div>
                        <label>Category</label>
                        <select name="category" required>
                            <option value="" disabled {{ !$category ? 'selected' : '' }}>Select Category</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c }}" {{ $category === $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>User Type</label>
                        <select name="user_type">
                            <option value="0">All Users</option>
                            @foreach ($usertypes as $ut)
                                <option value="{{ $ut->id }}">{{ $ut->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label>Thumbnail (JPG / PNG)</label>
                        <input type="file" name="thumbnail" accept="image/*" required>
                    </div>
                    <div>
                        <label>A4 File (PDF)</label>
                        <input type="file" name="file" accept=".pdf,.png,.jpg" required>
                    </div>
                    <div>
                        <label>A5 File (PDF)</label>
                        <input type="file" name="file2" accept=".pdf,.png,.jpg" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelUploadForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Download</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Grid --}}
    <div class="am-card">
        <div id="amDownloadsContainer" style="position:relative;">
            @include('admin.dashboard.admin.partials.downloads_grid')
        </div>
    </div>

</div>

{{-- Shared delete modal --}}
<div class="am-modal" id="amConfirmDelete" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete <span id="amConfirmType">Item</span>?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete <strong id="amConfirmLabel">this item</strong>.
            This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline" id="amConfirmCancel">Cancel</button>
            <form id="amConfirmForm" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="am-btn" style="background:var(--am-danger);color:#fff;">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    var baseUrl     = '{{ url("/upload") }}';
    var currentCat  = @json($category);

    // Toggle upload form
    var toggleBtn = document.getElementById('toggleUploadForm');
    var cancelBtn = document.getElementById('cancelUploadForm');
    var form      = document.getElementById('newUploadForm');
    toggleBtn && toggleBtn.addEventListener('click', function() { form.classList.toggle('open'); });
    cancelBtn && cancelBtn.addEventListener('click', function() { form.classList.remove('open'); });

    // Debounced AJAX search + pagination
    function debounce(fn, wait) {
        var t;
        return function() {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function(){ fn.apply(ctx, args); }, wait);
        };
    }

    var container = document.getElementById('amDownloadsContainer');
    var input     = document.getElementById('amDownloadsSearch');

    function fetchPage(page, cat) {
        var params = new URLSearchParams();
        params.set('cat', cat || currentCat);
        if (input && input.value.trim() !== '') params.set('q', input.value.trim());
        if (page) params.set('page', page);

        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';

        fetch(baseUrl + '?' + params.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r){ return r.text(); })
            .then(function(html) {
                container.innerHTML = html;
                container.style.opacity = '';
                container.style.pointerEvents = '';
                window.history.replaceState({}, '', baseUrl + '?' + params.toString());
            })
            .catch(function(){
                container.style.opacity = '';
                container.style.pointerEvents = '';
            });
    }

    // Category pill click → AJAX (no full reload)
    document.querySelectorAll('.am-pill').forEach(function(pill) {
        pill.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.am-pill').forEach(function(p){ p.classList.remove('active'); });
            pill.classList.add('active');
            currentCat = pill.getAttribute('data-cat');
            fetchPage(1, currentCat);
        });
    });

    input && input.addEventListener('input', debounce(function(){ fetchPage(1); }, 350));
    container && container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });

    // Delete modal
    var modal      = document.getElementById('amConfirmDelete');
    var cForm      = document.getElementById('amConfirmForm');
    var typeEl     = document.getElementById('amConfirmType');
    var labelEl    = document.getElementById('amConfirmLabel');
    var modalCancel = document.getElementById('amConfirmCancel');

    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-confirm-delete');
        if (!btn) return;
        e.preventDefault();
        cForm.setAttribute('action', btn.getAttribute('data-action') || '');
        typeEl.textContent = btn.getAttribute('data-type') || 'Item';
        labelEl.textContent = btn.getAttribute('data-label') || 'this item';
        modal.classList.add('open');
    });

    function closeModal() { modal.classList.remove('open'); }
    modalCancel && modalCancel.addEventListener('click', closeModal);
    modal && modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
})();
</script>

@endsection
