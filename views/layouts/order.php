<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use kartik\sidenav\SideNav;
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
    <
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
                'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/profile1.png" style="height: 16px; " > &nbsp;<span>Account</span>',
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
        $menuItems[] = '<a href="'.Yii::$app->request->baseUrl.'/user/signup"><button type="button" class="btn btn-primary navbar-btn essay-font">Sign Up</button></a>';
    } else {
        $menuItems[] =
            \app\components\Notification::KEY_NEW_MESSAGE ? ''.NotificationsWidget::widget([
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
                </li>': '<li class="dropdown notifications-menu">
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
            'label' => $this->params['balance']?
                '<a style="height: 55px; margin-top: -35px;" href="'.Yii::$app->request->baseUrl.'/wallet/index"> <img style="height: 35px;" 
            src="'.Yii::$app->request->baseUrl.'/images/rating/wallet.png" >'.'<span style="color: black; font-size: 18px; margin-top: 10px"> $'.number_format(floatval($this->params['balance']),
                2, '.', ',').'</span>':'<a style="height: 55px; margin-top: -35px;" href="'.Yii::$app->request->baseUrl.'/wallet/index"> <img style="height: 35px;" 
            src="'.Yii::$app->request->baseUrl.'/images/rating/wallet.png"> <span style="color: black; font-size: 18px">$0.00</span>'.'</a>',
            'active' => $this->context->route == 'wallet/index'
                ];
        $menuItems[] = [
           'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/profile1.png" style="height: 35px; margin-top: -5px; margin-bottom: -10px" >',
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
    <div class="mycontent">
        <div class="row" style="margin-right: 0; margin-left: 0; color: #133111">
            <div class="col-md-3 col-sm-3 hidden-xs">
                <div class="sidebar">
                    <?php
                    $type = 'success';
                    $item = 'home';
                    echo SideNav::widget([
                        'type' => $type,
                        'encodeLabels' => false,
                        'heading' => '<i class="fa fa-cog fa-spin" aria-hidden="true"></i><strong style="color: #3D715B"> Order Operations</strong>',
                        'items' => [
                            //
                            //
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            //
                            // NOTE: The variable `$item` is specific to this demo page that determines
                            // which menu item will be activated. You need to accordingly define and pass
                            // such variables to your view object to handle such logic in your application
                            // (to determine the active status).
                            //
                            //
                            ['label' => '<i class="fa fa-dashboard text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Dashboard</strong>','active' => $this->context->route == 'order/index', 'url' => Yii::$app->request->baseUrl.'/order/index'],
                            ['label' => '<i class="fa fa-plus text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Place Order</strong>',  'active' => $this->context->route == 'order/create', 'url' => Yii::$app->request->baseUrl.'/order/create'],
                            ['label' =>  $this->params['pending_count'] ? '<i class="fa fa-list text-success" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['pending_count'].'</span><strong style="color: #3D715B"> Pending</strong>':
                                '<i class="fa fa-list text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Pending</strong>', 'active' => $this->context->route == 'order/pending','url' => Yii::$app->request->baseUrl.'/order/pending'],
                            ['label' => $this->params['available_count'] ? '<i class="fa fa-clock-o" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['available_count'].'</span><strong style="color: #3D715B"> Waiting to be assigned</strong>':
                                '<i class="fa fa-clock-o text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Waiting to be assigned</strong>', 'active' => $this->context->route == 'order/available', 'url' => Yii::$app->request->baseUrl.'/order/available'],
                            ['label' =>  $this->params['active_count'] ? '<i class="fa fa-spinner fa-spin text-success" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['active_count'].'</span><strong style="color: #3D715B"> In Progress</strong>':
                                '<i class="fa fa-spinner fa-spin text-success" aria-hidden="true"></i><strong style="color: #3D715B"> In Progress</strong>', 'active' => $this->context->route == 'order/active', 'url' => Yii::$app->request->baseUrl.'/order/active'],
                            ['label' =>  $this->params['cancel_count'] ? '<i class="fa fa-close text-success" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['cancel_count'].'</span><strong style="color: #3D715B"><strong style="color: #3D715B"> Cancelled</strong>':
                                '<i class="fa fa-close text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Cancelled</strong>', 'active' => $this->context->route == 'order/cancelled', 'url' => Yii::$app->request->baseUrl.'/order/cancelled'],
                            ['label' =>  $this->params['revision_count'] ? '<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> <span class="pull-right badge">'.$this->params['revision_count'].'</span><strong style="color: #3D715B"> Revision</strong>':
                                '<span class="glyphicon glyphicon-repeat text-success" aria-hidden="true"></span><strong style="color: #3D715B"> Revision</strong>', 'active' => $this->context->route == 'order/revision','url' => Yii::$app->request->baseUrl.'/order/revision'],
//                            ['label' =>  $this->params['editing_count'] ? '<i class="fa fa-edit " aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['editing_count'].'</span> Editing':
//                                '<i class="fa fa-edit " aria-hidden="true"></i> Editing','active' => $this->context->route == 'order/editing', 'url' => Yii::$app->request->baseUrl.'/order/editing'],
                            ['label' => $this->params['completed_count'] ? '<i class="fa fa-trophy text-success" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['completed_count'].'</span><strong style="color: #3D715B"> Completed</strong>':
                                '<i class="fa fa-trophy text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Completed</strong>', 'active' => $this->context->route == 'order/completed','url' => Yii::$app->request->baseUrl.'/order/completed'],
                            ['label' => $this->params['approved_count'] ? '<i class="fa fa-thumbs-up text-success" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['approved_count'].'</span><strong style="color: #3D715B"> Approved</strong>':
                                '<i class="fa fa-thumbs-up text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Approved</strong>', 'active' => $this->context->route == 'order/approved','url' => Yii::$app->request->baseUrl.'/order/approved'],
                            ['label' => $this->params['rejected_count'] ? '<i class="fa fa-thumbs-down text-success" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['rejected_count'].'</span><strong style="color: #3D715B"> Rejected</strong>':
                                '<i class="fa fa-thumbs-down text-success" aria-hidden="true"></i><strong style="color: #3D715B"> Rejected</strong>', 'active' => $this->context->route == 'order/rejected', 'url' => Yii::$app->request->baseUrl.'/order/rejected'],
//                            ['label' => $this->params['disputed_count'] ? '<i class="fa fa-legal" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['disputed_count'].'</span> Disputed':
//                                '<i class="fa fa-legal" aria-hidden="true"></i> Disputed', 'active' => $this->context->route == 'order/disputed', 'url' => Yii::$app->request->baseUrl.'/order/disputed'],
                            ['label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/settings.png" style="height: 24px; " ><strong style="color: #3D715B"> Settings</strong>', 'items' => [
                                ['label' => 'Profile', 'active' => $this->context->route == 'user-profile/create','url' => Yii::$app->request->baseUrl.'/user-profile/create'],
                                ['label' => 'Account',  'active' => $this->context->route == 'site/account','url' => Yii::$app->request->baseUrl.'/site/account'],
                            ],
                           ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <div class="col-md-9" style="padding-left: 10px; padding-right: 0">
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
                <ul class="pull-left">
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
                <li class="col-xs-12" style="margin-top: 3px;"><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/paypalpro.jpg" alt="PayPal" class="pm paypal"></li>
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
