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
        <div class="col-md-10 col-sm-10 col-xs-12" style="overflow-x:auto;">
            <div class="table-responsive">
                <table class="table" id="transactions">
                    <tr>
                        <th>Description</th>
                        <th>Deposit</th>
                        <th>Withdrawals</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    foreach($paypals as $paypal){
                        echo $this->render('_records',[
                            'paypal'=>$paypal,
                        ]);
                    }
                    ?>
                    <tr style="background-color: #e6f5ff">
                        <td><strong>Totals</strong></td>
                        <td><strong>$<?= number_format(floatval($totaldeposit), 2, '.', ',') ?></strong></td>
                        <td><strong>$<?= number_format(floatval($totalwithdrawal), 2, '.', ',') ?></strong></td>
                    </tr>
                </table>
            </div>
            <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pagination,
            ]);
//            echo \kartik\ipinfo\IpInfo::widget([
//                'ip' => Yii::$app->getRequest()->getUserIP(),
//                'showPopover' => false,
//                'template' => ['inlineContent'=>'{flag} {country_code}{country_name} {zip_code} {city} '],
//            ]);
            ?>
        </div><!-- /.row -->
    </div>
</div>
