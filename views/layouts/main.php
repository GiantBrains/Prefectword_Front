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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
     <?php if (isset($this->blocks['block5'])): ?>
        <?= $this->blocks['block5'] ?>
    <?php else: ?>
    <?php endif; ?>
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

<div class="wrap" style="background-image: url('/images/background.jpg');">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #1695a4  ; font-size: 20px;">Verified</strong><strong style="color: #3D715B; font-size: 20px;">Professors</strong>',
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
<button type="button" class="btn btn-sm btn-danger navbar-btn essay-font">Logout ('.Yii::$app->user->identity->username.')</button></a>';
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
    <div style="margin-top: -10px;">
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background-color: #242a35; height: auto">
    <div class="container" style="height: auto">
        <div id="navigation" style=" height: 20px; margin-bottom: 20px">
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
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/maestro.png" width="57px" height="19px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" alt="American Express" class="pm ae"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" width="45px" height="27px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" alt="MasterCard" class="pm mc"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" width="60px" height="17px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" alt="PayPal" class="pm paypal"></li>
            </ul>
            <ul class="pull-right hidden-lg hidden-md hidden-sm col-xs-12" style="text-align: center" >
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png"  width="40px" height="13px"  data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png" alt="Visa" class="pm visa"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" width="57px" height="19px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" alt="American Express" class="pm ae"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" width="45px" height="27px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" alt="MasterCard" class="pm mc"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" width="60px" height="17px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" alt="PayPal" class="pm paypal"></li>
            </ul>
        </div><!-- navigation -->
    </div>
    <center><span  class="essay-font" style="font-size: 13px; color: #a1a9b3">  &copy;  <?= Yii::$app->name?> <?= date('Y') ?>  All Rights Reserved</span></center>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
