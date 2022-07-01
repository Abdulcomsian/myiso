
<?php $__env->startSection('title'); ?>
Experts
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<main class="expertMain">
    <div class="mainBanner expertBanner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bannerLeft expertBannerLeft">
                        <h3>Experts</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed<br> aliquam id nibh ut
                            efficitur. Proin congue interdum lacus, sed<br> ornare augue viverra sit amet.</p>
                        <div class="searchBox desktopHide">
                            <div class="countryDiv">
                                <select name="" id="">
                                    <option value="Country">Country</option>
                                </select>
                            </div>
                            <div class="expertiseDiv">
                                <select name="" id="">
                                    <option value="Expertise">Expertise</option>
                                </select>
                                <div class="btnDiv">
                                    <button><img src="../assets/img/searchBtnIcon.svg" alt="" class="img-fluid">
                                        Search</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-6" style="padding: 0px;">
                    <div class="bannerRight">
                        <img src="../assets/img/expertBanner.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="searchBox mobileHide">
            <div class="countryDiv">
                <select name="" id="">
                    <option value="Country">Country</option>
                </select>
            </div>
            <div class="expertiseDiv">
                <select name="search_expert" id="search_expert">
                    <option disabled selected>Select Education</option>
                    <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($education->id); ?>"><?php echo e($education->education_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="btnDiv">
                    <button onclick="fetchData()"><img src="../assets/img/searchBtnIcon.svg" alt="" class="img-fluid"> Search</button>
                </div>
            </div>

        </div>
    </div>
    <div class="bolgSection">
        <div class="sortingDiv">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="selectDiv">
                            <p>Sort By</p>
                            <select name="" id="">
                                <option value="Latest">Latest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="multiBlog">
            <div class="row"  id="result">
                <?php if(count($lawyers) > 0): ?>
                <?php $__currentLoopData = $lawyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lawyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4" id="card">
                    <a href="<?php echo e(route('expert-detail',$lawyer['lawyer_profile'][0]->id)); ?>">
                        <div class="expertCard">
                            <img src="<?php echo e(asset('lawyer_profile/'.$lawyer['lawyer_profile'][0]->image)); ?>" style="width:292px;height:275px !important;" alt="" class="img-fluid">
                            <div class="cardContet">
                                <div class="rating">
                                    <p>
                                        <i class="fa fa-star"></i>
                                        <span>4.1</span>
                                    </p>
                                </div>
                                <div class="cardBody">
                                    <h3><?php echo e($lawyer->f_name); ?> <?php echo e($lawyer->l_name); ?></h3>
                                <p><?php echo e($lawyer['lawyer_profile'][0]->title); ?></p>
                                </div>
                                <div class="line">
                                    <img src="../assets/img/line.png" alt="" class="img-fluid">
                                </div>
                                <div class="cardFooter">
                                    <p>Address: <span><?php echo e($lawyer['lawyer_profile'][0]->address); ?></span></p>
                                    <p>Education: 
                                        <span>
                                            <?php
                                                $lawyer_educations = App\Models\LawyersHasEducation::where('lawyer_profile_id',$lawyer['lawyer_profile'][0]->id)->get();
                                            ?>
                                            <?php $__currentLoopData = $lawyer_educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($education->education->education_name); ?>

                                                <?php if(!($loop->last)): ?>
                                                ,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="contactDiv">
                                    <ul>
                                        <li>
                                            <button><img src="../assets/img/recentQuestionIcon.png" alt=""> ASK A QUESTION</button>
                                        </li>
                                        <li>
                                            <button><img src="../assets/img/chatIcon.svg" alt=""> CHAT</button>
                                        </li>
                                        <li>
                                            <button><img src="../assets/img/request.png" alt=""> REQUEST CALLBACK</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="paginationDiv">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="paginationList">
                            <ul>
                                <li>
                                    <img src="../assets/img/leftIcon.png" alt="">
                                </li>
                                <li>
                                    <a href="">1</a>
                                </li>
                                <li>
                                    <a href="">2</a>
                                </li>
                                <li>
                                    <a href="">3</a>
                                </li>
                                <li>
                                    <a href="">4</a>
                                </li>
                                <li>
                                    <a href="">5</a>
                                </li>
                                <li>
                                    <img src="../assets/img/rightIcon.png" alt="">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(count($news) > 0): ?>
    <div class="leatestNews">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="leatesNewContent">
                        <h2>Latest News</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam id nibh utitur Proin
                            congue interdum lacus.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="sliderDiv">
                        <div class="newsSlider">
                            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="newsCard">
                                <img src="<?php echo e(asset('news/'.$new->image)); ?>" width="223px" height="162px" alt="" class="img-fluid">
                                <div class="cardContent">
                                    <div class="date">
                                        <p><?php echo e(date('Y/m/d', strtotime($new->created_at))); ?></p>
                                    </div>
                                    <h4><?php echo e($new->title); ?></h4>
                                    <?php echo $new->description; ?>

                                    <!-- <a href="./aboutUs.html">Learn More <img src="<?php echo e(asset('assets/img/sliderArrow.png')); ?>" alt=""></a> -->
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="requestInformation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="informationContent">
                        <h2>Request Information</h2>
                        <div class="formDiv">
                            <form action="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="first_name" id="first_name"
                                                placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="last_name" id="last_name"
                                                placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="email" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="inputDiv">
                                            <input type="text" name="phone" id="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="inputDiv">
                                            <textarea name="message" id="message" placeholder="Message" cols="30"
                                                rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button>Submit Now</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="imgText">
                        <img src="../assets/img/information.png" alt="" class="img-fluid">
                        <div class="imgTextMiddle">
                            <p>Legal Advice<br> Across the<br> Globe</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    function fetchData()
    {
        //Search Value
        const val = document.getElementById('search_expert').value;

        //Search Url
        const url = "<?php echo e(route('search_expert')); ?>" + "?search_expert=" + val;

        fetch(url)
        .then((resp) => resp.json()) //Transform the data into json
        .then(function(data){
            if(document.getElementById('card'))
            {
                document.getElementById('card').style="display:none";
            }
            let experts = data;

            document.getElementById('result').innerHTML = ``;
            experts.map(function(expert){
                
                document.getElementById('result').innerHTML += `
                    <div class="col-lg-4" id="card">
                        <a href="expert-detail/${expert.id}">
                            <div class="expertCard">
                                <img src="lawyer_profile/${expert.image}" style="width:292px;height:275px !important;" alt="" class="img-fluid">
                                <div class="cardContet">
                                    <div class="rating">
                                        <p>
                                            <i class="fa fa-star"></i>
                                            <span>4.1</span>
                                        </p>
                                    </div>
                                    <div class="cardBody">
                                        <h3>${expert.f_name} ${expert.l_name}</h3>
                                    <p>${expert.title}</p>
                                    </div>
                                    <div class="line">
                                        <img src="../assets/img/line.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="cardFooter">
                                        <p>Address: <span>${expert.address}</span></p>
                                        <p>Education: 
                                            <span>
                                                <?php
                                                    $lawyer_educations = App\Models\LawyersHasEducation::where('lawyer_profile_id',$lawyer['lawyer_profile'][0]->id)->get();
                                                ?>
                                                <?php $__currentLoopData = $lawyer_educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($education->education->education_name); ?>

                                                    <?php if(!($loop->last)): ?>
                                                    ,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="contactDiv">
                                        <ul>
                                            <li>
                                                <button><img src="../assets/img/recentQuestionIcon.png" alt=""> ASK A QUESTION</button>
                                            </li>
                                            <li>
                                                <button><img src="../assets/img/chatIcon.svg" alt=""> CHAT</button>
                                            </li>
                                            <li>
                                                <button><img src="../assets/img/request.png" alt=""> REQUEST CALLBACK</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                `;

                 
                }); 
                    
        })
        .catch(function(error){
            console.log(error);
        })
    }

    function createNode(element)
    {
        return document.createElement(element);
    }

    function append(parent,el)
    {
        return parent.appendChild(el);
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/frontend/experts.blade.php ENDPATH**/ ?>