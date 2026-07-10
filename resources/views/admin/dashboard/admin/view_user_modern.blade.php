@extends('admin.dashboard.layouts.modern')

@section('title', 'Users Listing')
@section('page_title', 'Users Listing')
@section('page_crumb', 'Manage all registered clients')

@section('content')

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>All Users</h2>
            <p>Browse, edit and manage every client account.</p>
        </div>
        <div>
            <a href="{{ url('/add_user') }}" class="am-btn am-btn-primary">
                <i class="fa fa-plus"></i> New User
            </a>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="am-stats">
        <div class="am-stat">
            <span class="am-stat__icon blue"><i class="fa fa-users"></i></span>
            <div>
                <p class="am-stat__label">Total Users</p>
                <div class="am-stat__value">{{ number_format($users->count()) }}</div>
            </div>
        </div>
        <div class="am-stat">
            <span class="am-stat__icon green"><i class="fa fa-check-circle"></i></span>
            <div>
                <p class="am-stat__label">Active Recently</p>
                <div class="am-stat__value">
                    {{ number_format($users->where('last_login', '>=', now()->subDays(30))->count()) }}
                </div>
            </div>
        </div>
        <div class="am-stat">
            <span class="am-stat__icon orange"><i class="fa fa-user-plus"></i></span>
            <div>
                <p class="am-stat__label">New This Month</p>
                <div class="am-stat__value">
                    {{ number_format($users->where('created_at', '>=', now()->startOfMonth())->count()) }}
                </div>
            </div>
        </div>
        <div class="am-stat">
            <span class="am-stat__icon cyan"><i class="fa fa-globe"></i></span>
            <div>
                <p class="am-stat__label">Countries</p>
                <div class="am-stat__value">{{ number_format($users->pluck('country')->filter()->unique()->count()) }}</div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Users table --}}
    <div class="am-card">
        <div class="am-card__toolbar">
            <div class="am-search">
                <i class="fa fa-search"></i>
                <input type="text" id="amUsersSearch" placeholder="Search users by name, email, or company…">
            </div>
            <div style="margin-left:auto; display:flex; gap:8px;">
                <a href="{{ url('/add_user') }}" class="am-btn am-btn-outline am-btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>

        <div class="am-table-wrap">
            <table class="am-table" id="amUsersTable">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Country</th>
                        <th>Activation</th>
                        <th>Last Login</th>
                        <th>Expiry</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <td>
                                <div class="am-user-cell">
                                    <span class="am-avatar">
                                        @if(!empty($item->profile_image))
                                            <img src="{{ asset($item->profile_image) }}" alt="">
                                        @else
                                            {{ strtoupper(substr($item->company_name ?? $item->name ?? 'U', 0, 1)) }}
                                        @endif
                                    </span>
                                    <div>
                                        <span class="am-cell-primary">{{ $item->company_name ?? '—' }}</span>
                                        <span class="am-cell-sub">ID: {{ $item->order_number ?? $item->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="am-cell-primary">{{ $item->name ?? '—' }}</span>
                                <span class="am-cell-sub">{{ $item->email ?? '' }}</span>
                            </td>
                            <td>{{ $item->country ?? '—' }}</td>
                            <td>
                                @if($item->created_at)
                                    <span class="am-chip info">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                @else
                                    <span class="am-cell-sub">—</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($item->last_login))
                                    {{ \Carbon\Carbon::parse($item->last_login)->diffForHumans() }}
                                @else
                                    <span class="am-cell-sub">Never</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($item->exp_date))
                                    @php
                                        $exp = \Carbon\Carbon::parse($item->exp_date);
                                        $daysLeft = now()->diffInDays($exp, false);
                                    @endphp
                                    @if($daysLeft < 0)
                                        <span class="am-chip danger">Expired</span>
                                    @elseif($daysLeft < 30)
                                        <span class="am-chip warning">{{ $exp->format('d M Y') }}</span>
                                    @else
                                        <span class="am-chip success">{{ $exp->format('d M Y') }}</span>
                                    @endif
                                @else
                                    <span class="am-cell-sub">—</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <div class="am-actions">
                                    <a href="javascript:;" class="am-icon-btn" title="View" data-toggle="modal" data-target="#viewUser" data-userid="{{ $item->id }}"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:;" class="am-icon-btn" title="Edit" data-toggle="modal" data-target="#editUser" data-userid="{{ $item->id }}"><i class="fa fa-pen"></i></a>
                                    <a href="javascript:;" class="am-icon-btn danger" title="Delete" data-toggle="modal" data-target="#deleteUser" data-userid="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="am-empty">
                                    <i class="fa fa-users"></i>
                                    <p>No users found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="am-pagination">
            <div class="am-pagination__info" id="amPaginationInfo">
                Showing <strong>{{ $users->count() }}</strong> users
            </div>
            <div class="am-pagination__nav" id="amPaginationNav">
                {{-- simple client-side pagination placeholder --}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Simple client-side search (filters visible rows)
    (function() {
        var input = document.getElementById('amUsersSearch');
        var rows = document.querySelectorAll('#amUsersTable tbody tr');
        input && input.addEventListener('input', function() {
            var q = this.value.trim().toLowerCase();
            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = (q === '' || text.indexOf(q) !== -1) ? '' : 'none';
            });
        });
    })();
</script>
@endsection
