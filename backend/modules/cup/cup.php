<?php

namespace backend\modules\cup;

class cup extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\cup\controllers';

    public function init()
    {
        parent::init();

        $this->params['a'] = 123;
        // custom initialization code goes here
    }
}
