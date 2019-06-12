<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 25.04.2019
 * Time: 15:23
 */

namespace app\controllers;


use app\models\tables\Users;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $html = '';
        $users = Users::find()->select(['username'])->orderBy('username')->column();
        foreach ($users as $username) {
            $html .= "<li>$username</li>";
        }

        return $this->render('usersList', ['items' => $html]);
    }

    public function actionReg()
    {
        $model = new Users(
          [
              //'username'=>'sasha',
          ]
        );

        // при отправке поста
        if($model->load(\Yii::$app->request->post())) {
            $model->save();
        }

        return $this->render('registration', ['model' => $model]);

    }

}