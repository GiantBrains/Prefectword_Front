<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_number')->textInput() ?>

    <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
