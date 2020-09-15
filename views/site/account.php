<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 8/23/18
 * Time: 12:22 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Change Password';
?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'account-form',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                            'labelOptions' => ['class' => 'col-lg-3 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'email')->textInput(['readonly'=> true]) ?>

                    <?= $form->field($model, 'current_password')->passwordInput() ?>

                    <hr/>

                    <?= $form->field($model, 'new_password')->passwordInput() ?>

                    <?= $form->field($model, 'repeat_password')->passwordInput() ?>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-success']) ?><br>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>