<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\tables\Test;

class TestEventController extends Controller
{
    public function actionIndex(){
        $model = new Test();
        $model->on(Test::EVENT_RUN_STARTED, function(){
            echo "Обработчик старта<br>";
        });
        $model->display();
        $model->run();
        exit;
    }
}