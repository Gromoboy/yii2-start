<?php

use yii\db\Migration;

/**
 * Class m190529_023317_rbac_init
 */
class m190529_023317_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 2 роли - Модератор может создавать и обновлять, Админ - создавать, обновлять, удалять
        $am = Yii::$app->authManager;

        $permitionTaskCreate = $am->createPermission('TaskCreate');
        $permitionTaskUpdate = $am->createPermission('TaskUpdate');
        $permitionTaskDelete = $am->createPermission('TaskDelete');

        $am->add($permitionTaskCreate);
        $am->add($permitionTaskUpdate);
        $am->add($permitionTaskDelete);

        // создание ролей и добавление в базу
        $admin = $am->createRole('admin');
        $moder = $am->createRole('moder');

        //
        $am->add($admin);
        $am->add($moder);

        // разграничение ролей
        $am->addChild($admin, $permitionTaskCreate);
        $am->addChild($admin, $permitionTaskUpdate);
        $am->addChild($admin, $permitionTaskDelete);

        $am->addChild($moder, $permitionTaskCreate);
        $am->addChild($moder, $permitionTaskUpdate);

        // связывание ролей с пользователем (id from UserIdentity class)
        $am->assign($admin, 100);
        $am->assign($moder, 101);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190529_023317_rbac_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190529_023317_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
