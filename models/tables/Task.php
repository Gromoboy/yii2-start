<?php

namespace app\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property int $responsable_id
 * @property string $deadline
 * @property int $status_id
 *
 * @property Users $creator
 * @property Users $responsable
 * @property TaskComments[] $comments
 * @property TaskAttachments[] $attachments
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['creator_id', 'responsable_id', 'status_id'], 'integer'],
            [['deadline'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['responsable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['responsable_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'task_name'),
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'responsable_id' => Yii::t('app', 'task_responsable'),
            'deadline' => Yii::t('app', 'task_deadline'),
            'status_id' => Yii::t('app', 'task_status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable()
    {
        return $this->hasOne(Users::className(), ['id' => 'responsable_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
    }

    public function getComments() {
        return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
    }
    public function getAttachments() {
        return $this->hasMany(TaskAttachments::class, ['task_id' =>'id']);
    }

    public static function getList() {
        return ArrayHelper::map(
            static::find()
            ->select(['id', 'name'])
            ->asArray()
            ->indexBy('id')
            ->all(),
            'id', 'name'
        );
    }

    public static function getDeadlineIn($days)
    {
        $sqlDeadlineDayLeft = 'DATEDIFF(NOW(), task.deadline)';
        return static::find()
            ->where("$sqlDeadlineDayLeft <= $days ")
            // подцепка таблицы users сразу, без последующих обращени к бд
            ->with('responsable')
            ->all();
    }

}
