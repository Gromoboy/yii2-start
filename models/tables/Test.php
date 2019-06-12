<?php

namespace app\models\tables;

use app\behaviors\MyBehavior;
use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $title
 */
class Test extends \yii\db\ActiveRecord
{
    const EVENT_RUN_STARTED = 'event_run_started';
    const EVENT_RUN_FINISHED = 'event_run_finished';

    public function behaviors()
    {
        return [
            'my' => [
                'class' => MyBehavior::class,
                'message' => 'changed greetings in conf from myBehaviors<br>',
            ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
    /**
     * example for Events in ActiveRecord
     */
    public function run() {
        $this->trigger(static::EVENT_RUN_STARTED);
        echo 'Method start running<br>';
        echo 'Method is working...<br>';
        $this->trigger(static::EVENT_RUN_FINISHED);
        echo 'Method stop working<br>';
    }
}
