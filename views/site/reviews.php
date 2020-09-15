<?php
use yii\widgets\LinkPager;
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/28/18
 * Time: 1:58 PM
 */
$this->title = 'Ratings and Reviews';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Trusted custom essay writers with the best customer reviews. 
    We have our open view feedback page for you. You can trust us.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Best customer reviews, You can trust, Trusted custom essay'
]);
?>
<div class="container">
    <div class="row">
        <h1 class="text-primary" ><?= \yii\helpers\Html::encode($this->title) ?></h1>
        <div class="col-md-8">
            <?php
            foreach ($ratings as $rating) {
                echo' <div class="row" style="background-color:#f5f5f5; border-color: #ddd; padding: 0 10px 0 10px">';
                echo ' <p> <strong>Order# '.$rating->order_number.'</strong></p>';
                echo' <div class="row">';
                echo '<div class="col-md-1"><strong>Rating:</strong></div> <div style="margin-top: -10px" class="col-md-9">'.\kartik\rating\StarRating::widget([
                        'name' => 'rating_21',
                        'disabled' => true,
                        'value' => $rating->value,
                        'pluginOptions' => [
                            'size' => 'xs',
                            'filledStar'=>'<i style="color: orange" class="glyphicon glyphicon-star"></i>',
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                        ],
                    ]).'</div>';
                echo '</div>';
                $user_id = 12069+intval($rating->client_id);
                echo '<p><strong>Review:</strong> '.$rating->description.' - <span style="text-transform: capitalize; font-style: italic"> Customer '.$user_id.'</span></p>';
                echo '</div>';
                echo '<br>';
            }
            // display pagination
            echo LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>
        </div>
    </div>
</div>
