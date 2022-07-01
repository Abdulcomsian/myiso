

<?php $__env->startSection('content'); ?>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Maintenance Records</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    				<a onclick="maintanceRecordForm()" class="addBtn">Add Maintenance records</a>
                    		</div>
                    	</div>
                    <div class="maintance_record_from_div">
                        <form action="<?php echo e(route('maintain_rec')); ?> " method="POST">
                                <?php echo csrf_field(); ?>
                    			<div class="row">
       
       <!--<input type="hidden" class="form-control" name="mgtreviewId" value="241">-->
                                       <?php echo csrf_field(); ?>
                                            <?php 
            $urlparam = request()->route()->parameters;
            ?>
    

<input type="hidden" name="user_id" value="<?php echo e($urlparam['userid']); ?>">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Maintenance Record Date (DD/MM/YYYY):</label><br>
											<input type="date" max="2999-12-31" class="form-control" name="mrdate" required>
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Item:</label>
											<input type="text" class="form-control" name="mritem" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Activity:</label>
											<input type="text" class="form-control" name="mractivity" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Location:</label>
											<input type="text" class="form-control" name="mlocation" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Observations:</label>
											<input type="text" class="form-control" name="mrobservation" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Actions:</label>
											<input type="text" class="form-control" name="mractions" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Maintenance Record Activity Performed By:</label>
											<input type="text" class="form-control" name="mractivityperofrmby" required>
										</div>
									</div>
								</div>
								
								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="maintanceRecordForm()" class="submitBtn" style="margin-right: 10px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                            <div class="d-flex justify-content-between mb-2">
                                <h4>Total Records Listed</h4>
                                <a href="/edit_user/<?php echo e($urlparam['userid']); ?>" class="btn btn-clean btn-icon-sm back_icon" style="float: right;">
                                    <i class="la la-long-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                            <!--<button>Add an Entry</button>-->
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>Maintenance Record ID</th>
											<th>Maintenance Record Date</th>
											<th>Item</th>
											<th>Activity</th>
											<th>Location</th>
											<th>Observations</th>
											<th>Actions</th>
                                            <th>Performed By</th>
                                            <th>Maintenance Record Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                        ?>
                                        <?php $__currentLoopData = $mainrecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i++); ?></td>
                                                <td> <?php echo e(date('d-M-Y', strtotime($data->mrdate))); ?></td>
                                                <td><?php echo e($data->mritem); ?></td>
                                                <td><?php echo e($data->mractivity); ?></td>
                                                <td><?php echo e($data->mlocation); ?></td>
                                                <td><?php echo e($data->mrobservation); ?></td>
                                                <td><?php echo e($data->mractions); ?></td>
                                                <td><?php echo e($data->mractivityperofrmby); ?></td>
                                                <td>
                                                    <button onclick="viewMR(<?php echo e(json_encode($data)); ?>);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="view"><i class="la la-info"></i>
													</button>
                                                    <button onclick="getEid(<?php echo e(json_encode($data)); ?>);"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"><i class="la la-edit"></i>
													</button>
													<button onclick="deleteModal(<?php echo e(json_encode($data)); ?>);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="la la-trash"></i>
													</button>
													
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
								</table>
								<!--end: Datatable -->
                    		</div>
						</div>
					</div>


	</section>

	<!--End::Section-->
</div>
<div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deleting an entry.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
			
					<form action="<?php echo e(route('deletemaintanceRecAdmin')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="id" id="re_id" value="">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-danger">Yes</button>
						</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editepmloyee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Maintenance Record Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
		<form action="<?php echo e(route('editmentainance')); ?> " method="POST">
            <?php echo csrf_field(); ?>
			<div class="modal-body">
                <input type="hidden" name="id" value="" id="editproject">
                            <?php 
            $urlparam = request()->route()->parameters;
            ?>
    

<input type="hidden" name="user_id" value="<?php echo e($urlparam['userid']); ?>">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date (DD/MM/YYYY):</label><br>
                                <input type="date" class="form-control" name="mrdate">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Item:</label>
                                <input type="text" class="form-control" name="mritem" placeholder="Enter Management Review Meeting:">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity:</label>
                                <input type="text" class="form-control" name="mractivity" placeholder="Enter Review Previous Meeting:">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Location:</label>
                                <input type="text" class="form-control" name="mlocation">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Observations:</label>
                                <input type="text" class="form-control" name="mrobservation">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Actions:</label>
                                <input type="text" class="form-control" name="mractions">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity Performed By:</label>
                                <input type="text" class="form-control" name="mractivityperofrmby">
                            </div>
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
				<button type="submit" class="btn btn-danger">Update</button>
            </div>
        </form>
		</div>
	</div>
</div>
<!--VIEW--->
<div class="modal fade" id="viewMR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View Maintenance Record Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
		<form >
            <?php echo csrf_field(); ?>
			<div class="modal-body">
                <input type="hidden" name="id" value="" id="editproject">
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Maintenance Record Date:</label><br>
                                <input type="date" class="form-control" name="mrdate" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Item:</label>
                                <input type="text" class="form-control" name="mritem" placeholder="Enter Management Review Meeting:" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity:</label>
                                <input type="text" class="form-control" name="mractivity" placeholder="Enter Review Previous Meeting:" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Location:</label>
                                <input type="text" class="form-control" name="mlocation" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Observations:</label>
                                <input type="text" class="form-control" name="mrobservation" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Actions:</label>
                                <input type="text" class="form-control" name="mractions" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Maintenance Record Activity Performed By:</label>
                                <input type="text" class="form-control" name="mractivityperofrmby" disabled>
                            </div>
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
		</div>
	</div>
</div>



<?php $__env->stopSection(); ?>

<script>

		function maintanceRecordForm(){
				if($(".maintance_record_from_div").css("display")==="block"){
					$(".maintance_record_from_div").css("display","none");
				}
				else{
					$(".maintance_record_from_div").css("display","block");
				}
			}
			
    function getEid(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='mlocation']").val(data.mlocation);
         $("input[name='mractions']").val(data.mractions);
         $("input[name='mractivity']").val(data.mractivity);
         $("input[name='mractivityperofrmby']").val(data.mractivityperofrmby);
         $("input[name='mrdate']").val(data.mrdate);
         $("input[name='mritem']").val(data.mritem);
         $("input[name='mrobservation']").val(data.mrobservation);
         $("input[name='mid']").val(data.mid);
         $("#editepmloyee").modal('show');

     }
    function viewMR(data){
        console.log(data);
         $("#editproject").val(data.id);
         $("input[name='mlocation']").val(data.mlocation);
         $("input[name='mractions']").val(data.mractions);
         $("input[name='mractivity']").val(data.mractivity);
         $("input[name='mractivityperofrmby']").val(data.mractivityperofrmby);
         $("input[name='mrdate']").val(data.mrdate);
         $("input[name='mritem']").val(data.mritem);
         $("input[name='mrobservation']").val(data.mrobservation);
         $("input[name='mid']").val(data.mid);
         $("#viewMR").modal('show');

     }
     
     
     
	 function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

     }


</script>

<?php echo $__env->make('admin.dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/admin/adminform_records/maintance_record.blade.php ENDPATH**/ ?>