<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use \machour\yii2\notifications\widgets\NotificationsWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow,noodp,noydir">
    <?= Html::csrfMetaTags() ?>
     <?php if (isset($this->blocks['block5'])): ?>
        <?= $this->blocks['block5'] ?>
    <?php else: ?>
    <?php endif; ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src='https://scanverify.com/javascript.js'> </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115152658-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-115152658-1');
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var conn = new WebSocket('ws://localhost:8080');
        conn.onmessage = function(e) {
            console.log('Response:' + e.data);
        };
        conn.onopen = function(e) {
            console.log("Connection established!");
            console.log('Hey!');
            conn.send('Hey!');
        };

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5a9ae4dfd7591465c7083800/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #5bc0de; font-size: 20px; border-color: #46b8da;">Doctorate</strong><strong style="color: midnightblue; font-size: 20px;">Essays</strong>',
        'brandUrl' => Yii::$app->request->baseUrl.'/',
        'options' => [
            'class' => 'navbar navbar-default1 navbar-fixed-top',
        ],
    ]);
    $menuItem []= ['label' => 'How it Works', 'url' => ['/how_it_works'],
        'active' => $this->context->route == 'site/how_it_works'
    ];
    $menuItem []=  ['label' => 'Services', 'url' => ['/services'],
        'active' => $this->context->route == 'site/services'
    ];
    $menuItem []=  ['label' => 'About Us', 'url' => ['/about'],
        'active' => $this->context->route == 'site/about',
        'visible' => Yii::$app->user->isGuest
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItem,
        'encodeLabels' => false,
    ]);

    $menuItems []=  ['label' => '<i style="color: orange" class="fa fa-phone" aria-hidden="true"></i>: <span>+1-814-250-1019</span>'];
    $menuItems []=  ['label' => '<i style="color: orange" class="fa fa-envelope" aria-hidden="true"></i>: <span>support@doctorateessays.com  
     </span>'];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Log In ' , 'url' => Yii::$app->request->baseUrl.'/site/login',
            'active' => $this->context->route == 'site/login',
        ];
        $menuItems[] = '<a href="'.Yii::$app->request->baseUrl.'/site/signup"><button type="button" class="btn btn-sm btn-primary navbar-btn essay-font">Sign Up</button></a>';
    } else {
        $menuItems[] =
            ''.NotificationsWidget::widget([
                'theme' => NotificationsWidget::THEME_GROWL,
                'clientOptions' => [
                    'location' => 'br',
                ],
                'counters' => [
                    '.notifications-header-count',
                    '.notifications-icon-count'
                ],
                'markAllSeenSelector' => '#notification-seen-all',
                'listSelector' => '#notifications',
            ]).'
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning notifications-icon-count">0</span>
                    </a>
                    <ul class="dropdown-menu" style="width: auto; min-width: 250px; max-width: 320px">
                        <li class="header">You have <span class="notifications-header-count">0</span> notifications</li>
                        <li>
                            <ul class="menu">
                                <div id="notifications"></div>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>';
        $menuItems[] = [
            'label' => 'Dashboard',
            'url' => Yii::$app->request->baseUrl.'/order/index',
            'active' => $this->context->route == 'order/index'
        ];

        $menuItems[] = '<a data-method="post" href="'.Yii::$app->request->baseUrl.'/site/logout">
<button type="button" class="btn btn-sm btn-danger navbar-btn essay-font">Logout ('.Yii::$app->user->identity->username.')</button></a>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>
    <div style="margin-top: 60px">
        <?= Alert::widget() ?>
    </div>
    <div style="margin-top: -10px">
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background-color: #242a35; height: auto">
    <div class="container" style="height: auto">
        <div id="navigation" style=" height: 20px; margin-bottom: 30px">
            <ul class="pull-left footer-link essay-font" style="font-size: 13px; color: #a1a9b3">
                <div class="hidden-xs">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/terms_and_conditions">&nbsp; Terms & Conditions &nbsp;</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/faq">&nbsp; FAQ &nbsp;</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/reviews">&nbsp; Reviews &nbsp;</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/contact">&nbsp; Contact Us &nbsp;</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/privacy_policy">Privacy Policy</a></li>
                </div>
                <div class="hidden-lg hidden-md hidden-sm col-xs-12" style="text-align: center">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/terms_and_conditions">&nbsp; Terms & Conditions &nbsp;</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/faq">&nbsp; FAQ &nbsp;</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/reviews">&nbsp; Reviews &nbsp;</a></li>
                </div>
                <div class="hidden-lg hidden-md hidden-sm col-xs-12" style="text-align: center">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/contact">&nbsp; Contact Us &nbsp;</a></li>
                    <li><a class="f-link essay-font" style="font-size: 13px;"  href="<?= Yii::$app->request->baseUrl?>/site/privacy_policy">Privacy Policy</a></li>
                </div>
            </ul>

            <ul class="pull-right hidden-xs">
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png"  width="40px" height="13px"  data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png" alt="Visa" class="pm visa"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" width="57px" height="19px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" alt="American Express" class="pm ae"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" width="45px" height="27px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" alt="MasterCard" class="pm mc"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" width="60px" height="17px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" alt="PayPal" class="pm paypal"></li>
                <!-- Begin ScanVerify Seal Code -->
                <li><a target=_blank href="https://scanverify.com/siteverify.php?ref=stp&site=doctorateessays.com">
                        <img src='https://scanverify.com/seal/seal.php?site=https://www.google.com/recaptcha/api/siteverify' height="40px" border=0 ALT='ScanVerify.com Trust Seal' ></a></li>
                <!-- End ScanVerify Seal Code -->
            </ul>
            <ul class="pull-right hidden-lg hidden-md hidden-sm col-xs-12" style="text-align: center" >
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png"  width="40px" height="13px"  data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png" alt="Visa" class="pm visa"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" width="57px" height="19px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" alt="American Express" class="pm ae"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" width="45px" height="27px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" alt="MasterCard" class="pm mc"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" width="60px" height="17px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" alt="PayPal" class="pm paypal"></li>
            </ul>
        </div><!-- navigation -->
        <div class="row hidden-xs">
            <div class="col-md-3">
                <ul class="articles footer-link essay-font">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/part-time-students">Part time students</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/extra-credit-paper">Extra credit paper </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/plagiarism-free-work">Plagiarism free work</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/pass-college-assignments">Pass college assignments</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/online-assignments-help">Online assignments help </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/urgent-homework-help">Urgent homework help </a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/avoid-failing">Avoid failing </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/pass-your-assignments">Pass your assignments </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/statement-of-purpose-writing">Statement of Purpose writing </a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="articles footer-link essay-font">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/write-my-paper">Write my paper</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/take-online-class">Take online class</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/improve-my-grades">Improve my grades</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/buy-online-essay">Buy online essay</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/proofreading-and-editing">Proofreading and Editing</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/assignment-solutions-for-you">assignment solutions for you</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/group-projects"> Group projects </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/final-project-help">Final project help </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/pay-for-paper">Pay for paper </a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="articles footer-link essay-font">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/online-tutors">Online Tutors</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/maths-statistics-help">Maths & Statistics help</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/dissertation-or-thesis-writing">Dissertation or Thesis writing</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/best-online-tutors">Best online tutors</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/do-my-homework">Do my homework</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/essay-writing-online">Essay writing online</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/quick-paper-writing"> Quick paper writing</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/paraphrasing-and-rewriting">Paraphrasing and rewriting </a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="articles footer-link essay-font">
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/custom-writing">Custom writing</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/write-my-paper-cheap">Write my paper cheap</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/urgent-essay-writing">Urgent essay writing</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/english-essays">English essays</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/plagiarism-report">Plagiarism report </a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/paper-revision">Paper revision</a></li>
                    <br>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/buy-assignments"> Buy assignments</a></li>
                    <li><a href="<?= Yii::$app->request->baseUrl?>/site/article/buy-personal-statement">Buy personal statement </a></li>
                </ul>
            </div>
        </div>
    </div>
    <center>
    <span style="color: #a1a9b3;" class="rating-desc" itemscope="" itemtype="http://schema.org/Product">
     <span style="display: none" itemprop="name">Doctorate Essays</span>
     <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating"> Rated <span itemprop="ratingValue"><?= number_format(floatval($this->params['avgrating']), 1, '.', ',')?></span> / 5 based on <span itemprop="reviewCount"><?= number_format(floatval(11238+$this->params['count']), 0, '.', ',')?></span> Reviews. | <a style="color: #a1a9b3;" class="ratings" href="https://www.doctorateessays.com/site/reviews">All Reviews</a> </span>
    </span>
    </center>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
        $(function() {
            var chat = new WebSocket('ws://localhost:8080');
            chat.onmessage = function(e) {
                $('#response').text('');

                var response = JSON.parse(e.data);
                if (response.type && response.type == 'chat') {
                    $('#chat').append('<div><b>' + response.from + '</b>: ' + response.message + '</div>');
                    $('#chat').scrollTop = $('#chat').height;
                } else if (response.message) {
                    $('#response').text(response.message);
                }
            };
            chat.onopen = function(e) {
                $('#response').text("Connection established! Please, set your username.");
            };
            $('#btnSend').click(function() {
                if ($('#message').val()) {
                    chat.send( JSON.stringify({'action' : 'chat', 'message' : $('#message').val()}) );
                } else {
                    alert('Enter the message')
                }
            })

            $('#btnSetUsername').click(function() {
                if ($('#username').val()) {
                    chat.send( JSON.stringify({'action' : 'setName', 'name' : $('#username').val()}) );
                } else {
                    alert('Enter username')
                }
            })
        })
    </script>
    <center><span  class="essay-font" style="font-size: 13px; color: #a1a9b3">  &copy;  <?= Yii::$app->name?> <?= date('Y') ?>  All Rights Reserved</span></center>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
