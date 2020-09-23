<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Sign Up';
?>
<div class="container">
    <div class="site-login">
        <div class="row"><br>
            <div class="col-md-4 col-sm-4 col-xs-12" style="border: solid; border-color: #ddd; border-width: thin; border-radius: 5px">
                <div class="row" style="background-color:#71D8EC; border-color: #ddd; border-top-left-radius: 5px; border-top-right-radius: 5px">
                    <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
                </div>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <div class="row" style="padding-right: 30px; padding-left: 30px;">
                            <?= $form->field($model, 'email')->textInput() ?>
                            <?= $form->field($model, 'username')->textInput() ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'password_repeat')->label('Confirm Password')->passwordInput() ?>
                            <center>
                                <?= $form->field($model, 'reCaptcha')->label("")->widget(
                                    \himiklab\yii2\recaptcha\ReCaptcha2::className()
                                ) ?>
                            </center>
                            <center><div class="form-group">
                                    <?= Html::submitButton('Signup', ['class' => 'btn btn-block btn-info', 'name' => 'signup-button']) ?>
                                </div></center>

                        <div class="col-md-12">
                            <?= yii\authclient\widgets\AuthChoice::widget([
                                'baseAuthUrl' => ['site/auth'],
                                'popupMode' => false,
                            ]) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>