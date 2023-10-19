<!DOCTYPE html>
<html>
<head>
    <title>QMS Audit Report</title>
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
    <h1>QMS Audit Report</h1>
        @forelse($qmsaudit as $auditdata)
            <div class="container">
                <table>
                    <tr>
                        <th>Question No:4.1 Understanding the organization and its context. Is this correct?</th>
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
                        <th>Question No:4.2 Understanding the needs and expectations of interested parties. Is this still correct?</th>
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
                        <th>Question No:4.3 Determining the scope of the quality management system. Is this still correct?</th>
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
                        <th>Question No:4.4 Quality management system and its processes. Are processes owned, relevant and show interaction?</th>
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
                        <th>Question No:5.1 Leadership and commitment. Is top level management accountable for the quality system and is it customer focused?</th>
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
                        <th>Question No:5.2 Policy. Is the quality policy established and accurate, reviewed and communicated?</th>
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
                        <th>Question No:5.3 Organizational roles, responsibilities and authorities. Are these assigned and communicated?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction7 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance7 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:6.1 Actions to address risks and opportunities. Are risks and opportunities managed, understood and reviewed?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction8 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance8 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:6.2 Quality objectives and planning to achieve them. Are objectives set at Management Review and monitored?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction9 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance10 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:6.3 Planning of changes. Have any changes occurred been planned to meet section 6.3 of the standard?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction11 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance12 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:7.1 Resources. Are there sufficient resources available? Considering people, infrastructure, process-operating environment, resource monitoring and measurement, and organizational knowledge.</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction12 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence13 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:7.2 Competence. Are the training records being updated?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction13 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidance14 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:7.3 Awareness. Does employee awareness comply with standard's section 7.3? </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction14 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence17 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:7.4 Communication. Does communication comply with standard’s section 7.4? </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction15 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence15 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:7.5 Documented information. is all documentation related to the quality system being regulated as mentioned in P1? </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction16 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence17 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:8.1 Planning and managing operations. Is the control system up to date and functional?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correciton17 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence18 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:8.2 Requirements for products and services. Are customer communications successful, and has expectations for goods and services been established, examined, and recorded?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction18 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence19 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:8.3 Design and development of products and services. Are the requirements of this standard met?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction19 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence20 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:8.4 Control over procedures, goods, and services that are delivered by third parties. Are the external processes, products and services being regulated?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction20 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence21 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:8.5 Production and service provision. Production and service delivery, including after-delivery operations, are they under control?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction21 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence22 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:8.6 Release of products and services. Are products and services completed and checked before release to the customer?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction22 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence23 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:8.7 Control of nonconforming outputs. Does the records being updated?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction23 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence24 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:9.1 Monitoring, measurement, analysis and evaluation, including section 9.1.3. Monitoring, measurement, analysis, and evaluation are carried out and recorded?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction24 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence25 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:9.1.2 Customer satisfaction. Have customer satisfaction surveys been completed? </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction25 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence26 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:9.2 Internal audit. Are regular internal audits planned and completed? </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction26 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence27 }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question No:9.3 Management review. Has the management review been planned and completed? </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction27 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence28 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:10.1 Improvement - Has the organization identified and prioritized areas for improvement and taken any necessary steps to meet customer expectations and improve client satisfaction?  </th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction28 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence29 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:10.2 Nonconformity and corrective action - Are these Properly documented?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction30 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence30 }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question No:10.3 Continual improvement - Is there proof that the company has been continuously improving?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->correction29 }}</td>
                    </tr>
                    <tr>
                        <td>Evidence: {{ $auditdata->evidence31 }}</td>
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
                        <th>Question: Audit Comments and Actions:</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->audit_comments_actions }}</td>
                    </tr>
                </table>


                <table>
                    <tr>
                        <th>Question: Date Completed (DD/MM/YYYY)</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ date('d/m/Y', strtotime($auditdata->competedDate)) }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Question: Auditor Name</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->auditrName }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Any other issues or points to note?</th>
                    </tr>
                    <tr>
                        <td>Answer: {{ $auditdata->any_issues }}</td>
                    </tr>
                </table>

            </div>
        @empty 
            <h3>No Audit Data Available</h3>
        @endforelse
</body>
</html>
