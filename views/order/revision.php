<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders on Revision';
$this->params['breadcrumbs'][] = $this->title;
//$deadline = <<< JS
//var displayMoment = document.getElementById('deadline-date');
/*var theMoment = moment("<?php echo $model->deadline; ?>", "YYYY-MM-DD HH-mm-ss").fromNow();*/
//
//var now = moment();
/*const exp = moment("<?php echo $model->deadline; ?>", "YYYY-MM-DD HH-mm-ss");*/
//days = exp.diff(now, 'days');
//hours = exp.subtract(days, 'days').diff(now, 'hours');
//minutes = exp.subtract(hours, 'hours').diff(now, 'minutes');
//displayMoment.innerHTML = days+' days, '+hours+' hours, '+minutes+' minutes';
//JS;
//$this->registerJs($deadline);
?>
<div class="myorder" style="margin-left: -10px">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="row">
        <div class="hidden-lg hidden-md hidden-sm col-xs-4">
            <?php  echo '<div class="dropdown">
                              <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Menu
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li class="active"><a href="'.Yii::$app->request->baseUrl.'/order/index"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/create"><i class="fa fa-plus " aria-hidden="true"></i> Place Order</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/pending"><i class="fa fa-list " aria-hidden="true"></i> Pending ('.$this->params['pending_count'].')</a></li>
                                 <li><a href="'.Yii::$app->request->baseUrl.'/order/available"><i class="fa fa-clock-o" aria-hidden="true"></i> Waiting to be assigned ('.$this->params['available_count'].')</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/active"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> In Progress ('.$this->params['active_count'].')</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/cancelled"><i class="fa fa-close" aria-hidden="true"></i> Cancelled ('.$this->params['cancel_count'].')</a></li>
                                <li class="active"><a href="'.Yii::$app->request->baseUrl.'/order/revision"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Revision ('.$this->params['revision_count'].')</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/completed"><i class="fa fa-trophy " aria-hidden="true"></i> Completed ('.$this->params['completed_count'].')</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/approved"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approved ('.$this->params['approved_count'].')</a></li>
                                <li><a href="'.Yii::$app->request->baseUrl.'/order/rejected"><i class="fa fa-thumbs-down " aria-hidden="true"></i> Rejected ('.$this->params['rejected_count'].')</a></li>
                              </ul>
                            </div>';
            ?>
        </div>
        <div class="col-md-4  col-md-push-8 col-sm-4  col-sm-push-8 col-xs-8">
            <?php  echo $this->render('_revision', ['model' => $searchModel]); ?>
        </div>
    </div>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'service_id',
            [
                'attribute'=>'ordernumber',
                'width'=>'100px',
                'format' => 'raw',
                'value'=> function ($model, $key, $index, $column) {
                    return   Html::a($model->ordernumber, ['/order/view','oid'=>$model->ordernumber]);
                }
            ],
            [
                'attribute'=>'subject_id',
                'value'=>'subject.name'
            ],

            [
                'attribute'=>'deadline',
                'format' => 'raw',
                'value'=>function ($model, $key, $index, $column) {
                    $epoch = time();
                    $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                    $myzone = new DateTimeZone(Yii::$app->timezone->name);
                    $dt->setTimezone($myzone);
                    $dt->format('Y-m-d H:i:s');
                    $interval = date_diff( date_create( $dt->format('Y-m-d H:i:s')), date_create($model->deadline));

                    $date_days = $interval->format('%a');
                    $date_hours = $interval->format('%r%H');
                    $date_minutes = $interval->format('%r%I');
                    if($date_days == 0) {
                        if ($interval->format('%r%I') < 0 && $interval->format('%H') == 0) {
                            return '<p style="color: red">' . $interval->format('%r%I minutes') . ' </p>';
                        }else if ($interval->format('%r%I') > 0 && $interval->format('%H') == 0) {
                            return '<p style="color: green">' . $interval->format('%r%I minutes') . ' </p>';
                        }else if($interval->format('%r%H') < 0){
                            return  '<p style="color: red">'.$interval->format('%r%H hours %I minutes' ).' </p>';
                        }else if($interval->format('%r%H') > 0){
                            return  '<p style="color: green">'.$interval->format('%r%H hours %I minutes' ).' </p>';
                        }else{
                            return '<p style="color: green">'.$interval->format('%r%H hours %I minutes' ).' </p>';
                        }

                    }else  if($date_hours == 0) {
                        if ($interval->format('%r%I') < 0 && $interval->format('%a') == 0) {
                            return '<p style="color: red">' . $interval->format('%r%I minutes') . ' </p>';
                        }else if ($interval->format('%r%I') > 0 && $interval->format('%a') == 0) {
                            return '<p style="color: green">' . $interval->format('%r%I minutes') . ' </p>';
                        }else if ($interval->format('%r%a') < 0) {
                            return '<p style="color: red">' . $interval->format('%r%a days %I minutes') . ' </p>';
                        }else if ($interval->format('%r%a') > 0) {
                            return '<p style="color: green">' . $interval->format('%r%a days %I minutes') . ' </p>';
                        }else{
                            return '<p style="color: green">'.$interval->format('%r%a days %H hours %I minutes' ).' </p>';
                        }

                    }
                    else if ($interval->format('%r%a') < 0){
                        return  '<p style="color: red">'.$interval->format('%r%a days %H hours %I minutes' ).' </p>';

                    }else{
                        return  '<p  style="color: green">'.$interval->format('%a days %H hours %I minutes' ).' </p>';
                    }

                }
            ],
            [
                'attribute'=>'type_id',
                'value'=>'type.name'
            ],
//                'created_by',
//                'written_by',
//                'edited_by',
            [
                'attribute'=>'pages_id',
                'width'=>'100px',
                'format' => 'raw',
                'value'=>function ($model, $key, $index, $column) {
                    return   '<p style="text-align: center">'.$model->pages->no_of_page.'</p>';
                }
            ],
            //'subject_id',
            [
                'attribute'=>'amount',
                'width'=>'100px',
                'format' => 'raw',
                'value'=>function ($model, $key, $index, $column) {
                    if ($model->amount != null){
                        return   '<p>$'.$model->amount.'</p>';
                    }else{
                        return '<p>$0.00</p>';
                    }
                }
            ],
            //'sources_id',
            //'language_id',
            //'pagesummary',
            //'plagreport',
            //'initialdraft',
            //'topic',
            //'instructions:ntext',
            //'qualitycheck',
            //'topwriter',
            //'phone',
            //'promocode',
            //'files',
            //'created_at',
        ],
    ]); ?>
</div>
