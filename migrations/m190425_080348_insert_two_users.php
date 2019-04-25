<?php

use yii\db\Migration;

/**
 * Class m190425_080348_insert_two_users
 */
class m190425_080348_insert_two_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->insert('users', [
        'id' => 1,
        'username'=> 'sasha',
        'password'=> 'sasha',
        'email'=> 'sasha@gmail.com'
      ]);

      $this->insert('users', [
        'id' => 2,
        'username'=> 'oleg',
        'password'=> 'oleg',
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        echo "m190425_080348_insert_two_users cannot be reverted.\n";
//
//        return false;
      $this->delete('users', ['id'=> 1]);
      $this->delete('users', ['id'=> 2]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190425_080348_insert_two_users cannot be reverted.\n";

        return false;
    }
    */
}
