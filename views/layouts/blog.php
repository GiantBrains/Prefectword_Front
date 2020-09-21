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
<!--    <script type="text/javascript">-->
<!--        var conn = new WebSocket('ws://localhost:8080');-->
<!--        conn.onmessage = function(e) {-->
<!--            console.log('Response:' + e.data);-->
<!--        };-->
<!--        conn.onopen = function(e) {-->
<!--            console.log("Connection established!");-->
<!--            console.log('Hey!');-->
<!--            conn.send('Hey!');-->
<!--        };-->
<!---->
<!--        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->
<!--        (function(){-->
<!--            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->
<!--            s1.async=true;-->
<!--            s1.src='https://embed.tawk.to/5a9ae4dfd7591465c7083800/default';-->
<!--            s1.charset='UTF-8';-->
<!--            s1.setAttribute('crossorigin','*');-->
<!--            s0.parentNode.insertBefore(s1,s0);-->
<!--        })();-->
<!--    </script>-->
    <!--End of Tawk.to Script-->
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #71D8EC; font-size: 20px;">Verified</strong><strong style="color: #3D715B; font-size: 20px;">Professors</strong>',
//        'brandLabel' => Html::img('@web/images/logo.png', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #F5C34F ; font-size: 20px;">Verified</strong><strong style="color: #A2110A; font-size: 20px;">Professors</strong>',
        'brandUrl' => Yii::$app->request->baseUrl.'/',
        'options' => [
            'class' => 'navbar navbar-default1 navbar-fixed-top',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Log In ' , 'url' => Yii::$app->request->baseUrl.'/site/login',
            'active' => $this->context->route == 'site/login',
        ];
        $menuItems[] = '<a href="'.Yii::$app->request->baseUrl.'/site/signup"><button type="button" style="background-color:#90F1C8" class="btn btn-sm navbar-btn essay-font">Sign Up</button></a>';
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
<button type="button" class="btn btn-sm btn-info navbar-btn essay-font">Logout ('.Yii::$app->user->identity->username.')</button></a>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
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
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItem,
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
        <div class="row hidden-xs">
            <div class="col-md-4">
                <ul class="articles footer-link essay-font">
                    <li><a style="text-decoration: none; font-size: 20px;" <i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;support@verifiedprofessors.com</a></li>
                    <br>
                    <li><a style="text-decoration: none; font-size: 20px;" <i class="fa fa-phone fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;0741790736</a></li>
                </ul><br>
                <ul id="navigation" class="text-center hidden-xs">
                    <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png"  width="40px" height="13px"  data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png" alt="Visa" class="pm visa"></li>
                    <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" width="57px" height="19px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" alt="American Express" class="pm ae"></li>
                    <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" width="45px" height="27px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" alt="MasterCard" class="pm mc"></li>
                    <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" width="60px" height="17px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" alt="PayPal" class="pm paypal"></li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="articles footer-link essay-font">
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/">Home</a></li>
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/site/faq">FAQ</a></li>
                    <br>
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/how_it_works">How it works</a></li>
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/site/terms_and_conditions">Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="articles footer-link essay-font">
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/site/about">About Us</a></li>
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/order">Order Now</a></li>
                    <br>
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/site/privacy_policy">Privacy Policy</a></li>
                    <li><a style="text-decoration: none; font-size: 15px;" href="<?= Yii::$app->request->baseUrl?>/site/guarantee">Money Back Guarantee</a></li>
                  </ul>
            </div>
        </div>
    </div>
    <br><br>
    <center>
    <span style="color: #a1a9b3;" class="rating-desc" itemscope="" itemtype="http://schema.org/Product">
     <span style="display: none" itemprop="name">Verified Profesors</span>
     <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating"> Rated <span itemprop="ratingValue"><?= number_format(floatval($this->params['avgrating']), 1, '.', ',')?></span> / 5 based on <span itemprop="reviewCount"><?= number_format(floatval(11238+$this->params['count']), 0, '.', ',')?></span> Reviews. | <a style="color: #a1a9b3;" class="ratings" href="https://www.verifiedprofessors.com/site/reviews">All Reviews</a> </span>
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
