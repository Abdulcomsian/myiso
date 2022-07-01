<?php $__env->startSection('content'); ?>

    <style> .new-file-upload {
            display: block;
            width: 91px;
            height: 34px;
            position: absolute;
            top: 23px;
            font-size: 12px;
            background: #FFF;
            border-radius: 4px;
            border: 1px solid #0d47b3;
        }

        .has_file {
            font-size: 0px !important;
            position: relative !important;
            left: -135px !important;
            top: 25px !important;
        }</style>

    <!-- begin:: Content -->

    <div class="kt-content  kt-grid__item kt-grid__item--fluid view_user_content" id="kt_content">

        <?php if($message = Session::get('success')): ?>

            <div class="alert alert-light alert-elevate" role="alert">

                <!-- <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div> -->

                <!-- <div class="alert-text">

                    DataTables has the ability to read data from virtually any JSON data source that can be obtained by Ajax. This can be done, in its most simple form, by setting the ajax option to the address of the JSON data source.

                    See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/data_sources/ajax.html" target="_blank">here</a>.

                </div> -->


                <!-- <div class="alert alert-success"> -->

                <p><?php echo e($message); ?></p>

                <!-- </div> -->

            </div>

        <?php endif; ?>

        <div class="kt-portlet kt-portlet--mobile">

            <div class="kt-portlet__head kt-portlet__head--lg">

                <div class="kt-portlet__head-label">

				<span class="kt-portlet__head-icon">

					<i class="kt-font-brand flaticon2-line-chart"></i>

				</span>

                    <h3 class="kt-portlet__head-title">

                        Users Listing

                    </h3>

                </div>

                <div class="kt-portlet__head-toolbar">

                    <div class="kt-portlet__head-wrapper">

                        <div class="kt-portlet__head-actions">

                            <div class="dropdown dropdown-inline">

                                

                            </div>

                            &nbsp;

                            <a href="/add_user" class="btn btn-brand btn-elevate btn-icon-sm">

                                <i class="la la-plus"></i>

                                New Record

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="kt-portlet__body">
                <style>th {
                        text-align: center;
                    }</style>
                <div class="table-responsive">

                    <!--begin: Datatable -->

                    <table class="table table-striped- table-bordered table-hover table-sm table-checkable" id="kt_table_agent2">

                        <thead>

                        <tr>

                            <!--<th>#</th>-->

                            <th>Company ID</th>
                            <th>Company Name</th>
                            <!----<th>Order Number</th>--->
                            <!----<th>Name</th>--->

                            <th>Country</th>
                            <th>User Name</th>

                            <th>Email Address</th>

                            <!--- <th>Phone</th>

                            <th>Address</th>--->
                            <th>Logo</th>
                            <th>Activation Date</th>
                            <th>Last Login</th>

                            <!--<th>Expiry date</th>-->


                            <th>Actions</th>

                        </tr>

                        </thead>

                        <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            <tr>

                            <!--<td><?php echo e($count); ?></td>-->
                                <td><?php echo e($item->order_number); ?></td>
                                <td><?php echo e($item->company_name); ?></td>
                                <!--- <td>{ order_number}}</td> --->
                                <!--- <td>{ ->name}}</td>--->
                                <td><?php echo e($item->country); ?></td>
                                <td><?php echo e($item->name); ?></td>

                                <td><?php echo e($item->email); ?></td>

                                <!----- <td>{ ->phonecode.' '. ->phone}</td> ----->

                                <td><?php
                                if(isset($item->profile_image)){
                                $logo = "<img src='https://myisoonline.com/public/" . $item->profile_image . "' width='60px'>"; } echo ($item->profile_image != "") ? $logo : ""  ?></td>

                                <td>Hello</td>

                                <td>
                                <?php if($item->last_login!=NULL){ ?>
                                    <?php echo e(date('d-m-y H:i:sA', strtotime($item->last_login))); ?>

                                    <?php } ?>
                                </td>

                                <!--<td> ->expiry_date </td>-->


                                <td>
                                    <button class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                            title="View Customer Details" value="" onclick="viewDetails(<?php echo e($item); ?>);"><i
                                            class="la la-info"></i>
                                    </button>
                                    <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Customer"
                                            onclick="editDetails(<?php echo e($item); ?>);">

                                        <span class="svg-icon svg-icon-md">									<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                                viewBox="0 0 24 24" version="1.1">										<g
                                                    stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect
                                                        x="0" y="0" width="24" height="24"></rect>											<path
                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                        fill="#5d78ff" fill-rule="nonzero"
                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path
                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                        fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>	                            </span>

                                    </button>


                                    <button class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                            onclick="deleteUser(<?php echo e($item->id); ?>)" title="Delete Customer">

                                        <span class="svg-icon svg-icon-md">									<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                                viewBox="0 0 24 24" version="1.1">										<g
                                                    stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect
                                                        x="0" y="0" width="24" height="24"></rect>											<path
                                                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                        fill="#5d78ff" fill-rule="nonzero"></path>											<path
                                                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                        fill="#5d78ff" opacity="0.3"></path>										</g>									</svg>								</span>

                                    </button>

                                    <a href="/edit_user/<?php echo e($item->id); ?>" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                       title="View Customer Forms">

								<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-09-29-132851/theme/html/demo1/dist/../src/media/svg/icons/Text/Dots.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

    <g stroke="none" stroke-width="1">

        <rect x="14" y="9" width="6" height="6" rx="3" fill="#5d78ff"/>

  <rect x="3" y="9" width="6" height="6" rx="3" fill="#5d78ff" fill-opacity="0.7"/>

 </g>

