<h1 class = "text-center">Регистрация</h1>
<?php
/** @var \app\models\tables\Users $model */

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$form = ActiveForm::begin();
echo $form->field($model, 'username')->textInput();
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'email');
echo Html::submitButton("Зарегистрироваться", ['class'=>'btn btn-success']);
ActiveForm::end();