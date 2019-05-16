<?php

namespace app\controllers;
use yii\web\Controller;

class TestEventController extends Controller
{
    public function actionIndex(){
        return $this->render('info',[
            //передача пар переменная - значение
            'title' => 'Yii2',
            'content' => 'Lesson #'
        ]);
    }
}