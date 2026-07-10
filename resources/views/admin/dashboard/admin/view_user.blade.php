@extends('admin.dashboard.layouts.app')
@section('content')

    <style> .new-file-upload {
            display: block;
            width: 91px;
            height: 34px;
            position: absolute;
            top: 23px;
            font-size: 12px;
            background: #FFF;
            border-radius: 4px;
            border: 1px solid #0d47b3;
        }
        #image-preview { position: relative; }
        #image-preview img#output,
        #image-preview img#view_output {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #fff;
            z-index: 1;
        }
        #image-preview img#output:not([src]),
        #image-preview img#output[src=""],
        #image-preview img#view_output:not([src]),
        #image-preview img#view_output[src=""] {
            display: none;
        }
        #image-preview label[for="image-upload"] { z-index: 6; }

        .has_file {
            font-size: 0px !important;
            position: relative !important;
            left: -135px !important;
            top: 25px !important;
        }


        #viewUser .modal-dialog
        {
            max-width: 750px;
        }
        button.btn.btn-danger {
        background: #3758ff;
        border-color:#3758ff;
        }
         #userNote .modal-body {
            max-height: 400px;
            overflow-y: auto;
        }
                </style>

    <!-- begin:: Content -->

    <div class="kt-content  kt-grid__item kt-grid__item--fluid view_user_content" id="kt_content" style="padding:26px;">

        {{-- Modern page header --}}
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
                    <div class="am-stat__value">{{ number_format($totalUsers ?? 0) }}</div>
                </div>
            </div>
            <div class="am-stat">
                <span class="am-stat__icon green"><i class="fa fa-check-circle"></i></span>
                <div>
                    <p class="am-stat__label">Active Recently</p>
                    <div class="am-stat__value">{{ number_format($activeRecent ?? 0) }}</div>
                </div>
            </div>
            <div class="am-stat">
                <span class="am-stat__icon orange"><i class="fa fa-user-plus"></i></span>
                <div>
                    <p class="am-stat__label">New This Month</p>
                    <div class="am-stat__value">{{ number_format($newThisMonth ?? 0) }}</div>
                </div>
            </div>
            <div class="am-stat">
                <span class="am-stat__icon cyan"><i class="fa fa-globe"></i></span>
                <div>
                    <p class="am-stat__label">Countries</p>
                    <div class="am-stat__value">{{ number_format($countries ?? 0) }}</div>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
                <i class="fa fa-check-circle"></i> {{ $message }}
            </div>
        @endif

        <div class="am-card">
            <div class="am-card__toolbar">
                <form method="GET" action="{{ url('/view_user') }}" class="am-search" id="amUsersSearchForm" style="margin:0;">
                    <i class="fa fa-search"></i>
                    <input type="text" name="q" id="amUsersSearch" value="{{ $search ?? '' }}" placeholder="Search users by name, email, company, country…" autocomplete="off">
                </form>
            </div>
        <div class="kt-portlet kt-portlet--mobile" style="background:transparent;box-shadow:none;border:none;margin:0;">

            <div class="kt-portlet__head kt-portlet__head--lg" style="display:none;">

                <div class="kt-portlet__head-label">

				<span class="kt-portlet__head-icon">

					<i class="kt-font-brand flaticon2-line-chart"></i>

				</span>

                    <h3 class="kt-portlet__head-title">

                        Users Listing

                    </h3>

                </div>

                <div class="kt-portlet__head-toolbar">

                    <div class="kt-portlet__head-wrapper">

                        <div class="kt-portlet__head-actions">

                            <div class="dropdown dropdown-inline">

                                {{-- <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="la la-download"></i> Export

                                </button>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <ul class="kt-nav">

                                        <li class="kt-nav__section kt-nav__section--first">

                                            <span class="kt-nav__section-text">Choose an option</span>

                                        </li>

                                        <li class="kt-nav__item">

                                            <a href="#" class="kt-nav__link">

                                                <i class="kt-nav__link-icon la la-print"></i>

                                                <span class="kt-nav__link-text">Print</span>

                                            </a>

                                        </li>

                                        <li class="kt-nav__item">

                                            <a href="#" class="kt-nav__link">

                                                <i class="kt-nav__link-icon la la-copy"></i>

                                                <span class="kt-nav__link-text">Copy</span>

                                            </a>

                                        </li>

                                        <li class="kt-nav__item">

                                            <a href="#" class="kt-nav__link">

                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>

                                                <span class="kt-nav__link-text">Excel</span>

                                            </a>

                                        </li>

                                        <li class="kt-nav__item">

                                            <a href="#" class="kt-nav__link">

                                                <i class="kt-nav__link-icon la la-file-text-o"></i>

                                                <span class="kt-nav__link-text">CSV</span>

                                            </a>

                                        </li>

                                        <li class="kt-nav__item">

                                            <a href="#" class="kt-nav__link">

                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>

                                                <span class="kt-nav__link-text">PDF</span>

                                            </a>

                                        </li>

                                    </ul>

                                </div> --}}
                            @php
                                $usertypes = \App\UserType::get();
                            @endphp
                            <!--<form action="{{url('/view_user')}}" id="showuserform">-->
                            <!--    <select name="showusers" id="showusers">-->
                            <!--        <option value="0" {{ request('showusers') == 0 ? 'selected' : '' }}>All Users</option>-->
                            <!--        @foreach ($usertypes as $usertype)-->
                            <!--        <option value="{{$usertype->id}}" {{ request('showusers') == $usertype->id ? 'selected' : '' }}>{{$usertype->name}}</option> -->
                            <!--        @endforeach-->
                            <!--    </select>-->
                            <!--</form>-->
                            </div>

                            &nbsp;

                            <a href="/add_user" class="btn btn-brand btn-elevate btn-icon-sm">

                                <i class="la la-plus"></i>

                                New Record

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="kt-portlet__body" style="padding:0;">
                <div id="amUsersContainer" style="position:relative;">
                    @include('admin.dashboard.admin.partials.users_table')
                </div>
            </div>
            @php if(false): @endphp
                <div class="am-table-wrap">
                    <table class="am-table" id="amUsersTable-legacy">
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
                        @foreach ($users as $item) */ @endphp


                            @php
                                $iso9001 = $item->iso9001_expirydate;
                                $iso14001 = $item->iso14001_expirydate;
                                $iso45001 = $item->iso45001_expirydate;
                                $x = strtotime($iso9001);
                                $y = strtotime($iso14001);
                                $z = strtotime($iso45001);
                                if ($x == 0 && $y == 0 && $z == 0) {
                                    $minValueRaw = strtotime('+3 years');
                                } else if ($x >= 0 && $y <= 0 && $z <= 0) {
                                    $minValueRaw = $x;
                                } else if ($x <= 0 && $y >= 0 && $z <= 0) {
                                    $minValueRaw = $y;
                                } else if ($x <= 0 && $y <= 0 && $z >= 0) {
                                    $minValueRaw = $z;
                                } else if ($x >= 0 && $y >= 0 && $z <= 0) {
                                    $minValueRaw = min($x, $y);
                                } else if ($x >= 0 && $y <= 0 && $z >= 0) {
                                    $minValueRaw = min($x, $z);
                                } else if ($x <= 0 && $y >= 0 && $z >= 0) {
                                    $minValueRaw = min($y, $z);
                                } else {
                                    $minValueRaw = min($x, min($y, $z));
                                }
                                $minValue = date('d/m/Y', $minValueRaw);
                                $daysToExpiry = intval(($minValueRaw - time()) / 86400);
                            @endphp
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
                                        <span class="am-chip info">{{ date('d M Y', strtotime($item->created_at)) }}</span>
                                    @else
                                        <span class="am-cell-sub">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($item->last_login))
                                        <span class="am-cell-primary">{{ date('d M Y', strtotime($item->last_login)) }}</span>
                                    @else
                                        <span class="am-cell-sub">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($daysToExpiry < 0)
                                        <span class="am-chip danger">Expired</span>
                                    @elseif($daysToExpiry < 30)
                                        <span class="am-chip warning">{{ $minValue }}</span>
                                    @else
                                        <span class="am-chip success">{{ $minValue }}</span>
                                    @endif
                                </td>

                                  <!--  if($iso9001==null &&  $iso14001==null  && $iso45001==null){-->

                                  <!--      $minValue = date('d/m/Y', strtotime('+3 years'));-->

                                  <!--  }else if($iso9001 != null && $iso14001 == null  && $iso45001 == null){-->
                                  <!--  $minValue=$x;-->
                                  <!--  $minValue = date('d/m/Y', $minValue);-->
                                  <!--  }else if($iso9001 == null && $iso14001 != null  && $iso45001 == null){-->

                                  <!--  $minValue=$y;-->
                                  <!--  $minValue = date('d/m/Y', $minValue);-->
                                  <!--  }else if($iso9001 == null && $iso14001 == null  && $iso45001 != null){-->

                                  <!--  $minValue=$z;-->
                                  <!--$minValue = date('d/m/Y', $minValue);-->
                                  <!--  }else if($iso9001 != null && $iso14001 != null  && $iso45001 == null){  -->
                                  <!--  $minValue=min($x,$y);-->
                                  <!--      $minValue = date('d/m/Y', $minValue);-->
                                  <!--  }else if($iso9001 != null && $iso14001 == null  && $iso45001 != null){-->
                                  <!--  $minValue=min($x,$z);-->
                                  <!--      $minValue = date('d/m/Y', $minValue);-->
                                  <!--  }else if($iso9001 == null && $iso14001 != null  && $iso45001 != null){  -->
                                  <!--  $minValue=min($y,$z);-->
                                  <!--      $minValue = date('d/m/Y', $minValue);-->
                                  <!--  }else{-->

                                  <!--      $minValue=min($x,min($y,$z));-->
                                  <!--          $minValue = date('d/m/Y', $minValue);-->

                                  <!--  }-->
                                <td>
                                    @php if($item->last_login!=NULL){ @endphp
                                    {{ date('d/m/Y', strtotime($item->last_login))}}
                                    @php } @endphp
                                </td>

                                <td>{{ $minValue }} </td>


                                <td style="text-align:right;white-space:nowrap;">
                                    <div class="am-actions">
                                        <button class="am-icon-btn" title="Download History" onclick="get_downloads({{$item->id}})"><i class="fa fa-download"></i></button>
                                        <button class="am-icon-btn" title="Notes History" onclick="get_notes({{$item->order_number}})"><i class="fas fa-info-circle"></i></button>
                                        <button class="am-icon-btn" title="Login History" onclick="get_history({{$item->id}})"><i class="fas fa-sign-in-alt"></i></button>
                                        <button class="am-icon-btn" title="Activity Reminder" onclick="userEmailDetail({{$item->id}})"><i class="fa fa-envelope"></i></button>
                                        <button class="am-icon-btn" title="Edit" onclick="editDetails({{$item}})"><i class="fa fa-pen"></i></button>
                                        <a href="/edit_user/{{$item->id}}" class="am-icon-btn" title="View Forms"><i class="fa fa-file-alt"></i></a>
                                        <button class="am-icon-btn danger" title="Delete" onclick="deleteUser({{$item->id}})"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach


                        </tbody>

                    </table>
                </div>
                <!--end: Datatable -->

            </div>

            <div class="am-pagination">
                <div class="am-pagination__info">
                    Showing <strong>{{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($users->total()) }}</strong>
                </div>
                <div class="am-pagination__nav">
                    @if ($users->onFirstPage())
                        <button disabled>‹</button>
                    @else
                        <button onclick="window.location='{{ $users->previousPageUrl() }}'">‹</button>
                    @endif

                    @php
                        $current = $users->currentPage();
                        $last = $users->lastPage();
                        $start = max(1, $current - 2);
                        $end = min($last, $start + 4);
                        $start = max(1, $end - 4);
                    @endphp
                    @for ($p = $start; $p <= $end; $p++)
                        <button onclick="window.location='{{ $users->url($p) }}'" class="{{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
                    @endfor

                    @if ($users->hasMorePages())
                        <button onclick="window.location='{{ $users->nextPageUrl() }}'">›</button>
                    @else
                        <button disabled>›</button>
                    @endif
                </div>
            </div>

        </div>
        </div>{{-- /.am-card --}}

    </div>

    @php endif; @endphp

    {{-- <!-- Modal for Login History -->
    <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Last Login History <span id="userName"></span></h1>
                    <div id="loginHistoryTable"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}


      {{-- Modern modals --}}

    <!-- Download History -->
    <div class="am-modal" id="viewUserDownloads" role="dialog" aria-modal="true">
        <div class="am-modal__box" style="max-width:820px;">
            <div class="am-modal__header">
                <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-download"></i></span>
                <h4 class="am-modal__title">Download History</h4>
            </div>
            <div class="am-modal__body">
                <div id="downloadHistoryTable"></div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
            </div>
        </div>
    </div>

    <!-- Login History -->
    <div class="am-modal" id="viewUser" role="dialog" aria-modal="true">
        <div class="am-modal__box" style="max-width:820px;">
            <div class="am-modal__header">
                <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-sign-in-alt"></i></span>
                <h4 class="am-modal__title">Login History</h4>
            </div>
            <div class="am-modal__body">
                <div id="loginHistoryTable"></div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
            </div>
        </div>
    </div>

    <!-- User Notes -->
    <div class="am-modal" id="userNote" role="dialog" aria-modal="true">
        <div class="am-modal__box" style="max-width:820px;">
            <div class="am-modal__header">
                <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-sticky-note"></i></span>
                <h4 class="am-modal__title">User Notes</h4>
            </div>
            <div class="am-modal__body">
                <form class="am-form" id="addusernotform" method="POST" action="{{ route('addusernote') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="editcompanyid" id="editcompanyid" value="">
                    <input type="hidden" name="_method" id="_method" value="POST">
                    <input type="hidden" id="note_id" name="note_id" value="">
                    <div class="form-group">
                        <label for="add_note" style="display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin-bottom:6px;">Add Note</label>
                        <textarea id="add_note" name="note" rows="4" class="form-control" placeholder="Description / Audit Comment" style="width:100%;padding:10px 14px;border:1px solid #e2e6ee;border-radius:8px;background:#f9fafc;font-size:13.5px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-top:14px;">
                        <label for="note_file" style="display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin-bottom:6px;">Note Image (optional)</label>
                        <input type="file" name="note_file" id="note_file" class="form-control-file" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx">
                        <div id="drop-area" style="border:2px dashed #cbd5e1;padding:16px;text-align:center;margin-top:10px;border-radius:8px;color:var(--am-text-muted);font-size:12.5px;">
                            <i class="fa fa-cloud-upload-alt" style="font-size:18px;margin-right:6px;"></i> Drag &amp; drop a file here
                        </div>
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:16px;">
                        <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                        <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Save Note</button>
                    </div>
                </form>

                <div style="margin-top:24px;">
                    <h5 style="font-size:13px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);margin:0 0 12px 0;font-weight:600;">History</h5>
                    <div id="notesHistoryTable"></div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
            </div>
        </div>
    </div>

    <!-- Activity Reminder Emails -->
    <div class="am-modal" id="user-email-details" role="dialog" aria-modal="true">
        <div class="am-modal__box" style="max-width:720px;">
            <div class="am-modal__header">
                <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-envelope"></i></span>
                <h4 class="am-modal__title">Activity Reminders</h4>
            </div>
            <div class="am-modal__body" id="modalBody">
                <div id="userDetailEmailTable"></div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
            </div>
        </div>
    </div>


        <!-- Modal for Login History -->
{{-- <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Last Login History <span id="userName"></span></h1>

                <div id="loginHistoryTable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Login Date & Time</th>
                                <th>IP Address</th>
                                <th>Browser</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loginHistory as $history)
                                <tr>
                                    <td style="text-align: center">{{ $loop->index + 1 }}</td>
                                    <td style="padding: 5px 15px; text-align: center">{{ date('d-m-Y H:i:s', strtotime($history->login_time)) }}</td>
                                    <td style="padding: 5px 15px; text-align: center">{{ $history->ip_address }}</td>
                                    <td style="padding: 5px 15px; text-align: center">{{ $history->browser }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $loginHistory->links() }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}





    <!-- Delete User -->
    <div class="am-modal" id="deleteUser" role="dialog" aria-modal="true">
        <div class="am-modal__box">
            <div class="am-modal__header">
                <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
                <h4 class="am-modal__title">Delete User?</h4>
            </div>
            <div class="am-modal__body">
                You are about to permanently delete <strong>this user</strong>. All their data will be lost. This action cannot be undone.
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <form action="{{ route('deleteuserd') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" id="userid" value="">
                    <button type="submit" class="am-btn" style="background:var(--am-danger);color:#fff;">
                        <i class="fa fa-trash"></i> Yes, delete
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit User Details -->
    <div class="am-modal" id="editModal" role="dialog" aria-modal="true">
        <div class="am-modal__box am-form" style="max-width:1100px;">
            <div class="am-modal__header">
                <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-user-edit"></i></span>
                <h4 class="am-modal__title">Edit User Details</h4>
            </div>

            <form id="addform" method="POST" action="{{route('updateuserinfo')}}" enctype="multipart/form-data" style="display:contents;">
                @csrf
                <div class="am-modal__body" style="padding:26px;">
                    <div class="kt-portlet__body" style="padding:0;">

                            <input type="hidden" name="id" id="editvalue" value="">

                            <div class="form-group row">

                                <div class="col-lg-4">

                                    <label for="address2">Company ID</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="number" id="order_number" name="order_number" class="form-control"
                                               placeholder="">

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <label for="name">Email Address:</label>

                                    <input type="text" id="email" name="email" class="form-control"
                                           placeholder="Enter email">

                                    <span class="form-text text-muted">Please enter Email Address</span>

                                </div>

                                <div class="col-lg-4">

                                    <label for="name">Username:</label>

                                    <input type="text" id="name" name="name" class="form-control"
                                           placeholder="Enter name">

                                    <span class="form-text text-muted">Please enter the client's Username</span>

                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">

                                    <label for="password">Password:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="password" id="password" name="password" class="form-control"
                                               placeholder="Enter password">
                                        <span class="form-text text-muted">Minimum 6 characters, at least 1 number & at least 1 Capital letter</span>
                                        <!--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->

                                    </div>

                                </div>

                                <div class="col-lg-4">
                                    <label for="company_name">Company Name:</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control"
                                           placeholder="Enter Company Name">
                                </div>


                                <div class="col-lg-4">
                                    <label for="company_address">Company Address:</label>
                                    <textarea id="company_address" name="company_address" class="form-control"
                                              placeholder="Enter Company Address"></textarea>
                                </div>


                            </div>


                            <div class="form-group row">
                                <div class="col-lg-4">

                                    <label for="state">Company Phone Number.</label>

                                    <div class="kt-input-icon kt-input-icon--right" id='phone_div'>


                                    </div>
                                    <input type="hidden" name="phonecode" id="phonecode">
                                    <input type="hidden" name="phoneflag" id="phoneflag">
                                </div>
                                <div class="col-lg-4">
                                    <label for="country">Country:</label>
                                    <input type="text" id="country" name="country" class="form-control"
                                           placeholder="Enter Country">
                                </div>
                                <div class="col-lg-4">

                                    <label for="city">Managing Director:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="director" name="director" class="form-control"
                                               placeholder="Managing Director">

                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="name">Person responsible for ISO:</label>
                                    <input type="text" id="person_iso" name="person_iso" class="form-control"
                                           placeholder="Iso Person Name" required>
                                    <span class="form-text text-muted">Please enter the ISO contact person's name</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="contact_iso">Contact number of ISO person:</label>
                                    <div class="kt-input-icon kt-input-icon--right" id='iso_div'>
                                    </div>
                                    <input type="hidden" name="isophonecode" id="isophonecode">
                                    <input type="hidden" name="isophoneflag" id="isophoneflag">
                                </div>
                                <div class="col-lg-4">
                                    <label for="password">Email of ISO contact person:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="email" id="email_iso" name="email_iso" class="form-control"
                                               placeholder="Enter Iso Email" required>
                                        <!--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->
                                        <span class="form-text text-muted">Please enter the email address of ISO contact person</span>

                                    </div>
                                </div>


                            </div>

                            <div class="form-group row">

                                <div class="col-lg-4">

                                    <label for="zip">Sales Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="sales_process" name="sales_process" class="form-control"
                                               placeholder="Enter Sales Process">

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <label for="password">Purchasing Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="purchasing_process" name="purchasing_process"
                                               class="form-control" placeholder="Purchasing Process Owner">

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <label class="">Servicing of Contract Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="servicing_process" name="servicing_process"
                                               class="form-control" placeholder="Servicing of Contract Process Owner">

                                    </div>

                                </div>

                            </div>


                            <div class="form-group row">

                                <div class="col-lg-6">

                                    <label for="address1">Competency Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="competency_process" name="competency_process"
                                               class="form-control" placeholder="Enter address1">

                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <label for="address2">Company Profile:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="file" id="company_profile" name="company_profile"
                                               class="form-control" placeholder="Company Profile">

                                        <span class="form-text text-muted" id="downloadlink"></span>


                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">


                                <div class="col-lg-6">

                                    <label for="address1">Business Scope:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <textarea id="scope" name="business_scopes" class="form-control"></textarea>

                                    </div>

                                </div>

                                <!--<div class="col-lg-6">-->

                                <!--	<label for="last_login">Last login:</label>-->

                                <!--	<div class="kt-input-icon kt-input-icon--right">-->

                                <!--		<input type="date" id="last_login" name="last_login" class="form-control" readonly disabled>-->

                                <!--	</div>-->

                                <!--</div>-->
                            </div>


                            <div class="form-group row">

                                <div class="col-lg-8">

                                    <label for="user_image">Company Description:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <textarea rows="8" class="form-control" id="Company_overview"
                                                  name="Company_overview"></textarea>

                                        <!-- <input type="text" id="Company_overview" name="Company_overview" class="form-control" > -->


                                    </div>


                                </div>

                                <div class="col-lg-4">

                                    <label for="user_image">Company Logo</label>

                                    <div class="kt-input-icon kt-input-icon--right">


                                        <div id="image-preview">

                                            <label for="image-upload" id="image-label"></label>

                                            <input type="file" accept="image/*" name="user_image" id="image-upload"
                                                   onchange="loadFile(event)"/>

                                            <p><label for="file" style="cursor: pointer;">Attach JPEG file only</label>
                                            </p>
                                            <p><img id="output" width="200px" height="200px"/></p>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="iso9001_certificate">ISO9001 Certificate:</label>&nbsp;&nbsp;
                                    <span id="view_9001"> </span>&nbsp;&nbsp;
                                    <a href="#" data-handle="iso9001" class="iso9001 delete-certificate">Delete</a>
                                    <input type="file" id="iso9001_certificate" accept=".pdf"
                                           name="iso9001_certificate">
                                    <!--<button type="button" class="new-file-upload"-->
                                    <!--        onclick="document.getElementById('iso9001_certificate').click()">Attach File-->
                                    <!--</button>-->
                                </div>



                                <div class="col-lg-4">
                                    <label for="iso9001_expirydate">Expiry date:</label>
                                    <input type="date" id="iso9001_expirydate" max="31-12-2999"
                                    name="iso9001_expirydate" class="form-control" placeholder="Expiry Date">
                                </div>


                                <div class="col-lg-4">
                                    <label for="iso9001_description">Description:</label>
                                    <textarea id="iso9001_description" name="iso9001_description" class="form-control"
                                              placeholder="Description for ISO9001 Certificate"></textarea>
                                </div>
                            </div>




                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="iso14001_certificate">ISO14001 Certificate:</label>&nbsp;&nbsp;<span
                                            id="view_4001"></span>&nbsp;&nbsp;<a href="#" data-handle="iso14001"
                                                                                 class="iso4001 delete-certificate">Delete</a>
                                    <input type="file" id="iso14001_certificate" accept=".pdf"
                                           name="iso14001_certificate">
                                    <!--<button type="button" class="new-file-upload"-->
                                    <!--        onclick="document.getElementById('iso14001_certificate').click()">Attach-->
                                    <!--    File-->
                                    <!--</button>-->
                                </div>

                                <div class="col-lg-4">
                                    <label for="iso14001_expirydate">Expiry date:</label>
                                    <input type="date" id="iso14001_expirydate" max="2999-12-31"
                                           name="iso14001_expirydate" class="form-control" placeholder="Expiry Date">
                                </div>

                                {{-- <div class="col-lg-4">
                                    <label for="iso14001_expirydate">Expiry date</label>
                                    <input type="text" id="iso14001_expirydate" name="iso14001_expirydate" class="form-control" placeholder="dd/mm/yyyy">
                                </div> --}}



                                <div class="col-lg-4">
                                    <label for="iso14001_description">Description:</label>
                                    <textarea id="iso14001_description" name="iso14001_description" class="form-control"
                                              placeholder="Description for ISO14001 Certificate"></textarea>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="iso45001_certificate">ISO45001 Certificate:</label>&nbsp;&nbsp;
                                    <span id="view_45001"></span>
                                    &nbsp;&nbsp; <a href="#" data-handle="iso45001" class="iso45001 delete-certificate">Delete</a>
                                    <input type="file" id="iso45001_certificate" accept=".pdf"
                                           name="iso45001_certificate">
                                </div>

                                <div class="col-lg-4">
                                    <label for="iso45001_expirydate">Expiry date:</label>
                                    <input type="date" id="iso45001_expirydate" max="2999-12-31"
                                           name="iso45001_expirydate" class="form-control" placeholder="Expiry Date">
                                </div>

                                {{-- <div class="col-lg-4">
                                    <label for="iso45001_expirydate">Expiry date</label>
                                    <input type="text" id="iso45001_expirydate" name="iso45001_expirydate" class="form-control" placeholder="dd/mm/yyyy">
                                </div> --}}



                                <div class="col-lg-4">
                                    <label for="iso45001_description">Description:</label>
                                    <textarea id="iso45001_description" name="iso45001_description" class="form-control"
                                              placeholder="Description for ISO45001 Certificate"></textarea>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="audit_report">Audit Report</label>&nbsp;&nbsp;
                                    <span id="edit_audit_report"></span>
                                    &nbsp;&nbsp; <a href="#" data-handle="audit_report"
                                                    class="audit_report delete-certificate">Delete</a>
                                    <input type="file" id="audit_report" accept=".pdf" name="audit_report">
                                </div>
                                <div class="col-lg-4">
                                    <label for="audit_comment">Audit Comment</label>&nbsp;&nbsp;
                                    <textarea id="audit_comment" name="audit_comment" class="form-control"
                                              placeholder="Description Audit Comment"></textarea>
                                </div>
                            </div>
                                <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="qa_certification"> QA Certification Agreement</label>&nbsp;&nbsp;
                                    <span id="edit_qa_certification"></span>
                                    &nbsp;&nbsp; <a href="#" data-handle="qa_certification"
                                                    class="qa_certification delete-qa_certification">Delete</a>
                                    <input type="file" id="qa_certification" accept=".pdf" name="qa_certification">
                                </div>

                            </div>
                        </div>


                    </div>

                <div class="am-modal__footer">
                    <button type="button" class="am-btn am-btn-outline am-modal-close">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="am-btn am-btn-primary">
                        <i class="fa fa-check"></i> Update User
                    </button>
                </div>
            </form>

        </div>
    </div>

    </div>


    {{-- comment the eye option on view user detail page on admin login--}}

    {{-- <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="modal-body">
                            <div class="kt-portlet__body">
                                <input type="hidden" name="id" id="editvalue" value="">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="address2">Company ID</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="number" id="order_number" name="order_number"
                                                   class="form-control" placeholder="" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="name">Email Address:</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                               placeholder="Enter email" readonly disabled>
                                        <span class="form-text text-muted">Please enter Email Address</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="name">Username:</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Enter name" readonly disabled>
                                        <span class="form-text text-muted">Please enter the client's Username</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="password">Password:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="password" id="password" name="password" class="form-control"
                                                   placeholder="Enter password" readonly disabled>
                                            <span class="form-text text-muted">Minimum 6 characters, at least 1 number & at least 1 Capital letter</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="company_name">Company Name:</label>
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                               placeholder="Enter Company Name" readonly disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="company_address">Company Address:</label>
                                        <textarea id="company_address" name="company_address" class="form-control"
                                                  placeholder="Enter Company Address" readonly disabled></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="state">Company Phone Number.</label>
                                        <div class="kt-input-icon kt-input-icon--right" id="view_phone_div">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="country">Country:</label>
                                        <input type="text" id="country" name="country" class="form-control"
                                               placeholder="Enter Country">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="city">Managing Director:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text" id="director" name="director" class="form-control"
                                                   placeholder="Managing Director" readonly disabled>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="name">Person responsible for ISO:</label>
                                        <input type="text" id="person_iso" name="person_iso" class="form-control"
                                               placeholder="Iso Person Name" required readonly disabled>
                                        <span
                                                class="form-text text-muted">Please enter the ISO contact person's name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="contact_iso">Contact number of ISO person:</label>
                                        <div class="kt-input-icon kt-input-icon--right" id='view_iso_div'>

                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="password">Email of ISO contact person:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="email" id="email_iso" name="email_iso" class="form-control"
                                                   placeholder="Enter Iso Email" readonly disabled>
                                            <!--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->
                                            <span class="form-text text-muted">Please enter the email address of ISO contact person</span>

                                        </div>
                                    </div>


                                </div>

                                <div class="form-group row">

                                    <div class="col-lg-4">

                                        <label for="zip">Sales Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="sales_process" name="sales_process"
                                                   class="form-control" placeholder="Enter Sales Process" readonly
                                                   disabled>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <label for="password">Purchasing Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="purchasing_process" name="purchasing_process"
                                                   class="form-control" placeholder="Purchasing Process Owner" readonly
                                                   disabled>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <label class="">Servicing of Contract Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="servicing_process" name="servicing_process"
                                                   class="form-control"
                                                   placeholder="Servicing of Contract Process Owner" readonly disabled>

                                        </div>

                                    </div>

                                </div>


                                <div class="form-group row">

                                    <div class="col-lg-6">

                                        <label for="address1">Competency Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="competency_process" name="competency_process"
                                                   class="form-control" placeholder="Enter address1" readonly disabled>

                                        </div>

                                    </div>
                                    <div class="col-lg-6">

                                        <label for="address2">Company Profile:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="file" id="company_profile" name="company_profile"
                                                   class="form-control" placeholder="Company Profile" readonly disabled>

                                            <span class="form-text text-muted" id="downloadlink">

									 <a target='_blank' href="" id="view_company_profile">Profile</a>

									</span>


                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">


                                    <div class="col-lg-6">

                                        <label for="address1">Business Scope:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <textarea id="scope" name="business_scopes" class="form-control" readonly
                                                      disabled></textarea>

                                        </div>

                                    </div>

                                    <!--<div class="col-lg-6">-->

                                    <!--	<label for="last_login">Last login:</label>-->

                                    <!--	<div class="kt-input-icon kt-input-icon--right">-->

                                    <!--		<input type="date" id="last_login" name="last_login" class="form-control" readonly disabled>-->

                                    <!--	</div>-->

                                    <!--</div>-->
                                </div>
                                <div class="form-group row">

                                    <div class="col-lg-8">

                                        <label for="user_image">Company Description:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                                <textarea rows="8" class="form-control" id="Company_overview"
                                                          name="Company_overview" readonly disabled></textarea>


                                        </div>


                                    </div>

                                    <div class="col-lg-4">

                                        <label for="user_image">Company Logo</label>

                                        <div class="kt-input-icon kt-input-icon--right">


                                            <div id="image-preview">

                                                <label for="image-upload" id="image-label"></label>

                                                <input type="file" accept="image/*" name="user_image"
                                                       id="image-upload" onchange="viewloadFile(event)"/>

                                                <p><label for="file" style="cursor: pointer;">Attach JPEG file
                                                        only</label></p>

                                                <p><img id="view_output" width="200px" height="200px"/></p>

                                            </div>

                                        </div>


                                    </div>


                                </div>

                                <div class="form-group row">

                                    <div class="col-lg-4">
                                        <label for="iso9001_certificate">ISO9001 Certificate:</label>
                                        <br>
                                        <span id="v_9001"> </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="iso9001_expirydate">Expiry date:</label>
                                        <input type="date" id="iso9001_expirydate" name="iso9001_expirydate"
                                               max="2999-12-31" class="form-control" placeholder="Expiry Date"
                                               readonly disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="iso9001_description">Description:</label>
                                        <textarea id="iso9001_description" name="iso9001_description"
                                                  class="form-control"
                                                  placeholder="Description for ISO9001 Certificate" readonly
                                                  disabled></textarea>
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <div class="col-lg-4">
                                        <label for="iso14001_certificate">ISO14001 Certificate:</label>
                                        <br>
                                        <span id="v_4001"> </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="iso14001_expirydate">Expiry date:</label>
                                        <input type="date" id="iso14001_expirydate" name="iso14001_expirydate"
                                               max="2999-12-31" class="form-control" placeholder="Expiry Date"
                                               readonly disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="iso14001_description">Description:</label>
                                        <textarea id="iso14001_description" name="iso14001_description"
                                                  class="form-control"
                                                  placeholder="Description for ISO14001 Certificate" readonly
                                                  disabled></textarea>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="iso45001_certificate">ISO45001 Certificate:</label>
                                        <br>
                                        <span id="v_45001"> </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="iso45001_expirydate">Expiry date:</label>
                                        <input type="date" id="iso45001_expirydate" name="iso45001_expirydate"
                                               max="2999-12-31" class="form-control" placeholder="Expiry Date"
                                               readonly disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="iso45001_description">Description:</label>
                                        <textarea id="iso45001_description" name="iso45001_description"
                                                  class="form-control"
                                                  placeholder="Description for ISO45001 Certificate" readonly
                                                  disabled></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label for="audit_report">Audit Report:</label>
                                        <br>
                                        <span id="v_audit_report"> </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="audit_comment">Audit Comment:</label>
                                        <br>
                                        <textarea id="audit_comment" name="audit_comment"
                                                  class="form-control"
                                                  placeholder="Audit Comment" readonly
                                                  disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--<button type="submit" class="btn btn-danger">Update</button>-->
                </div>
            </div>
        </div>
    </div> --}}






                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function ()
                    {
                        var input = document.getElementById('iso9001_expirydate');
                        input.addEventListener('input', function () {
                            var value = input.value;
                            if (/^\d{2}\/\d{2}\/\d{4}$/.test(value))
                            {
                                input.setCustomValidity('');
                            } else
                            {
                                input.setCustomValidity('Please enter a date in the format dd/mm/yyyy');
                            }
                        });
                    });
                </script> --}}


                {{-- <script>

                    document.addEventListener('DOMContentLoaded', function () {
                        var input = document.getElementById('iso14001_expirydate');
                        input.addEventListener('input', function ()
                        {
                            var value = input.value;
                            if (/^\d{2}\/\d{2}\/\d{4}$/.test(value))
                            {
                                input.setCustomValidity('');
                            } else
                            {
                                input.setCustomValidity('Please enter a date in the format dd/mm/yyyy');
                            }
                        });
                    });
                </script> --}}



                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function ()
                    {
                        var input = document.getElementById('iso45001_expirydate');
                        input.addEventListener('input', function ()
                        {
                            var value = input.value;
                            if (/^\d{2}\/\d{2}\/\d{4}$/.test(value))
                            {
                                input.setCustomValidity('');
                            } else {
                                input.setCustomValidity('Please enter a date in the format dd/mm/yyyy');
                            }
                        });
                    });
                </script> --}}




        <script>

            // ------ Modern modal helpers ------
            function openAmModal(id) { document.getElementById(id) && document.getElementById(id).classList.add('open'); }
            function closeAmModal(id) { document.getElementById(id) && document.getElementById(id).classList.remove('open'); }
            // Delegated close (Cancel/Close buttons + click backdrop + Escape)
            document.addEventListener('click', function(e) {
                var closeBtn = e.target.closest('.am-modal-close');
                if (closeBtn) {
                    var m = closeBtn.closest('.am-modal');
                    if (m) m.classList.remove('open');
                    return;
                }
                var modal = e.target.classList && e.target.classList.contains('am-modal') ? e.target : null;
                if (modal) modal.classList.remove('open');
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
            });

            // ------ Client-side searchable + paginated table for AJAX-injected content ------
            function enhanceModalTable(containerId, opts) {
                opts = opts || {};
                var perPage = opts.perPage || 10;
                var container = document.getElementById(containerId);
                if (!container) return;
                var table = container.querySelector('table');
                if (!table) return;

                var tbody = table.querySelector('tbody');
                if (!tbody) return;
                var allRows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
                if (allRows.length === 0) return;

                // Toolbar
                var toolbar = document.createElement('div');
                toolbar.className = 'am-mtable-toolbar';
                toolbar.innerHTML = '<div class="am-mtable-search"><i class="fa fa-search"></i><input type="text" placeholder="Search…"></div>' +
                                    '<div style="font-size:12px;color:var(--am-text-muted);"><strong>' + allRows.length + '</strong> total</div>';
                container.insertBefore(toolbar, table);

                // Pagination footer
                var pager = document.createElement('div');
                pager.className = 'am-mtable-pagination';
                pager.innerHTML = '<div class="am-mtable-pagination__info"></div><div class="am-mtable-pagination__nav"></div>';
                container.appendChild(pager);

                var input = toolbar.querySelector('input');
                var info  = pager.querySelector('.am-mtable-pagination__info');
                var nav   = pager.querySelector('.am-mtable-pagination__nav');
                var currentPage = 1;
                var filtered = allRows.slice();

                function debounce(fn, wait) { var t; return function(){ var ctx=this, args=arguments; clearTimeout(t); t=setTimeout(function(){ fn.apply(ctx,args); }, wait); }; }

                function render() {
                    var total = filtered.length;
                    var totalPages = Math.max(1, Math.ceil(total / perPage));
                    if (currentPage > totalPages) currentPage = totalPages;
                    var start = (currentPage - 1) * perPage;
                    var end = start + perPage;

                    allRows.forEach(function(r){ r.style.display = 'none'; });
                    filtered.slice(start, end).forEach(function(r){ r.style.display = ''; });

                    var from = total === 0 ? 0 : start + 1;
                    var to   = Math.min(end, total);
                    info.innerHTML = 'Showing <strong>' + from + '–' + to + '</strong> of <strong>' + total + '</strong>';

                    nav.innerHTML = '';
                    var prev = document.createElement('button'); prev.textContent = '‹'; prev.disabled = currentPage <= 1;
                    prev.addEventListener('click', function(){ currentPage--; render(); });
                    nav.appendChild(prev);

                    var maxBtns = 5;
                    var startPage = Math.max(1, currentPage - Math.floor(maxBtns/2));
                    var endPage = Math.min(totalPages, startPage + maxBtns - 1);
                    startPage = Math.max(1, endPage - maxBtns + 1);
                    for (var p = startPage; p <= endPage; p++) {
                        (function(page){
                            var b = document.createElement('button'); b.textContent = page;
                            if (page === currentPage) b.classList.add('active');
                            b.addEventListener('click', function(){ currentPage = page; render(); });
                            nav.appendChild(b);
                        })(p);
                    }

                    var next = document.createElement('button'); next.textContent = '›'; next.disabled = currentPage >= totalPages;
                    next.addEventListener('click', function(){ currentPage++; render(); });
                    nav.appendChild(next);
                }

                input.addEventListener('input', debounce(function() {
                    var q = this.value.trim().toLowerCase();
                    filtered = q === '' ? allRows.slice() : allRows.filter(function(r){ return r.textContent.toLowerCase().indexOf(q) !== -1; });
                    currentPage = 1;
                    render();
                }, 250));

                render();
            }

            function deleteUser(id)
            {
                var userid = id;
                $("#userid").val(userid);
                openAmModal('deleteUser');
            }

            var intel_phone = '';
            var intel_iso_phone = '';


        // function get_history(id)
        // {
        // $.ajax({
        //     type: "post",
        //     url: "{{ url('/userloginhistory') }}",
        //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //     data: {
        //         user_id: id,
        //         _token: $('meta[name="csrf-token"]').attr('content')
        //     },
        //         success: function (response)
        //         {
        //             // $('#userName').text(id);
        //             $('#loginHistoryTable').html(response);
        //             $('#viewUser').modal('show');
        //         },
        //     });
        // }



        function get_downloads(id) {
            $.ajax({
                type: "post",
                url: "{{ url('/userdownloadhistory') }}",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { user_id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#downloadHistoryTable').html(response);
                    enhanceModalTable('downloadHistoryTable');
                    openAmModal('viewUserDownloads');
                },
            });
        }
        function get_history(id) {
            $.ajax({
                type: "post",
                url: "{{ url('/userloginhistory') }}",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { user_id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#loginHistoryTable').html(response);
                    enhanceModalTable('loginHistoryTable');
                    openAmModal('viewUser');
                },
            });
        }
        function get_notes(id) {
            document.getElementById("editcompanyid").value = id;
            $.ajax({
                type: "post",
                url: "{{ url('/usernoteshistory') }}",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { user_id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#notesHistoryTable').html(response);
                    enhanceModalTable('notesHistoryTable');
                    openAmModal('userNote');
                },
            });
        }

        function userEmailDetail(id) {
            $.ajax({
                type: "post",
                url: "{{route('user.email.details')}}",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { user_id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#userDetailEmailTable').html(response.list);
                    enhanceModalTable('userDetailEmailTable');
                    openAmModal('user-email-details');
                }
            });
        }

            function editDetails(data)
            {
                intel_phone = '';
                intel_iso_phone = '';
                $('#phone_div').empty().append(`<input type="text" id="phoneee" name="phone" class="form-control" placeholder="Phone">`);
                $('#iso_div').empty().append(`<input type="text" id="contact_isooo" name="contact_iso" class="form-control" placeholder="Iso Contact number" required>`);
                $("#view_9001").empty();
                $("#view_4001").empty();
                $("#view_45001").empty();
                $("#edit_audit_report").empty();
                $("#edit_qa_certification").empty();
                $("#downloadlink").empty();
                console.log(data);
                $("#editvalue").val(data.id);
                $("#audit_comment").val(data.audit_comment);
                $("input[name='idnumber']").val(data.idnumber);
                $("input[name='name']").val(data.name);
// 		 $("input[name='password']").val(data.password);
                $("input[name='email']").val(data.email);
                $("input[name='person_iso']").val(data.persone_iso);
                $("input[name='contact_iso']").val(data.contact_number_iso);
                $("input[name='email_iso']").val(data.emailaddress_iso);
                //$("input[name='iso_certificates']").val(data.iso_certificate);
                $('#view_iso').html('<a target="_blank" href="public/' + data.iso_certificate + '">View iso certificates</a>');
                $("input[name='expiry_date']").val(data.expiry_date);
                $("input[name='country']").val(data.country);

                $("input[name='phone']").val(data.phone);

                $("input[name='director']").val(data.director);

                $("input[name='sales_process']").val(data.sales_process);
                if (data.company_profile != null) {
                    $('#downloadlink').html('<a target="_blank" href="{{ asset('/') }}' + data.company_profile + '">View Profile</a>');
                } else {
                    $('#downloadlink').html('');
                }
                //  $("input[name='company_profile']").val(data.company_profile);

                $("input[name='company_name']").val(data.company_name);

                $("textarea[name='company_address']").val(data.company_address);
//console.log(data.company_address);
                $("input[name='purchasing_process']").val(data.purchasing_process);

                $("input[name='servicing_process']").val(data.servicing_process);

                $("input[name='competency_process']").val(data.competency_process);

                $("input[name='order_number']").val(data.order_number);

                $("textarea[name='business_scopes']").val(data.scope);
                $("input[name='last_login']").val(data.last_login);

                $("textarea[name='Company_overview']").val(data.Company_overview);

                $("input[name='iso9001_expirydate']").val(data.iso9001_expirydate);
                // $("input[name='iso9001_expirydate']").val(formattedDate);

                $("textarea[name='iso9001_description']").val(data.iso9001_description);

                $("input[name='iso14001_expirydate']").val(data.iso14001_expirydate);
                $("textarea[name='iso14001_description']").val(data.iso14001_description);

                $("input[name='iso45001_expirydate']").val(data.iso45001_expirydate);
                $("textarea[name='iso45001_description']").val(data.iso45001_description);

                if (data.profile_image) {
                    $("#output").attr("src", "{{ asset('/') }}" + data.profile_image).show();
                } else {
                    $("#output").removeAttr("src").hide();
                }


                if (data.iso9001_certificate != null) {
                    // $('#iso9001_certificate').addClass('has_file');
                    $(".iso9001").show();
                    $("#view_9001").append("<a target='_blank' href='{{ asset('/') }}" + data.iso9001_certificate + "'>View</a>");
                } else {
                    $(".iso9001").hide();
                }
                if (data.iso14001_certificate != null) {
                    // $('#iso14001_certificate').addClass('has_file');
                    $("#view_4001").append("<a target='_blank' href='{{ asset('/') }}" + data.iso14001_certificate + "'>View</a>");
                    $(".iso4001").show();
                } else {
                    $(".iso4001").hide();
                }
                if (data.iso45001_certificate != null) {
                    // $('#iso45001_certificate').addClass('has_file');
                    $("#view_45001").append("<a target='_blank' href='{{ asset('/') }}" + data.iso45001_certificate + "'>View</a>");
                    $(".iso45001").show();

                } else
                {
                    $(".iso45001").hide();
                }
                if (data.audit_report != null)
                {
                    $("#edit_audit_report").append("<a target='_blank' href='" + data.audit_report + "'>View</a>");
                    $(".audit_report").show();

                } else {
                    $(".audit_report").hide();
                }
                if (data.qa_certification != null)
                {
                    $("#edit_qa_certification").append("<a target='_blank' href='" + data.qa_certification + "'>View</a>");
                    $(".qa_certification").show();

                } else {
                    $(".qa_certification").hide();
                }


                var input = document.querySelector("#phoneee");
                if (data.phoneflag == "preferred" || data.phoneflag == null) {
                    intel_phone = window.intlTelInput(input, {
                        separateDialCode: true,
                        preferredCountries: ["us"],
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                } else {
                    intel_phone = window.intlTelInput(input,
                    {
                        separateDialCode: true,
                        initialCountry: data.phoneflag,
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                }


                var input = document.querySelector("#contact_isooo");
                if (data.iso_phone_flag == "preferred" || data.iso_phone_flag == null) {
                    intel_iso_phone = window.intlTelInput(input, {
                        separateDialCode: true,
                        preferredCountries: ["us"],
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                } else {
                    intel_iso_phone = window.intlTelInput(input, {
                        separateDialCode: true,
                        initialCountry: data.iso_phone_flag,
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                }

                openAmModal('editModal');

            }

            // // Add a submit event listener to replace the input value with the submitted data attribute
            // document.querySelector("form").addEventListener("submit", function()
            // {
            //     var input = document.getElementById("iso9001_expirydate");
            //     var submittedValue = input.getAttribute("data-submitted-value");
            //     input.value = submittedValue;
            // });
            // Add a submit event listener to replace the input value with the submitted data attribute
            document.querySelector("form").addEventListener("submit", function()
            {
                var input = document.getElementById("iso9001_expirydate");
                var submittedValue = input.getAttribute("data-submitted-value");
                input.value = submittedValue;
            });




            function viewDetails(data)
            {
                $('#view_phone_div').empty().append(`<input type="text" id="view_phoneee" class="form-control" placeholder="Phone" readonly disabled>`);
                $('#view_iso_div').empty().append(`<input type="text" id="view_contact_isooo" class="form-control" placeholder="Iso Contact number" required  readonly disabled>`);


                $("#v_9001").empty();
                $("#v_4001").empty();
                $("#v_45001").empty();
                $("#v_audit_report").empty();
                $("#v_qa_certification").empty();
                $("#downloadlink").empty();
                $("#editvalue").val(data.id);
                $("input[name='idnumber']").val(data.idnumber);
                $("input[name='name']").val(data.name);

                $("input[name='email']").val(data.email);
                $("input[name='person_iso']").val(data.persone_iso);
                // 		 $("#contact_iso_view").val(data.iso_phone_code + data.contact_number_iso);
                $("#view_contact_isooo").val(data.contact_number_iso);
                $("input[name='email_iso']").val(data.emailaddress_iso);
                //$("input[name='iso_certificates']").val(data.iso_certificate);
                $('#view_iso').html('<a target="_blank" href="public/' + data.iso_certificate + '">View iso certificates</a>');

                $("input[name='expiry_date']").val(data.expiry_date);
                $("input[name='country']").val(data.country);

                // $("#phoneview").val(data.phonecode + data.phone);
                $("#view_phoneee").val(data.phone);

                $("input[name='director']").val(data.director);

                $("input[name='sales_process']").val(data.sales_process);

                if (data.company_profile != null) {
                    $('#view_company_profile').show().attr('href', '{{ asset('/') }}' + data.company_profile);
                } else {
                    $('#view_company_profile').hide();
                }
                //  $("input[name='company_profile']").val(data.company_profile);

                $("input[name='company_name']").val(data.company_name);

                $("textarea[name='company_address']").val(data.company_address);
                $("input[name='purchasing_process']").val(data.purchasing_process);

                $("input[name='servicing_process']").val(data.servicing_process);

                $("input[name='competency_process']").val(data.competency_process);

                $("input[name='order_number']").val(data.order_number);

                $("textarea[name='business_scopes']").val(data.scope);

                $("textarea[name='Company_overview']").val(data.Company_overview);
                $("textarea[name='audit_comment']").val(data.audit_comment);

                $("input[name='iso9001_expirydate']").val(data.iso9001_expirydate);
                $("textarea[name='iso9001_description']").val(data.iso9001_description);

                $("input[name='iso14001_expirydate']").val(data.iso14001_expirydate);
                $("textarea[name='iso14001_description']").val(data.iso14001_description);

                $("input[name='iso45001_expirydate']").val(data.iso45001_expirydate);
                $("textarea[name='iso45001_description']").val(data.iso45001_description);

                if (data.profile_image) {
                    $("#view_output").attr("src", "{{ asset('/') }}" + data.profile_image).show();
                } else {
                    $("#view_output").removeAttr("src").hide();
                }



                if (data.iso9001_certificate != null) {
                    $("#v_9001").append("<a target='_blank' href='{{ asset('/') }}" + data.iso9001_certificate + "'>View</a>");
                } else {
                    $('#v_9001').append('Not Found');
                }
                if (data.iso14001_certificate != null) {
                    $("#v_4001").append("<a target='_blank' href='{{ asset('/') }}" + data.iso14001_certificate + "'>View</a>");
                } else {
                    $('#v_4001').append('Not Found');
                }
                if (data.iso45001_certificate != null) {
                    $("#v_45001").append("<a target='_blank' href='{{ asset('/') }}" + data.iso45001_certificate + "'>View</a>");
                } else {
                    $('#v_45001').append('Not Found');
                }

                if (data.qa_certification != null) {
                    $("#v_qa_certification").append("<a target='_blank' href='" + data.audit_report + "'>View</a>");
                } else
                if (data.qa_certification != null) {
                    $("#v_qa_certification").append("<a target='_blank' href='" + data.audit_report + "'>View</a>");
                } else {
                    $('#v_qa_certification').append('Not Found');
                }

                var input = document.querySelector("#view_phoneee");
                if (data.phoneflag == "preferred" || data.phoneflag == null) {
                    window.intlTelInput(input,
                    {
                        separateDialCode: true,
                        preferredCountries: ["us"],
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                } else {
                    window.intlTelInput(input,
                    {
                        separateDialCode: true,
                        initialCountry: data.phoneflag,
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                }

                var input = document.querySelector("#view_contact_isooo");

                if (data.iso_phone_flag == "preferred" || data.iso_phone_flag == null) {
                    window.intlTelInput(input, {
                        separateDialCode: true,
                        preferredCountries: ["us"],
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                } else {
                    window.intlTelInput(input, {
                        separateDialCode: true,
                        initialCountry: data.iso_phone_flag,
                        customPlaceholder: function (
                            selectedCountryPlaceholder,
                            selectedCountryData
                        ) {
                            return "e.g. " + selectedCountryPlaceholder;
                        },
                    });
                }

                $("#viewModal").modal('show');

            }



        </script>


        @section('myscript')
            <script>

                $('.delete-certificate').on('click', function () {

                    let _this = $(this),
                    user_id = $('#editvalue').val();
                    _this.closest('.form-group.row').find('.form-control').val('');
                    _this.closest('.form-group.row').find('a').remove();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        }
                    });

                    let AjaxUrl = "{{ url('/remove_iso')}}";
                    $.ajax({
                        url: AjaxUrl,
                        type: "Post",
                        //dataType: "json",
                        //async: false,
                        data: {'handle': _this.data('handle'), 'user_id': user_id}
                    }).done(function (response) {
                        console.log(response);
                    });
                });
                $('.delete-qa_certification').on('click', function () {

                    let _this = $(this),
                    user_id = $('#editvalue').val();
                    _this.closest('.form-group.row').find('.form-control').val('');
                    _this.closest('.form-group.row').find('a').remove();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        }
                    });

                    let AjaxUrl = "{{ url('/remove_qa_iso')}}";
                    $.ajax({
                        url: AjaxUrl,
                        type: "Post",
                        //dataType: "json",
                        //async: false,
                        data: {'handle': _this.data('handle'), 'user_id': user_id}
                    }).done(function (response) {
                        console.log(response);
                    });
                });


                $("#addform").submit(function () {
                    let intel_phone_data = intel_phone.getSelectedCountryData();
                    let intel_iso_phone_data = intel_iso_phone.getSelectedCountryData();

                    //For flags
                    $("#phonecode").val(intel_phone_data.dialCode);
                    $("#isophonecode").val(intel_iso_phone_data.dialCode);

                    //For country code
                    $("#phoneflag").val(intel_phone_data.iso2);
                    $("#isophoneflag").val(intel_iso_phone_data.iso2);


                    // var i = 1;
                    // var j = 1;
                    // $('.iti__selected-dial-code').each(function () {
                    //     if (i == 1) {
                    //         var code = $(this).text();
                    //         $("#phonecode").val(code);

                    //     } else {
                    //         var code = $(this).text();
                    //         $("#isophonecode").val(code);

                    //     }
                    //     i++;
                    // });

                    //iti__flag iti__pk


                    // $(".iti__selected-flag").each(function () {
                    //     // let flag = $(this).attr('aria-activedescendant');
                    //     // console.log('flag',flag);
                    //     if (j == 1) {
                    //         var str = $(this).attr('aria-activedescendant');
                    //         var n = str.lastIndexOf('-');
                    //         var result = str.substring(n + 1);
                    //         console.log("phoneflag is" + result);
                    //         $("#phoneflag").val(result);
                    //     } else {
                    //         var str = $(this).attr('aria-activedescendant');
                    //         var n = str.lastIndexOf('-');
                    //         var result = str.substring(n + 1);
                    //         console.log("isophoneflag is" + result);
                    //         $("#isophoneflag").val(result);
                    //     }
                    //     j++;
                    // });

                });
            </script>
        @endsection
        <script>

            var loadFile = function (event) {

                var image = document.getElementById('output');

                image.src = URL.createObjectURL(event.target.files[0]);

            };

            var viewloadFile = function (event) {

                var image = document.getElementById('view_output');

                image.src = URL.createObjectURL(event.target.files[0]);

            };

            // document.getElementById('showusers').addEventListener('change', function() {
            //     document.getElementById('showuserform').submit();
            // });

            $(document).ready(function() {
                $('#showusers').on('change', function() {
                    $('#showuserform').submit();
                });

            });
        </script>


<script>


$('#addusernotform').submit(function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('company_id', $('#editcompanyid').val());
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    const noteId = $('#note_id').val();
    const isEdit = noteId !== '';

    // If editing, override the URL and method
    let actionUrl = isEdit ? `/updateusernote/${noteId}` : $(this).attr('action');

    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.success) {
                $('#add_note').val('');
                $('#note_file').val('');
                $('#note_id').val('');
                $('#_method').val('POST');
                $('#addusernotform').attr('action', '{{ route("addusernote") }}');
                get_notes($('#editcompanyid').val());
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});



function editNote(noteId, noteText) {
    $('#add_note').val(noteText);
    $('#note_id').val(noteId);
    $('#_method').val('PUT');
    $('#addusernotform').attr('action', '/updateusernote/' + noteId);
    $('#userNote').modal('show');
}

function deleteNote(id) {
    if (confirm('Are you sure you want to delete this note?')) {
        $.ajax({
            url: '/deleteusernote/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#note-row-' + id).remove();
                } else {
                    alert('Error deleting note.');
                }
            }
        });
    }
}

$('#drop-area').on('dragover', function(e) {
    e.preventDefault();
    $(this).css('background', '#eee');
});

$('#drop-area').on('dragleave', function(e) {
    e.preventDefault();
    $(this).css('background', '');
});

$('#drop-area').on('drop', function(e) {
    e.preventDefault();
    $(this).css('background', '');
    let files = e.originalEvent.dataTransfer.files;
    if (files.length > 0) {
        $('#note_file')[0].files = files;
    }
});


// AJAX-based search + pagination (no page refresh).
(function() {
    var input     = document.getElementById('amUsersSearch');
    var form      = document.getElementById('amUsersSearchForm');
    var container = document.getElementById('amUsersContainer');
    if (!container) return;

    var baseUrl   = form ? form.getAttribute('action') : window.location.pathname;
    var currentPage = 1;

    function debounce(fn, wait) {
        var t;
        return function() {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function(){ fn.apply(ctx, args); }, wait);
        };
    }

    function showLoading() {
        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';
    }
    function hideLoading() {
        container.style.opacity = '';
        container.style.pointerEvents = '';
    }

    function fetchPage(page) {
        var q = input ? input.value.trim() : '';
        var url = baseUrl + '?q=' + encodeURIComponent(q) + '&page=' + page;
        showLoading();
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r){ return r.text(); })
            .then(function(html) {
                container.innerHTML = html;
                currentPage = page;
                var newUrl = baseUrl + (q ? '?q=' + encodeURIComponent(q) : '') + (page > 1 ? (q ? '&' : '?') + 'page=' + page : '');
                window.history.replaceState({}, '', newUrl);
                hideLoading();
            })
            .catch(function() { hideLoading(); });
    }

    // Debounced search
    if (input) {
        input.addEventListener('input', debounce(function() {
            currentPage = 1;
            fetchPage(1);
        }, 350));
    }
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            currentPage = 1;
            fetchPage(1);
        });
    }

    // Delegated click handler for pagination buttons (they re-render on each fetch, so delegation is required)
    container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
})();
</script>


@endsection
