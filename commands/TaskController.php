<?php


namespace app\commands;


use yii\console\Controller;
use app\models\tables\Task;

class TaskController extends Controller
{
    public function actionTest()
    {
        echo 'hello world';
    }

    public function actionDeadline()
    {

        /** @var Task[] $comingDeadlineTasks */
        $comingDeadlineTasks = Task::getDeadlineIn(24);
//        var_dump($comingDeadlineTasks);exit;

        foreach ($comingDeadlineTasks as $task)
        {
            \Yii::$app->mailer->compose()
                ->setTo($task->responsable->email)
                ->setSubject('DEADLINE COMING!!!')
                ->setTextBody(\Yii::t('app', 'deadline_warning'))
                ->send();
        }
    }
}