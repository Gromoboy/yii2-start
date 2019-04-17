<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16.04.2019
 * Time: 11:52
 */

namespace app\controllers;
use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{
  public function actionIndex() {
    $model = new Task([
      'title' => ' Йии',
      'description' => 'Первоначальные уроки по фреймворку Йии',
      'status' => 'В работе',
      'author' => 1,
      'responsable' => 200
    ]);
//    var_dump($model->validate());
//    var_dump($model->getErrors());
//    var_dump($model->toArray()); exit;
  }
//  public $layout = false;
  public function actionHello() {
    return $this->render('hello', [
      'title'=>'Домашняя работа №1',
      'content'=>'Привет из фреймворка Йии 2'
    ]);
//    echo "Hello, world";
//    exit;
  }
}