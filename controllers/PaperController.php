<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 4/8/18
 * Time: 12:28 PM
 */
namespace app\controllers;


use yii\rest\ActiveController;

class PaperController extends ActiveController
{
    public $modelClass = 'app\models\Order';
}

