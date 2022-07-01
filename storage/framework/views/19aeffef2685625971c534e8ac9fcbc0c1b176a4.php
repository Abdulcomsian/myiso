

<?php $__env->startSection('content'); ?>
<!-- begin:: Content -->
<style>#procedure_section .procedure_div ul li::before {display:none !important;}</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

	<!--Begin::Dashboard 1-->


	<!--Begin::Section-->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Suppliers</h2>
		</div>
	</div>
	<section id="procedure_section">

		<div class="row">
			<div class="col-lg-12">
					<p>To add a record, click on the “Add
						Supplier” button. To amend or delete a record, click on the edit or delete
						icon of the entry that needs to be modified or deleted.</p>
                    <div class="procedure_div">
                    	<div class="row">
                    		<div class="col-lg-12 text-right">
                    			<a onclick="supplierForm()" class="addBtn">ADD SUPPLIER</a>
                    		</div>
                    	</div>
                    	<div class="supplier_from_div">
                            <form action="<?php echo e(route('supplier')); ?> "  id="addcust" method="post">
                                <?php echo csrf_field(); ?>
								<h3>Add Supplier Details</h3>
                    			<div class="row">
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Supplier ID Number:</label><br>
											<input type="number" class="form-control validate_number" min="1" name="idnumber" required placeholder="Enter ID:">
										</div>
                    				</div>
                    				<div class="col-lg-12">
                    					<div class="form-group">
											<label>Supplier Name:</label><br>
											<input type="text" class="form-control" required name="suppliername" placeholder="Enter Supplier Name:">
										</div>
                    				</div>
                    			</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Supplier Address:</label>
											<input type="text" name="supplieraddress" required class="form-control" placeholder="Enter Supplier Address:">
										</div>
									</div>
									
								</div>
								
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Country:</label>
											<input type="text" name="suppliercountry" required class="form-control" placeholder="Enter Country">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier
												Phone Number:</label>
											<input type="text" name="supplierphn"required id="supplierphn" class="form-control" placeholder="Enter phone number">
											<input type="hidden" name="phonecode" id="phonecode">
											<input type="hidden" name="phoneflag" id="phoneflag">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Email
												Address:</label>
											<input type="email" name="supplieremail"required class="form-control" placeholder="Enter Supplier Email address:">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Supplier Contact Name:</label>
											<input type="text" name="supplierContactNumber"required class="form-control" placeholder="Enter supplier contact person’s name.">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Services:</label>
											<input type="text" name="supplierservc"required required class="form-control" placeholder="Enter Supplier Services">
										</div>
									</div>
									</div>
								<button type="submit"  class="submitBtn">SUBMIT</button>
								<button type="reset" onclick="supplierForm()" class="btn btn-secondary submitBtn " style="margin-right:7px;">Cancel</button>
                    		</form>
                    	</div>
                    </div>
                    <div class="procedure_div">
                    	<div class="requirments_table_div">
                    		<h4>Total Suppliers Listed</h4>
                    		<div class="kt-portlet__body table-responsive">
								<!--begin: Datatable -->
								<table class="common_table table table-striped- table-bordered table-hover table-checkable table-responsive" id="kt_table_agent">
									<thead>
										<tr>
											<th class="w-100-px">Supplier ID
												Number</th>
											<th>Supplier Name</th>
											<th>Supplier Address</th>
											
											<th>Country</th>
											
											<!--<th>Country Code</th>-->
											<th>Supplier Phone Number</th>
											<th>Email Address</th>
											<th>Contact
												Person</th>
											<th>Services</th>
											<th class="w-100-px">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=1;
										?>
                                        <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


										<tr>
                                            <td><?php echo e($data->idnumber); ?></td>
                                            <td><?php echo e($data->suppliername); ?></td>
											<td><?php echo e($data->supplieraddress); ?></td>
											
											<td><?php echo e($data->suppliercountry); ?></td>
											
											<!--<td><?php echo e($data->phonecode); ?></td>-->
											<td><?php echo e($data->phonecode); ?> <?php echo e($data->supplierphn); ?></td>
											<td><?php echo e($data->supplieremail); ?></td>
                                            <td><?php echo e($data->supplierContactNumber); ?></td>
											<td><?php echo e($data->supplierservc); ?></td>
											<td>
											<button  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" onclick="getEid(<?php echo e($data); ?>);"><span class="svg-icon svg-icon-md">									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>
											</button>
											<button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" onclick="deleteModal(<?php echo e($data); ?>);"><i class="la la-trash"></i>
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
				<h5 class="modal-title" id="exampleModalLabel">Deleting Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this entry?</p>
			</div>
			<div class="modal-footer">
            <form action="<?php echo e(route('deleteSupplier')); ?>" method="POST">
                <?php echo csrf_field(); ?>
				<input type="hidden" name="id" id="re_id" value="">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo e(route('supplieredit')); ?> " id="editcust" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="id_feild" value="">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>ID Number:</label><br>
                                <input type="number" required class="form-control" name="idnumber" placeholder="">
                            </div>
                        </div> 
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Supplier Name:</label><br>
                                <input type="text" required class="form-control" name="suppliername" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Supplier Address:</label>
                                <input type="text" required name="supplieraddress" class="form-control" placeholder="">
                            </div>
                        </div>
                        
                    </div>
                    
                        
                        
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Supplier Telephone:</label>
                                <div id="edit_supplier_phone">

                                </div>
                                 <input type="hidden" name="phonecode" id="editphonecode">
                                <input type="hidden" name="phoneflag" id="editphoneflag">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier Email
									Address:</label>
                                <input type="email" required name="supplieremail" class="form-control" placeholder="Enter Supplier Email address">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Supplier Contact Name:</label>
                                <input type="text" name="supplierContactNumber" required class="form-control" placeholder="Enter supplier contact person’s name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Services:</label>
                                <input type="text" name="supplierservc" required class="form-control" placeholder="Enter Supplier Services">
                            </div>
                        </div>
                        </div>

			</div>
			<div class="modal-footer">
			    	<button type="button" class="btn btn-secondary submitBtn" data-dismiss="modal">Cancel</button>
				<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>-->
				<button type="submit" class="btn btn-danger">Update</button>
            </div>
            </form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<script>
    function getEid(data){
        console.log(data);
        $("#edit_supplier_phone").empty().append(`<input type="text" required name="editsupplierphn" id="editphone" class="form-control" placeholder="">`);

            $("#id_feild").val(data.id);
         $("input[name='idnumber']").val(data.idnumber);
         $("input[name='supplierContactNumber']").val(data.supplierContactNumber);
         $("input[name='supplieraddress']").val(data.supplieraddress);
         $("input[name='suppliercity']").val(data.suppliercity);
         $("input[name='suppliercountry']").val(data.suppliercountry);
         $("input[name='supplieremail']").val(data.supplieremail);
         $("input[name='suppliername']").val(data.suppliername);
         $("input[name='editsupplierphn']").val(data.supplierphn);
         $("input[name='supplierservc']").val(data.supplierservc);
         $("input[name='supplierstate']").val(data.supplierstate);
         $("input[name='supplierzip']").val(data.supplierzip);

        let phoneflag = '';
        if(data.phoneflag == 'preferred' || data.phoneflag == null){
            phoneflag = 'us';
        }else{
            phoneflag = data.phoneflag;
        }
        var input = document.querySelector("#editphone");
         window.intlTelInput(input, {
        separateDialCode: true,
        initialCountry: phoneflag,
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });
         $("#editSupplier").modal('show');
        $('#addcust').resetForm();
    }
     function deleteModal(data){
         $("#re_id").val(data.id);
         $("#deleteSupplier").modal('show');

     }
 </script>

 <?php $__env->startSection('myscript'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
        integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
        integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
        crossorigin="anonymous"></script>
        <script>

    var input = document.querySelector("#supplierphn");
    window.intlTelInput(input, {
        separateDialCode: true,
        // initialCountry: '<?php echo e(Auth::user()->phoneflag); ?>',
        customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
        ) {
            return "e.g. " + selectedCountryPlaceholder;
        },
    });



    $("#addcust").submit(function() {

            var i=1;
           var j=1;
           $('.iti__selected-dial-code').each(function(){
              if(i==1)
              {
                var code=$(this).text();
                $("#phonecode").val(code);
                console.log(code);
                  $("#phonecode").val(code);

              }

              i++;
          });

         $(".iti__selected-flag").each(function(){
              if(j==1)
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#phoneflag").val(result);
              }
            //   else
            //   {
            //       var str=$(this).attr('aria-activedescendant');
            //       var n = str.lastIndexOf('-');
            //       var result = str.substring(n + 1);
            //       $("#phoneflag").val(result);
            //   }
              j++;
          });

     });
    $("#editcust").submit(function() {

            var i=1;
           var j=1;
           $('.iti__selected-dial-code').each(function(){
              if(i==2)
              {
               var code=$(this).text();
                console.log(code);

               $("#editphonecode").val(code);

              }

              i++;
          });
            $(".iti__selected-flag").each(function(){
              if(j==2)
              {
                  var str=$(this).attr('aria-activedescendant');
                  var n = str.lastIndexOf('-');
                  var result = str.substring(n + 1);
                  $("#editphoneflag").val(result);
              }
            //   else
            //   {
            //       var str=$(this).attr('aria-activedescendant');
            //       var n = str.lastIndexOf('-');
            //       var result = str.substring(n + 1);
            //       $("#phoneflag").val(result);
            //   }
              j++;
          });


     });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\myiso\resources\views/dashboard/form_records/supplier.blade.php ENDPATH**/ ?>