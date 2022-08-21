<?php

use yii\db\Migration;

/**
 * Class m220820_081829_init_rbac
 */
class m220820_081829_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createbranch" permission
        $createbranch = $auth->createPermission('createbranch');
        $createbranch->description = 'Create a branch';
        $auth->add($createbranch);

        // add "updatebranch" permission
        $updatebranch = $auth->createPermission('updatebranch');
        $updatebranch->description = 'Update branch';
        $auth->add($updatebranch);

        // add "user" role and give this role the "createbranch" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createbranch);

        // add "admin" role and give this role the "updatebranch" permission
        // as well as the permissions of the "user" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatebranch);
        $auth->addChild($admin, $user);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
