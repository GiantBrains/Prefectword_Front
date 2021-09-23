<?php

use yii\helpers\Html;
use kartik\rating\StarRating;


/* @var $this yii\web\View */
/* @var $model app\models\File */
$tab2active = 'active';
$tabactive = 'not';
$tab3active = 'not';
$this->title = 'Download & Review';
?>
<?php if (Yii::$app->session->hasFlash('rating')): ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <a aria-hidden="true" data-dismiss="alert" class="close" type="button">×</a>
        <span><i class="icon fa fa-check"></i> <strong>Success - </strong></span>
        <?= Yii::$app->session->getFlash('rating') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('revision-sent')): ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <a aria-hidden="true" data-dismiss="alert" class="close" type="button">×</a>
        <span><i class="icon fa fa-check"></i> <strong>Success - </strong></span>
        <?= Yii::$app->session->getFlash('revision-sent') ?>
    </div>
<?php endif; ?>
<div class="file-create" style="margin-left: -10px">
    <h1><?= Html::encode('Order #'.$model->ordernumber) ?></h1>
    <hr>
    <?php
    $submittedfile = \app\models\Uploaded::find()->where(['order_number'=> $model->id])->all();
    $msgcount = \app\models\Notification::find()->where(['key'=>'new_message'])->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['seen'=> 0])->andFilterWhere([ 'order_number'=>$model->ordernumber])->count();
    ?>
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/view', 'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li role="presentation" ><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/messages', 'oid'=>$model->ordernumber])?>"><strong>Messages</strong>
                <?php
                if ($msgcount != 0){
                    echo '<span class="badge">'.$msgcount.'</span>';
                }else{
                    echo '';
                }
                ?> </a></li>
        <?php
        $downotsee = $model->rejected == 0;
        if ($submittedfile && $downotsee){
            echo '<li role="presentation" class="active"><a href="'.\yii\helpers\Url::to(['order/download-review', 'oid'=>$model->ordernumber]).'"><strong>Download & Review</strong></a></li>';
        }else{
            echo '';
        }
        $order_revisions = \app\models\Revision::find()->where(['order_number'=>$model->ordernumber])->all();
        if ($order_revisions){
            echo '<li role="presentation" ><a href="'.\yii\helpers\Url::to(['order/revision-view', 'oid'=>$model->ordernumber]).'"><strong>Revision Instructions</strong></a></li>';
        }else{
            echo '';
        }
        ?>
    </ul>
    <div class="row">
        <div class="col-md-11">
            <div class="table-responsive">
            <table class="table" id="files" cellspacing="0">
                <tr>
                    <th class="col-md-4" style="padding-left:15px">File Name</th>
                    <th class="col-md-2" style="padding-left:15px">File Type</th>
                    <th class="col-md-3" style="padding-left:15px">Time Uploaded</th>
                    <th class="col-md-2" style="padding-left:15px">Download</th>
                </tr>
                <?php
                foreach($models as $dmodel){
                    echo $this->render('_downloadfile',[
                        'model'=>$dmodel,
                    ]);
                }
                ?>
            </table>
            </div>
            <?php
            if ($model->completed == 1){
               echo ' <div class="row" >
                <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 10px;">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#revisionModal">Request Revision</button>
                </div>
           
                <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 10px;">
                     <button class="btn btn-success" data-toggle="modal" data-target="#fundsModal">Accept Order</button>
                </div>
            
                <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 10px; margin-bottom: 10px">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#rejectModal">Reject Order</button>
                </div>
            </div>
            ';
            }

            ?>
        </div>
    </div>
</div>

<!-- Revision Modal -->
<div class="modal fade" id="revisionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Request Revision For Order #<?=$model->ordernumber ?></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px">
                    <div class="revision-form">

                        <?php $form = \kartik\form\ActiveForm::begin([
                                'action'=> \yii\helpers\Url::to(['order/order-revision','oid'=>$model->ordernumber])
                        ]); ?>
                        <div class="row">
                            <div class="col-md-10">
                                <?= $form->field($revision, 'instructions')->textarea(['rows' => 4])->label('Revision Instructions') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Request Revision', ['class' =>'btn btn-primary']) ?>
                        </div>

                        <?php \kartik\form\ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Release Funds Modal -->
<div class="modal fade" id="fundsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Review Order #<?=$model->ordernumber?> </h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px">
                    <?php
                    $myrating = \app\models\Rating::find()->where(['order_number'=>$model->ordernumber])->one();
                    $check = $model->completed == 1 || $model->approved == 1;
                    if ($check || $model->rejected == 1){
                        if (!$myrating){

                            echo  '<h4><strong>Review the Order</strong></h4>';
                            $form = \kartik\form\ActiveForm::begin([
                                'action'=>\yii\helpers\Url::to(['order/rating', 'oid'=>$model->ordernumber])
                            ]);

                            echo $form->field($rating, 'value')->widget(StarRating::classname(), [
                                'options'=>['background-color'=>'red'],
                                'pluginOptions' => [
                                    'min' => 0,
                                    'max' => 5,
                                    'step' => 1,
                                    'filledStar'=>'<i style="color: orange" class="glyphicon glyphicon-star"></i>',
                                    'size' => 'xs',
                                    'starCaptions' => [
                                        1 => 'Very Poor',
                                        2 => 'Poor',
                                        3 => 'Average',
                                        4 => 'Very Good',
                                        5 => 'Excellent',
                                    ],
                                    'starCaptionClasses' => [
                                        1 => 'text-danger',
                                        2 => 'text-warning',
                                        3 => 'text-info',
                                        4 => 'text-primary',
                                        5 => 'text-success',
                                    ],
                                ],
                            ])->label(false);
                            echo '<div class="row">
                                      <div class="col-md-10">
                                             '.$form->field($rating, 'description')->textarea(['rows' => 4]).'  
                                      </div>  
                                  </div>';

                            echo ' <div class="form-group">
                 '.Html::submitButton('Send', ['class' => 'btn btn-primary']).'
            </div>';

                            \kartik\form\ActiveForm::end();
                        }else{
                            echo '
                <h4><strong>Review the Order</strong></h4>
                <p>Thank you for rating the order. We highly apppreciate your feedback and we will use it to improve our services.<br>
                </p>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Reject Order #<?=$model->ordernumber ?></h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px">
                    <div class="reject-form">
                        <div class="row">
                            <div class="col-md-10">
                                <strong style="color: red">Reminder:</strong> Kindly note that rejecting the order means that you cannot use the paper delivered to you.
                                If there is anything you need changed, we recommend that you ask for revision.
                            </div>
                        </div>

                        <?php $form = \kartik\form\ActiveForm::begin([
                                'action'=>\yii\helpers\Url::to(['order/order-reject','oid'=>$model->ordernumber])
                        ]); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($reject, 'reason_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Reason::find()->all(),
                                    'id', 'name'), ['prompt'=>'--select reason--'])->label('Reason') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <?= $form->field($reject, 'description')->textarea(['rows' => 4]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Send', ['class' =>'btn btn-primary']) ?>
                        </div>

                        <?php \kartik\form\ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
