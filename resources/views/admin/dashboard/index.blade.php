@extends('admin.dashboard.layouts.app')

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="dash-wrapper">

        {{-- Hero with quick-action pills in the top-right --}}
        <div class="dash-hero" style="position:relative;">
            <div>
                <h1 class="dash-hero-title">Welcome to the Admin Panel</h1>
                <p class="dash-hero-subtitle">Manage users, downloads and notifications from one place.</p>
            </div>
            <div class="dash-hero-actions">
                <a href="{{ url('/add_user') }}" class="dash-hero-pill" title="Add User">
                    <span class="dash-hero-pill__icon"><i class="fa fa-user-plus"></i></span>
                    <span>Add User</span>
                </a>
                <a href="{{ url('/view_user') }}" class="dash-hero-pill" title="View Users">
                    <span class="dash-hero-pill__icon"><i class="fa fa-eye"></i></span>
                    <span>View Users</span>
                </a>
                <a href="{{ url('/send_message') }}" class="dash-hero-pill" title="Send Notification">
                    <span class="dash-hero-pill__icon"><i class="fa fa-bell"></i></span>
                    <span>Notify</span>
                </a>
            </div>
        </div>
        <style>
            .dash-hero-actions {
                position: absolute;
                top: 50%;
                right: 24px;
                transform: translateY(-50%);
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            .dash-hero-pill {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 18px 10px 12px;
                background: #ffffff;
                color: var(--am-primary, #2E3B9A);
                border-radius: 999px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                box-shadow: 0 6px 18px rgba(15, 22, 78, 0.22), 0 1px 0 rgba(255,255,255,0.6) inset;
                transition: transform 0.18s cubic-bezier(.2,.7,.3,1), box-shadow 0.18s, background 0.18s, color 0.18s;
                position: relative;
                overflow: hidden;
            }
            .dash-hero-pill::before {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg, rgba(46,59,154,0) 0%, rgba(46,59,154,0.06) 100%);
                opacity: 0;
                transition: opacity 0.2s;
            }
            .dash-hero-pill:hover {
                transform: translateY(-2px);
                color: #fff;
                background: var(--am-primary, #2E3B9A);
                box-shadow: 0 10px 22px rgba(15, 22, 78, 0.32);
                text-decoration: none;
            }
            .dash-hero-pill:hover::before { opacity: 1; }
            .dash-hero-pill:hover .dash-hero-pill__icon {
                background: rgba(255,255,255,0.22);
                color: #fff;
            }
            .dash-hero-pill__icon {
                width: 26px;
                height: 26px;
                border-radius: 999px;
                background: linear-gradient(135deg, var(--am-primary, #2E3B9A) 0%, #5560C4 100%);
                color: #fff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                flex-shrink: 0;
                transition: background 0.18s, color 0.18s;
            }
            .dash-hero-pill span { position: relative; z-index: 1; }
            @media (max-width: 900px) {
                .dash-hero-actions {
                    position: static;
                    transform: none;
                    margin-top: 16px;
                    justify-content: flex-start;
                }
            }
            @media (max-width: 640px) {
                .dash-hero-pill { padding: 8px 12px 8px 8px; font-size: 12px; }
                .dash-hero-pill__icon { width: 22px; height: 22px; font-size: 10px; }
            }
        </style>

        {{-- Stat cards --}}
        <h6 class="dash-section-title">Overview</h6>
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="stat-card">
                    <span class="stat-icon bg-primary-soft"><i class="fa fa-users"></i></span>
                    <div>
                        <p class="stat-label">Total Users</p>
                        <div class="stat-value">{{ number_format($stats['total_users'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="stat-card">
                    <span class="stat-icon bg-warning-soft"><i class="fa fa-user-plus"></i></span>
                    <div>
                        <p class="stat-label">New This Month</p>
                        <div class="stat-value">{{ number_format($stats['users_this_month'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="stat-card">
                    <span class="stat-icon bg-info-soft"><i class="fa fa-download"></i></span>
                    <div>
                        <p class="stat-label">Downloads Available</p>
                        <div class="stat-value">{{ number_format($stats['total_downloads'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="stat-card">
                    <span class="stat-icon bg-success-soft"><i class="fa fa-envelope"></i></span>
                    <div>
                        <p class="stat-label">Notifications Sent</p>
                        <div class="stat-value">{{ number_format($stats['total_notifications'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Upcoming Notifications --}}
        <h6 class="dash-section-title mt-2">Upcoming Notifications
            <span style="font-size:11px;font-weight:500;color:var(--am-text-muted);text-transform:none;letter-spacing:0;margin-left:6px;">
                Users whose next inactivity notification is due within the next 10 days
            </span>
        </h6>

        <div class="am-card" style="margin-bottom:26px;">
            <div class="am-card__toolbar">
                <div class="am-search" style="flex:1;max-width:340px;">
                    <i class="fa fa-search"></i>
                    <input type="text" id="amUpcomingSearch" placeholder="Search users…" autocomplete="off">
                </div>
                <div style="margin-left:auto;font-size:12.5px;color:var(--am-text-muted);">
                    <strong>{{ count($upcomingNotifications) }}</strong> upcoming
                </div>
            </div>
            <div class="am-table-wrap">
                <table class="am-table" id="amUpcomingTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Last Login</th>
                            <th>Days Inactive</th>
                            <th>Notification</th>
                            <th>Sends On</th>
                            <th style="text-align:right;">Days Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($upcomingNotifications as $index => $row)
                            <tr data-search="{{ strtolower($row->name . ' ' . $row->email . ' ' . $row->user_id . ' ' . $row->threshold_label) }}">
                                <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                                <td>
                                    <span class="am-cell-primary">{{ $row->name }}</span>
                                    <span class="am-cell-sub">ID: {{ $row->user_id }}</span>
                                </td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->last_login->format('d M Y') }}</td>
                                <td>{{ $row->days_inactive }} days</td>
                                <td>
                                    <span class="am-chip {{ $row->threshold == 90 ? 'info' : ($row->threshold == 180 ? 'warning' : 'danger') }}">
                                        {{ $row->threshold_label }}
                                    </span>
                                </td>
                                <td>{{ $row->scheduled_on->format('d M Y') }}</td>
                                <td style="text-align:right;">
                                    <strong style="color:{{ $row->days_until <= 3 ? 'var(--am-danger)' : ($row->days_until <= 6 ? '#c8811f' : 'var(--am-primary)') }};">
                                        {{ $row->days_until }} {{ Str::plural('day', $row->days_until) }}
                                    </strong>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="am-empty">
                                        <i class="fa fa-bell-slash"></i>
                                        <p>No upcoming notifications in the next 10 days.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="am-pagination" id="amUpcomingPagination"></div>
        </div>

        <script>
        (function(){
            var perPage = 10;
            var input = document.getElementById('amUpcomingSearch');
            var tbody = document.querySelector('#amUpcomingTable tbody');
            if (!tbody) return;
            var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr[data-search]'));
            if (rows.length === 0) return;
            var pagEl = document.getElementById('amUpcomingPagination');
            var filtered = rows.slice();
            var currentPage = 1;

            function debounce(fn, wait){ var t; return function(){ var c=this,a=arguments; clearTimeout(t); t=setTimeout(function(){ fn.apply(c,a); }, wait); }; }

            function render(){
                var total = filtered.length;
                var totalPages = Math.max(1, Math.ceil(total / perPage));
                if (currentPage > totalPages) currentPage = totalPages;
                rows.forEach(function(r){ r.style.display = 'none'; });
                filtered.slice((currentPage - 1) * perPage, currentPage * perPage).forEach(function(r){ r.style.display = ''; });

                var from = total === 0 ? 0 : (currentPage - 1) * perPage + 1;
                var to   = Math.min(currentPage * perPage, total);
                var html = '<div class="am-pagination__info">Showing <strong>' + from + '–' + to + '</strong> of <strong>' + total + '</strong></div>';
                html += '<div class="am-pagination__nav">';
                html += '<button data-p="' + (currentPage - 1) + '" ' + (currentPage <= 1 ? 'disabled' : '') + '>‹</button>';
                var start = Math.max(1, currentPage - 2), end = Math.min(totalPages, start + 4);
                start = Math.max(1, end - 4);
                for (var i = start; i <= end; i++) {
                    html += '<button data-p="' + i + '" ' + (i === currentPage ? 'class="active"' : '') + '>' + i + '</button>';
                }
                html += '<button data-p="' + (currentPage + 1) + '" ' + (currentPage >= totalPages ? 'disabled' : '') + '>›</button>';
                html += '</div>';
                pagEl.innerHTML = html;
            }

            input && input.addEventListener('input', debounce(function(){
                var q = this.value.trim().toLowerCase();
                filtered = q === '' ? rows.slice() : rows.filter(function(r){ return r.getAttribute('data-search').indexOf(q) !== -1; });
                currentPage = 1;
                render();
            }, 250));

            pagEl && pagEl.addEventListener('click', function(e){
                var btn = e.target.closest('button[data-p]');
                if (!btn || btn.disabled) return;
                var p = parseInt(btn.getAttribute('data-p'), 10);
                if (!isNaN(p) && p >= 1) { currentPage = p; render(); }
            });

            render();
        })();
        </script>

    </div>
</div>

{{-- Delete confirmation modals (kept for backwards compatibility) --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Deleting Requirements Due</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure? Do you really want to delete this?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="calibrationModal" tabindex="-1" role="dialog" aria-labelledby="calibrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calibrationModalLabel">Deleting Calibration Due</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure? Do you really want to delete this?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
