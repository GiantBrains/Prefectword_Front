<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$tabactive = 'not';
$tab2active = 'not';
$tab3active = 'active';
$this->title = 'Messages';
$messages = <<<JS
$(document).ready(function(){
    
    var iScrollHeight = $("#order_message_list").prop("scrollHeight");
    var scrollToTop = $('.scroll-table').scrollTop(iScrollHeight);

    $("#new_message").on("pjax:end", function() {
          var iScrollHeight = $("#order_message_list").prop("scrollHeight");
    var scrollToTop = $('.scroll-table').scrollTop(iScrollHeight);
        $.pjax.reload({container:"#messages"});  //Reload GridView
        $('input[type="text"], textarea').val('');
            var messageBody = document.querySelector('#order_message_list');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        });
    });
JS;
$this->registerJs($messages);
?>
<div class="message-index" style="margin-left: -10px">
    <h1><?= Html::encode('Order #' . $model->ordernumber) ?></h1>
    <hr>
    <?php
    $submittedfile = \app\models\Uploaded::find()->where(['order_number' => $model->id])->all();
    $msgcount = \app\models\Notification::find()->where(['key' => 'new_message'])->andWhere(['user_id' => Yii::$app->user->id])->andWhere(['seen' => 0])->andFilterWhere(['order_number' => $model->ordernumber])->count();
    ?>
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation"><a
                    href="<?= \yii\helpers\Url::to(['order/view', 'oid' => $model->ordernumber]) ?>"><strong>Order
                    details</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid' => $model->ordernumber]) ?>"><strong>Order
                    Files</strong></a></li>
        <li role="presentation" class="active"><a
                    href="<?= \yii\helpers\Url::to(['order/messages', 'oid' => $model->ordernumber]) ?>"><strong>Messages</strong>
                <?php
                if ($msgcount != 0) {
                    echo '<span class="badge">' . $msgcount . '</span>';
                } else {
                    echo '';
                }
                ?>
            </a></li>
        <?php
        $downotsee = $model->rejected == 0;
        if ($submittedfile && $downotsee) {
            echo '<li role="presentation" ><a href="' . \yii\helpers\Url::to(['order/download-review', 'oid' => $model->ordernumber]) . '"><strong>Download & Review</strong></a></li>';
        } else {
            echo '';
        }
        $order_revisions = \app\models\Revision::find()->where(['order_number' => $model->ordernumber])->all();
        if ($order_revisions) {
            echo '<li role="presentation" ><a href="' . \yii\helpers\Url::to(['order/revision-view', 'oid' => $model->ordernumber]) . '"><strong>Revision Instructions</strong></a></li>';
        } else {
            echo '';
        }
        ?>
    </ul>
    <div class="row" style="padding: 0 10px 0 10px">
        <!--            <button style="margin-left: 15px; margin-bottom: 15px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageModal">-->
        <!--                <i class="icon fa fa-plus"></i> New Message-->
        <!--            </button>-->
        <diV class="row" style="margin-left: 15px">
            <div id="supasupa" class="col-lg-10"
                 style="border: solid; border-color: #8c8c8c; padding: 10px;border-width: thin; border-radius: 10px;">
                <?php
                Pjax::begin(['id' => 'messages']);
                echo '<div id="order_message_list" class="scroll-table" style="height: auto; padding: 5px 10px 5px 10px;  max-height: 400px;  overflow-x: hidden; overflow-y: scroll; ">';
                foreach ($order_messages as $order_message) {
                    //get the time from the db in UTC and convert it client timezone
                    $startTime = new \DateTime('' . $order_message->created_at . '', new \DateTimeZone('UTC'));
                    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
                    $ptime = $startTime->format("M d, Y H:i");
                    echo '<div class="mymessage row" style="height: auto; padding: 5px 10px 5px 10px;">';
                    if ($order_message->sender_id != Yii::$app->user->id) {
                        echo '<div  class="col-md-7 col-sm-7 col-xs-8" style="text-align: left; border-radius: 5px; background-color: #ECEFF4">';
                        echo '<div>' . $order_message->message . '</div>';
                        echo '<div style="text-decoration: underline"><span style="font-style: italic; font-size: small">' . $ptime . '</span></div>';
                        echo '</div>';
                    } else {
                        echo '<div  class="col-md-7 col-md-push-5 col-sm-7 col-sm-push-5 col-xs-8 col-xs-push-4" style="border-radius: 5px; background-color: #e2e9e4">';
                        echo '<div style="text-align: left">' . $order_message->message . '</div>';
                        echo '<div style="text-decoration: underline; text-align: left"><span style="font-style: italic; font-size: small">' . $ptime . '</span></div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                echo '</div>';
                Pjax::end();
                ?>
                <hr>
                <?php
                if ($model->approved == 1 || $model->rejected == 1) {
                    echo '';
                } else {
                    echo '<div class="message-form">';
                    Pjax::begin(['id' => 'new_message']);
                    $form = \kartik\form\ActiveForm::begin([
                        'options' => ['data-pjax' => true],
                        'id' => 'create_message',
                        'action' => \yii\helpers\Url::to(['order/messages', 'oid' => $model->ordernumber])
                    ]);
                    echo '<div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            ' . $form->field($message, 'message')->textarea(['rows' => 2])->label(false) . '
                        </div>
                        <div class="col-md-2 col-sm-10 col-xs-4" style="margin-top: 5px">
                            ' . Html::submitButton('Send', ['class' => 'btn btn-primary btn-lg', 'id' => 'send-message']) . '
                        </div>
                    </div>';
                    \kartik\form\ActiveForm::end();
                    Pjax::end();
                    echo ' </div>';
                }
                ?>
            </div>
        </diV>
    </div>
</div>
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="text-align: center" class="modal-title" id="exampleModalLabel"><strong>New Message</strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message-form">
                    <?php $form = \kartik\form\ActiveForm::begin([
                        'action' => \yii\helpers\Url::to(['order/messages', 'oid' => $model->ordernumber])
                    ]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($message, 'receiver_id')->textInput()->label('Send To:')->dropDownList([3 => 'Writer', 1 => 'Admin']) ?>
                        </div>
                    </div>
                    <?= $form->field($message, 'message')->textarea(['rows' => 6]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php \kartik\form\ActiveForm::end(); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>