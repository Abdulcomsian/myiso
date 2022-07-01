
<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <div class="profileDiv">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="editBar">
                            <h5>My Profile</h5>
                            <span>Edit Profile</span>
                        </div>
                        <div class="editProfileBox">
                            <div class="profileImg">
                                <img src="../assets/img/editProfile.png" alt="" class="img-fluid">

                            </div>
                            <div class="editProfile">
                                <div class="userDetail">
                                    <div class="avatar">
                                        <img src="../assets/img/avatar.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="userProfile">
                                        <h4>Aaron Bourke</h4>
                                        <p>King & Wood Mallesons</p>
                                    </div>
                                </div>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <div class="listDiv">
                                    <ul>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/locationIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span>134 lane, Business Tower</span>
                                        </li>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/languageIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span>Arabic, English</span>
                                        </li>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/consultantIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span>Legal consultant</span>
                                        </li>
                                        <li>
                                            <div class="imgDiv">
                                                <img src="../assets/img/lawIcon.png" alt="" class="img-fluid">
                                            </div>
                                            <span>Corporate Law</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <div class="editProfileContent">
                                    <h4>profile</h4>
                                    <p>Aaron Bourke is a Dubai-based lawyer who has gained exceptional knowledge and proficiency in Employment law, Real Estate, Succession, Commercial & Corporate laws. </p>
                                    <p>He has gained expertise in legal drafting, vetting and reviewing commercial contracts, especially agreements for construction and installation companies wills drafting in all three jurisdictions in UAE, with specific attention to probate procedures. He has effectively held a number of negotiation and settlement meetings for both individuals and corporate clients.</p>
                                    <p>After obtaining a master’s degree in Corporate law and taxation she joined as an Assistant Professor in one of the premium law schools in India and dealt successfully with various aspects of taxation. </p>
                                    <p>Currently, he is associated with King & Wood Mallesons</p>
                                    <div class="line">
                                        <img src="../assets/img/line.png" alt="" class="img-fluid">
                                    </div>
                                    <h4>Education</h4>
                                    <ul>
                                        <li>- LL.M.</li>
                                    </ul>
                                    <div class="line">
                                        <img src="../assets/img/line.png" alt="" class="img-fluid">
                                    </div>
                                    <h4>Associations & Memberships
                                    </h4>
                                    <ul>
                                        <li>- ICSI</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.lawyerlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/lawyer/dashboard/index.blade.php ENDPATH**/ ?>