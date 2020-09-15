<?php

namespace app\rbac;

use yii\rbac\Rule;
use Yii;

/**
 * Checks if authorID matches user passed via params
 */
class ClientRule extends Rule
{
    public $name = 'isClient';

    public function execute($user, $item, $params)
    {
        if(isset($params['model'])){ //Directly specify the model you plan to use via param
            $model = $params['model'];
        }else{ //Use the controller findModel method to get the model - this is what executes via the behaviour/rules
            $id = Yii::$app->request->get('id'); //Note, this is an assumption on your url structure.
            $model = Yii::$app->controller->findUserModel($id); //Note, this only works if you change findModel to be a public function within the controller.
        }
        return $model->created_by == $user;
    }

}