<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Update Order: #'.$model->ordernumber.'';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ordernumber, 'url' => ['view', 'number' => $model->ordernumber]];
$this->params['breadcrumbs'][] = 'Update';
?>
    <div class="order-update">
        <h2><?= Html::encode($this->title) ?></h2>
        <hr>

        <?= $this->render('_form2', [
            'model' => $model,
        ]) ?>

    </div>
