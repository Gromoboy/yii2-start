<?php

use yii\db\Migration;

/**
 * Handles adding created_at to table `{{%task}}`.
 */
class m190520_073649_add_created_at_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'created_at', $this->DATETIME());
        $this->addColumn('{{%task}}', 'updated_at', $this->DATETIME());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%task}}', 'created_at');
        $this->dropColumn('{{%task}}', 'updated_at');
    }
}
