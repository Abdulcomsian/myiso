@extends('admin.dashboard.layouts.app')

@section('content')
@php
    $userId = request()->route('id');
    $forms = [
        ['title' => 'Requirements Due',        'url' => '/requiremntCheck/'.$userId,     'icon' => 'fa-tasks',    'group' => 'Compliance'],
        ['title' => 'Process Audits',          'url' => '/ProcessCheck/'.$userId,        'icon' => 'fa-clipboard-list','group' => 'Audits'],
        ['title' => 'Interested Parties',      'url' => '/interested_parties/'.$userId,  'icon' => 'fa-users',         'group' => 'Compliance'],
        ['title' => 'QMS Audits',              'url' => '/AuditsCheck/'.$userId,         'icon' => 'fa-shield-alt', 'group' => 'Audits'],
        ['title' => 'Non-Conformities',        'url' => '/nonConformCheck/'.$userId,     'icon' => 'fa-exclamation-triangle','group' => 'Audits'],
        ['title' => 'Customers',               'url' => '/customerCheck/'.$userId,       'icon' => 'fa-user-friends',    'group' => 'Business'],
        ['title' => 'Customer Review',         'url' => '/customerReviewad/'.$userId,    'icon' => 'fa-star',          'group' => 'Business'],
        ['title' => 'Suppliers',               'url' => '/supplierCheck/'.$userId,       'icon' => 'fa-truck',         'group' => 'Business'],
        ['title' => 'Calibration',             'url' => '/calibrationcheck/'.$userId,    'icon' => 'fa-tachometer-alt',         'group' => 'Operations'],
        ['title' => 'Employees',               'url' => '/EmployeCheck/'.$userId,        'icon' => 'fa-id-badge',      'group' => 'HR'],
        ['title' => 'Management Reviews',      'url' => '/managementCheck/'.$userId,     'icon' => 'fa-chart-line',    'group' => 'Management'],
        ['title' => 'Maintenance Records',     'url' => '/maintainRecCheck/'.$userId,    'icon' => 'fa-wrench',        'group' => 'Operations'],
        ['title' => 'Accident Risk Assessments','url' => '/AccidentCheck/'.$userId,      'icon' => 'fa-first-aid',      'group' => 'Safety'],
        ['title' => 'Risk Assessments',        'url' => '/riskAssesmntCheck/'.$userId,   'icon' => 'fa-user-shield',   'group' => 'Safety'],
        ['title' => 'Chemical Control',        'url' => '/chemicalcheck/'.$userId,       'icon' => 'fa-flask',         'group' => 'Safety'],
        ['title' => 'Work Instructions',       'url' => '/workinstructionCheck/'.$userId,'icon' => 'fa-file-alt',    'group' => 'Documentation'],
        ['title' => 'Additional Policies',     'url' => '/additionalpolicies/'.$userId,  'icon' => 'fa-book',          'group' => 'Documentation'],
    ];
@endphp

<style>
    .am-forms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 14px;
    }
    .am-form-card {
        background: #fff;
        border: 1px solid var(--am-border);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        transition: transform 0.18s, box-shadow 0.18s, border-color 0.18s;
        position: relative;
        overflow: hidden;
    }
    .am-form-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(46, 59, 154, 0.12);
        border-color: var(--am-primary-soft);
        text-decoration: none;
        color: inherit;
    }
    .am-form-card__icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--am-primary-tint);
        color: var(--am-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .am-form-card__title {
        font-size: 14px;
        font-weight: 600;
        color: var(--am-text);
        margin: 0;
        line-height: 1.3;
    }
    .am-form-card__group {
        font-size: 10.5px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--am-text-muted);
        font-weight: 600;
    }
    .am-form-card__arrow {
        position: absolute;
        top: 20px;
        right: 20px;
        color: var(--am-text-soft);
        font-size: 12px;
        transition: transform 0.18s, color 0.18s;
    }
    .am-form-card:hover .am-form-card__arrow {
        color: var(--am-primary);
        transform: translateX(3px);
    }
    .am-form-search-wrap {
        max-width: 360px;
        flex: 1;
        min-width: 220px;
    }
