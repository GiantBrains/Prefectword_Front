<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= \dosamigos\fileupload\FileUploadUI::widget([
        'model' => $model,
        'attribute' => 'attached',
        'url' => ['order/image-upload', 'id'=>$id],
        'gallery' => false,
        'clientOptions' => [
            'maxFileSize' => 20000000
        ],
        // ...
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
            'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        ],
    ]); ?>
    <?php ActiveForm::end(); ?>

</div>
