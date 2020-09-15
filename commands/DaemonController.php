<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 7/5/18
 * Time: 4:59 PM
 */

namespace app\commands;

use app\models\Order;
use Carbon\Carbon;
use yii\console\Controller;

class DaemonController extends Controller{

    public function actionApprove()
    {
        $orders = Order::allCompletedOrders();
        foreach ($orders as $key => $order) {
            $date = Carbon::now();
            $model = Order::find()->where(['ordernumber'=> $order['ordernumber']])->one();
            if ($date > $order['approval_date']){
                $model->completed = 0;
                $model->approved = 1;
                $model->active = 0;
                $model->revision= 0;
                $model->save(false);
            }
        }
    }

    public function actionCron()
    {
      return \Yii::$app->db->createCommand()->insert('cron', ['message'=>'You are using the best framework'])->execute();
    }
}
