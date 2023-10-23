<!DOCTYPE html>
<html>
<head>
    <title>Process Audit Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        .container 
        {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Process Audit Report</h1>

    @if($process_audit->isEmpty())
        <p>No audit data available.</p>
    @else
        @foreach($process_audit as $auditdata)
            <div class="container">
                <table>
                    <tr>
                        <th>Question: Process being audited</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->processAudit }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: Auditor</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->auditor }}</td>
                    </tr>
                    <tr>
                        <th>Question: Audit Date (DD/MM/YYYY)</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ date('d/m/Y', strtotime($auditdata->auditDate)) }}</td>
                    </tr>
                </table>

                <table>
                      <tr>
                        <th>Question: Number of Non-Conformities:</th>
                      </tr>
                      <tr>
                        <td>Answer: {{ $auditdata->nonConformities }}</td>
                      </tr>
                    <tr>
                        <th>Question: Number of Observations:</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->Observations }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: Non-Conformance Report Reference (if applicable):</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->nonConfReport }}</td>
                    </tr>
                    <tr>
                        <th>Question: Audit Actions:</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->AdutiActions }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: Audit Frequency (Months):</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->dateFrequency }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:1 Is this process included in the Quality Manual or Work Instructions and is it still relevant?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->qmsCorects }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:2 Is this process being implemented as detailed in documented information?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->needExpactations }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance2 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:3 Are all relevant personnel trained in this process and are records complete?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction3 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence3 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:4 Are key performance indicator information being monitored for this process?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction4 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance4 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:5 Have appropriate targets and objectives been set for this process at Management Review?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction5 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence5 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:6 Have previous targets and objectives been reviewed for this process?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction6 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence:{{ $auditdata->evidance7 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:7 Are all supporting procedures and work instructions used and at the correct revision?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction7 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance8 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:8 Are all equipment calibrated, up-to-date and recorded?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction9 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance9 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:9 Is the job paperwork satisfactory? Record the job details for this process here.</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction10 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance10 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: Attach Evidence</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->attach_evidence }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: Any other issues or points to note?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->any_issues }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    @endif
</body>
</html>