</svg><!--end::Svg Icon--></span>

                                    </a>

                                </td>

                            </tr>
                            <?php
                                $count++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </tbody>

                    </table>
                </div>
                <!--end: Datatable -->

            </div>

        </div>

    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Deleting User</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    </button>

                </div>

                <div class="modal-body">

                    <p>Are you sure you want to delete this entry?</p>

                </div>

                <div class="modal-footer">

                    <form action="<?php echo e(route('deleteuserd')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" id="userid" value="">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button type="submit" class="btn btn-danger">Yes</button>

                    </form>

                </div>

            </div>

        </div>

    </div>



    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    </button>

                </div>

                <form class="kt-form kt-form--label-right" id="addform" method="POST"
                      action="<?php echo e(route('updateuserinfo')); ?>" enctype="multipart/form-data">

                    <?php echo csrf_field(); ?>

                    <div class="modal-body">


                        <div class="kt-portlet__body">

                            <input type="hidden" name="id" id="editvalue" value="">

                            <div class="form-group row">

                                <div class="col-lg-4">

                                    <label for="address2">Company ID</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="number" id="order_number" name="order_number" class="form-control"
                                               placeholder="" >

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <label for="name">Username:</label>

                                    <input type="text" id="name" name="name" class="form-control"
                                           placeholder="Enter name">

                                    <span class="form-text text-muted">Please enter the client's Username</span>

                                </div>

                                <div class="col-lg-4">

                                    <label for="name">Email Address:</label>

                                    <input type="text" id="email" name="email" class="form-control"
                                           placeholder="Enter email">

                                    <span class="form-text text-muted">Please enter Email Address</span>

                                </div>


                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">

                                    <label for="password">Password:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="password" id="password" name="password" class="form-control"
                                               placeholder="Enter password">
                                        <span class="form-text text-muted">Minimum 6 characters, at least 1 number & at least 1 Capital letter</span>
                                        <!--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->

                                    </div>

                                </div>

                                <div class="col-lg-4">
                                    <label for="company_name">Company Name:</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control"
                                           placeholder="Enter Company Name">
                                </div>


                                <div class="col-lg-4">
                                    <label for="company_address">Company Address:</label>
                                    <textarea id="company_address" name="company_address" class="form-control"
                                              placeholder="Enter Company Address"></textarea>
                                </div>


                            </div>


                            <div class="form-group row">
                                <div class="col-lg-4">

                                    <label for="state">Company Phone Number.</label>

                                    <div class="kt-input-icon kt-input-icon--right" id='phone_div'>


                                    </div>
                                    <input type="hidden" name="phonecode" id="phonecode">
                                    <input type="hidden" name="phoneflag" id="phoneflag">
                                </div>
                                <div class="col-lg-4">
                                    <label for="country">Country:</label>
                                    <input type="text" id="country" name="country" class="form-control"
                                           placeholder="Enter Country">
                                </div>
                                <div class="col-lg-4">

                                    <label for="city">Managing Director:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="director" name="director" class="form-control"
                                               placeholder="Managing Director">

                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="name">Person responsible for ISO:</label>
                                    <input type="text" id="person_iso" name="person_iso" class="form-control"
                                           placeholder="Iso Person Name" required>
                                    <span class="form-text text-muted">Please enter the ISO contact person's name</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="contact_iso">Contact number of ISO person:</label>
                                    <div class="kt-input-icon kt-input-icon--right" id='iso_div'>
                                    </div>
                                    <input type="hidden" name="isophonecode" id="isophonecode">
                                    <input type="hidden" name="isophoneflag" id="isophoneflag">
                                </div>
                                <div class="col-lg-4">
                                    <label for="password">Email of ISO contact person:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="email" id="email_iso" name="email_iso" class="form-control"
                                               placeholder="Enter Iso Email" required>
                                        <!--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->
                                        <span class="form-text text-muted">Please enter the email address of ISO contact person</span>

                                    </div>
                                </div>


                            </div>

                            <div class="form-group row">

                                <div class="col-lg-4">

                                    <label for="zip">Sales Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="sales_process" name="sales_process" class="form-control"
                                               placeholder="Enter Sales Process">

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <label for="password">Purchasing Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="purchasing_process" name="purchasing_process"
                                               class="form-control" placeholder="Purchasing Process Owner">

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <label class="">Servicing of Contract Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="servicing_process" name="servicing_process"
                                               class="form-control" placeholder="Servicing of Contract Process Owner">

                                    </div>

                                </div>

                            </div>


                            <div class="form-group row">

                                <div class="col-lg-6">

                                    <label for="address1">Competency Process Owner:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="text" id="competency_process" name="competency_process"
                                               class="form-control" placeholder="Enter address1">

                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <label for="address2">Company Profile:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <input type="file" id="company_profile" name="company_profile"
                                               class="form-control" placeholder="Company Profile">

                                        <span class="form-text text-muted" id="downloadlink">

									 <a href="uploads/user/5f86bde211a21.pdf">Profile</a>

									</span>


                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">


                                <div class="col-lg-6">

                                    <label for="address1">Business Scope:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <textarea id="scope" name="business_scopes" class="form-control"></textarea>

                                    </div>

                                </div>

                                <!--<div class="col-lg-6">-->

                                <!--	<label for="last_login">Last login:</label>-->

                                <!--	<div class="kt-input-icon kt-input-icon--right">-->

                                <!--		<input type="date" id="last_login" name="last_login" class="form-control" readonly disabled>-->

                                <!--	</div>-->

                                <!--</div>-->
                            </div>


                            <div class="form-group row">

                                <div class="col-lg-8">

                                    <label for="user_image">Company Description:</label>

                                    <div class="kt-input-icon kt-input-icon--right">

                                        <textarea rows="8" class="form-control" id="Company_overview"
                                                  name="Company_overview"></textarea>

                                        <!-- <input type="text" id="Company_overview" name="Company_overview" class="form-control" > -->


                                    </div>


                                </div>

                                <div class="col-lg-4">

                                    <label for="user_image">Company Logo</label>

                                    <div class="kt-input-icon kt-input-icon--right">


                                        <div id="image-preview">

                                            <label for="image-upload" id="image-label"></label>

                                            <input type="file" accept="image/*" name="user_image" id="image-upload"
                                                   onchange="loadFile(event)"/>

                                            <p><label for="file" style="cursor: pointer;">Attach JPEG file only</label>
                                            </p>

                                            <p><img id="output" width="200px" height="200px"/></p>

                                        </div>

                                    </div>


                                </div>


                            </div>

                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="iso9001_certificate">ISO9001 Certificate:</label>&nbsp;&nbsp;<span id="view_9001"> </span>&nbsp;&nbsp;<a href="#" data-handle="iso9001" class="iso9001 delete-certificate">Delete</a>
                                    <input type="file" id="iso9001_certificate" accept=".pdf"
                                           name="iso9001_certificate">
                                    <!--<button type="button" class="new-file-upload"-->
                                    <!--        onclick="document.getElementById('iso9001_certificate').click()">Attach File-->
                                    <!--</button>-->

                                </div>
                                <div class="col-lg-4">
                                    <label for="iso9001_expirydate">Expiry date:</label>
                                    <input type="date" id="iso9001_expirydate" max="2999-12-31"
                                           name="iso9001_expirydate" class="form-control" placeholder="Expiry Date">
                                </div>
                                <div class="col-lg-4">
                                    <label for="iso9001_description">Description:</label>
                                    <textarea id="iso9001_description" name="iso9001_description" class="form-control"
                                              placeholder="Description for ISO9001 Certificate"></textarea>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="iso14001_certificate">ISO14001 Certificate:</label>&nbsp;&nbsp;<span id="view_4001"></span>&nbsp;&nbsp;<a href="#" data-handle="iso14001" class="iso4001 delete-certificate">Delete</a>
                                    <input type="file" id="iso14001_certificate" accept=".pdf"
                                           name="iso14001_certificate">
                                    <!--<button type="button" class="new-file-upload"-->
                                    <!--        onclick="document.getElementById('iso14001_certificate').click()">Attach-->
                                    <!--    File-->
                                    <!--</button>-->
                                </div>
                                <div class="col-lg-4">
                                    <label for="iso14001_expirydate">Expiry date:</label>
                                    <input type="date" id="iso14001_expirydate" max="2999-12-31"
                                           name="iso14001_expirydate" class="form-control" placeholder="Expiry Date">
                                </div>
                                <div class="col-lg-4">
                                    <label for="iso14001_description">Description:</label>
                                    <textarea id="iso14001_description" name="iso14001_description" class="form-control"
                                              placeholder="Description for ISO14001 Certificate"></textarea>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="iso45001_certificate">ISO45001 Certificate:</label>&nbsp;&nbsp;<span id="view_45001"></span>
                                        &nbsp;&nbsp;<a href="#" data-handle="iso45001" class="iso45001 delete-certificate">Delete</a>
                                    <input type="file" id="iso45001_certificate" accept=".pdf"
                                           name="iso45001_certificate">
                                </div>
                                <div class="col-lg-4">
                                    <label for="iso45001_expirydate">Expiry date:</label>
                                    <input type="date" id="iso45001_expirydate" max="2999-12-31"
                                           name="iso45001_expirydate" class="form-control" placeholder="Expiry Date">
                                </div>
                                <div class="col-lg-4">
                                    <label for="iso45001_description">Description:</label>
                                    <textarea id="iso45001_description" name="iso45001_description" class="form-control"
                                              placeholder="Description for ISO45001 Certificate"></textarea>
                                </div>

                            </div>

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


    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">View User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="modal-body">
                            <div class="kt-portlet__body">
                                <input type="hidden" name="id" id="editvalue" value="">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="address2">Company ID</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="number" id="order_number" name="order_number"
                                                   class="form-control" placeholder="" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="name">Username:</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Enter name" readonly disabled>
                                        <span class="form-text text-muted">Please enter the client's Username</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="name">Email Address:</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                               placeholder="Enter email" readonly disabled>
                                        <span class="form-text text-muted">Please enter Email Address</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="password">Password:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="password" id="password" name="password" class="form-control"
                                                   placeholder="Enter password" readonly disabled>
                                            <span class="form-text text-muted">Minimum 6 characters, at least 1 number & at least 1 Capital letter</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="company_name">Company Name:</label>
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                               placeholder="Enter Company Name" readonly disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="company_address">Company Address:</label>
                                        <textarea id="company_address" name="company_address" class="form-control"
                                                  placeholder="Enter Company Address" readonly disabled></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="state">Company Phone Number.</label>
                                        <div class="kt-input-icon kt-input-icon--right" id="view_phone_div">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="country">Country:</label>
                                        <input type="text" id="country" name="country" class="form-control"
                                               placeholder="Enter Country">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="city">Managing Director:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text" id="director" name="director" class="form-control"
                                                   placeholder="Managing Director" readonly disabled>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="name">Person responsible for ISO:</label>
                                        <input type="text" id="person_iso" name="person_iso" class="form-control"
                                               placeholder="Iso Person Name" required readonly disabled>
                                        <span
                                            class="form-text text-muted">Please enter the ISO contact person's name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="contact_iso">Contact number of ISO person:</label>
                                        <div class="kt-input-icon kt-input-icon--right" id='view_iso_div'>

                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <label for="password">Email of ISO contact person:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="email" id="email_iso" name="email_iso" class="form-control"
                                                   placeholder="Enter Iso Email" readonly disabled>
                                            <!--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->
                                            <span class="form-text text-muted">Please enter the email address of ISO contact person</span>

                                        </div>
                                    </div>


                                </div>

                                <div class="form-group row">

                                    <div class="col-lg-4">

                                        <label for="zip">Sales Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="sales_process" name="sales_process"
                                                   class="form-control" placeholder="Enter Sales Process" readonly
                                                   disabled>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <label for="password">Purchasing Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="purchasing_process" name="purchasing_process"
                                                   class="form-control" placeholder="Purchasing Process Owner" readonly
                                                   disabled>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <label class="">Servicing of Contract Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="servicing_process" name="servicing_process"
                                                   class="form-control"
                                                   placeholder="Servicing of Contract Process Owner" readonly disabled>

                                        </div>

                                    </div>

                                </div>


                                <div class="form-group row">

                                    <div class="col-lg-6">

                                        <label for="address1">Competency Process Owner:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="text" id="competency_process" name="competency_process"
                                                   class="form-control" placeholder="Enter address1" readonly disabled>

                                        </div>

                                    </div>
                                    <div class="col-lg-6">

                                        <label for="address2">Company Profile:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <input type="file" id="company_profile" name="company_profile"
                                                   class="form-control" placeholder="Company Profile" readonly disabled>

                                            <span class="form-text text-muted" id="downloadlink">

									 <a target='_blank' href="" id="view_company_profile">Profile</a>

									</span>


                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">


                                    <div class="col-lg-6">

                                        <label for="address1">Business Scope:</label>

                                        <div class="kt-input-icon kt-input-icon--right">

                                            <textarea id="scope" name="business_scopes" class="form-control" readonly
                                                      disabled></textarea>

                                        </div>

                                    </div>

                                    <!--<div class="col-lg-6">-->

                                    <!--	<label for="last_login">Last login:</label>-->

                                    <!--	<div class="kt-input-icon kt-input-icon--right">-->

                                    <!--		<input type="date" id="last_login" name="last_login" class="form-control" readonly disabled>-->

                                    <!--	</div>-->

                                    <!--</div>-->
                                </div>

                                <div class="form-group row">


                                    <div class="form-group row">

                                        <div class="col-lg-8">

                                            <label for="user_image">Company Description:</label>

                                            <div class="kt-input-icon kt-input-icon--right">

                                                <textarea rows="8" class="form-control" id="Company_overview"
                                                          name="Company_overview" readonly disabled></textarea>


                                            </div>


                                        </div>

                                        <div class="col-lg-4">

                                            <label for="user_image">Company Logo</label>

                                            <div class="kt-input-icon kt-input-icon--right">


                                                <div id="image-preview">

                                                    <label for="image-upload" id="image-label"></label>

                                                    <input type="file" accept="image/*" name="user_image"
                                                           id="image-upload" onchange="viewloadFile(event)"/>

                                                    <p><label for="file" style="cursor: pointer;">Attach JPEG file
                                                            only</label></p>

                                                    <p><img id="view_output" width="200px" height="200px"/></p>

                                                </div>

                                            </div>


                                        </div>


                                    </div>

                                    <div class="form-group row">

                                        <div class="col-lg-4">
                                            <label for="iso9001_certificate">ISO9001 Certificate:</label>
                                            <br>
                                            <span id="v_9001"> </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="iso9001_expirydate">Expiry date:</label>
                                            <input type="date" id="iso9001_expirydate" name="iso9001_expirydate"
                                                   max="2999-12-31" class="form-control" placeholder="Expiry Date"
                                                   readonly disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="iso9001_description">Description:</label>
                                            <textarea id="iso9001_description" name="iso9001_description"
                                                      class="form-control"
                                                      placeholder="Description for ISO9001 Certificate" readonly
                                                      disabled></textarea>
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <div class="col-lg-4">
                                            <label for="iso14001_certificate">ISO14001 Certificate:</label>
                                            <br>
                                            <span id="v_4001"> </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="iso14001_expirydate">Expiry date:</label>
                                            <input type="date" id="iso14001_expirydate" name="iso14001_expirydate"
                                                   max="2999-12-31" class="form-control" placeholder="Expiry Date"
                                                   readonly disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="iso14001_description">Description:</label>
                                            <textarea id="iso14001_description" name="iso14001_description"
                                                      class="form-control"
                                                      placeholder="Description for ISO14001 Certificate" readonly
                                                      disabled></textarea>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label for="iso45001_certificate">ISO45001 Certificate:</label>
                                            <br>
                                            <span id="v_45001"> </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="iso45001_expirydate">Expiry date:</label>
                                            <input type="date" id="iso45001_expirydate" name="iso45001_expirydate"
                                                   max="2999-12-31" class="form-control" placeholder="Expiry Date"
                                                   readonly disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="iso45001_description">Description:</label>
                                            <textarea id="iso45001_description" name="iso45001_description"
                                                      class="form-control"
                                                      placeholder="Description for ISO45001 Certificate" readonly
                                                      disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--<button type="submit" class="btn btn-danger">Update</button>-->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
        integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
      integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
      crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
        crossorigin="anonymous"></script>
