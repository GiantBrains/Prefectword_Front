<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $settings app\models\Settings */
/* @var $model app\models\Order */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="myorder">
    <h2 style="color: #3D715B">Place Order</h2>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,
        'settings' => $settings
    ]) ?>

</div>
