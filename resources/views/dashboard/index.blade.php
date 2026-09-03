@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Welcome, {{Auth::user()->name}}</h2>
            <p>Your ISO management portal</p>
        </div>
    </div>

    @if (!empty($showInactivityAlert) && $showInactivityAlert)
    {{-- Inactivity Warning Modal (only shows when previous last_login was 90+ days ago) --}}
    <div id="inactivityAlertOverlay" style="position:fixed;inset:0;background:rgba(20,26,55,0.55);z-index:9999;display:flex;align-items:center;justify-content:center;padding:16px;">
        <div style="background:#fff;border-radius:14px;max-width:520px;width:100%;padding:28px 26px;box-shadow:0 20px 50px rgba(0,0,0,0.35);position:relative;">
            <div style="display:flex;gap:14px;align-items:flex-start;margin-bottom:14px;">
                <span style="width:44px;height:44px;flex-shrink:0;border-radius:50%;background:#fff3cd;color:#b7791f;display:inline-flex;align-items:center;justify-content:center;font-size:20px;">
                    <i class="fa fa-exclamation-triangle"></i>
                </span>
                <div>
                    <h4 style="margin:0 0 4px 0;font-size:17px;font-weight:600;color:#141a37;">System Review Overdue</h4>
                    <p style="margin:0;font-size:13px;color:#6b7391;">You haven't reviewed your documentation in a while</p>
                </div>
            </div>
            <p style="font-size:14px;color:#141a37;line-height:1.6;margin:14px 0 20px 0;">
                It's been 90 days since your documentation system was reviewed. An unmaintained system risks audit failure and certification suspension or revocation. Please review and update your records.
            </p>
            <div style="text-align:right;">
                <button type="button" onclick="document.getElementById('inactivityAlertOverlay').style.display='none';"
                    style="background:#7a97d9;color:#fff;border:none;padding:9px 20px;border-radius:6px;font-size:14px;cursor:pointer;font-weight:500;">
                    OK, I'll review
                </button>
            </div>
        </div>
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- Quick Links --}}
    {{-- <h6 class="dash-section-title">Quick Links</h6> --}}
    <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem;">
        <a href="{{url('quality_manual')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-book"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Main Procedures &amp; Forms</div>
            </div>
        </a>
        <a href="{{url('sale_processes')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-cogs"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Processes</div>
            </div>
        </a>
        <a href="{{url('documented_information')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-file-text"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Procedures</div>
            </div>
        </a>
        <a href="{{url('requirements_aspect')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-clipboard"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Forms &amp; Records</div>
            </div>
        </a>
        <a href="{{url('work_instruction')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-list-ol"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Local Work Instructions</div>
            </div>
        </a>
    </div>

    {{-- Requirements Due --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Requirements Due
                </span>
            </div>
            @php
                $requirement=App\requirement::where('user_id',Auth::user()->id)->get();
            @endphp
            @if($requirement->isEmpty())
            <div class="am-empty">
                <i class="fa fa-database"></i>
                <p>No requirements due.</p>
            </div>
            @else
            <div class="am-table-wrap">
                <table class="am-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Requirements</th>
                            <th>Date Completed</th>
                            <th>Periodicity (Months)</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        @foreach ($requirement as $data)
                            <?php $counter++; ?>
                            <tr>
                                <td>{{ $counter}}</td>
                                <td>{{ $data->requirment_title}}</td>
                                @php $d = strtotime($data->completion_date); @endphp
                                <td>{{date("d/m/Y", $d) }}</td>
                                <td>{{ $data->periods }}</td>
                                @php $d = strtotime("+$data->periods months",strtotime($data->completion_date)); @endphp
                                <td>{{ date("d/m/Y",$d)}}</td>
                                <td>
                                    <a href="#" data-id="{{$data->id}}" class="delete_requirement am-btn am-btn-sm am-btn-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- Calibration Due --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Calibration Due
                </span>
            </div>
            @php
                $calibration=App\calibration::where('user_id',Auth::user()->id)->get();
            @endphp
            @if($calibration->isEmpty())
            <div class="am-empty">
                <i class="fa fa-database"></i>
                <p>No calibration records due.</p>
            </div>
            @else
            <div class="am-table-wrap">
                <table class="am-table">
                    <thead>
                        <tr>
                            <th>Equipment ID</th>
                            <th>Equipment Name</th>
                            <th>Serial Number</th>
                            <th>Date Calibrated</th>
                            <th>Frequency</th>
                            <th>Date Due</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; ?>
                        @foreach ($calibration as $data)
                        <?php $counter++; ?>
                        <tr>
                            <td>{{ $counter}}</td>
                            <td>{{$data->equipment}}</td>
                            <td>{{$data->serialNum}}</td>
                            <td>{{date('d/m/Y', strtotime($data->calibratedDate))}}</td>
                            <td>{{$data->freq}}</td>
                            @php $d = strtotime("+$data->freq months",strtotime($data->calibratedDate)); @endphp
                            <td>{{ date("d/m/Y", $d) }}</td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" data-id="{{$data->id}}" class="calibrationModal am-btn am-btn-sm am-btn-danger" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- ISO Certificates --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    ISO Certificates
                </span>
            </div>
            @php
                $hasCert = $user['iso9001_certificate'] || $user['iso14001_certificate'] || $user['iso45001_certificate'];
            @endphp
            @if(!$hasCert)
            <div class="am-empty">
                <i class="fa fa-certificate"></i>
                <p>No certificates uploaded.</p>
            </div>
            @else
            <div class="am-table-wrap">
                <table class="am-table">
                    <thead>
                        <tr>
                            <th>Certificate</th>
                            <th>Link</th>
                            <th>Description</th>
                            <th>Expiry</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($user['iso9001_certificate'])
                        <tr>
                            <th>ISO9001</th>
                            <td>
                                <a href="{{ asset($user['iso9001_certificate']) }}" target="_blank">
                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                </a>
                            </td>
                            <td>{{ $user['iso9001_description'] }}</td>
                            <td>{{ date("d/m/Y", strtotime($user['iso9001_expirydate'])) }}</td>
                        </tr>
                        @endif
                        @if($user['iso14001_certificate'])
                        <tr>
                            <th>ISO14001</th>
                            <td>
                                <a href="{{ asset($user['iso14001_certificate']) }}" target="_blank">
                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                </a>
                            </td>
                            <td>{{ $user['iso14001_description'] }}</td>
                            <td>{{ date("d/m/Y", strtotime($user['iso14001_expirydate'])) }}</td>
                        </tr>
                        @endif
                        @if($user['iso45001_certificate'])
                        <tr>
                            <th>ISO45001</th>
                            <td>
                                <a href="{{ asset($user['iso45001_certificate']) }}" target="_blank">
                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                </a>
                            </td>
                            <td>{{ $user['iso45001_description'] }}</td>
                            <td>{{ date("d/m/Y", strtotime($user['iso45001_expirydate'])) }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- Supporting Documents --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Supporting Documents
                </span>
            </div>
            <h6 class="dash-section-title">Audit Report</h6>
            <div style="margin-bottom:.75rem;">
                @if(!empty($user['audit_report']))
                <a href="{{ asset($user['audit_report']) }}" target="_blank" style="margin-right:.5rem; color:var(--am-primary);">
                    Click to view audit report
                </a>
                <a href="{{ asset($user['audit_report']) }}" target="_blank">
                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                </a>
                @else
                <p style="color:#888;">No audit report available.</p>
                @endif
            </div>

            <h6 class="dash-section-title">Auditor Comments</h6>
            <div style="margin-bottom:.75rem;">
                @if(!empty($user['audit_comment']))
                    {{$user['audit_comment']}}
                @else
                    <p style="color:#888;">No comments.</p>
                @endif
            </div>

            <h6 class="dash-section-title">Remote Audit Overview</h6>
            <div style="margin-bottom:.75rem;">
                <a href="/uploads/user/pdfs/Remote-Audit-Overview.pdf" target="_blank" style="color:var(--am-primary); margin-right:.5rem;">
                    View Remote Audit Overview
                </a>
                <a href="/uploads/user/pdfs/Remote-Audit-Overview.pdf" target="_blank">
                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                </a>
            </div>

            <h6 class="dash-section-title">Use Of Certificate &amp; Certification Marks</h6>
            <div style="margin-bottom:.75rem;">
                <a href="/uploads/user/pdfs/Use-Of-Certificate-and-Certification-Marks.pdf" target="_blank" style="color:var(--am-primary); margin-right:.5rem;">
                    View Certification Marks Guide
                </a>
                <a href="/uploads/user/pdfs/Use-Of-Certificate-and-Certification-Marks.pdf" target="_blank">
                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                </a>
            </div>

            @if(!empty($user['qa_certification']))
            <h6 class="dash-section-title">QA Certification Agreement</h6>
            <div style="margin-bottom:.75rem;">
                <a href="{{ asset($user['qa_certification']) }}" target="_blank" style="color:var(--am-primary); margin-right:.5rem;">
                    View QA Certification Agreement
                </a>
                <a href="{{ asset($user['qa_certification']) }}" target="_blank">
                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                </a>
            </div>
            @endif
        </div>
    </div>

</div>

{{-- Delete Calibration Modal --}}
<div class="am-modal" id="calibrationModal" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete Calibration Entry?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete this calibration record. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{route('deletecaliberinfo')}}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="req_id2" value=""/>
                <button type="submit" class="am-btn am-btn-lightblue">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Requirement Modal --}}
<div class="am-modal" id="myModal" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete Requirement?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete this requirement. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{route('deleteRequirementadmin')}}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="req_id" value=""/>
                <button type="submit" class="am-btn am-btn-lightblue">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('myscript')
<script>
    // Open modals
    document.querySelectorAll('.delete_requirement').forEach(function(el){
        el.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('req_id').value = this.getAttribute('data-id');
            document.getElementById('myModal').classList.add('open');
        });
    });
    document.querySelectorAll('.calibrationModal').forEach(function(el){
        el.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('req_id2').value = this.getAttribute('data-id');
            document.getElementById('calibrationModal').classList.add('open');
        });
    });

    // Close modal on Cancel / overlay click / Escape
    document.addEventListener('click', function(e) {
        var close = e.target.closest('.am-modal-close');
        if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
        if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
    });
</script>
@endsection
