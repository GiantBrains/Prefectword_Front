<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Frontorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frontorder-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'service_id')->label('Service')->dropDownList(\app\models\Service::getServices(),
                ['options' => [1 => ['Selected'=>'selected'], 'prompt'=> '...select Service....', 'id'=>'service-id']]) ?>

            <?= $form->field($model, 'type_id')->label('Type of Paper')->dropDownList(\app\models\Type::getTypes(),
                ['options' => [20 => ['Selected'=>'selected'], 'prompt'=> '...select Type....', 'id'=>'type-id']]) ?>

            <?= $form->field($model, 'urgency_id')->label('Urgency')->dropDownList(\app\models\Urgency::getUrgency(), [
                'options' => [12 => ['Selected'=>'selected'],  'prompt'=> '...select Deadline....', 'id'=>'urgency-id']]) ?>

            <?= $form->field($model, 'pages_id')->label('Number of Pages')->dropDownList(\app\models\Pages::getPages(), [
                'options' => [1 => ['Selected'=>'selected'],  'prompt'=> '...select Pages....', 'id'=>'pages-id']]) ?>

            <?= $form->field($model, 'level_id')->label('Level')->dropDownList(\app\models\Level::getLevels(), [
                'options' => [2 => ['Selected'=>'selected'], 'prompt'=> '...select Level....', 'id'=>'level-id']]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
