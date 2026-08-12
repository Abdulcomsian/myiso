@include('dashboard.includes.head')

<body class="am-body">

{{-- ============ Modern Sidebar ============ --}}
<aside class="am-sidebar" id="amSidebar">
    <div class="am-sidebar__brand">
        <a href="{{ url('/home') }}">
            <img src="{{ asset(Auth::user()->profile_image) }}" alt="Logo" style="max-height:50px;width:auto;max-width:160px;object-fit:contain;">
        </a>
        <button class="am-sidebar__close" id="amSidebarClose" aria-label="Close menu">
            <i class="la la-close"></i>
        </button>
    </div>

    <nav class="am-sidebar__nav">

        <div class="am-nav-heading">Overview</div>

        <div class="am-nav-item">
            <a href="{{ url('/home') }}" class="am-nav-link {{ Request::is('home') ? 'active' : '' }}">
                <i class="fa fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="am-nav-heading">Documents</div>

        <div class="am-nav-item am-nav-group {{ Request::is('quality_manual') || Request::is('quality_policy') || Request::is('environment_policy') || Request::is('health_policy') || Request::is('management_organogram') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-lock"></i>
                <span>Manuals &amp; Policies</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('quality_manual') }}" class="am-nav-link {{ Request::is('quality_manual') ? 'active' : '' }}">Quality Manual</a>
                <a href="{{ url('quality_policy') }}" class="am-nav-link {{ Request::is('quality_policy') ? 'active' : '' }}">Quality Policy</a>
                <a href="{{ url('environment_policy') }}" class="am-nav-link {{ Request::is('environment_policy') ? 'active' : '' }}">Environmental Policy</a>
                <a href="{{ url('health_policy') }}" class="am-nav-link {{ Request::is('health_policy') ? 'active' : '' }}">Health &amp; Safety Policy</a>
                <a href="{{ url('management_organogram') }}" class="am-nav-link {{ Request::is('management_organogram') ? 'active' : '' }}">Management Organogram</a>
            </div>
        </div>

        <div class="am-nav-item am-nav-group {{ Request::is('sale_processes') || Request::is('purchasing_processes') || Request::is('servicing_contract') || Request::is('competency_process') || Request::is('process_interaction') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-spinner"></i>
                <span>Process Flow Charts</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('sale_processes') }}" class="am-nav-link {{ Request::is('sale_processes') ? 'active' : '' }}">QP1 – Sales Process</a>
                <a href="{{ url('purchasing_processes') }}" class="am-nav-link {{ Request::is('purchasing_processes') ? 'active' : '' }}">QP2 – Purchasing Process</a>
                <a href="{{ url('servicing_contract') }}" class="am-nav-link {{ Request::is('servicing_contract') ? 'active' : '' }}">QP3 – Servicing of a Contract</a>
                <a href="{{ url('competency_process') }}" class="am-nav-link {{ Request::is('competency_process') ? 'active' : '' }}">QP4 – Competency Process</a>
                <a href="{{ url('process_interaction') }}" class="am-nav-link {{ Request::is('process_interaction') ? 'active' : '' }}">Process Interaction</a>
            </div>
        </div>

        <div class="am-nav-item am-nav-group {{ Request::is('documented_information') || Request::is('corrective_action') || Request::is('management_review') || Request::is('monitoring_measure') || Request::is('auidt') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-gear"></i>
                <span>Procedures</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('documented_information') }}" class="am-nav-link {{ Request::is('documented_information') ? 'active' : '' }}">P1 – Documented Information</a>
                <a href="{{ url('corrective_action') }}" class="am-nav-link {{ Request::is('corrective_action') ? 'active' : '' }}">P2 – Corrective Actions</a>
                <a href="{{ url('management_review') }}" class="am-nav-link {{ Request::is('management_review') ? 'active' : '' }}">P3 – Management Review</a>
                <a href="{{ url('monitoring_measure') }}" class="am-nav-link {{ Request::is('monitoring_measure') ? 'active' : '' }}">P4 – Monitoring &amp; Measuring</a>
                <a href="{{ url('auidt') }}" class="am-nav-link {{ Request::is('auidt') ? 'active' : '' }}">P5 – Audits</a>
            </div>
        </div>

        <div class="am-nav-item am-nav-group {{ Request::is('requirements_aspect') || Request::is('process_audit') || Request::is('interesting_parties') || Request::is('qms_audit') || Request::is('non_confromities') || Request::is('customer') || Request::is('customer_review') || Request::is('supplier') || Request::is('calibration_record') || Request::is('employess') || Request::is('add_management_review') || Request::is('maintance_record') || Request::is('accident_risk') || Request::is('risk_assessment') || Request::is('chemical_control') || Request::is('work_instruction') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fab fa-wpforms"></i>
                <span>Forms &amp; Records</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('requirements_aspect') }}" class="am-nav-link {{ Request::is('requirements_aspect') ? 'active' : '' }}">Requirements Due</a>
                <a href="{{ url('process_audit') }}" class="am-nav-link {{ Request::is('process_audit') ? 'active' : '' }}">Process Audits</a>
                <a href="{{ url('interesting_parties') }}" class="am-nav-link {{ Request::is('interesting_parties') ? 'active' : '' }}">Interested Parties</a>
                <a href="{{ url('qms_audit') }}" class="am-nav-link {{ Request::is('qms_audit') ? 'active' : '' }}">QMS Audits</a>
                <a href="{{ url('non_confromities') }}" class="am-nav-link {{ Request::is('non_confromities') ? 'active' : '' }}">Non-Conformities</a>
                <a href="{{ url('customer') }}" class="am-nav-link {{ Request::is('customer') ? 'active' : '' }}">Customers</a>
                <a href="{{ url('customer_review') }}" class="am-nav-link {{ Request::is('customer_review') ? 'active' : '' }}">Customer Review</a>
                <a href="{{ url('supplier') }}" class="am-nav-link {{ Request::is('supplier') ? 'active' : '' }}">Suppliers</a>
                <a href="{{ url('calibration_record') }}" class="am-nav-link {{ Request::is('calibration_record') ? 'active' : '' }}">Calibration</a>
                <a href="{{ url('employess') }}" class="am-nav-link {{ Request::is('employess') ? 'active' : '' }}">Employees</a>
                <a href="{{ url('add_management_review') }}" class="am-nav-link {{ Request::is('add_management_review') ? 'active' : '' }}">Management Reviews</a>
                <a href="{{ url('maintance_record') }}" class="am-nav-link {{ Request::is('maintance_record') ? 'active' : '' }}">Maintenance Records</a>
                <a href="{{ url('accident_risk') }}" class="am-nav-link {{ Request::is('accident_risk') ? 'active' : '' }}">Accident Risk Assessments</a>
                <a href="{{ url('risk_assessment') }}" class="am-nav-link {{ Request::is('risk_assessment') ? 'active' : '' }}">Risk Assessments</a>
                <a href="{{ url('chemical_control') }}" class="am-nav-link {{ Request::is('chemical_control') ? 'active' : '' }}">Chemical Control</a>
                <a href="{{ url('work_instruction') }}" class="am-nav-link {{ Request::is('work_instruction') ? 'active' : '' }}">Work Instructions</a>
            </div>
        </div>

        <div class="am-nav-heading">Communication</div>

        <div id="admin_notifications" class="am-nav-item am-nav-group {{ Request::is('createMessage') || Request::is('inboxMessages*') || Request::is('sentMessages*') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-envelope"></i>
                <span>Notifications</span>
                <span class="count_notifications am-badge" style="display:none;"></span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ route('storeMessage') }}" class="am-nav-link">Create Message</a>
                <a href="{{ route('inboxMessages') }}" class="am-nav-link">Inbox</a>
                <a href="{{ route('sentMessages') }}" class="am-nav-link">Sent</a>
            </div>
        </div>

        <div class="am-nav-heading">Support</div>

        <div class="am-nav-item am-nav-group {{ Request::is('faq') || Request::is('explainer_videos') || Request::is('userDownload') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-life-ring"></i>
                <span>Support</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('faq') }}" class="am-nav-link {{ Request::is('faq') ? 'active' : '' }}">FAQ's</a>
                <a href="{{ url('explainer_videos') }}" class="am-nav-link {{ Request::is('explainer_videos') ? 'active' : '' }}">Training Videos</a>
                <a href="{{ url('userDownload') }}" class="am-nav-link {{ Request::is('userDownload') ? 'active' : '' }}">Downloads</a>
            </div>
        </div>

        <div class="am-nav-item am-nav-group">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-graduation-cap"></i>
                <span>ISO Certified Courses</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="https://myisoonline.com/lms/courses/iso-90012015-qms-quality-management-system/" class="am-nav-link" target="_blank">ISO 9001:2015</a>
                <a href="https://myisoonline.com/lms/courses/iso-450012018-occupational-health-safety-management-system-internal-auditor-course/" class="am-nav-link" target="_blank">ISO 45001:2018</a>
                <a href="https://myisoonline.com/lms/courses/iso-140012015-environmental-management-system-internal-auditor-course/" class="am-nav-link" target="_blank">ISO 14001:2015</a>
            </div>
        </div>

        <div class="am-nav-item am-nav-group">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-book"></i>
                <span>Short Courses</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <div class="am-nav-sub-label">ISO 9001:2015</div>
                <a href="https://myisoonline.com/lms/courses/maintaining-equipment-and-tool/" class="am-nav-link" target="_blank">Maintaining Equipment &amp; Tools</a>
                <a href="https://myisoonline.com/lms/courses/material-reuse-sustainable-practices-in-construction-and-office-environments/" class="am-nav-link" target="_blank">Material Reuse: Sustainable Practices</a>
                <div class="am-nav-sub-label">ISO 45001:2018</div>
                <a href="https://myisoonline.com/lms/courses/workplace-safety-avoiding-slips-trips-and-simple-accidents/" class="am-nav-link" target="_blank">Workplace Safety: Slips, Trips &amp; Accidents</a>
                <a href="https://myisoonline.com/lms/courses/safety-walk-around-course/" class="am-nav-link" target="_blank">Safety Walk Around Course</a>
                <a href="https://myisoonline.com/lms/courses/lifting-carrying-and-working-the-right-way/" class="am-nav-link" target="_blank">Lifting, Carrying &amp; Working</a>
                <a href="https://myisoonline.com/lms/courses/fire-safety-best-practices-in-the-workplace/" class="am-nav-link" target="_blank">Fire Safety Best Practices</a>
                <div class="am-nav-sub-label">ISO 14001:2015</div>
                <a href="https://myisoonline.com/lms/courses/practical-waste-reduction-in-construction/" class="am-nav-link" target="_blank">Practical Waste Reduction</a>
                <a href="https://myisoonline.com/lms/courses/waste-reduction-and-recycling-in-the-office/" class="am-nav-link" target="_blank">Waste Reduction &amp; Recycling</a>
                <a href="https://myisoonline.com/lms/courses/environmental-awareness-in-construction-2/" class="am-nav-link" target="_blank">Environmental Awareness</a>
            </div>
        </div>

        {{-- <div class="am-nav-item">
            <a href="{{ url('schedule-training') }}" class="am-nav-link {{ Request::is('schedule-training') ? 'active' : '' }}">
                <i class="fa fa-calendar"></i>
                <span>Schedule Training</span>
            </a>
        </div> --}}

    </nav>
