<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
?>
<ol class="breadcrumb breadcrumb-arrow" style="margin-top: 5px; margin-left: 10px;">
    <li><a href="<?=\yii\helpers\Url::to(['/'])?>">Home</a></li>
    <li class="active"><span> <?= Html::encode($this->title) ?></span></li>
</ol>
<div class="container">
    <div class="site-request-password-reset">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>Please fill out your email. A link to reset password will be sent there.</p>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>