@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Process Audit Report</h2>
            <p>Review all process audit submissions.</p>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible">{{ session('message') }}</div>
    @endif

    @if($process_audit->isEmpty())
        <div class="am-card">
            <div class="am-empty">
                <i class="fa fa-database"></i>
                <p>No audit data available.</p>
            </div>
        </div>
    @else
        @foreach($process_audit as $auditdata)
        <div class="am-card" style="margin-bottom:24px;">
            <div class="am-card__body">

                <h6 class="dash-section-title">Audit Overview</h6>
                <div class="am-table-wrap">
                    <table class="am-table">
                        <tbody>
                            <tr>
                                <th style="width:40%;">Process being audited</th>
                                <td>{{ $auditdata->processAudit }}</td>
                            </tr>
                            <tr>
                                <th>Auditor</th>
                                <td>{{ $auditdata->auditor }}</td>
                            </tr>
                            <tr>
                                <th>Audit Date (DD/MM/YYYY)</th>
                                <td>{{ date('d/m/Y', strtotime($auditdata->auditDate)) }}</td>
                            </tr>
                            <tr>
                                <th>Number of Non-Conformities</th>
                                <td>{{ $auditdata->nonConformities }}</td>
                            </tr>
                            <tr>
                                <th>Number of Observations</th>
                                <td>{{ $auditdata->Observations }}</td>
                            </tr>
                            <tr>
                                <th>Non-Conformance Report Reference (if applicable)</th>
                                <td>{{ $auditdata->nonConfReport }}</td>
                            </tr>
                            <tr>
                                <th>Audit Actions</th>
                                <td>{{ $auditdata->AdutiActions }}</td>
                            </tr>
                            <tr>
                                <th>Audit Frequency (Months)</th>
                                <td>{{ $auditdata->dateFrequency }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="dash-section-title" style="margin-top:20px;">Audit Questions</h6>
                <div class="am-table-wrap">
                    <table class="am-table">
                        <thead>
                            <tr>
                                <th style="width:5%;">Q#</th>
                                <th style="width:50%;">Question</th>
                                <th>Answer</th>
                                <th>Evidence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Is this process included in the Quality Manual or Work Instructions and is it still relevant?</td>
                                <td>{{ $auditdata->qmsCorects }}</td>
                                <td>{{ $auditdata->evidence }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Is this process being implemented as detailed in documented information?</td>
                                <td>{{ $auditdata->needExpactations }}</td>
                                <td>{{ $auditdata->evidance2 }}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Are all relevant personnel trained in this process and are records complete?</td>
                                <td>{{ $auditdata->correction3 }}</td>
                                <td>{{ $auditdata->evidence3 }}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Are key performance indicator information being monitored for this process?</td>
                                <td>{{ $auditdata->correction4 }}</td>
                                <td>{{ $auditdata->evidance4 }}</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Have appropriate targets and objectives been set for this process at Management Review?</td>
                                <td>{{ $auditdata->correction5 }}</td>
                                <td>{{ $auditdata->evidence5 }}</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Have previous targets and objectives been reviewed for this process?</td>
                                <td>{{ $auditdata->correction6 }}</td>
                                <td>{{ $auditdata->evidance7 }}</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Are all supporting procedures and work instructions used and at the correct revision?</td>
                                <td>{{ $auditdata->correction7 }}</td>
                                <td>{{ $auditdata->evidance8 }}</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Are all equipment calibrated, up-to-date and recorded?</td>
                                <td>{{ $auditdata->correction9 }}</td>
                                <td>{{ $auditdata->evidance9 }}</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Is the job paperwork satisfactory? Record the job details for this process here.</td>
                                <td>{{ $auditdata->correction10 }}</td>
                                <td>{{ $auditdata->evidance10 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="dash-section-title" style="margin-top:20px;">Additional Information</h6>
                <div class="am-table-wrap">
                    <table class="am-table">
                        <tbody>
                            <tr>
                                <th style="width:40%;">Attach Evidence</th>
                                <td>{{ $auditdata->attach_evidence }}</td>
                            </tr>
                            <tr>
                                <th>Any other issues or points to note?</th>
                                <td>{{ $auditdata->any_issues }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @endforeach
    @endif

</div>
@endsection
