<?php


namespace app\assets;


use yii\web\AssetBundle;

class TaskOneAsset extends  AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/task.css'
    ];

}