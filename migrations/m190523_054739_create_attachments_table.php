<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attachments}}`.
 */
class m190523_054739_create_attachments_table extends Migration
{
    protected $attachmentsTableName = 'task_attachments';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->attachmentsTableName, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string()
        ]);

        $this->addForeignKey(
            'fk_attachments_tasks',
            $this->attachmentsTableName, 'task_id',
            \app\models\tables\Task::tableName(), 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->attachmentsTableName);
    }
}
