@extends('admin.dashboard.layouts.app')

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>Videos Management</h2>
            <p>Upload and organise training videos shown to clients.</p>
        </div>
    </div>

    {{-- Flash message --}}
    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Toolbar + inline form --}}
    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form id="amVideosSearchForm" class="am-search" style="margin:0;flex:1;max-width:340px;" onsubmit="return false;">
                <i class="fa fa-search"></i>
                <input type="text" id="amVideosSearch" name="q" value="{{ $search }}" placeholder="Search video title…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleVideoForm">
                <i class="fa fa-plus"></i> New Video
            </button>
        </div>

        <div class="am-inline-form" id="newVideoForm" style="margin:16px 20px;">
            <form action="{{ url('/add_video') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div>
                        <label>Video Title</label>
                        <input type="text" name="title" placeholder="Enter a title" required>
                    </div>
                    <div>
                        <label>Video File (MP4 / AVI, max 40MB)</label>
                        <input type="file" name="video" accept="video/mp4,video/x-msvideo" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelVideoForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Upload Video</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="am-card">
        <div id="amVideosContainer" style="position:relative;">
            @include('admin.dashboard.admin.partials.videos_table')
        </div>
    </div>

</div>

{{-- Shared delete confirmation modal --}}
<div class="am-modal" id="amConfirmDelete" role="dialog" aria-modal="true" aria-labelledby="amConfirmDeleteTitle">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title" id="amConfirmDeleteTitle">Delete <span id="amConfirmType">Item</span>?</h4>
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
    var baseUrl = '{{ url("/all_videos") }}';

    // ------- Toggle inline form -------
    var toggleBtn = document.getElementById('toggleVideoForm');
    var cancelBtn = document.getElementById('cancelVideoForm');
    var form      = document.getElementById('newVideoForm');
    toggleBtn && toggleBtn.addEventListener('click', function() { form.classList.toggle('open'); });
    cancelBtn && cancelBtn.addEventListener('click', function() { form.classList.remove('open'); });

    // ------- Debounced AJAX search + pagination -------
    function debounce(fn, wait) {
        var t;
        return function() {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function(){ fn.apply(ctx, args); }, wait);
        };
    }

    var container = document.getElementById('amVideosContainer');
    var input     = document.getElementById('amVideosSearch');

    function fetchPage(page) {
        var params = new URLSearchParams();
        if (input && input.value.trim() !== '') params.set('q', input.value.trim());
        params.set('page', page);

        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';

        fetch(baseUrl + '?' + params.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r){ return r.text(); })
            .then(function(html) {
                container.innerHTML = html;
                container.style.opacity = '';
                container.style.pointerEvents = '';
            })
            .catch(function(){
                container.style.opacity = '';
                container.style.pointerEvents = '';
            });
    }

    input && input.addEventListener('input', debounce(function(){ fetchPage(1); }, 350));
    container && container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });

    // ------- Delete confirmation modal -------
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
