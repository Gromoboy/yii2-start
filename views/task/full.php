<?php
use yii\widgets\ActiveForm;
?>
<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['task/save', ''])]); ?>
        <?= $form->field($task, 'name')->textInput();?>
        <div class="row">
            <div class="col-lg-4">
                <?=$form->field($task, 'status')->dropDownList($statusesList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($task, 'responsable_id')->dropDownList($usersList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($task, 'deadline')->textInput(['type'=>'date'])?>
            </div>
        </div>
    </div>
</div>

