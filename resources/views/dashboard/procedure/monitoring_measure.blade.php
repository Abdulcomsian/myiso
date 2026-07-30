@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>P4 - Monitoring and Measuring Equipment</h2>
            <p>Equipment calibration and maintenance procedure</p>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body" style="padding:32px; line-height:1.8;">
            <h4>1. Purpose and scope</h4>
            <p>This procedure ensures that equipment used to measure, monitor or control operating parameters is maintained and calibrated to preserve its efficiency and accuracy.</p>

            <h4 class="mt-4">2. Responsibility</h4>
            <p>The Director is responsible for defining measuring and monitoring equipment which needs to be maintained or calibrated and ensuring that action is taken at the correct time. The results of calibration are assessed and appropriate action taken if equipment has fallen out of calibration. Records are kept using this record.</p>

            <h4 class="mt-4">3. Equipment to be calibrated or maintained</h4>
            <p>Each piece of equipment which requires calibration or regular maintenance shall be uniquely identified.</p>

            <h4 class="mt-4">4. Calibration</h4>
            <h5 class="mt-3">4.1 Records</h5>
            <p>Each piece of equipment shall be entered onto the record form, which will also act as a recall system.</p>

            <h5 class="mt-3">4.2 Methods of calibration</h5>
            <p>Unless the equipment is marked 'For indication purposes only' all calibrations shall be traceable to nationally recognised standards. If this is not possible, the basis of the method of calibration shall be stated.</p>
            <p>When appropriate or necessary, an approved external calibration service may be used. This can be the original manufacturer or his agent, or a NAMAS/UKAS or ISO 9001 approved test house.</p>
            <p>Calibration shall be carried out in suitable working environment conditions.</p>

            <h5 class="mt-3">4.3 Results of calibration</h5>
            <p>The results of calibration shall be compared with the tolerance. When calibration is carried out by a subcontractor, the results shall be reviewed and, if acceptable, the certificate shall be initialled and dated. If calibration is satisfactory, the Calibration Record shall be annotated 'OK'.</p>

            <h4 class="mt-4">5. Calibration failure</h4>
            <p>If a piece of equipment falls out of tolerance, it shall be withdrawn from use and repaired and re-calibrated, or be withdrawn permanently and replaced.
            The validity of measurements taken prior to the failure shall be reviewed and a decision taken whether any retrospective action needs to be taken.</p>

            <h4 class="mt-4">6. Retest dates</h4>
            <p>Ideally, when equipment has been calibrated it should be labelled to show the next retest date.
            Retest dates shall also be shown on the schedule as part of the computer based recall program.</p>

            <h4 class="mt-4">7. Test software</h4>
            <p>Software used for measuring and monitoring shall be validated prior to use.</p>
        </div>
    </div>

</div>
@endsection