<script>
    function deleteUser(id) {
        var userid = id;
        $("#userid").val(userid);
        $("#deleteUser").modal('show');
    }
    var intel_phone = '';
    var intel_iso_phone = '';
    function editDetails(data) {
        intel_phone = '';
        intel_iso_phone = '';
        $('#phone_div').empty().append(`<input type="text" id="phoneee" name="phone" class="form-control" placeholder="Phone">`);
        $('#iso_div').empty().append(`<input type="text" id="contact_isooo" name="contact_iso" class="form-control" placeholder="Iso Contact number" required>`);
        $("#view_9001").empty();
        $("#view_4001").empty();
        $("#view_45001").empty();
        $("#downloadlink").empty();
        console.log(data);
        $("#editvalue").val(data.id);
        $("input[name='idnumber']").val(data.idnumber);
        $("input[name='name']").val(data.name);
// 		 $("input[name='password']").val(data.password);
        $("input[name='email']").val(data.email);
        $("input[name='person_iso']").val(data.persone_iso);
        $("input[name='contact_iso']").val(data.contact_number_iso);
        $("input[name='email_iso']").val(data.emailaddress_iso);
        //$("input[name='iso_certificates']").val(data.iso_certificate);
        $('#view_iso').html('<a target="_blank" href="public/' + data.iso_certificate + '">View iso certificates</a>');
        $("input[name='expiry_date']").val(data.expiry_date);
        $("input[name='country']").val(data.country);

        $("input[name='phone']").val(data.phone);

        $("input[name='director']").val(data.director);

        $("input[name='sales_process']").val(data.sales_process);
        if (data.company_profile != null) {
            $('#downloadlink').html('<a target="_blank" href="public/' + data.company_profile + '">View Profile</a>');
        }
        //  $("input[name='company_profile']").val(data.company_profile);

        $("input[name='company_name']").val(data.company_name);

        $("textarea[name='company_address']").val(data.company_address);
//console.log(data.company_address);
        $("input[name='purchasing_process']").val(data.purchasing_process);

        $("input[name='servicing_process']").val(data.servicing_process);

        $("input[name='competency_process']").val(data.competency_process);

        $("input[name='order_number']").val(data.order_number);

        $("textarea[name='business_scopes']").val(data.scope);
        $("input[name='last_login']").val(data.last_login);

        $("textarea[name='Company_overview']").val(data.Company_overview);

/////
        $("input[name='iso9001_expirydate']").val(data.iso9001_expirydate);
        $("textarea[name='iso9001_description']").val(data.iso9001_description);

        $("input[name='iso14001_expirydate']").val(data.iso14001_expirydate);
        $("textarea[name='iso14001_description']").val(data.iso14001_description);

        $("input[name='iso45001_expirydate']").val(data.iso45001_expirydate);
        $("textarea[name='iso45001_description']").val(data.iso45001_description);

        let logo_src = "https://myisoonline.com/public/" + data.profile_image;
        $("#output").attr("src", logo_src);
//

        if (data.iso9001_certificate != null) {
            // $('#iso9001_certificate').addClass('has_file');
            $(".iso9001").show();
            $("#view_9001").append("<a target='_blank' href='https://myisoonline.com/public/" + data.iso9001_certificate + "'>View</a>");
        }else{
            $(".iso9001").hide();
        }
        if (data.iso14001_certificate != null) {
            // $('#iso14001_certificate').addClass('has_file');
            $("#view_4001").append("<a target='_blank' href='https://myisoonline.com/public/" + data.iso14001_certificate + "'>View</a>");
            $(".iso4001").show();
        }else{
            $(".iso4001").hide();
        }
        if (data.iso45001_certificate != null) {
            // $('#iso45001_certificate').addClass('has_file');
            $("#view_45001").append("<a target='_blank' href='https://myisoonline.com/public/" + data.iso45001_certificate + "'>View</a>");
            $(".iso45001").show();

        }else{
            $(".iso45001").hide();

        }


        var input = document.querySelector("#phoneee");
        if(data.phoneflag == "preferred" || data.phoneflag == null){
            intel_phone = window.intlTelInput(input, {
                separateDialCode: true,
                preferredCountries: ["us"],
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
        }else{
            intel_phone = window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: data.phoneflag,
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
        }


        var input = document.querySelector("#contact_isooo");
        if(data.iso_phone_flag == "preferred" || data.iso_phone_flag == null){
            intel_iso_phone = window.intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: ["us"],
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });
        }else{
            intel_iso_phone = window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: data.iso_phone_flag,
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
    }

        $("#editModal").modal('show');

    }


    function viewDetails(data) {
        $('#view_phone_div').empty().append(`<input type="text" id="view_phoneee" class="form-control" placeholder="Phone" readonly disabled>`);
        $('#view_iso_div').empty().append(`<input type="text" id="view_contact_isooo" class="form-control" placeholder="Iso Contact number" required  readonly disabled>`);


        $("#v_9001").empty();
        $("#v_4001").empty();
        $("#v_45001").empty();
        $("#downloadlink").empty();
        $("#editvalue").val(data.id);
        $("input[name='idnumber']").val(data.idnumber);
        $("input[name='name']").val(data.name);

        $("input[name='email']").val(data.email);
        $("input[name='person_iso']").val(data.persone_iso);
// 		 $("#contact_iso_view").val(data.iso_phone_code + data.contact_number_iso);
        $("#view_contact_isooo").val(data.contact_number_iso);
        $("input[name='email_iso']").val(data.emailaddress_iso);
        //$("input[name='iso_certificates']").val(data.iso_certificate);
        $('#view_iso').html('<a target="_blank" href="public/' + data.iso_certificate + '">View iso certificates</a>');

        $("input[name='expiry_date']").val(data.expiry_date);
        $("input[name='country']").val(data.country);

        // $("#phoneview").val(data.phonecode + data.phone);
        $("#view_phoneee").val(data.phone);

        $("input[name='director']").val(data.director);

        $("input[name='sales_process']").val(data.sales_process);

        if (data.company_profile != null) {
            $('#view_company_profile').show().attr('href', 'public/' + data.company_profile);
        } else {
            $('#view_company_profile').hide();
        }
        //  $("input[name='company_profile']").val(data.company_profile);

        $("input[name='company_name']").val(data.company_name);

        $("textarea[name='company_address']").val(data.company_address);
//console.log(data.company_address);
        $("input[name='purchasing_process']").val(data.purchasing_process);

        $("input[name='servicing_process']").val(data.servicing_process);

        $("input[name='competency_process']").val(data.competency_process);

        $("input[name='order_number']").val(data.order_number);

        $("textarea[name='business_scopes']").val(data.scope);

        $("textarea[name='Company_overview']").val(data.Company_overview);

/////
        $("input[name='iso9001_expirydate']").val(data.iso9001_expirydate);
        $("textarea[name='iso9001_description']").val(data.iso9001_description);

        $("input[name='iso14001_expirydate']").val(data.iso14001_expirydate);
        $("textarea[name='iso14001_description']").val(data.iso14001_description);

        $("input[name='iso45001_expirydate']").val(data.iso45001_expirydate);
        $("textarea[name='iso45001_description']").val(data.iso45001_description);

        let logo_src = "https://myisoonline.com/public/" + data.profile_image;
        $("#view_output").attr("src", logo_src);


//

        if (data.iso9001_certificate != null) {
            $("#v_9001").append("<a target='_blank' href='https://myisoonline.com/public/" + data.iso9001_certificate + "'>View</a>");
        } else {
            $('#v_9001').append('Not Found');
        }
        if (data.iso14001_certificate != null) {
            $("#v_4001").append("<a target='_blank' href='https://myisoonline.com/public/" + data.iso14001_certificate + "'>View</a>");
        } else {
            $('#v_4001').append('Not Found');
        }
        if (data.iso45001_certificate != null) {
            $("#v_45001").append("<a target='_blank' href='https://myisoonline.com/public/" + data.iso45001_certificate + "'>View</a>");
        } else {
            $('#v_45001').append('Not Found');
        }

        var input = document.querySelector("#view_phoneee");
        if(data.phoneflag == "preferred" || data.phoneflag == null){
            window.intlTelInput(input, {
                separateDialCode: true,
                preferredCountries: ["us"],
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
        }else{
            window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: data.phoneflag,
                customPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    return "e.g. " + selectedCountryPlaceholder;
                },
            });
        }

        var input = document.querySelector("#view_contact_isooo");

        if(data.iso_phone_flag == "preferred" || data.iso_phone_flag == null){
            window.intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: ["us"],
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });
        }else{
             window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: data.iso_phone_flag,
            customPlaceholder: function (
                selectedCountryPlaceholder,
                selectedCountryData
            ) {
                return "e.g. " + selectedCountryPlaceholder;
            },
        });
        }

        $("#viewModal").modal('show');

    }


