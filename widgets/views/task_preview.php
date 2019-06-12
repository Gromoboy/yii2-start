<?php

use \yii\helpers\Url;

/** @var $model \app\models\tables\Task */
?>

<div class="task-container">
    <a class="task-preview-link" href="<?=Url::to(['task/one', 'id' => $model->id])?>">
        <div class="task-preview">
            <div class="task-preview-header"><?=$model->name ?></div>
            <div class="task-preview-content"><?=$model->description ?></div>
            <div class="task-preview-user"><?=$model->responsable->username?></div>
            <div class="text-muted"><small><?=$model->created_at?></small></div>
        </div>
    </a>
</div>
