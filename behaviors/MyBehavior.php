<?php

namespace app\behaviors;
use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public  $message = 'hello dynamic prop of myBehavior';

    public function display() {
        echo $this->message ;
    }
}