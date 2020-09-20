<div class="site-index1" style="background-image: url('images/slides/7.jpg');">
    <div class="container" style="z-index: 100; color: white;">
        <?php Yii::$app->timezone->name ?>
        <div class="row superslide">
            <div class="col-md-6 col-xs-12">
            </div>
            <div class="col-md-6 col-xs-12"
                 style="background-color: white; opacity: 0.8; border-radius: 10px; color: black">
                <div class="hidden-xs">
                    <h1 style="font-weight: bolder; font-family: 'Open Sans', sans-serif; ">Quality Academic
                        Writing</h1>
                    <h2 style="font-weight: bolder; font-family: 'Open Sans', sans-serif;">Service at an Affordable
                        Price.</h2>
                    <h4 style="font-family: 'Open Sans', sans-serif; font-size: 18px">Hire us, sit back and
                        relax…….We’ll do it for you.</h4>
                </div>
                <div class="row hidden-xs" style="margin-top: 32px">
                    <div class="col-md-2 hidden-xs">

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo '<a class="btn btn-lg btn-info" href="' . Url::to(['/site/signup']) . '">Sign Up</a>';
                        } else {
                            echo '<a class="btn btn-lg btn-warning" href="' . Url::to(['/order/index']) . '">Dashboard</a>';
                        }
                        ?>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <a class="btn btn-lg btn-primary" href="<?= Url::to(['/order/create']) ?>">Order Now</a>
                    </div>
                </div>
                <div class="hidden-xs" style="margin-top: 50px;">
                    <h4 style="font-family: 'Open Sans', sans-serif; font-size: 18px">Get 100% <strong
                            style="color: #5bc0de;">UNIQUE & QUALITY</strong> work delivered to you <strong
                            style="color: #5bc0de;">ON TIME</strong>.</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-index2">
    <div class="body-container essay-font" style="background-color: white;">
        <div class="container" style="background-color: white;">
            <div class="row" style="height: auto; margin-bottom: 20px;">
                <h2 style="text-align: center; color: black;font-family: 'JetBrains Mono'">MAIN BENEFITS</h2>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><img width="130px" style="margin-top: 20px;border-radius: 30px"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/registration.jpg"></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>No registration fees</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-envelope fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none;color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>Payments always on time</strong>
                        </li>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em;color: #3D715B;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>Orders in the sphere of your interest</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><img width="130px" style="border-radius: 30px"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/customer.jpg"></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>24/7 available support team</strong>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row" style="height: auto; margin-bottom: 20px; color: #46b8da;">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-check fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none;color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>High wages</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-envelope fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>Manage your time and workload yourself</strong>
                        </li>

                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; none; font-size: 18px; text-align: center">
                        <li>
                            <strong>Working from home</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="height: auto; margin-bottom: 20px;background-color: #f0f2f6">
    <div class="row" style="margin-bottom: 20px;">
        <h2 class="essay-font" style="text-align: center;font-family: 'JetBrains Mono'">HOW IT WORKS</h2>
    </div>
    <center>
        <div class="col-md-2">
            <div style="height: 90px">
                <div class="row">
                    <div class="col-md-8 essay-font hidden-xs">
                        <img width="150px" style="border-radius: 30px"
                             src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/place-order.png">
                        <p style="vertical-align: middle">PLACE YOUR ORDER</p>
                    </div>
                    <p class="hidden-md hidden-lg hidden-sm">PLACE YOUR ORDER</p>
                    <div class="col-md-4 col-sm-2 col-xs-12">
                        <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                           class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                           aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <center>
        <div class="col-md-2 col-sm-2 col-xs-12">
            <div class="row">
                <div class="col-md-8 essay-font hidden-xs">
                    <img width="150px" style="border-radius: 30px"
                         src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/preparation.png">
                    <p style="vertical-align: middle">The writer prepares sources for your work</p>
                </div>
                <p class="hidden-md hidden-lg hidden-sm">The writer prepares sources for your work</p>
                <div class="col-md-4 col-sm-2 col-xs-12">
                    <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                       class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                    <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                       aria-hidden="true"></i>
                </div>
            </div>
    </center>
    <center>
        <div class="col-md-2 col-sm-2 col-xs-12">
            <div class="row">
                <div class="col-md-8 essay-font hidden-xs">
                    <img width="150px" style="border-radius: 30px"
                         src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/complete.jpg">
                    <p style="vertical-align: middle">The writer completes your paper</p>
                </div>
                <p class="hidden-md hidden-lg hidden-sm">The writer completes your paper</p>
                <div class="col-md-4 col-sm-2 col-xs-12">
                    <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                       class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                    <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                       aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </center>
    <center>
        <div class="col-md-2 col-sm-2 col-xs-12">
            <div class="row">
                <div class="col-md-8 essay-font hidden-xs">
                    <img width="150px"
                         src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/polished.png">
                    <p style="vertical-align: middle">The writer polishes your paper</p>
                </div>
                <p class="hidden-md hidden-lg hidden-sm">The writer polishes your paper</p>
                <div class="col-md-4 col-sm-2 col-xs-12">
                    <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                       class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                    <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                       aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </center>
    <center>
        <div class="col-md-2 col-sm-2 col-xs-12">
            <div class="col-md-8 essay-font hidden-xs">
                <p style="vertical-align: middle"><strong><h4 style="font-family: 'Comfortaa', cursive;">YOU RECEIVE THE FINAL PAPER</h4></strong></p>
            </div>
            <p class="hidden-md hidden-lg hidden-sm">YOU RECEIVE THE FINAL PAPER</p>
            <div class="col-md-4 col-sm-2 col-xs-12">
                <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                   class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                   aria-hidden="true"></i>
            </div>
        </div>
    </center>
    <center>
        <div class="col-md-2 col-sm-2 col-xs-12">
            <div class="col-md-8 essay-font hidden-xs">
                <p style="vertical-align: middle"><i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                                                     class="fa fa-check-circle fa-5x hidden-xs" aria-hidden="true"></i></p>
            </div>
            <p class="hidden-md hidden-lg hidden-sm">Checked</p>
            <div class="col-md-4 col-sm-2 col-xs-12">
                <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                   aria-hidden="true"></i>
            </div>
        </div>
    </center>
