@extends('admin.dashboard.layouts.app')

@section('styles')
<script src="{{ asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>FAQs Management</h2>
            <p>Create and manage frequently asked questions and their categories.</p>
        </div>
    </div>

    {{-- Flash messages --}}
    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Tabs --}}
    <div class="am-tabs">
        <button type="button" class="am-tab {{ $tab === 'faqs' ? 'active' : '' }}" data-tab="faqs">
            <i class="fa fa-question-circle"></i>
            FAQs
            <span class="am-tab-count">{{ $totalFaqs }}</span>
        </button>
        <button type="button" class="am-tab {{ $tab === 'categories' ? 'active' : '' }}" data-tab="categories">
            <i class="fa fa-folder"></i>
            Categories
            <span class="am-tab-count">{{ $totalCats }}</span>
        </button>
    </div>

    {{-- FAQs tab --}}
    <div class="am-tab-panel {{ $tab === 'faqs' ? 'active' : '' }}" data-panel="faqs">

        {{-- Toolbar: search + add button --}}
        <div class="am-card" style="margin-bottom:16px;">
            <div class="am-card__toolbar">
                <form id="amFaqsSearchForm" class="am-search" style="margin:0;flex:1;max-width:340px;" onsubmit="return false;">
                    <i class="fa fa-search"></i>
                    <input type="text" id="amFaqsSearch" name="fq" value="{{ $faqSearch }}" placeholder="Search question, answer, category…" autocomplete="off">
                </form>
                <button type="button" class="am-btn am-btn-primary" id="toggleFaqForm">
                    <i class="fa fa-plus"></i> New FAQ
                </button>
            </div>

            {{-- Toggle-able inline form --}}
            <div class="am-inline-form" id="newFaqForm" style="margin:16px 20px;">
                <form action="{{ url('/add_faq') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div>
                            <label>Question</label>
                            <input type="text" name="question" placeholder="Enter question" required>
                        </div>
                        <div>
                            <label>Category</label>
                            <select name="category" required>
                                <option value="">Choose a category…</option>
                                @foreach($categoriesForSelect as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <label>Answer</label>
                        <textarea name="answer" id="faqAnswerEditor" placeholder="Enter answer" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelFaqForm">Cancel</button>
                        <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save FAQ</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="am-card">
            <div id="amFaqsContainer" style="position:relative;">
                @include('admin.dashboard.admin.partials.faqs_table')
            </div>
        </div>
    </div>

    {{-- Categories tab --}}
    <div class="am-tab-panel {{ $tab === 'categories' ? 'active' : '' }}" data-panel="categories">

        <div class="am-card" style="margin-bottom:16px;">
            <div class="am-card__toolbar">
                <form id="amCatsSearchForm" class="am-search" style="margin:0;flex:1;max-width:340px;" onsubmit="return false;">
                    <i class="fa fa-search"></i>
                    <input type="text" id="amCatsSearch" name="cq" value="{{ $catSearch }}" placeholder="Search categories…" autocomplete="off">
                </form>
                <button type="button" class="am-btn am-btn-primary" id="toggleCatForm">
                    <i class="fa fa-plus"></i> New Category
                </button>
            </div>

            <div class="am-inline-form" id="newCatForm" style="margin:16px 20px;">
                <form action="{{ url('/add_faq_cate') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div>
                            <label>Category Name</label>
                            <input type="text" name="faq_cate" placeholder="e.g. Getting Started" required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelCatForm">Cancel</button>
                        <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Category</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="am-card">
            <div id="amCatsContainer" style="position:relative;">
                @include('admin.dashboard.admin.partials.categories_table')
            </div>
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
    var baseUrl = '{{ url("/all_faqs") }}';

    // ------- Tabs -------
    var tabs = document.querySelectorAll('.am-tab');
    var panels = document.querySelectorAll('.am-tab-panel');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            var name = tab.getAttribute('data-tab');
            tabs.forEach(function(t){ t.classList.toggle('active', t === tab); });
            panels.forEach(function(p){ p.classList.toggle('active', p.getAttribute('data-panel') === name); });
            // Update URL param
            var url = new URL(window.location.href);
            url.searchParams.set('tab', name);
            window.history.replaceState({}, '', url);
        });
    });

    // ------- Toggle forms -------
    function bindToggle(btnId, cancelId, formId) {
        var btn = document.getElementById(btnId);
        var cancel = document.getElementById(cancelId);
        var form = document.getElementById(formId);
        btn && btn.addEventListener('click', function() { form.classList.toggle('open'); });
        cancel && cancel.addEventListener('click', function() { form.classList.remove('open'); });
    }
    bindToggle('toggleFaqForm', 'cancelFaqForm', 'newFaqForm');
    bindToggle('toggleCatForm', 'cancelCatForm', 'newCatForm');

    // ------- Debounced AJAX search + pagination for each table -------
    function debounce(fn, wait) {
        var t;
        return function() {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function(){ fn.apply(ctx, args); }, wait);
        };
    }

    function setupAjaxTable(cfg) {
        var container = document.getElementById(cfg.container);
        var input     = document.getElementById(cfg.searchInput);
        if (!container) return;

        function fetchPage(page) {
            var params = new URLSearchParams();
            params.set('tab', cfg.tab);
            if (input && input.value.trim() !== '') params.set(cfg.searchParam, input.value.trim());
            params.set(cfg.pageParam, page);

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

        if (input) {
            input.addEventListener('input', debounce(function(){ fetchPage(1); }, 350));
        }
        container.addEventListener('click', function(e) {
            var btn = e.target.closest('.' + cfg.pageBtnClass);
            if (!btn || btn.disabled) return;
            e.preventDefault();
            var p = parseInt(btn.getAttribute('data-page'), 10);
            if (!isNaN(p) && p > 0) fetchPage(p);
        });
    }

    setupAjaxTable({
        container: 'amFaqsContainer',
        searchInput: 'amFaqsSearch',
        searchParam: 'fq',
        pageParam: 'fpage',
        tab: 'faqs',
        pageBtnClass: 'am-faqs-page',
    });
    setupAjaxTable({
        container: 'amCatsContainer',
        searchInput: 'amCatsSearch',
        searchParam: 'cq',
        pageParam: 'cpage',
        tab: 'categories',
        pageBtnClass: 'am-cats-page',
    });

    // ------- CKEditor for FAQ Answer -------
    // Init lazily when the FAQ form opens (CKEditor mounts to <textarea>).
    var ckInited = false;
    var toggleBtn = document.getElementById('toggleFaqForm');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            if (!ckInited && typeof CKEDITOR !== 'undefined' && document.getElementById('faqAnswerEditor')) {
                CKEDITOR.replace('faqAnswerEditor');
                ckInited = true;
            }
        });
    }

    // ------- Delete confirmation modal (delegated) -------
    var modal      = document.getElementById('amConfirmDelete');
    var form       = document.getElementById('amConfirmForm');
    var typeEl     = document.getElementById('amConfirmType');
    var labelEl    = document.getElementById('amConfirmLabel');
    var cancelBtn  = document.getElementById('amConfirmCancel');

    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-confirm-delete');
        if (!btn) return;
        e.preventDefault();
        form.setAttribute('action', btn.getAttribute('data-action') || '');
        typeEl.textContent = btn.getAttribute('data-type') || 'Item';
        labelEl.textContent = btn.getAttribute('data-label') || 'this item';
        modal.classList.add('open');
    });

    function closeModal() { modal.classList.remove('open'); }
    cancelBtn && cancelBtn.addEventListener('click', closeModal);
    modal && modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
})();
</script>

@endsection
