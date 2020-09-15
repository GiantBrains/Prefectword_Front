<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $blog app\models\Blog */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="blog-index">

        <h1> All <?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?php
            if (Yii::$app->user->can('admin')){
                echo ''.Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']).'';
            }
            ?>
        </p>
        <hr>
        <?php
        foreach ($blogs as $blog) {
            echo '<div class="row">
                    <div class="col-md-8">
                   <a href="'.\yii\helpers\Url::to(['blog/view', 'id'=>$blog->id, 'slug'=>$blog->slug]).'"><strong>'.$blog->title.'</strong></a> <br>
                   <div class="cut-text">'.$blog->description.'</div> <br>
                   <div><a class="btn btn-primary" href="'.\yii\helpers\Url::to(['order/create']).'">Place Order</a></div>
                  </div>
                    <div class="col-md-8">
                    <hr>
                    </div>
                  </div>
                ';
        }
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
</div>