</aside>

{{-- ============ Top Header ============ --}}
<header class="am-header">
    <button class="am-header__toggle" id="amSidebarToggle" aria-label="Open menu">
        <i class="fa fa-bars"></i>
    </button>
    <div>
        <h1 class="am-header__title">{{ Auth::user()->company_name }}</h1>
        <p class="am-header__crumb">
            ID: {{ Auth::user()->order_number }}
            @php
                $iso9001 = Auth::user()->iso9001_expirydate;
                $iso14001 = Auth::user()->iso14001_expirydate;
                $iso45001 = Auth::user()->iso45001_expirydate;
                $x = $iso9001 ? strtotime($iso9001) : null;
                $y = $iso14001 ? strtotime($iso14001) : null;
                $z = $iso45001 ? strtotime($iso45001) : null;
                $vals = array_filter([$x, $y, $z]);
                $minStamp = $vals ? min($vals) : strtotime('+3 years');
                $expiryLabel = date('d/m/Y', $minStamp);
            @endphp
            &nbsp;·&nbsp; Expiry: {{ $expiryLabel }}
        </p>
    </div>

    <div class="am-header__right">
        @if (Auth::user()->member_scaiso == 1)
            <img src="{{ asset('assets/media/logos/sca-iso-final-logo.png') }}" style="height:32px;width:auto;" alt="SCA ISO">
        @endif

        @auth
        <div class="am-user-wrap">
            <button type="button" class="am-user" id="amUserToggle" aria-haspopup="true" aria-expanded="false">
                <span class="am-user__avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                <span class="am-user__name">{{ Auth::user()->name ?? 'Account' }}</span>
                <i class="fa fa-chevron-down am-user__caret"></i>
            </button>
            <div class="am-user-menu" id="amUserMenu">
                <div class="am-user-menu__header">
                    <div class="am-user-menu__name">{{ Auth::user()->name ?? '' }}</div>
                    <div class="am-user-menu__email">{{ Auth::user()->email ?? '' }}</div>
                </div>
                <a href="{{ route('userprofile') }}" class="am-user-menu__item">
                    <i class="fa fa-user"></i> My Account
                </a>
                <div class="am-user-menu__divider"></div>
                <a href="{{ route('logout') }}" class="am-user-menu__item danger">
                    <i class="fa fa-sign-out-alt"></i> Sign Out
                </a>
            </div>
        </div>
        @endauth
    </div>
