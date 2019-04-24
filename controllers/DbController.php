<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 21.04.2019
 * Time: 0:06
 */

namespace app\controllers;


use yii\web\Controller;
use app\models\tables;

class DbController extends Controller
{
  public function actionIndex() {
    $result = \Yii::$app->db->createCommand(
      "SELECT * FROM frutella.test"
    )->queryAll();

    var_dump($result);

  }

  public function actionSecond() {
    var_dump(tables\Task::findOne(2)->name);
    exit;
  }
}