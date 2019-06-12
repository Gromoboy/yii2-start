<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m190523_054655_create_comments_table extends Migration
{
    protected $commentsTableName = 'task_comments';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->commentsTableName, [
            'id' => $this->primaryKey(),
            'content' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer()
        ]);

        $taskTableName = \app\models\tables\Task::tableName();
        $userTableName = \app\models\tables\Users::tableName();

        $this->addForeignKey(
            'fk_comments_tasks',
            $this->commentsTableName, 'task_id',
            $taskTableName, 'id'
        );
        $this->addForeignKey(
            'fk_comments_users',
            $this->commentsTableName, 'user_id',
            $userTableName, 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->commentsTableName);
    }
}