</header>

{{-- ============ Main content ============ --}}
<div class="am-backdrop" id="amBackdrop" style="display:none;"></div>
<main class="am-main">
    @yield('content')
</main>

@include('dashboard.includes.foot')

<script>
(function() {
    var sidebar  = document.getElementById('amSidebar');
    var toggle   = document.getElementById('amSidebarToggle');
    var closeBtn = document.getElementById('amSidebarClose');
    var backdrop = document.getElementById('amBackdrop');
    function openSidebar()  { sidebar.classList.add('open'); backdrop.style.display = 'block'; }
    function closeSidebar() { sidebar.classList.remove('open'); backdrop.style.display = 'none'; }
    toggle   && toggle.addEventListener('click', openSidebar);
    closeBtn && closeBtn.addEventListener('click', closeSidebar);
    backdrop && backdrop.addEventListener('click', closeSidebar);
})();

document.querySelectorAll('.am-nav-group__toggle').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        el.closest('.am-nav-group').classList.toggle('open');
    });
});

(function() {
    var toggle = document.getElementById('amUserToggle');
    var menu   = document.getElementById('amUserMenu');
    if (!toggle || !menu) return;
    toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.classList.toggle('open');
        toggle.setAttribute('aria-expanded', menu.classList.contains('open'));
    });
    document.addEventListener('click', function(e) {
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
})();
</script>

</body>
</html>
