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
    <h1 class="text-success" style="text-align: center;"><?= \yii\helpers\Html::encode($this->title) ?></h1>
    <div class="site-how">
        <div class="col-md-8  col-md-offset-2" style="text-align: center">
            <p>Whenever you need essay help, chances are that you are tired and maybe running out of time.
                You do not need such a long process to help you get your paper done.
                It is for this reason that we have made sure to simplify the process in 5 simple steps.</p>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <center>
                <h2 style="color: #3D715B;font-weight: bolder">STEP 1:</h2>
                <p>New to Verified Professors? Quickly Sign Up for an account now and start discovering.</p>
                    <a href="<?=Yii::$app->request->baseUrl ?>/order">
                        <button style="color: black; border-radius: 30px;font-family: 'Philosopher', sans-serif; background-color: #71D8EC" type="button" class="btn btn-lg essay-font">
                            Sign Up
                        </button>
                    </a>
                <br><br>
                <i class="fa fa-arrow-down text-success fa-3x"
                   aria-hidden="true"></i>
            </center>
            <hr>
        </div>
        <br>
        <div class="col-md-6 col-md-offset-3">
            <center>
                <h2 style="color: #3D715B; font-weight: bolder">STEP 2:</h2>
                <p>After Signing up, fill the form provided to select the service you want, pages etc and place the order</p>
                    <a href="<?=Yii::$app->request->baseUrl ?>/order">
                        <button style="color: black; border-radius: 30px;font-family: 'Philosopher', sans-serif; background-color: #71D8EC" type="button" class="btn btn-lg essay-font">
                            Fill the Order Form
                        </button>
                    </a><br><br>
                <i class="fa fa-arrow-down text-success fa-3x"
                   aria-hidden="true"></i>
            </center>
            <hr>
        </div>
        <br>
        <div class="col-md-6 col-md-offset-3">

            <center>
                <h2 style="color: #3D715B;font-weight: bolder">STEP 3:</h2>
                <p>On Placing the you will get a pop modal shoning you to reserve the payment.
                    Click on reserve payment with your wallet or Paypal button to reserve your payment </p>
                <a href="<?=Yii::$app->request->baseUrl ?>/order">
                <button style="border-radius: 30px;font-family: 'Philosopher', sans-serif; background-color: #71D8EC; color: black" type="button" class="btn btn-lg essay-font">
                    Reserve Payment
                </button>
                </a>
                <br><br>
                <i class="fa fa-arrow-down text-success fa-3x"
                   aria-hidden="true"></i>
            </center>
            <hr>
        </div>
        <br>
        <div class="col-md-6 col-md-offset-3">
            <center>
                <h2 style="color: #3D715B; font-weight: bolder">STEP 4:</h2>
            <p>Download your order, read through the paper and confirm that the writer has met your expectations.
                If your instructions were not followed, ask for a revision.
                If you are satisfied with the paper, Release Funds and Rate Your Writer.</p>
            </center>
        </div>
        <br>
    </div>
</div>
<div style="margin-bottom: 20px;">
    <center><a style="color:black; border-radius: 30px; background-color: #71D8EC" href="<?= Yii::$app->request->baseUrl?>/order/create" type="button" class="btn btn-lg essay-font">Order Now</a></center>
</div>