</script>
<?php $__env->startSection('myscript'); ?>
    <script>

        $('.delete-certificate').on('click', function () {

            let _this = $(this),
                user_id = $('#editvalue').val();

            _this.closest('.form-group.row').find('.form-control').val('');
            _this.closest('.form-group.row').find('a').remove();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                }
            });

            let AjaxUrl = "<?php echo e(url('/remove_iso')); ?>";
            $.ajax({
                url: AjaxUrl,
                type: "Post",
                //dataType: "json",
                //async: false,
                data: {'handle': _this.data('handle'), 'user_id': user_id}
            }).done(function (response) {
                console.log(response);
            });
        });


        $("#addform").submit(function () {
            let intel_phone_data = intel_phone.getSelectedCountryData();
            let intel_iso_phone_data = intel_iso_phone.getSelectedCountryData();

            //For flags
            $("#phonecode").val(intel_phone_data.dialCode);
            $("#isophonecode").val(intel_iso_phone_data.dialCode);

            //For country code
            $("#phoneflag").val(intel_phone_data.iso2);
            $("#isophoneflag").val(intel_iso_phone_data.iso2);


            // var i = 1;
            // var j = 1;
            // $('.iti__selected-dial-code').each(function () {
            //     if (i == 1) {
            //         var code = $(this).text();
            //         $("#phonecode").val(code);

            //     } else {
            //         var code = $(this).text();
            //         $("#isophonecode").val(code);

            //     }
            //     i++;
            // });

            //iti__flag iti__pk


            // $(".iti__selected-flag").each(function () {
            //     // let flag = $(this).attr('aria-activedescendant');
            //     // console.log('flag',flag);
            //     if (j == 1) {
            //         var str = $(this).attr('aria-activedescendant');
            //         var n = str.lastIndexOf('-');
            //         var result = str.substring(n + 1);
            //         console.log("phoneflag is" + result);
            //         $("#phoneflag").val(result);
            //     } else {
            //         var str = $(this).attr('aria-activedescendant');
            //         var n = str.lastIndexOf('-');
            //         var result = str.substring(n + 1);
            //         console.log("isophoneflag is" + result);
            //         $("#isophoneflag").val(result);
            //     }
            //     j++;
            // });

        });
    </script>
<?php $__env->stopSection(); ?>
<script>

    var loadFile = function (event) {

        var image = document.getElementById('output');

        image.src = URL.createObjectURL(event.target.files[0]);

    };

    var viewloadFile = function (event) {

        var image = document.getElementById('view_output');

        image.src = URL.createObjectURL(event.target.files[0]);

    };


</script>

<?php echo $__env->make('admin.dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hashir/Documents/myiso/resources/views/admin/dashboard/admin/view_user.blade.php ENDPATH**/ ?>