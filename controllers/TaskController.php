<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16.04.2019
 * Time: 11:52
 */

namespace app\controllers;

use app\models\tables\Task;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
          'query'=> Task::find(),
        ]);
        return $this->render(
          'index',
          [
            'dataProvider' => $dataProvider,
          ]
        );
        // проверка url:   http://yii2.uni.loc/?r=task/
//    var_dump($model->validate());
//    var_dump($model->getErrors());
//    var_dump($model->toArray()); exit;

    }

//  public $layout = false;
    public function actionHello()
    {
        return $this->render(
          'hello',
          [
            'title' => 'Домашняя работа №1',
            'content' => 'Привет из фреймворка Йии 2',
          ]
        );
//    echo "Hello, world";
//    exit;
    }
}