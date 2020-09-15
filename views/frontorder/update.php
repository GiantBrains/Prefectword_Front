<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Frontorder */

$this->title = 'Update Frontorder: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Frontorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
    <div class="frontorder-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
