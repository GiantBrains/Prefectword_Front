<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
$this->title = $model->title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->description,
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Essay Writing, Quality Essays, Academic Writing, Verified Professors, Best Essay Writers '.$this->title.', Essay Writers'
]);

$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="blog-view">

        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?php
            if (Yii::$app->user->can('admin')){
                echo '<span style="margin-right: 15px">'.Html::a('Update', ['update', 'id' => $model->id, 'slug'=>$model->slug], ['class' => 'btn btn-primary']).'</span>';
                echo '<span style="margin-right: 15px">'.Html::a('Delete', ['delete', 'id' => $model->id, 'slug'=>$model->slug], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]).'</span>';
            }
            echo ''.Html::a('Blogs', ['index'], ['class' => 'btn btn-warning']).'';
            ?>
        </p>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <div style="font-size: 16px"><?= $model->description?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-push-6">
                <a class="btn btn-lg btn-primary" href="<?= Yii::$app->request->baseUrl?>/order/create">Place Order</a>
            </div>
        </div>
    </div>

</div>