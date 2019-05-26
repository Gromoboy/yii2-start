<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/**
 * @var \app\models\Task $task
 * @var array $statusesList
 * @var array $usersList
 * @var \app\models\tables\TaskComments $taskCommentForm
 * @var \app\models\tables\TaskAttachments $taskAttachmentsForm
 * @var integer $cur_user_id
 */
?>
<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $task->id])]); ?>
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
<div class="attachments">
    <h3>Вложения</h3>
    <?php $form = ActiveForm::begin([
            'action' => Url::to(['task/add-attachment']),
            'options' => ['class'=> 'form-inline'], // class для оформления
    ]); ?>
        <!-- сохраняем ID задачи для использования в форме  -->
        <?= $form->field($taskAttachmentsForm, 'task_id')->hiddenInput(['value'=> $task->id])->label(false) ?>
        <?= $form->field($taskAttachmentsForm, 'attachment')->fileInput() ?>
        <?= Html::submitButton('Добавить картинку', ['class'=> 'btn btn-default']) ?>
    <?php ActiveForm::end(); ?>
    <hr>
    <div class="attachments-history">
        <? foreach ($task->attachments as $file):?>
            <a href="/img/tasks/<?= $file->path ?>">

               <img src="/img/tasks/small/<?= $file->path ?>">
            </a>
        <? endforeach; ?>
    </div>
</div>

<div class="comments">
    <h3>Комметарии</h3>
    <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]); ?>

        <?=$form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $cur_user_id])->label(false);?>
        <?=$form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $task->id])->label(false);?>
        <?=$form->field($taskCommentForm, 'content')->textInput() ?>
        <?=Html::submitButton("Добавить", ['class' => 'btn btn-default'])?>
    <?php ActiveForm::end(); ?>
    <hr>
    <div class="comments-history">
        <? foreach ($task->comments as $comment):?>
            <p class="comment">
                <strong> <?=$comment->author->username?> </strong>
                <?=$comment->content?>
            </p>
        <? endforeach; ?>
    </div>
</div>
