<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Wallet';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('invalidAmt')): ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <a aria-hidden="true" data-dismiss="alert" class="close" type="button">×</a>
        <span><i class="icon fa fa-exclamation"></i> <strong>Error - </strong></span>
        <?= Yii::$app->session->getFlash('invalidAmt') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('notpaid')): ?>
    <div class="alert alert-danger alert-dismissable" role="alert">
        <a aria-hidden="true" data-dismiss="alert" class="close" type="button">×</a>
        <span><i class="icon fa fa-exclamation"></i> <strong>Error - </strong></span>
        <?= Yii::$app->session->getFlash('notpaid') ?>
    </div>
<?php endif; ?>
<div class="row">
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation" class="<?=$active1?>"><a href="<?= Yii::$app->request->baseUrl?>/wallet/index"><strong>Deposit</strong></a></li>
        <li role="presentation" class="<?= $active3?>"><a href="<?=  Yii::$app->request->baseUrl?>/wallet/withdraw"><strong>Withdraw Requests</strong></a></li>
        <li role="presentation" class="<?= $active2?>"><a href="<?=Yii::$app->request->baseUrl ?>/wallet/transactions"><strong>Transactions</strong></a></li>
    </ul>
</div>
<div class="wallet-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row" style="height: 200px; border: solid; border-color: darkgrey; border-width: thin;">
        <div class="row" style="margin-top: 20px; margin-left: 20px">
                <div class="col-md-4">
                    <form action="<?= Yii::$app->request->baseUrl?>/wallet/deposit">
                    <div class="input-group">
                        <span style="background-color: #3D715B; color: white;" class="input-group-addon">$</span>
                        <input type="text" required name="amount" class="form-control" value="" placeholder="Enter amount...">
                        <span class="input-group-btn">
                         <input  class="btn btn-default form-control" style="color: midnightblue;background-color: #D1F2EB; font-weight: 900;" type="submit" value="PayPal">
                        </span>
                    </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div>
</div>
