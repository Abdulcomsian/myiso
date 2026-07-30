@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Welcome, {{Auth::user()->name}}</h2>
            <p>Your ISO management portal</p>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- Quick Links --}}
    <h6 class="dash-section-title">Quick Links</h6>
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
    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Requirements Due</h6>
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
    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">Calibration Due</h6>
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
    <div class="am-card">
        <div class="am-card__body">
            <h6 class="dash-section-title">ISO Certificates</h6>
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

    {{-- Audit Report & Related Documents --}}
    <div class="am-card">
        <div class="am-card__body">
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
<div class="modal fade" id="calibrationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Deleting Calibration Due</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this entry?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('deletecaliberinfo')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="req_id2" value=""/>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Requirement Modal --}}
<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:var(--am-primary);color:#fff;">
                <h5 class="modal-title">Deleting Requirements Due</h5>
                <button type="button" class="close" style="color:#fff;" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
                <form action="{{route('deleteRequirementadmin')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="req_id" value=""/>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete Requirement</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('myscript')
<script>
    $(".delete_requirement").click(function () {
        $id = $(this).attr('data-id');
        $("#req_id").val($id);
        $("#myModal").modal('show');
    })
    $(".calibrationModal").click(function () {
        $id = $(this).attr('data-id');
        $("#req_id2").val($id);
        $("#calibrationModal").modal('show');
    })
</script>
@endsection
