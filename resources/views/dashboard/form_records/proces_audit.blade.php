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
                        <th>Question: <i>Process being audited</i></th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->processAudit }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: <i>Auditor</i></th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->auditor }}</td>
                    </tr>
                    <tr>
                        <th>Question: <i> Audit Date (DD/MM/YYYY) </i> </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ date('d/m/Y', strtotime($auditdata->auditDate)) }}</td>
                    </tr>
                </table>

                <table>
                      <tr>
                        <th>Question: <i> Number of Non-Conformities: </i> </th>
                      </tr>
                      <tr>
                        <td>Answer: {{ $auditdata->nonConformities }}</td>
                      </tr>
                    <tr>
                        <th>Question: <i> Number of Observations: </i> </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->Observations }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: <i> Non-Conformance Report Reference (if applicable): </i> </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->nonConfReport }}</td>
                    </tr>
                    <tr>
                        <th>Question: <i> Audit Actions: </i> </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->AdutiActions }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: <i> Audit Frequency (Months): </i> </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->dateFrequency }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:1 <i> Is this process included in the Quality Manual or Work Instructions and is it still relevant? </i> </th>
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
                        <th>Question No:2 <i> Is this process being implemented as detailed in documented information? </i> </th>
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
                        <th>Question No:3 <i> Are all relevant personnel trained in this process and are records complete? </i> </th>
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
                        <th>Question No:4 <i> Are key performance indicator information being monitored for this process? </i> </th>
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
                        <th>Question No:5 <i> Have appropriate targets and objectives been set for this process at Management Review? </i> </th>
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
                        <th>Question No:6 <i> Have previous targets and objectives been reviewed for this process? </i> </th>
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
                        <th>Question No:7  <i> Are all supporting procedures and work instructions used and at the correct revision? </i> </th>
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
                        <th>Question No:8 <i> Are all equipment calibrated, up-to-date and recorded? </i> </th>
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
                        <th>Question No:9 <i> Is the job paperwork satisfactory? Record the job details for this process here. </i></th>
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
                        <th>Question: <i>Attach Evidence </i> </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->attach_evidence }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: <i> Any other issues or points to note? </i> </th>
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
