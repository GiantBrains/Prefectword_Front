<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Sign Up';
?>
<div class="container">
    <div class="site-signup">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="row" style="border: solid; border-color: #ddd; border-width: thin; border-radius: 5px; background-color: whitesmoke">
                    <br>
                    <div class="col-md-8 col-md-offset-2">
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
                                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div></center>
                    </div>
                     <div class="col-md-12">
                     <?= yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['site/auth'],
                    'popupMode' => false,
                ]) ?>
                 </div>
                </div>
                <?php ActiveForm::end(); ?>
                 <br><br><br><br>
            </div>
        </div>
    </div>
</div>
