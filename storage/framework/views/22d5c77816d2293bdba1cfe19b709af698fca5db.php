
<?php $__env->startSection('title'); ?>
Fixed Price Service
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<main>
    <div class="mainBanner fixedBanner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bannerLeft fixedBannerLeft">
                        <h3>Fixed-Fee <br> <span>Legal Services</span></h3>
                        <p class="commonPara">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed<br> aliquam id nibh ut
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
                        <img src="../assets/img/fixedFreeBanner.png" alt="" class="img-fluid">
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
                <select name="search" id="search" class="form-controller" >
                    <option disabled selected>Select Expertise</option>
                    <?php $__currentLoopData = $expertises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($expertise->id); ?>"><?php echo e($expertise->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="btnDiv">
                    <button onclick="fetchData()"><img src="../assets/img/searchBtnIcon.svg" alt="" class="img-fluid"> Search</button>
                </div>
            </div>

        </div>
    </div>
    <div class="bolgSection freeServiceSection">
        <div class="sortingDiv">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="selectDiv">
                            <p>Sort By</p>
                            <select name="" id="">
                                <option value="Low to High Price">Low to High Price</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="relatedService freeRelatedService">
        <div class="container-fluid">
            <div class="multiRelatedService">
                <div class="row" id="result">
                    <?php if(count($services) > 0): ?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4" id="card">
                        <div class="card" >
                            <img src="<?php echo e(asset('fixed_service/'.$service->image)); ?>" width="322px" height="210px" alt="" class="img-fluid">
                            <div class="cardContent">
                                <h4><?php echo e($service->time_limit); ?> <?php echo e($service->title); ?></h4>
                                <p class="tag"><?php echo e($service->short_des); ?></p>
                                <p class="line">.................................................................................</p>
                                <?php echo e($service->short_des); ?>

                                <div class="cardFooter">
                                    <h4><?php echo e($service->price); ?> <span>USD</span></h4>
                                    <a href="<?php echo e(route('fixed_service_detail', $service->id)); ?>" class="learnMore">Learn More <img src="../assets/img/sliderArrow.png" alt="" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
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
        const val = document.getElementById('search').value;

        //Search Url
        const url = "<?php echo e(route('search')); ?>" + "?search=" + val;

        console.log(url);
        fetch(url)
        .then((resp) => resp.json()) //Transform the data into json
        .then(function(data){
            if(document.getElementById('card'))
            {
               document.getElementById('card').style="display:none"; 
            }
            
            let expertises = data;
            console.log(expertises);

            document.getElementById('result').innerHTML = ``;
            expertises.map(function(expertise){
                
                document.getElementById('result').innerHTML += `

                     <div class="col-lg-4" id="card">
                        <div class="card" >
                            <img src="fixed_service/${expertise.image}" width="322px" height="210px" alt="" class="img-fluid">
                            <div class="cardContent">
                                <h4>${expertise.time_limit} ${expertise.title}</h4>
                                <p class="tag">${expertise.short_des}</p>
                                <p class="line">.................................................................................</p>
                                
                                <div class="cardFooter">
                                    <h4>${expertise.price}<span>USD</span></h4>
                                    <a href="fixed-service-detail/${expertise.id}" class="learnMore">Learn More <img src="../assets/img/sliderArrow.png" alt="" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
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
<?php echo $__env->make('layout.loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\expertgateway\resources\views/frontend/services.blade.php ENDPATH**/ ?>