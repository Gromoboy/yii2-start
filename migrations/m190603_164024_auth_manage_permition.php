<?php

use yii\db\Migration;

/**
 * Class m190603_164024_auth_manage_permition
 */
class m190603_164024_auth_manage_permition extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $authManage = $auth->createPermission('AuthManage');
        $auth->add($authManage);
        $auth->addChild($auth->getRole('admin'), $authManage);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190603_164024_auth_manage_permition cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190603_164024_auth_manage_permition cannot be reverted.\n";

        return false;
    }
    */
}
