<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionCreateClientRule()
    {
        $auth = Yii::$app->authManager;

        // add the rule
        $rule = new \app\rbac\ClientRule();
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $manageOwnPost = $auth->createPermission('manageOwnPost');
        $manageOwnPost->description = 'Manage own post';
        $manageOwnPost->ruleName = $rule->name;
        $auth->add($manageOwnPost);

        // get the "updatePost" permission
        $updatePost = $auth->getPermission('updatePost');

        // get the "client" role
        $client = $auth->getRole('client');

        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($manageOwnPost, $updatePost);

        // allow "client" to update their own posts
        $auth->addChild($client, $manageOwnPost);
    }
}