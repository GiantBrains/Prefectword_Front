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
<div class="row">
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation" class="<?= $active1?>"><a href="<?= Yii::$app->request->baseUrl?>/wallet/index"><strong>Deposit</strong></a></li>
        <li role="presentation" class="<?= $active3?>"><a href="<?=  Yii::$app->request->baseUrl?>/wallet/withdraw"><strong>Withdraw Requests</strong></a></li>
        <li role="presentation" class="<?=$active2?>"><a href="<?=Yii::$app->request->baseUrl ?>/wallet/transactions"><strong>Transactions</strong></a></li>
    </ul>
</div>
<div class="wallet-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row" style="height: auto; min-height: 200px; border: solid; border-color: darkgrey; padding-top: 10px; border-width: thin;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;overflow-x:auto;">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12"
                <form action="<?= Yii::$app->request->baseUrl?>/wallet/withdraw-request">
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" required name="amount" class="form-control" value="" placeholder="Enter amount...">
                        <span class="input-group-btn" style="background-color: darkgrey">
                         <input  class="btn btn-default form-control" style="color: midnightblue; font-weight: 900;" type="submit" value="Withdraw">
                        </span>
                    </div><!-- /input-group -->
                </form>
            </div>
            <br><br><br>
            <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="table-responsive">
            <table class="table" id="transactions">
                <tr>
                    <th style="background-color: #3D715B">Amount</th>
                    <th style="background-color: #3D715B ">Date</th>
                    <th style="background-color: #3D715B ">Status</th>
                </tr>
                <?php
                foreach($withdraws as $withdraw){
                    echo $this->render('_withdraw',[
                        'withdraw'=>$withdraw,
                    ]);
                }
                ?>
            </table>
            </div>
            </div>
        </div>
        </div><!-- /.row -->
    </div>
</div>