</div>
<div class="row" style="margin-bottom: 20px">
    <center><a href="<?= Url::to(['site/how_it_works']) ?>">
            <button style="border-radius: 30px;background-color: #90F1C8" type="button" class="btn btn-lg essay-font">Learn
                More
            </button>
        </a></center>
    <br>
</div>
<div class="row" style="background-color: white; font-family: 'Open Sans', sans-serif;line-height: 2.0">
    <div class="container">
        <div class="col-md-4 col-sm-4">
            <h2 style="font-family: 'JetBrains Mono'"><strong>Moneyback Guarantee</strong></h2>
            <p>Are you searching for a website that will guarantee you good grades?
                One of the best essay writing service provider is DoctorateEssays.
                With a team of proficient writers from native English speaking countries,
                we promise to deliver quality work to you on time. Our writers are available 24/7
                to handle all your projects regardless of the deadline or the difficulty.
                We write all papers from scratch and highly penalize any writer who tries to
                deliver plagiarized writing to you. All revisions are free until you are 100%
                satisfied with your paper.</p>
            <center><img src="<?= Yii::$app->request->baseUrl ?>/images/page/money-back-guarantee2.png"
                         width="222px"></center>
            <center><a href="<?= Url::to(['site/guarantee']) ?>">
                    <button style="border-radius: 30px; background-color: #90F1C8" type="button" class="btn btn-lg essay-font">
                        Money back guarantee
                    </button>
                </a></center>
        </div>
        <div class="col-md-8 col-sm-4">
            <center><h2 style="font-family: 'JetBrains Mono'"><strong>Who we are</strong></h2></center>
            <p>Verified Preffessors is a reliable partner for professional freelance writers who are looking for a trustworthy long-term cooperation. For those pursuing personal development, our company is also the right choice since we offer numerous interesting projects and opportunities for self-improvement. Besides, our support team members are always ready to help as they work 24/7.
                If writing is what you like, you are welcome to give it a try with us!</p>
        </div>
    </div>
