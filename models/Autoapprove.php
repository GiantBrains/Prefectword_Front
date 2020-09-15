<?php
namespace app\models;
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 5/16/18
 * Time: 3:43 AM
 */
use Yii;
use  yii\base\BaseObject;
use  app\models\Order;
use yii\queue\JobInterface;

class Autoapprove extends BaseObject implements JobInterface
{
    public $id;
//    public $url;

    public function execute($queue)
    {
        $connection = Yii::$app->db;
        $connection->createCommand('UPDATE  doctorateessays.order  SET revision = 0, active = 0, completed = 0, approved = 1  WHERE id ='.$this->id.'')->execute();
    }
}