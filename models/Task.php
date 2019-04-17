<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16.04.2019
 * Time: 18:43
 */

namespace app\models;


use yii\base\Model;

class Task extends Model
{
  public $title;
  public $description;
  public $author;
  public $responsable;
  public $status;

  public function rules() {
    return [
      [['title','description'], 'required'],
      ['title', 'string', 'max'=>10],
      ['status', 'statusValidate']
    ];
  }

  public function statusValidate($attribute, $params) {
    if(!in_array($this->$attribute, ['В работе', 'Закрыта'])) {
      $this->addError($attribute, 'Неверный статус ');
    }
  }
}