

<?php $__env->startSection('content'); ?>
<style>
    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
  color: #fff;
  position: relative;
}

input[type="date"]::-webkit-datetime-edit-year-field{
  position: absolute !important;
  border-left:1px solid #8c8c8c;
  padding: 2px;
  color:#000;
  left: 56px;
}

input[type="date"]::-webkit-datetime-edit-month-field{
  position: absolute !important;
  border-left:1px solid #8c8c8c;
  padding: 2px;
  color:#000;
  left: 26px;
}


input[type="date"]::-webkit-datetime-edit-day-field{
  position: absolute !important;
  color:#000;
  padding: 2px;
  left: 4px;
  
}
</style>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Requirements and Aspects</h2>
		</div>
	</div>
	<section id="procedure_section">
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="requirementFrom()" class="addBtn">ADD A REQUIRMENT</a>
                    		</div>
                    	</div>
                    	<div class="requirments_from_div">
                    		<form action="<?php echo e(route('addRequirementadmin')); ?>" method="POST">
                    		    <?php echo csrf_field(); ?>
                    			<div class="form-group">
									<label>Requirement:</label>
									<input type="text" class="form-control" name="requirement" aria-describedby="emailHelp" placeholder="Enter Requirement:" required>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Requirement Completion Date of the Activity (dd/mm/yyyy):</label>
											<input type="date" max="2999-12-31" name="req_date" class="form-control" aria-describedby="emailHelp" placeholder="dd/mm/yyyy" value="yyyy/mm/dd" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Periodicity (Months):</label>
											<input type="number" min="1" max="12" name="period" class="form-control validate_number" aria-describedby="emailHelp" placeholder="Enter Months:" required>
										</div>
									</div>
								</div>
								
            <?php 
            $urlparam = request()->route()->parameters;
            ?>  

<input type="hidden" name="user_id" value="<?php echo e($urlparam['userid']); ?>">

								<button type="submit" class="submitBtn">SUBMIT</button>
								<button type="reset" class="submitBtn" style="
    margin-right: 20px;
" onclick="requirementFrom()">Cancel</button>
                    		</form>
                    	</div>
                    </div>
		<div class="row">
			<div class="col-lg-12">
                    <div class="procedure_div">
						
							
								<a href="/edit_user/<?php echo e($urlparam['userid']); ?>" class="btn btn-clean btn-icon-sm back_icon" style="float: right;">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
						
					
                    	<div class="requirments_table_div">
                    		<div class="kt-portlet__body table-responsive">
								
                                <!--begin: Datatable -->

								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th>No.</th>
											<th>Requirements.</th>
											<th>Date Completed</th>
											<th>Periodicity
												(Months)</th>
											<th>Due Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $counter=0; ?>
                                        <?php $__currentLoopData = $getReq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $counter++; ?>
										<tr>
											<td> <?php echo e($counter); ?></td>
											<td><?php echo e($data->requirment_title); ?></td>
											<td><?php echo e(date("d-M-Y",strtotime($data->completion_date))); ?></td>
											<td><?php echo e($data->periods); ?></td>
												<?php 
											$d = strtotime("+$data->periods months",strtotime($data->completion_date)); 
										$d_id = $data->id;
											?>
											<td><?php echo e(date("d-M-Y",$d)); ?></td>
                                        <td>
											<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" 
                                            onclick="getEid(<?php echo e(json_encode($data)); ?>);">								<i class="la la-edit"></i>
                                            </button>
										<!--<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"  onclick="deleteModal(<?php echo e(json_encode($data)); ?>);" ><i class="la la-trash"></i>-->
          <!--                              </button>-->
                                        
<button data-toggle="modal" data-target="#confirm-<?php echo e($d_id); ?>" id="remove_<?php echo e($d_id); ?>" title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
 <i class="la la-trash"></i>
</button>
                  <!-- Delete Modal -->

                  <div class="modal fade modal-mini modal-primary" id="confirm-<?php echo e($d_id); ?>" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="<?php echo e(route('deleteRequirementadmin')); ?>" method="post">
                          <div class="modal-header justify-content-center"> <?php echo csrf_field(); ?> 
                            <div class="modal-profile"><h5>Deleting an entry</h5></div>
                          </div>
                          <div class="modal-body text-center">
                            <p>Are you sure you want to delete this entry?</p>
                          </div>
                          <div class="modal-footer">
                              <input type="hidden" name="id" value="<?php echo e($d_id); ?>">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                                    </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting an
					entry.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
            <form action="<?php echo e(route('deleteRequirementadmin')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="" id="re_id">

				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editRequirment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Amend a
					Requirement.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
            </div>
			<form action="<?php echo e(route('updaterequiremntadmin')); ?>" method="POST">
			<div class="modal-body">
				<?php echo csrf_field(); ?>
					<input type="hidden" name="requirment_id" value="" id="id_feild" >
					
                    <div class="form-group">
						<label>Requirement:</label>
						<input type="text" class="form-control" value="" name="requirment_title" required placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>Requirement Completion Date of the Activity (DD/MM/YYYY):</label>
						<input type="date" class="form-control" value="" name="completion_date" required placeholder="Enter Requirement:">
					</div>
					<div class="form-group">
						<label>Periodicity (Months):</label>
						<input type="number" class="form-control periodicity" onkeyup="myFunction()" min="1" max="12" value="" name="periods" required placeholder="Enter Months:">
					</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Update</button>

            </div>
        </form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<script>
    function myFunction(){
        var value=$(".periodicity").val();
        if(value<=0)
           { 
              $(".periodicity").val();
           }else if(value>12){
               $(".periodicity").val(12);
           } 
    }
   function getEid(data){

        $("#id_feild").val(data.id);
		$("input[name='periods']").val(data.periods);
		$("input[name='requirment_title']").val(data.requirment_title);
		$("input[name='completion_date']").val(data.completion_date);
        $("#editRequirment").modal('show');
    }
    function deleteModal(data){
        $("#re_id").val(data.id);
        $("#deleteRequirment").modal('show');

    }
</script>

<?php echo $__env->make('admin.dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/admin/adminform_records/requirements_aspect.blade.php ENDPATH**/ ?>