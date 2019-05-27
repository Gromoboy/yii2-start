<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16.04.2019
 * Time: 11:52
 */

namespace app\controllers;

use app\models\tables\{Task, TaskAttachments, TaskComments, TaskStatuses, Users};
use app\models\forms\TaskAttachmentsAddForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class TaskController extends Controller
{
    public function actionIndex($month = 0)
    {
        $query = ($month > 0 and $month <= 12) ?
            Task::find()->where("MONTH(created_at)=$month") :
            Task::find();
//        var_dump($query); exit;
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        //кэширование запроса
        \Yii::$app->db->cache(
            function () use ($dataProvider) {
                return $dataProvider->prepare();
            }
        );


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

    public function actionOne($id)
    {
        $taskRecord = Task::findOne($id);

        return $this->render(
            'full',
            [
                'task' => $taskRecord,
                'usersList' => Users::getUsersList(),
                'statusesList' => TaskStatuses::getList(),
                'taskCommentForm' => new TaskComments(),
                'cur_user_id' => \Yii::$app->user->id,
                'taskAttachmentsForm' => new TaskAttachmentsAddForm(),
            ]
        );
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

    }

    public function actionSave($id)
    {
        if ($taskRec = Task::findOne($id) and
            $taskRec->load(\Yii::$app->request->post()) and
            $taskRec->save()) {
            \Yii::$app->session->setFlash('success', "Изменения сохранены");
        } else {
            \Yii::$app->session->setFlash('error', 'Ну удалось сохранить изменения');
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddComment()
    {
        $sendedComment = \Yii::$app->request->post();
//        var_dump($post);exit;
        $newTaskCommentRec = new TaskComments();

        if ($newTaskCommentRec->load($sendedComment) and $newTaskCommentRec->save()) {
            \Yii::$app->session->setFlash('success', "Комментарий добавлен");
        } else {
            \Yii::$app->session->setFlash('error', 'Нe удалось добавить комментарий');
        }

        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddAttachment()
    {
        $newAttachmentInfo = new TaskAttachmentsAddForm();
        $newAttachmentInfo->load(\Yii::$app->request->post());
        $newAttachmentInfo->attachment = UploadedFile::getInstance($newAttachmentInfo, 'attachment');

        if ($newAttachmentInfo->save()) {
           \Yii::$app->session->setFlash('success', 'Файл добавлен') ;
        } else {
            \Yii::$app->session->setFlash('error', 'Ну удается добавить файл');
        }

        $this->redirect(\Yii::$app->request->referrer);
    }
}