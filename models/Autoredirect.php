<?php
namespace app\models;
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 5/16/18
 * Time: 11:39 PM
 */
class Autoredirect extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public $oid;
    public $url;

    public function execute($queue)
    {
        http_redirect('https://doctorateessays.com/order/here?oid='.$this->oid.'');
    }
}