</div>
<div class="body-container essay-font" style="background-color: #3D715B">
    <div class="container">
        <div class="row" style="height: auto; color: #69D9F4;margin-top: 10px">
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/approved.png"></center>
                <h1 class="numbers-with-commas"
                    style="color:white; font-size: 60px; font-weight: 900; text-align: center"><?= number_format(floatval($allorders), 0, '.', ',') ?></h1>
                <h5 style="color:white; text-align: center">COMPLETED ORDERS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/satisfied.png"></center>
                <h1 class="numbers-with-commas" style="color:white; font-size: 60px; font-weight: 900; text-align: center">52</h1>
                <h5 style="color:white; text-align: center">SATISFIED CLIENTS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/tick.png"></center>
                <h1 style="color:white; font-size: 60px; font-weight: 900; text-align: center">97.64<sup>%</sup></h1>
                <h5 style="color:white; text-align: center;">POSITIVE FEEDBACKS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/rep.jpg"></center>
                <h1 class="numbers-with-commas" style="color:white; font-size: 60px; font-weight: 900; text-align: center">8</h1>
                <h5 style="color:white; text-align: center">SUPPORT REPRESENTATIVES</h5>
            </div>
        </div>
    </div>
</div>
<div class="row"">
        <div class="row essay-font" style="margin-bottom: 20px; text-align: center">
            <h1>WHY CHOOSE US</h1>
        </div>
        <div class="col-md-4">
            <div class="col-md-11">
                <div class="row block-reason">
                    <div class="col-md-3  col-sm-3 col-xs-3 svg-back">
                        <i class="fa fa-graduation-cap fa-3x"
                           style="color: white; line-height: 60px; vertical-align: middle"
                           aria-hidden="true"></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <p style="font-size: 20px;">More than 10 years <span
                                style="font-weight: 900">Experience</span></p>
                    </div>
                </div>
                <div class="row block-reason">
                    <div class=" col-md-3 col-sm-3 col-xs-3 svg-back">
                        <i class="fa fa-check-circle fa-3x"
                           style="color: white; line-height: 60px; vertical-align: middle"
                           aria-hidden="true"></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <p style="font-size: 20px;">100 percent <b style="font-weight: 900">Original</b> <span>Paper</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-11">
                <div class="row block-reason">
                    <div class=" col-md-3 col-sm-3 col-xs-3 svg-back">
                        <i class="fa fa-clock-o fa-3x"
                           style="color: white; line-height: 60px; vertical-align: middle"
                           aria-hidden="true"></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <p style="font-size: 20px;">Delivers on <b style="font-weight: 900">Urgent</b> <span>Orders</span>
                        </p>
                    </div>
                </div>
                <div class="row block-reason">
                    <div class=" col-md-3 col-sm-3 col-xs-3 svg-back">
                        <i class="fa fa-th-list fa-3x"
                           style="color: white; line-height: 60px; vertical-align: middle"
                           aria-hidden="true"></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <p style="font-size: 20px;">All writing <b style="font-weight: 900">Subjects</b> <span>Offered</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-11">
                <div class="row block-reason">
                    <div class="col-md-3 col-sm-3 col-xs-3 svg-back">
                        <i class="fa fa-percent fa-3x"
                           style="color: white; line-height: 60px; vertical-align: middle"
                           aria-hidden="true"></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9" 0
                    <p style="font-size: 20px;">Amazing <b style="font-weight: 900">Discounts</b>
                        <span>offered</span></p>
                </div>
            </div>
            <div class="row block-reason">
                <div class="col-md-3 col-sm-3 col-xs-3 svg-back">
                    <i class="fa fa-certificate fa-3x"
                       style="color: white; line-height: 60px; vertical-align: middle" aria-hidden="true"></i>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <p style="font-size: 20px;">Amazing <b style="font-weight: 900">Features</b> <span>for every order</span>
                    </p>
                </div>
            </div>
        </div>
</div>
