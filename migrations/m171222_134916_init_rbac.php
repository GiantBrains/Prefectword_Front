<?php

use yii\db\Migration;

/**
 * Class m171222_134916_init_rbac
 */
class m171222_134916_init_rbac extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "author" role and give this role the "createPost" permission
        $client = $auth->createRole('client');
        $auth->add($client);
        $auth->addChild($client, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $client);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($client, 2);
        $auth->assign($admin, 1);



        $auth = Yii::$app->authManager;

// add the rule
        $rule = new \app\rbac\AuthorRule;
        $auth->add($rule);

// add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

// "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnPost, $updatePost);

// allow "author" to update their own posts
        $auth->addChild($author, $updateOwnPost);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }


}
