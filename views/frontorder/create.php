<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Frontorder */

$this->title = 'Create Frontorder';
$this->params['breadcrumbs'][] = ['label' => 'Frontorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="frontorder-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
