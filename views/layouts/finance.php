<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5f6cbb5bf0e7167d001375c3/default';
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
         'brandLabel' => Html::img('@web/'.$this->params['logo'].'', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' '.$this->params['name'].'',
        'brandUrl' => Yii::$app->request->baseUrl.'/order/index',
        'options' => [
            'class' => 'navbar navbar-default2 navbar-fixed-top',
        ],
    ]);

    $menuItem []= ['label' => 'My Orders', 'url' => Yii::$app->request->baseUrl.'/order/index',
        'active' => $this->context->route == 'order/index',
    ];
    $menuItem []= ['label' => 'Create Order', 'url' => Yii::$app->request->baseUrl.'/order/create',
        'active' => $this->context->route == 'order/create'
    ];
    $menuItem []=  ['label' => 'Settings',
        'items' => [
            [
                'label' => '<i class="fa fa-user" aria-hidden="true"></i> &nbsp; <span>Profile</span>',
                'url' => Yii::$app->request->baseUrl.'/user-profile/create',
                'active' => $this->context->route == 'user-profile/create'
            ],
            '<li role="separator" class="divider"></li>',
            [
                'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/user.png" style="height: 16px; " > &nbsp;<span>Account</span>',
                'url' => Yii::$app->request->baseUrl.'/site/account',
                'active' => $this->context->route == 'site/account'
            ],
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => $menuItem,
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => 'Log In ' , 'url' => Yii::$app->request->baseUrl.'/site/login',
            'active' => $this->context->route == 'site/login',
        ];
        $menuItems[] = '<a href="'.Yii::$app->request->baseUrl.'/site/register"><button type="button" class="btn btn-primary navbar-btn essay-font">Sign Up</button></a>';
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
                        <i class="fa fa-bell-o text-success"></i>
                        <span class="label label-info notifications-icon-count">0</span>
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
            'label' => $this->params['balance']?
                '<a style="height: 55px; margin-top: -35px;" href="'.Yii::$app->request->baseUrl.'/wallet/index"> <img style="height: 35px;" 
            src="'.Yii::$app->request->baseUrl.'/images/rating/wallet4.png" >'.'<span style="color: black; font-size: 18px; margin-top: 10px"> $'.number_format(floatval($this->params['balance']),
                    2, '.', ',').'</span>':'<a style="height: 55px; margin-top: -35px;" href="'.Yii::$app->request->baseUrl.'/wallet/index"> <img style="height: 35px;" 
            src="'.Yii::$app->request->baseUrl.'/images/rating/wallet.png"> <span style="color: black; font-size: 18px">$0.00</span>'.'</a>',
            'active' => $this->context->route == 'wallet/index'
        ];
        $menuItems[] = [
            'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/user.png" style="height: 35px; margin-top: -5px; margin-bottom: -10px" >',
            'items' => [
                [
                    'label' => '<i class="fa fa-user fa-2x" aria-hidden="true"></i> &nbsp; <span style="font-size: 20px">Profile</span>',
                    'url' => Yii::$app->request->baseUrl.'/user-profile/create',
                    'active' => $this->context->route == 'user-profile/create'
                ],
                '<li role="separator" class="divider"></li>',
                [
                    'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/wallet3.png" style="height: 32px; " > &nbsp; <span style="font-size: 20px">My Finances</span>',
                    'url' => Yii::$app->request->baseUrl.'/wallet/index',
                    'active' => $this->context->route == 'wallet/index'
                ],
                '<li role="separator" class="divider"></li>',
                [
                    'label' => '<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> &nbsp; <span style="font-size: 20px"> Logout ('.Yii::$app->user->identity->username.')</span>',
                    'url' => Yii::$app->request->baseUrl.'/site/logout',
                    'linkOptions' => ['data-method' => 'post']
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div style="margin-top: 60px">
        <?= Alert::widget() ?>
    </div>
    <div class="myfinance">
        <div class="row" style="margin-right: 0; margin-left: 0;">
            <h1><?= Html::encode($this->title) ?></h1>
            <hr>
            <div class="col-md-2" style="margin-bottom: 20px">
                <div style="border: solid; border-radius: 10px; border-top: none; border-width: thin; height: 275px; border-color: darkgrey">
                    <div style="border: solid; border-left: none; border-right: none; border-top-left-radius: 10px; background-color: #3D715B; border-top-right-radius: 10px; border-width: thin; height: 40px; border-color: darkgrey">
                        <h4 style="color:white; line-height: 20px; vertical-align: middle; margin-left: 20px">Balance</h4>
                    </div>
                    <div style=" border-bottom: solid;  height: 100px; border-width: thin;">
                        <h2 style="line-height: 70px; margin-left: 20px; vertical-align: middle; color: midnightblue"><?php if ($this->params['balance']){
                            echo '$'.number_format(floatval($this->params['balance']), 2, '.', ',');
                            }else{
                            echo '$0.00';
                            }?></h2>
                    </div>
                    <div class="wrapper row">
                        <a style="display: block; margin-top: 15px" href="<?= Yii::$app->request->baseUrl?>/wallet/index"><button style="width: 120px" class="btn btn-md btn-info <?=$this->params['deposit'] ?>"><span class="glyphicon glyphicon-import" style="font-size: 20px" aria-hidden="true"></span> &nbsp; Deposit</button></a>
                    </div>
                    <div class="wrapper row">
                        <a style="display: block; margin-top: 15px" href="<?= Yii::$app->request->baseUrl?>/wallet/withdraw"><button style="width: 120px" class="btn btn-md btn-info <?=$this->params['withdraw'] ?>"><span class="glyphicon glyphicon-export" style="font-size: 20px" aria-hidden="true"></span> &nbsp; Withdraw</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer" style="background-color: white; border-top-color: #0f0f0f;">
    <div class="container">
        <diV class="row" style="margin-top: -5px">
            <div class="col-md-1"></div>
            <ul class="hidden-lg hidden-md hidden-sm col-xs-12" style="list-style-type: none; text-align: center">
                <li><p  class="essay-font" style="font-size: 13px; color: #666666;"><?= Yii::$app->name?> &copy; <?= date('Y') ?>  All Rights Reserved &nbsp; </p></li>
                <li><a href="<?= \yii\helpers\Url::to(['site/terms_and_conditions'])?>"> &nbsp; Terms and Conditions</a></li>
            </ul>
            <div class="col-md-5 rights hidden-xs" style="margin-top: 5px">
                <ul class="pull-left hidden-xs">
                    <li><p  class="essay-font" style="font-size: 13px; color: #666666;"><?= Yii::$app->name?> &copy; <?= date('Y') ?>  All Rights Reserved &nbsp; </p></li>
                    <li><a href="<?= \yii\helpers\Url::to(['site/terms_and_conditions'])?>"> &nbsp; Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-5 hidden-xs">
                <ul class="pull-right pay-cards">
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/visapro.jpg"  alt="Visa" class="pm visa"></li>
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/amexpro.jpg" alt="American Express" class="pm ae"></li>
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/mcard.jpg" alt="MasterCard" class="pm mc"></li>
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/paypalpro.jpg" alt="PayPal" class="pm paypal"></li>
                </ul>
            </div>
            <ul class="hidden-lg hidden-md hidden-sm col-xs-12" style="list-style-type: none; text-align: center; background-color: white">
                <li class="col-xs-4"><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/visapro.jpg"  alt="Visa" class="pm visa"></li>
                <li class="col-xs-4"><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/amexpro.jpg" alt="American Express" class="pm ae"></li>
                <li class="col-xs-4"><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/mcard.jpg" alt="MasterCard" class="pm mc"></li>
                <li class="col-xs-12"  style="margin-top: 3px;"><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/paypalpro.jpg" alt="PayPal" class="pm paypal"></li>
            </ul>
            <div class="col-md-1">

            </div>
        </diV>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
