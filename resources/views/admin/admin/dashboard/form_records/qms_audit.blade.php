@extends('dashboard.layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>QMS Audits</h2>
		</div>
	</div>
	<section id="procedure_section">
		
		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, complete the form below and select the add button. To amend a record, fill in the form with the correct record number and include the new data and select update. You do need to complete the whole form.</p>
                    <p>This audit is a horizontal audit against each clause in the standard. The frequency all this audit will typically be annually and is used to determine the level of compliance to ISO 9001:2015.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="qmsAudit()" class="addBtn">ADD AUDIT DETAILS</a>
                    		</div>
                    	</div>
                    	<div class="qms_audit_from_div">
                    		<form>
                    			<div class="row">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>QMS Audit ID Number (See table below. For amendments only):</label>
											<input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter QMS Audit ID:">
										</div>
                    				</div>
                    			</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>4.1 Understanding the organization and its context. Is this correct?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>4.2 Understanding the needs and expectations of interested parties. Is this still correct?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>4.3 Determining the scope of the quality management system. Is this still correct?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>4.4 Quality management system and its processes. Are processes owned, relevant and show interaction?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>55.1 Leadership and commitment. Is top level management accountable for the quality system and is it customer focused?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>5.2 Policy. Is the quality policy established and accurate, reviewed and communicated?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>5.3 Organizational roles, responsibilities and authorities. Are these assigned and communicated?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>6.1 Actions to address risks and opportunities. Are risks and opportunities managed, understood and reviewed?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>6.2 Quality objectives and planning to achieve them. Are objectives set at Management Review and monitored?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>6.3 Planning of changes. Have any changes occurred been planned to meet section 6.3 of the standard?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>7.1 Resources. Are satisfactory resources in place? Consider people, infrastructure, environment for the operation of processes, monitoring and measuring resources and organizational knowledge.</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>7.2 Competence. Are the training records current?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>7.3 Awareness. Does employee awareness meet section 7.3 of the standard?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>7.4 Communication. Does communication meet section 7.4 of the standard?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>7.5 Documented information. Are all documents pertaining to the quality system controlled?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.1 Operational planning and control. Is the controlling system current and effective?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.2 Requirements for products and services. Is customer communication effective and has the requirements for products and services been defined, reviewed and documented?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.3 Design and development of products and services. Are the requirements of this standard met?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.4 Control of externally provided processes, products and services. Are externally provided processes, products and services controlled?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.5 Production and service provision. Is production and service provision controlled, including post delivery activities?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.6 Release of products and services. Are products and services completed before release to the customer?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>8.7 Control of nonconforming outputs. Are records kept and up to date?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>9.1 Monitoring, measurement, analysis and evaluation. Is monitoring, measurement, analysis and evaluation performed and documented?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>9.1.2 Customer satisfaction. Have customer satisfaction surveys been completed?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>9.2 Internal audit. Are internal audits planned and completed</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>9.3 Management review. Has the management review been planned and completed?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>10.1 Improvement - Has the organization determined and selected opportunities for improvement and implemented any necessary actions to meet customer requirements and enhance customer satisfaction?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>10.3 Continual improvement - Is there evidence that the company has continually improved?</label>
												<div class="kt-radio-list">
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 1
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 2
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="radio2"> Option 3
														<span></span>
													</label>
												</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Evidence:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Audit Comments and Actions:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Comment:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date Completed (YYYY/MM/DD):</label>
											<input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Auditor Name:</label>
											<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Auditor Name:">
										</div>
									</div>
								</div>
								<button onclick="qmsAudit()" class="submitBtn">SUBMIT</button>
							</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Audits Listed</h4>
                    		<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_agent">
									<thead>
										<tr>
											<th>QMS Audit ID</th>
											<th>Audit Date</th>
											<th>Detail View</th>
										</tr>
									</thead>
								</table>
								<!--end: Datatable -->
                    	</div>
                    </div>
			</div>
		</div>
	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting Process</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure?Do you really want to delete this?.</p>
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
<div class="modal fade" id="editProcessAudit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Requirements</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>1 - Is this process included in the system scope and is it still relevant?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>2 - Is this process being implemented as detailed in documented information?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>3 - Are all relevant personnel trained in this process and are records complete?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>4 - Are key performance indicator information being monitored for this process?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>5 - Have appropriate targets and objectives been set for this process at Management Review?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>6 - Have previous targets and objectives been reviewed for this process?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>7 - Are all supporting procedures and work instructions used and at the correct revision?</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>9 - Is the job paperwork satisfactory? Record the job details for this process here.</label>
									<div class="kt-radio-list">
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 1
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 2
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="radio2"> Option 3
											<span></span>
										</label>
									</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Evidence:</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Evidence::">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Any other issues?</label>
								<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Issue:">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<form action="" method="POST">
				@csrf
				@method('DELETE')
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
				<button type="submit" class="btn btn-danger">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
<!-- end:: Content --''