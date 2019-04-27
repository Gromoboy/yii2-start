<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'creator_id',
            'responsable_id',
            //'deadline',
            //'status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
        echo \yii\widgets\ListView::widget([
           'dataProvider' => $dataProvider,
           'itemView' => 'view',
            'viewParams' => [
                    'hide' => true,
            ]
        ]);
    ?>


</div>
