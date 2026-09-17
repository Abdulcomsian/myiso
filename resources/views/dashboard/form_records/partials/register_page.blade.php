{{--
    Body of a simple register page (used by the user and admin layouts).
    Params: $module, $records, $search, $isAdmin, $ownerId
--}}
@php
    $listUrl = $isAdmin ? url($module['admin_url'].'/'.$ownerId) : url($module['key']);
    $openAddForm = old('_form') === 'add';
@endphp

<style>
    .am-register-grid { display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:12px 16px; margin-bottom:12px; }
    .am-register-grid .wide { grid-column:1 / -1; }
    @media (max-width: 768px) { .am-register-grid { grid-template-columns:1fr; } }
    .am-register-info ul { margin:6px 0 0; padding-left:18px; }
</style>

@if (session('msg'))
    <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
        <i class="fa fa-check-circle"></i> {{ session('msg') }}
    </div>
@endif
@if ($errors->any())
    <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#b83432;background:rgba(235,77,75,0.08);">
        <i class="fa fa-exclamation-circle"></i> Please fix the following:
        <ul style="margin:6px 0 0;padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="am-card am-register-info" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
    <div style="display:flex;gap:12px;align-items:flex-start;">
        <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;"><i class="fa fa-info-circle"></i></span>
        <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
            <strong>{{ $module['info_title'] }}</strong>
            <ul>
                @foreach ($module['info_items'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            Click <strong>{{ $module['add_label'] }}</strong> to add a new record.
        </div>
    </div>
</div>

<div class="am-card" style="margin-bottom:16px;">
    <div class="am-card__toolbar">
        <form method="GET" action="{{ $listUrl }}" class="am-search" id="amRegSearchForm" style="flex:1;max-width:340px;margin:0;">
            <i class="fa fa-search"></i>
            <input type="text" name="q" id="amRegSearch" value="{{ $search }}" placeholder="{{ $module['search_placeholder'] }}" autocomplete="off">
        </form>
        <button type="button" class="am-btn am-btn-primary" id="amRegToggle">
            <i class="fa fa-plus"></i> {{ $module['add_label'] }}
        </button>
    </div>

    <div class="am-inline-form {{ $openAddForm ? 'open' : '' }}" id="amRegAddForm" style="margin:16px 20px;">
        <form method="POST" action="{{ route($module['key'].'.store') }}">
            @csrf
            <input type="hidden" name="_form" value="add">
            @if ($isAdmin)
                <input type="hidden" name="user_id" value="{{ $ownerId }}">
            @endif
            @include('dashboard.form_records.partials.register_fields', ['mode' => 'add'])
            <div class="form-actions">
                <button type="button" class="am-btn am-btn-outline am-btn-sm" id="amRegCancel">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save</button>
            </div>
        </form>
    </div>
</div>

<div class="am-card">
    <div id="amRegContainer">
        @include('dashboard.form_records.partials.register_table')
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="amRegViewModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:760px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">{{ $module['item_name'] }} Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                @foreach ($module['fields'] as $name => $field)
                    <div style="{{ (!empty($field['wide']) || $field['type'] === 'textarea') ? 'grid-column:1/-1;' : '' }}">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">{{ $field['label'] }}</div>
                        <div id="v-reg-{{ $name }}" style="color:var(--am-text);line-height:1.45;white-space:pre-wrap;">—</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="amRegEditModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">{{ $module['edit_title'] }}</h4>
        </div>
        <form method="POST" action="{{ route($module['key'].'.update') }}" style="display:contents;">
            @csrf
            <input type="hidden" name="id">
            <div class="am-modal__body" style="padding:20px;">
                @include('dashboard.form_records.partials.register_fields', ['mode' => 'edit'])
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

<script>
var AM_REG_FIELDS = @json($module['fields']);
(function() {
    var t = document.getElementById('amRegToggle');
    var f = document.getElementById('amRegAddForm');
    var c = document.getElementById('amRegCancel');
    t && t.addEventListener('click', function() { f.classList.toggle('open'); });
    c && c.addEventListener('click', function() { f.classList.remove('open'); });
})();
(function() {
    var input = document.getElementById('amRegSearch');
    var form = document.getElementById('amRegSearchForm');
    var container = document.getElementById('amRegContainer');
    if (!container) return;
    var baseUrl = @json($listUrl);
    function debounce(fn, wait) { var t; return function() { var ctx = this, args = arguments; clearTimeout(t); t = setTimeout(function() { fn.apply(ctx, args); }, wait); }; }
    function fetchPage(page) {
        var q = input ? input.value.trim() : '';
        container.style.opacity = '0.5'; container.style.pointerEvents = 'none';
        fetch(baseUrl + '?q=' + encodeURIComponent(q) + '&page=' + page, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r) { return r.text(); })
            .then(function(html) { container.innerHTML = html; })
            .finally(function() { container.style.opacity = ''; container.style.pointerEvents = ''; });
    }
    input && input.addEventListener('input', debounce(function() { fetchPage(1); }, 350));
    form && form.addEventListener('submit', function(e) { e.preventDefault(); fetchPage(1); });
    container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
})();
function amRegDisplay(field, value) {
    if (value === null || value === undefined || value === '') return '—';
    if (field.type === 'select') return field.options[value] || value;
    if (field.type === 'date') { var p = String(value).substring(0, 10).split('-'); return p.length === 3 ? p[2] + '/' + p[1] + '/' + p[0] : value; }
    return value;
}
function amRegView(d) {
    Object.keys(AM_REG_FIELDS).forEach(function(k) {
        var el = document.getElementById('v-reg-' + k);
        if (el) el.textContent = amRegDisplay(AM_REG_FIELDS[k], d[k]);
    });
    document.getElementById('amRegViewModal').classList.add('open');
}
function amRegEdit(d) {
    var m = document.getElementById('amRegEditModal');
    m.querySelector("input[name='id']").value = d.id;
    Object.keys(AM_REG_FIELDS).forEach(function(k) {
        var el = m.querySelector("[name='" + k + "']");
        if (!el) return;
        var v = d[k] === null || d[k] === undefined ? '' : String(d[k]);
        el.value = AM_REG_FIELDS[k].type === 'date' ? v.substring(0, 10) : v;
    });
    m.classList.add('open');
}
</script>
