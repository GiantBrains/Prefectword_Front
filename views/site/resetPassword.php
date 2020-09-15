<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<ol class="breadcrumb breadcrumb-arrow" style="margin-top: 5px; margin-left: 10px;">
    <li><a href="<?=\yii\helpers\Url::to(['/'])?>">Home</a></li>
    <li class="active"><span> <?= Html::encode($this->title) ?></span></li>
</ol>
<div class="container">
    <div class="site-reset-password">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>Please choose your new password:</p>
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password_repeat')->label('Confirm Password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Save New Password', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>