<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $email
 *
 * @property Task[] $tasks
 * @property Task[] $tasks0
 *
 * @property Users $responsable
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['username', 'password'], 'required'],
          [['username', 'password', 'authKey', 'accessToken', 'email'], 'string', 'max' => 255],
          [['email'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'id' => 'ID',
          'username' => 'Имя пользователя',
          'password' => 'Пароль',
          'authKey' => 'Auth Key',
          'accessToken' => 'Access Token',
          'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasMany(Task::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable()
    {
        return $this->hasMany(Task::className(), ['responsable_id' => 'id']);
    }

    public static function getUsersList() {
        return static::find()
                        ->select(['username'])
                        ->indexBy('id')
                        ->column();
    }
//    public function afterSave($insert, $changedAttributes) {
//        parent::afterSave($insert, $changedAttributes);
//
//    }
}

