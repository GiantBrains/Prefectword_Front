<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
                'preset' => 'custom',
                'options'=>['rows'=>18],
                'clientOptions' => [
                    'height'=>  250,
                    'toolbar' => [
                        [
                            'name' => 'row1',
                            'items' => [
                                'Source', '-',
                                'Bold', 'Italic', 'Underline', 'Strike', '-',
                                'Subscript', 'Superscript', 'RemoveFormat', '-',
                                'TextColor', 'BGColor', '-',
                                'NumberedList', 'BulletedList', '-',
                                'Outdent', 'Indent', '-', 'Blockquote', '-',
                                'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list', 'indent', 'blocks', 'align', 'bidi', '-',
                                'Link', 'Unlink', 'Anchor', '-',
                                'ShowBlocks', 'Maximize',
                            ],
                        ],
                        [
                            'name' => 'row2',
                            'items' => [
                                'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe', '-',
                                'NewPage', 'Print', 'Templates', '-',
                                'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-',
                                'Undo', 'Redo', '-',
                                'Find', 'SelectAll', 'Format', 'Font', 'FontSize','styles','colors', 'tools', 'others'
                            ],
                        ],
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
