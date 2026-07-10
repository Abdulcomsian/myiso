@extends('admin.dashboard.layouts.app')

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="dash-wrapper">

        {{-- Hero --}}
        <div class="dash-hero">
            <div>
                <h1 class="dash-hero-title">Welcome to the Admin Panel</h1>
                <p class="dash-hero-subtitle">Manage users, downloads and notifications from one place.</p>
            </div>
        </div>

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

        {{-- Quick actions --}}
        <h6 class="dash-section-title mt-2">Quick Actions</h6>
        <div class="row">
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <a href="{{ url('/add_user') }}" class="action-card">
                    <span class="action-icon"><i class="fa fa-user-plus"></i></span>
                    <p class="action-title">Add User</p>
                    <p class="action-hint">Register a new client</p>
                </a>
            </div>
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <a href="{{ url('/view_user') }}" class="action-card">
                    <span class="action-icon"><i class="fa fa-eye"></i></span>
                    <p class="action-title">View Users</p>
                    <p class="action-hint">Browse the users list</p>
                </a>
            </div>
            <div class="col-6 col-md-4 col-xl-3 mb-4">
                <a href="{{ url('/send_notifications') }}" class="action-card">
                    <span class="action-icon"><i class="fa fa-bell"></i></span>
                    <p class="action-title">Notifications</p>
                    <p class="action-hint">Send a new message</p>
                </a>
            </div>

        </div>

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
