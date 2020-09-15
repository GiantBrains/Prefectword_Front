<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/2/18
 * Time: 2:46 AM
 */
$this->title = 'How It Works';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'For how to order my essay online, check how it works. Easiest way to complete your assignment on time.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Order my essay'
]);
?>
<div class="container" style="background-color: #fff">
    <h1 class="text-primary" style="text-align: center;"><?= \yii\helpers\Html::encode($this->title) ?></h1>
    <div class="site-how">
        <div class="col-md-10  col-md-offset-1" style="text-align: center">
            <p>Whenever you need essay help, chances are that you are tired and maybe running out of time.
                You do not need such a long process to help you get your paper done.
                It is for this reason that we have made sure to simplify the process in 5 simple steps.</p>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h2>STEP 1: Calculate the Minimum Price and click Continue</h2>
            <center><img src="<?=Yii::$app->request->baseUrl ?>/images/howitworks/min-price.jpg"></center>
            <hr>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h2>STEP 2: SIGN UP</h2>
            <center><img src="<?=Yii::$app->request->baseUrl ?>/images/howitworks/signup.jpg"></center>
            <hr>
        </div>
        <br>
        <div class="col-md-8 col-md-offset-2">
            <h2>STEP 3: Fill the Order Form and Place Order</h2>
           <center> <img src="<?=Yii::$app->request->baseUrl ?>/images/howitworks/placeorder.jpg" width="700px"></center>
            <hr>
        </div>
        <br>
        <div class="col-md-8 col-md-offset-2">
            <h2>STEP 4: Reserve Payment</h2>
            <center><img src="<?=Yii::$app->request->baseUrl ?>/images/howitworks/reserve.jpg" width="700px"></center>
            <hr>
        </div>
        <br>
        <div class="col-md-8 col-md-offset-2">
            <h2>STEP 5: Download & Review </h2>
            <p>Download your order, read through the paper and confirm that the writer has met your expectations.
                If your instructions were not followed, ask for a revision.
                If you are satisfied with the paper, Release Funds and Rate Your Writer.</p>
            <center><img src="<?=Yii::$app->request->baseUrl ?>/images/howitworks/download.jpg" width="700px"></center>
        </div>
        <br>
    </div>
</div>
<div style="margin-bottom: 20px;">
    <center><a style="border-radius: 30px" href="<?= Yii::$app->request->baseUrl?>/order/create" type="button" class="btn btn-lg btn-primary essay-font">Order Now</a></center>
</div>