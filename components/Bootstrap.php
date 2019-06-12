<?php

namespace app\components;

use app\models\tables\Task;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class Bootstrap extends Component implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $this->attachEventHandlers();
        $this->setLanguage();
    }

    public function setLanguage()
    {
        $lang = \Yii::$app->session->get('lang');
        if (!$lang) return;
        \Yii::$app->language = $lang;
    }

    private function attachEventHandlers()
    {

        Event::on(
            Task::class,
            Task::EVENT_BEFORE_INSERT,
            function ($event) {
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
            }
        );
    }
}