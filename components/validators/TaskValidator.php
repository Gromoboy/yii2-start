<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17.04.2019
 * Time: 13:38
 */
namespace app\components\validators;
use yii\validators\Validator;
class TaskValidator extends Validator
{
  public function validateAttribute($model, $attribute) {
    if(!in_array($model->$attribute, ['in progress...', 'Closed'])) {
      $this->addError($model, $attribute, 'Wrong status');
    }
  }
}