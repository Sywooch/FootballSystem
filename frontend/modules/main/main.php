<?php

namespace frontend\modules\main;

class main extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\main\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public  function  gg()
    {
        echo "gg";
    }
}
