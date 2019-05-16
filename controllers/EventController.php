<?php


namespace app\controllers;

use app\models\tables\Task;
use yii\base\Event;
use yii\web\Controller;

class EventController extends Controller
{
    public function actionIndex() {
        Event::on(Task::class, Task::EVENT_BEFORE_INSERT, function ($event) {
            /** @var Task $task */
            $task = $event->sender;
            $user = $task->responsable;

            $body = "На вас назначена новая задача {$task->name}. Посмотреть можно по ссылке: 
            http://yii2.uni.loc/?r=task/one&id={$task->id}
            ";

            \Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom('admin@test.ru')
                ->setSubject('Новая задача')
                ->setTextBody($body)
                ->send();
        });
    }

}