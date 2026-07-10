<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | MyISOOnline</title>

    {{-- Poppins font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome (already used by app) --}}
    <link href="{{ asset('assets/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/admin-modern-layout.css') }}" rel="stylesheet" type="text/css">
    @yield('styles')
</head>
<body class="am-body">

{{-- ============ Sidebar ============ --}}
<aside class="am-sidebar" id="amSidebar">
    <div class="am-sidebar__brand">
        <a href="{{ url('admin') }}">
            <img src="{{ asset('assets/media/logos/MyISOOnline-Logo.png') }}" alt="MyISOOnline">
        </a>
        <button class="am-sidebar__close" id="amSidebarClose" aria-label="Close menu">
            <i class="la la-close"></i>
        </button>
    </div>

    <nav class="am-sidebar__nav">

        <div class="am-nav-heading">Overview</div>

        <div class="am-nav-item">
            <a href="{{ url('admin') }}" class="am-nav-link {{ Request::is('admin') ? 'active' : '' }}">
                <i class="fa fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="am-nav-heading">User Management</div>

        <div class="am-nav-item">
            <a href="{{ url('/view_user') }}" class="am-nav-link {{ Request::is('view_user') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span>All Users</span>
            </a>
        </div>
        <div class="am-nav-item">
            <a href="{{ url('/add_user') }}" class="am-nav-link {{ Request::is('add_user') ? 'active' : '' }}">
                <i class="fa fa-user-plus"></i>
                <span>Add User</span>
            </a>
        </div>

        <div class="am-nav-heading">Communication</div>

        <div class="am-nav-item am-nav-group {{ Request::is('send_message*') || Request::is('receiveNotification*') || Request::is('sentNotification*') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-envelope"></i>
                <span>Notifications</span>
                <span class="am-badge count_notifications" style="display:none;"></span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('/send_message') }}" class="am-nav-link {{ Request::is('send_message*') ? 'active' : '' }}">Create Message</a>
                <a href="{{ route('receiveNotification') }}" class="am-nav-link {{ Request::is('receiveNotification*') ? 'active' : '' }}">Inbox</a>
                <a href="{{ route('sentNotification') }}" class="am-nav-link {{ Request::is('sentNotification*') ? 'active' : '' }}">Sent</a>
            </div>
        </div>

        <div class="am-nav-heading">Resources</div>

        <div class="am-nav-item am-nav-group {{ Request::is('all_faqs*') || Request::is('all_videos*') || Request::is('upload*') ? 'open' : '' }}">
            <a href="javascript:;" class="am-nav-link am-nav-group__toggle">
                <i class="fa fa-info-circle"></i>
                <span>Info for Users</span>
                <i class="fa fa-chevron-right am-chevron"></i>
            </a>
            <div class="am-nav-group__children">
                <a href="{{ url('/all_faqs') }}" class="am-nav-link {{ Request::is('all_faqs*') ? 'active' : '' }}">FAQs</a>
                <a href="{{ url('/all_videos') }}" class="am-nav-link {{ Request::is('all_videos*') ? 'active' : '' }}">Videos</a>
                <a href="{{ url('/upload') }}" class="am-nav-link {{ Request::is('upload*') ? 'active' : '' }}">Uploads</a>
            </div>
        </div>

    </nav>
</aside>

{{-- ============ Top Header ============ --}}
<header class="am-header">
    <button class="am-header__toggle" id="amSidebarToggle" aria-label="Open menu">
        <i class="fa fa-bars"></i>
    </button>
    <div>
        <h1 class="am-header__title">@yield('page_title', 'Dashboard')</h1>
        <p class="am-header__crumb">@yield('page_crumb', 'Admin panel')</p>
    </div>

    <div class="am-header__right">
        <button class="am-header__btn" aria-label="Notifications" onclick="window.location='{{ route('receiveNotification') }}'">
            <i class="fa fa-bell"></i>
            <span class="am-dot"></span>
        </button>

        @auth
        <div class="am-user-wrap">
            <button type="button" class="am-user" id="amUserToggle" aria-haspopup="true" aria-expanded="false">
                <span class="am-user__avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</span>
                <span class="am-user__name">{{ Auth::user()->name ?? 'Admin' }}</span>
                <i class="fa fa-chevron-down am-user__caret"></i>
            </button>
            <div class="am-user-menu" id="amUserMenu">
                <div class="am-user-menu__header">
                    <div class="am-user-menu__name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="am-user-menu__email">{{ Auth::user()->email ?? '' }}</div>
                </div>
                <a href="{{ url('/admin') }}" class="am-user-menu__item">
                    <i class="fa fa-th-large"></i> Dashboard
                </a>
                <a href="{{ url('/view_user') }}" class="am-user-menu__item">
                    <i class="fa fa-cog"></i> Manage Users
                </a>
                <div class="am-user-menu__divider"></div>
                <a href="{{ url('/logout') }}" class="am-user-menu__item danger">
                    <i class="fa fa-sign-out-alt"></i> Sign out
                </a>
            </div>
        </div>
        @endauth
    </div>
</header>

{{-- ============ Main ============ --}}
<div class="am-backdrop" id="amBackdrop" style="display:none;"></div>
<main class="am-main">
    <div class="am-content">
        @yield('content')
    </div>
</main>

{{-- ============ jQuery + Bootstrap for modals --}}
<script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('assets/vendors/general/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script>
    // Sidebar collapse toggle (mobile)
    (function() {
        var sidebar = document.getElementById('amSidebar');
        var toggle = document.getElementById('amSidebarToggle');
        var closeBtn = document.getElementById('amSidebarClose');
        var backdrop = document.getElementById('amBackdrop');

        function open() {
            sidebar.classList.add('open');
            backdrop.style.display = 'block';
        }
        function close() {
            sidebar.classList.remove('open');
            backdrop.style.display = 'none';
        }
        toggle && toggle.addEventListener('click', open);
        closeBtn && closeBtn.addEventListener('click', close);
        backdrop && backdrop.addEventListener('click', close);
    })();

    // Sidebar submenu accordion
    document.querySelectorAll('.am-nav-group__toggle').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            el.closest('.am-nav-group').classList.toggle('open');
        });
    });

    // User dropdown menu
    (function() {
        var toggle = document.getElementById('amUserToggle');
        var menu = document.getElementById('amUserMenu');
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

@yield('scripts')
</body>
</html>