</style>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>User Forms &amp; Records</h2>
            <p>Every form, certificate and record filed by this client. Click a category to open.</p>
        </div>
        <div>
            <a href="{{ url('/view_user') }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Users
            </a>
        </div>
    </div>

    {{-- Stat card --}}
    <div class="am-stats" style="margin-bottom:22px;">
        <div class="am-stat">
            <span class="am-stat__icon blue"><i class="fa fa-folder-open"></i></span>
            <div>
                <p class="am-stat__label">Total Categories</p>
                <div class="am-stat__value">{{ count($forms) }}</div>
            </div>
        </div>
        <div class="am-stat">
            <span class="am-stat__icon green"><i class="fa fa-shield-alt"></i></span>
            <div>
                <p class="am-stat__label">Compliance &amp; Audits</p>
                <div class="am-stat__value">{{ collect($forms)->whereIn('group', ['Compliance', 'Audits'])->count() }}</div>
            </div>
        </div>
        <div class="am-stat">
            <span class="am-stat__icon orange"><i class="fa fa-user-shield"></i></span>
            <div>
                <p class="am-stat__label">Safety</p>
                <div class="am-stat__value">{{ collect($forms)->where('group', 'Safety')->count() }}</div>
            </div>
        </div>
        <div class="am-stat">
            <span class="am-stat__icon cyan"><i class="fa fa-briefcase"></i></span>
            <div>
                <p class="am-stat__label">Business &amp; Operations</p>
                <div class="am-stat__value">{{ collect($forms)->whereIn('group', ['Business', 'Operations'])->count() }}</div>
            </div>
        </div>
    </div>

    {{-- Search + grid card --}}
    <div class="am-card">
        <div class="am-card__toolbar">
            <div class="am-form-search-wrap am-search">
                <i class="fa fa-search"></i>
                <input type="text" id="amFormsSearch" placeholder="Search categories…" autocomplete="off">
            </div>
            <div style="margin-left:auto;font-size:12.5px;color:var(--am-text-muted);">
                <strong>{{ count($forms) }}</strong> categories
            </div>
        </div>

        <div style="padding:20px;">
            <div class="am-forms-grid" id="amFormsGrid">
                @foreach ($forms as $index => $form)
                    <a href="{{ $form['url'] }}" class="am-form-card" data-name="{{ strtolower($form['title'] . ' ' . $form['group']) }}">
                        <span class="am-form-card__icon"><i class="fa {{ $form['icon'] }}"></i></span>
                        <span class="am-form-card__arrow"><i class="fa fa-arrow-right"></i></span>
                        <div>
                            <span class="am-form-card__group">{{ $form['group'] }}</span>
                            <h3 class="am-form-card__title">{{ $form['title'] }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
            <div id="amFormsEmpty" style="display:none;padding:40px 20px;text-align:center;color:var(--am-text-muted);">
                <i class="fa fa-search" style="font-size:32px;color:var(--am-text-soft);margin-bottom:10px;"></i>
                <p style="margin:0;">No categories match your search.</p>
            </div>
        </div>
    </div>

</div>

<script>
(function() {
    var input = document.getElementById('amFormsSearch');
    var cards = document.querySelectorAll('#amFormsGrid .am-form-card');
    var empty = document.getElementById('amFormsEmpty');
    var grid  = document.getElementById('amFormsGrid');

    function debounce(fn, wait) {
        var t;
        return function() {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function(){ fn.apply(ctx, args); }, wait);
        };
    }

    input && input.addEventListener('input', debounce(function() {
        var q = this.value.trim().toLowerCase();
        var visible = 0;
        cards.forEach(function(card) {
            var name = card.getAttribute('data-name') || '';
            var show = q === '' || name.indexOf(q) !== -1;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        empty.style.display = visible === 0 ? 'block' : 'none';
        grid.style.display  = visible === 0 ? 'none' : '';
    }, 250));
})();
</script>

@endsection
