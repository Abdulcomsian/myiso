@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Quality Manual</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="procedure_div">
					<h4>Scope</h4>
					<p>This Quality Manual defines the Quality Management System (QMS) applicable to the activities performed by Signum Intelligence Ltd, in accordance with the requirements of ISO 9001:2015.</p>
					<h4 class="m-t-20">Normative References</h4>
					<div class="list_div">
						<div class="list_number">
							<p>2.1 -</p>
							<p>2.1.1 -</p>
							<p>2.1.2 -</p>
							<p>2.1.3 -</p>
						</div>
						<div class="list_content">
							<p>This document references the following:</p>
							<p>Procedures</p>
							<p>Processes</p>
							<p>Forms and records</p>
						</div>
					</div>
					<h4 class="m-t-20">Terms and Definitions</h4>
					<div class="list_div">
						<div class="list_number">
							<p>3.1 -</p>
						</div>
						<div class="list_content">
							<p>Follow the terms and conditions detailed in the standard ISO9001: 2015.</p>
						</div>
					</div>
					<h4 class="m-t-20">Context of the Organisation</h4>
					<div class="list_div">
						<div class="list_number">
							<p>4.1 -</p>
						</div>
						<div class="list_content">
							<p>Understanding the organisation and its context.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.1.1 -</p>
						</div>
						<div class="list_content">
							<p>This Manual presents policy and procedural requirements for the quality management system of Signum Intelligence Ltd. In understanding the external context, consideration shall be given to issues arising from legal, technological, competitive, market, cultural, social, and economic environments, whether international, national, regional, or local. In understanding the internal context, consideration is given to issues related to values, culture, knowledge, and performance of the organisation.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence deals with technology based solutions. Hardware, Software and consulting. Its core activity is consulting clients on what technology to use and how best to implement it.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.2 -</p>
						</div>
						<div class="list_content">
							<p>Understanding the needs and expectations of interested parties.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.2.1 -</p>
						</div>
						<div class="list_content">
							<p>See Quality Policy.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd consider interested parties to include customers, legal obligations, employees and contractors, suppliers and company neighbours.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.3 -</p>
						</div>
						<div class="list_content">
							<p>Determining the scope of the quality management system.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.3.1 -</p>
						</div>
						<div class="list_content">
							<p>The scope of the quality system defined by this manual addresses all activities required by ISO 9001:2015, based on the scope detailed in 4.1.2, with the exceptions of aspects listed in paragraph 4.3.3.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.3.2 -</p>
						</div>
						<div class="list_content">
							<p>The scope for Signum Intelligence Ltd is: " Services and Consulting to the Technology and Telecommunication Sector."</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.3.3 -</p>
						</div>
						<div class="list_content">
							<p>Reduction in Scope</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.3.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Quality system items that are not applicable: - ISO 9001 Section 8.3, Design and development of products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.3.3.2 -</p>
						</div>
						<div class="list_content">
							<p>These exclusions are applicable because of their non-relevance to the activities of Signum Intelligence Ltd or to their desired scope of registration. Not doing this element does not impact on the product or service provided to the customers.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.4 -</p>
						</div>
						<div class="list_content">
							<p>Quality management system and its processes.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.4.1 -</p>
						</div>
						<div class="list_content">
							<p>The following key processes are used and defined by Signum Intelligence Ltd.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.4.1.1 -</p>
						</div>
						<div class="list_content">
							<p>QP1 - Sales Process</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.4.1.2 -</p>
						</div>
						<div class="list_content">
							<p>QP2 - Purchasing Process</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.4.1.3 -</p>
						</div>
						<div class="list_content">
							<p>QP3 - Servicing of a Contract</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>4.4.1.4 -</p>
						</div>
						<div class="list_content">
							<p>QP4 - Competency Process</p>
						</div>
					</div>
					<h4 class="m-t-20">Leadership</h4>
					<div class="list_div">
						<div class="list_number">
							<p>5.1 -</p>
						</div>
						<div class="list_content">
							<p>Leadership and Commitment</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.1.1 -</p>
						</div>
						<div class="list_content">
							<p>General</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.1.1.1 -</p>
						</div>
						<div class="list_content">
							<p>he Management of Signum Intelligence Ltd are committed to a policy of continuous improvement in all aspects of its business operations, together with the effective implementation and continuous improvement of our QMS in order to provide enhanced Customer satisfaction and added value to the business. Management will ensure that the importance of meeting Customer, regulatory and legal requirements is effectively communicated within the organisation.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Customer focus</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.1.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Accordingly, it is recognised that the Customer’s needs and expectations are paramount, and will be fully determined in order to ensure that we aim not only to meet them, but also to enhance the levels of quality, service and value provided to our Customers. Top management through Customer feedback following the completion of product delivery achieves this.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.2 -</p>
						</div>
						<div class="list_content">
							<p>Quality Policy</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.2.1 -</p>
						</div>
						<div class="list_content">
							<p>The Management of Signum Intelligence Ltd are committed to providing products and services that consistently exceed our Customer’s needs and expectations for Quality and Value.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.2.2 -</p>
						</div>
						<div class="list_content">
							<p>The Quality Policy will be detailed in QM102 – Quality Policy.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.3 -</p>
						</div>
						<div class="list_content">
							<p>Organisational roles, responsibilities and authorities.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.3.1 -</p>
						</div>
						<div class="list_content">
							<p>The organisational structure and reporting relationships are defined within the Management Organisation Chart.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.3.2 -</p>
						</div>
						<div class="list_content">
							<p>In addition, specific responsibilities and authorities and reporting relationships are defined within documented Job Descriptions, and further referenced within documented procedures, instructions, etc. as required.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>5.3.3 -</p>
						</div>
						<div class="list_content">
							<p>The Management Representative Oliver Bocking is responsible for ensuring that the QMS processes are established, implemented and maintained, reporting on the effectiveness of the Quality System, and promoting awareness of Customer requirements throughout the organisation.</p>
						</div>
					</div>
					<h4 class="m-t-20">Planning</h4>
					<div class="list_div">
						<div class="list_number">
							<p>6.1 -</p>
						</div>
						<div class="list_content">
							<p>Actions to address risks and opportunities.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.1 -</p>
						</div>
						<div class="list_content">
							<p>Various forms of quality planning are implemented, including:</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.1.1 -</p>
						</div>
						<div class="list_content">
							<p>The identification and acquisition of required personnel.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.1.2 -</p>
						</div>
						<div class="list_content">
							<p>The identification of required skills and consequential training.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.1.3 -</p>
						</div>
						<div class="list_content">
							<p>The identification of required testing, checking and/or verification activities.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.1.4 -</p>
						</div>
						<div class="list_content">
							<p>The identification of required records.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.1.5 -</p>
						</div>
						<div class="list_content">
							<p>The ability to meet the expectation of the customer in terms of quality, delivery and cost shall be assessed at contract review.</p>
						</div>
					</div>

					<p>Where a process is planned which may affect the operation, the change is considered so as to ensure that the integrity of the process is not compromised in any way. The effect of a major change where known in advance, is reviewed during the Quality Management Review Meetings.</p>


					<div class="list_div">
						<div class="list_number">
							<p>6.1.2 -</p>
						</div>
						<div class="list_content">
							<p>As part of our policy of continual improvement, Signum Intelligence Ltd has established documented procedures to provide for the review and analysis of information derived from the QMS processes.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Such information will be used to identify potential sources of non-conformance, and where necessary, the need for action will be determined, and effectively implemented. All actions taken will be recorded and will form part of the Management Review agenda in accordance with P3.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.2 -</p>
						</div>
						<div class="list_content">
							<p>Quality objectives and planning to achieve them.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Measurable quality objectives have been established for all relevant functions within the organisation.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Objective shall be set during the Managment Review meeting as defined in P3.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.2.3 -</p>
						</div>
						<div class="list_content">
							<p>To achieve those objectives established during the Management Review process P3, the Managing Director Oliver Bocking is responsible for achieving the objectives set out in the Management Review meeting. The target and the date for achievement for each objective shall be set at the Management Review meeting. By default, the target date for meeting the objective shall be by the following Management Review meeting.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.3 -</p>
						</div>
						<div class="list_content">
							<p>Planning of changes.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Various forms of quality planning are implemented, including:</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.3.1.1 -</p>
						</div>
						<div class="list_content">
							<p>The identification and acquisition of required personnel.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.3.1.2 -</p>
						</div>
						<div class="list_content">
							<p>The identification of required skills and consequential training.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.3.1.3 -</p>
						</div>
						<div class="list_content">
							<p>The identification of required testing, checking and/or verification activities.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>6.3.1.4 -</p>
						</div>
						<div class="list_content">
							<p>The identification of required records.</p>
						</div>
					</div>
					
					
					
					
					<h4 class="m-t-20">Support</h4>
					<div class="list_div">
						<div class="list_number">
							<p>7.1 -</p>
						</div>
						<div class="list_content">
							<p>Resources.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.1 -</p>
						</div>
						<div class="list_content">
							<p>The Management of Signum Intelligence Ltdwill ensure that resources required are determined and available, in order to ensure the effective operation of the QMS and achievement and enhancement of Customer satisfaction.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.2 -</p>
						</div>
						<div class="list_content">
							<p>All personnel will be suitably qualified to perform their assigned tasks and have their objectives reviewed annually, including training reviews. Through the appraisal and objective process, ensure that staff continue to embrace the values namely:</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Maximise staff marketability and fulfilment.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Grow Profitably.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.2.3 -</p>
						</div>
						<div class="list_content">
							<p>Strive passionately for Customer success.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.2.4 -</p>
						</div>
						<div class="list_content">
							<p>Deliver renowned efficiency.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.2.5 -</p>
						</div>
						<div class="list_content">
							<p>Reference is given to section 7.2 and 7.3.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Infrastructure.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Infrastructure.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd is committed to ensuring that suitable infrastructure in terms of buildings; facilities and equipment are identified, acquired, and adequately maintained.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.4 -</p>
						</div>
						<div class="list_content">
							<p>Environment for the operation of processes.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.4.1 -</p>
						</div>
						<div class="list_content">
							<p>The Management of Signum Intelligence Ltd will ensure that all aspects of the work environment having an effect on product conformance are identified, and effectively managed at all times.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.5 -</p>
						</div>
						<div class="list_content">
							<p>Monitoring and measuring resources.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.5.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd shall ensure that an annual calibration of the weighing device utilised is carried out; details of the calibration will be recorded accordingly, should the weighing device fail its calibration, this will be recorded on the calibration test documentation and brought to the attention of the Operations Manager, a decision will then be made by Management as to whether the device is to be used or not and what action if any is to be taken.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.6 -</p>
						</div>
						<div class="list_content">
							<p>Organisational knowledge</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.1.6.1 -</p>
						</div>
						<div class="list_content">
							<p>Training shall be considered a vital part of the growth and continued success of Signum Intelligence Ltd. The organisation has determined what employees are required to maintain a satisfactory business outlook. The organisation has employees in key areas of production, maintenance and management that are able to professionally liaise with clients and suppliers. Management shall be capable of producing a satisfactory standard of work as acceptable to the customer base.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.2 -</p>
						</div>
						<div class="list_content">
							<p>Competence.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.2.1 -</p>
						</div>
						<div class="list_content">
							<p>The skills, qualifications, experience or other competency criteria required for personnel performing work-affecting quality will be identified and, where required, training provided to ensure these needs are met.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.2.2 -</p>
						</div>
						<div class="list_content">
							<p>The effectiveness of the training provided would be evaluated in order to ensure the training objectives are met as referenced in 7.1.2.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.3 -</p>
						</div>
						<div class="list_content">
							<p>Awareness.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.3.1 -</p>
						</div>
						<div class="list_content">
							<p>In addition, all Company Management will ensure that all personnel are aware of the importance and relevance of their activities and their effect on quality and Customer satisfaction by the use of method statements.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.3.2 -</p>
						</div>
						<div class="list_content">
							<p>Records of skills, qualifications, experience and training provided will be maintained, together with a record of staff turnover.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.4 -</p>
						</div>
						<div class="list_content">
							<p>Communication.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.4.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd will employ appropriate methods of communication to ensure that all information relating to the performance of the QMS is communicated to concerned personnel and external interested parties; these include as required review meetings. The person responsible for all communication internally and externally is Oliver Bocking.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5 -</p>
						</div>
						<div class="list_content">
							<p>Documented information</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1 -</p>
						</div>
						<div class="list_content">
							<p>General - Documented information is controlled by P1.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1 -</p>
						</div>
						<div class="list_content">
							<p>GSignum Intelligence Ltd operates a QMS based upon the requirements of ISO 9001:2015, structured as detailed below:</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1.1 -</p>
						</div>
						<div class="list_content">
							<p>Quality policy - Quality Policy</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Quality objectives - Management Review</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Quality Manual</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1.4 -</p>
						</div>
						<div class="list_content">
							<p>Quality system operating procedures</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1.5 -</p>
						</div>
						<div class="list_content">
							<p>Process planning, operation and control documents / flowcharts (including those of external origin)</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.1.1.6 -</p>
						</div>
						<div class="list_content">
							<p>Quality forms and records</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2 -</p>
						</div>
						<div class="list_content">
							<p>Creating and updating</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1 -</p>
						</div>
						<div class="list_content">
							<p>All documents forming part of the QMS will be subject to documented procedures to ensure that:</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.1 -</p>
						</div>
						<div class="list_content">
							<p>Documents are approved by the appropriate authority prior to issue</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Only uncontrolled issues of documents are available at designated locations</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Obsolete documents are removed from all points of use</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.4 -</p>
						</div>
						<div class="list_content">
							<p>Obsolete documents required for historical purposes are suitably identified</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.5 -</p>
						</div>
						<div class="list_content">
							<p>Each document is uniquely identified</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.6 -</p>
						</div>
						<div class="list_content">
							<p>Quality Representative retains master registers of documents outside this system.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.7 -</p>
						</div>
						<div class="list_content">
							<p>Documents are subject to review, update and re-approval, as necessary</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.2.1.8 -</p>
						</div>
						<div class="list_content">
							<p>Essential documents of an external nature shall be controlled and be of the latest issue</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.3 -</p>
						</div>
						<div class="list_content">
							<p>Control of documented Information</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Quality Records will be maintained, providing objective evidence of conformance to specified requirements.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.3.2 -</p>
						</div>
						<div class="list_content">
							<p>Documented procedures define the method and responsibilities for the retention and storage of Quality records generated within the Quality System in order to ensure such records are legible, filed for ease of retrieval, and stored in a suitable environment, in order to prevent loss or damage (including records stored on Electronic media). The retention period for Quality records will be as defined within applicable quality documents.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>7.5.3.3 -</p>
						</div>
						<div class="list_content">
							<p>Where contractually specified, Quality Records will be available for review by the Customer’s representative, and retained for an agreed period in accordance with P1.</p>
						</div>
					</div>


					<h4 class="m-t-20">Operation</h4>
					<div class="list_div">
						<div class="list_number">
							<p>8.1 -</p>
						</div>
						<div class="list_content">
							<p>Operational planning and control</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.1.1 -</p>
						</div>
						<div class="list_content">
							<p>All processes involved in the provision of our products will be developed and planned. Such plans will include, as appropriate:-</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.1.1.1 -</p>
						</div>
						<div class="list_content">
							<p>The determination of product objectives and requirements</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.1.1.2 -</p>
						</div>
						<div class="list_content">
							<p>The provision of processes, documents and resources required 8.1.1.3 - Required verification, validation, inspection and test activities, including acceptance criteria</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.1.1.4 -</p>
						</div>
						<div class="list_content">
							<p>Records required to demonstrate conformance to specified requirements</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.1.1.5 -</p>
						</div>
						<div class="list_content">
							<p>Where contractually required, for a particular product, Product Realisation plans may be referred to as Quality Plans, and submitted in a format agreed with the Customer concerned.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2 -</p>
						</div>
						<div class="list_content">
							<p>Requirements for products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Customer communication</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.1.1 -</p>
						</div>
						<div class="list_content">
							<p>All points of contact and communication with our Customers relating to sales enquiries, orders, and Customer feedback, are clearly defined within our website.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Determination of requirements related to products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Following a Sales Order or enquiry, Customer requirements are identified including, as applicable:-</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.2.1.1 -</p>
						</div>
						<div class="list_content">
							<p>Requirements specified by the Customer including delivery activities.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.2.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Requirements not specified by the Customer, but required for known or intended use.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.2.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Any statutory or regulatory requirements related to the product.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.2.1.4 -</p>
						</div>
						<div class="list_content">
							<p>Additional requirements determined by Signum Intelligence Ltd.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3 -</p>
						</div>
						<div class="list_content">
							<p>Review of requirements related to the products and services.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.1 -</p>
						</div>
						<div class="list_content">
							<p>All Customer enquiries and orders will be reviewed to ensure that Signum Intelligence Ltd has the capability to meet Customer’s specified requirements for quality, delivery and cost.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2 -</p>
						</div>
						<div class="list_content">
							<p>The review will be conducted dependent upon the product required, and similarity to previously utilised products, and will ensure that: -</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Product requirements are adequately defined.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd has the ability to meet these requirements.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2.3 -</p>
						</div>
						<div class="list_content">
							<p>Any differences or ambiguities arising are resolved with the Customer.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2.4 -</p>
						</div>
						<div class="list_content">
							<p>All relevant information is communicated to those personnel responsible for implementation.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2.5 -</p>
						</div>
						<div class="list_content">
							<p>Verbal requirements are confirmed prior to acceptance.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.2.3.2.6 -</p>
						</div>
						<div class="list_content">
							<p>All variations to contracted requirements are identified, documented, and communicated to concerned personnel for implementation.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.3 -</p>
						</div>
						<div class="list_content">
							<p>Design and development of products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.3.1 -</p>
						</div>
						<div class="list_content">
							<p>This section is excluded.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4 -</p>
						</div>
						<div class="list_content">
							<p>Control of externally provided products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.1 -</p>
						</div>
						<div class="list_content">
							<p>General</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.1.1 -</p>
						</div>
						<div class="list_content">
							<p>It is the policy of Signum Intelligence Ltd to ensure that all products procured from suppliers are of proven capability to meet specified requirements. Accordingly, the qualification of suppliers will be in accordance with defined criteria, the nature and extent of qualification undertaken being dependent on the criticality of the product to be provided. Records of “Approved “suppliers shall be maintained. QP2 refers</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.2 -</p>
						</div>
						<div class="list_content">
							<p>Type and extent of control of external provision</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Verification of purchased products will be undertaken on receipt, in accordance with planned arrangements. The level and nature of inspection will be dependent on the criticality of the product concerned, and proven supplier capability, including Quality System arrangements, previous performance, and documented evidence of compliance. Verification of materials and products at the Supplier’s premises undertaken by Signum Intelligence Ltd shall be clearly documented within associated Purchase documentation and agreed with the Supplier concerned.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3 -</p>
						</div>
						<div class="list_content">
							<p>Information for external providers</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Supplier performance shall be periodically reviewed and recorded, in accordance with documented procedures. The results of such reviews shall be used to update the records of “Approved” suppliers.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3.2 -</p>
						</div>
						<div class="list_content">
							<p>All purchase requirements (and any subsequent amendments) shall be clearly identified and documented, and subject to review and approval, prior to release.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3.3 -</p>
						</div>
						<div class="list_content">
							<p>Purchasing requirements will include all relevant information related to the product and will include, as appropriate: -</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3.4 -</p>
						</div>
						<div class="list_content">
							<p>Criteria for approval of products/procedures/processes and equipment</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3.5 -</p>
						</div>
						<div class="list_content">
							<p>Qualification and approval of personnel</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.4.3.6 -</p>
						</div>
						<div class="list_content">
							<p>QMS requirements</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5 -</p>
						</div>
						<div class="list_content">
							<p>Production and service provision</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.1 -</p>
						</div>
						<div class="list_content">
							<p>Control of production and service provision</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.1.1 -</p>
						</div>
						<div class="list_content">
							<p>All processes involved in the provision of our products will be planned and operated under controlled conditions via the site file system and method statements, including: -</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.1.1.1 -</p>
						</div>
						<div class="list_content">
							<p>The availability of relevant information describing the required product’s characteristics</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.1.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Availability and use of monitoring and measuring devices</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.1.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Implementation of measurement and monitoring, including during delivery activities</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.2 -</p>
						</div>
						<div class="list_content">
							<p>Identification and traceability</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.2.1 -</p>
						</div>
						<div class="list_content">
							<p>All products will be suitably identified throughout its lifecycle within Signum Intelligence Ltd and during delivery to the Customer.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.2.1 -</p>
						</div>
						<div class="list_content">
							<p>All products will be suitably identified throughout its lifecycle within Signum Intelligence Ltd and during delivery to the Customer.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Where traceability is a specified requirement, a unique identification number will be assigned and used to identify each product. This identification will be recorded on all affected process documentation.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.3 -</p>
						</div>
						<div class="list_content">
							<p>Property belonging to customers or external providers</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd will exercise due care and diligence with regard to Customer-supplied property including materials, products, hardware, software, or “intellectual property”, and will provide for the proper care and maintenance, and the prevention of loss, misuse, or unauthorized dissemination.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.3.2 -</p>
						</div>
						<div class="list_content">
							<p>In the remote and unlikely event that such Customer property suffers loss, damage or degradation, such will be immediately identified and formally reported to the Customer or Customer’s representative.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.4 -</p>
						</div>
						<div class="list_content">
							<p>Preservation</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.4.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd shall ensure all products delivered to site are suitably identified, handled, protected from damage and environmentally controlled when required.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.5 -</p>
						</div>
						<div class="list_content">
							<p>Post-delivery activities</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.5.1 -</p>
						</div>
						<div class="list_content">
							<p>All post delivery processes involved in the provision of our products will be planned and operated under controlled conditions taking into account statutory and regulatory requirements; the potential undesired consequences associated with its products and services; the nature, use and intended lifetime of the products and services; including: -</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.5.2 -</p>
						</div>
						<div class="list_content">
							<p>The availability of relevant information describing the required product’s characteristics meeting customer and contractual requirements.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.5.3 -</p>
						</div>
						<div class="list_content">
							<p>Availability and use of calibrated monitoring and measuring devices used for post delivery activities.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.5.4 -</p>
						</div>
						<div class="list_content">
							<p>Implementation of requested warranty claims identified during post-delivery activities and assessment of any customer feedback.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.6 -</p>
						</div>
						<div class="list_content">
							<p>Control of changes</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.5.6.1 -</p>
						</div>
						<div class="list_content">
							<p>The organisation shall review and control changes for production or service provision, to the extent necessary to ensure continuing conformity with requirements.  The organisation shall retain documented information describing the results of the review of changes, the person authorising the change, and any necessary actions arising from the review. Any changes required shall be documented in the management review.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.6 -</p>
						</div>
						<div class="list_content">
							<p>Release of products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.6.1 -</p>
						</div>
						<div class="list_content">
							<p>Controls will be applied to provide for the monitoring and measurement of product characteristics, at defined stages of the realization process, and evidence of conformity to specified requirements will be maintained.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.6.2 -</p>
						</div>
						<div class="list_content">
							<p>Where, and if, the need to release a product prior to completion of specified monitoring and measurement activities is required, such release will be approved by authorized personnel, including the Customer, where applicable, and recorded.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.6.3 -</p>
						</div>
						<div class="list_content">
							<p>Verification of purchased products will be undertaken on receipt, in accordance with planned arrangements.  The level and nature of inspection will be dependent on the criticality of the product concerned, and proven supplier capability, including Quality System arrangements, previous performance, and documented evidence of compliance.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.6.4 -</p>
						</div>
						<div class="list_content">
							<p>Verification of materials and products at the Supplier’s premises undertaken by Signum Intelligence Ltd shall be clearly documented within associated Purchase documentation and agreed with the Supplier concerned.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.7 -</p>
						</div>
						<div class="list_content">
							<p>Control of nonconforming process outputs, products and services</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.7.1 -</p>
						</div>
						<div class="list_content">
							<p>Any instances of non-conforming product encountered will be identified and quarantined to prevent inadvertent use or delivery.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.7.2 -</p>
						</div>
						<div class="list_content">
							<p>In addition, the review and disposal of any non-conforming product will be undertaken by authorised personnel, in accordance with documented procedures, and may include, as appropriate: -</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.7.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Action taken to eliminate the non-conformance. Authorisation of the use, release or acceptance by authorised personnel, and the Customer (where applicable). Action taken to prevent its original intended use or application.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.7.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Where the non-conformance is deemed to affect products already delivered or in use, appropriate measures will be taken in order to determine the effects of the non-conformity and implement any corrective actions required.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>8.7.2.3 -</p>
						</div>
						<div class="list_content">
							<p>Records of non-conformities and disposal action taken will be maintained in accordance with P2.</p>
						</div>
					</div>

					
					
					<h4 class="m-t-20">Performance evaluation</h4>

					<div class="list_div">
						<div class="list_number">
							<p>9.1 -</p>
						</div>
						<div class="list_content">
							<p>Monitoring, measurement, analysis and evaluation</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.1.1 -</p>
						</div>
						<div class="list_content">
							<p>General</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.1.1.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd has planned and implemented monitoring and measurement of key indicators related to process, product and Quality System performance, together with the analysis of data using appropriate statistical methodology, to identify opportunities for continuous improvement and enhanced Customer satisfaction.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.1.2 -</p>
						</div>
						<div class="list_content">
							<p>Customer satisfaction</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.1.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd has established a Customer Satisfaction Survey Form to collect and analyse data from our Customers in order to determine whether their needs and expectations related to our products have been satisfied, and to identify opportunities for improvement.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.1.3 -</p>
						</div>
						<div class="list_content">
							<p>Analysis and evaluation</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.1.3.1 -</p>
						</div>
						<div class="list_content">
							<p>All data collected from the QMS, and the monitoring and measurement processes implemented within Signum Intelligence Ltd will be subject to review and analysis, and used as the basis for determining the effectiveness of the quality system, and to provide the basis for our continuous improvement programme. QP104 refers.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2 -</p>
						</div>
						<div class="list_content">
							<p>Internal audit</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2.1 -</p>
						</div>
						<div class="list_content">
							<p>The Management of Signum Intelligence Ltd recognise that Internal Audits play a fundamental role in the control and improvement of the QMS.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2.2 -</p>
						</div>
						<div class="list_content">
							<p>Internal Quality Audits will be conducted in accordance with a planned schedule, to ensure that each aspect of the documented Quality System is audited, at no more than 12 monthly intervals.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2.3 -</p>
						</div>
						<div class="list_content">
							<p>Audits will be scheduled on the basis of the importance of the area or activity audited, and the results of previous audits obtained.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2.4 -</p>
						</div>
						<div class="list_content">
							<p>Auditors will be suitably trained, and will not audit their own work.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2.5 -</p>
						</div>
						<div class="list_content">
							<p>Internal audit procedures will define the method and responsibilities for the planning, and conduct of Internal Quality Audits, together with the reporting of audit results, action implementation and verification of the effectiveness of action taken.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.2.6 -</p>
						</div>
						<div class="list_content">
							<p>The Management will review the results of Internal Audits, at each Management Review meeting.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.3 -</p>
						</div>
						<div class="list_content">
							<p>Management review</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.3.1 -</p>
						</div>
						<div class="list_content">
							<p>Management Reviews will be held annually and at the discretion of management, to ensure the continuing effectiveness, suitability and adequacy of the QMS.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.3.2 -</p>
						</div>
						<div class="list_content">
							<p>Management Review inputs will be identified and include information regarding the performance and effectiveness of the QMS, products and processes together with opportunities for improvement.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>9.3.3 -</p>
						</div>
						<div class="list_content">
							<p>Management Review outputs will clearly identify improvement actions and any resource needs arising from Management Reviews.</p>
						</div>
					</div>




					<h4 class="m-t-20">Improvement</h4>
					<div class="list_div">
						<div class="list_number">
							<p>10.1 -</p>
						</div>
						<div class="list_content">
							<p>General</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>10.1.1 -</p>
						</div>
						<div class="list_content">
							<p>Signum Intelligence Ltd is committed to a policy of continual improvement in all aspects of our business. The QMS effectively contributes towards the achievement of our Quality Policies and Objectives.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>10.2 -</p>
						</div>
						<div class="list_content">
							<p>Nonconformity and corrective action</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>10.2.1 -</p>
						</div>
						<div class="list_content">
							<p>Non-conformance related to the Quality System, processes and Customer complaints would be subject to documented procedures, which define the methods and responsibilities for recording, analysis and investigation, together with the implementation, and verification of the effectiveness of corrective actions taken. P2 refers.</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>10.3 -</p>
						</div>
						<div class="list_content">
							<p>Continual Improvement</p>
						</div>
					</div>
					<div class="list_div">
						<div class="list_number">
							<p>10.4 -</p>
						</div>
						<div class="list_content">
							<p>Reference is given to section 10.1</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>@endsection
<!-- end:: Content -->