<?php

use yii\db\Migration;

/**
 * Class m190425_081701_add_foreign_keys_to_task
 */
class m190425_081701_add_foreign_keys_to_task extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->addForeignKey('fk_task_creator_user',
      'task', 'creator_id',
      'users', 'id');
    $this->addForeignKey('fk_task_responsable_user',
      'task', 'responsable_id',
      'users', 'id');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown() {

    $this->dropForeignKey('fk_task_creator_user', 'task');
    $this->dropForeignKey('fk_task_responsable_user', 'task');
  }
  /*
  // Use up()/down() to run migration code without a transaction.
  public function up()
  {

  }

  public function down()
  {
      echo "m190425_081701_add_foreign_keys_to_task cannot be reverted.\n";

      return false;
  }
  */
}
