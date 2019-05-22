<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['task/save', 'id' => $task->id])]); ?>
        <?= $form->field($task, 'name')->textInput(); ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($task, 'status_id')->dropDownList($statusesList) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($task, 'responsable_id')->dropDownList($usersList) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($task, 'deadline')->textInput(['type' => 'date']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

