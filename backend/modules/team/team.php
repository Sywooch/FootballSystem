<?php

namespace backend\modules\team;

use Yii;
use yii\base\Module;

class team extends Module
{
    public $controllerNamespace = 'backend\modules\team\controllers';

    public $avatarWidth = 100;

    public $avatarHeight = 100;

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function avatarUrl($image = null)
    {
        $url = '/uploads/avatars/';
        if ($image !== null) {
            $url .= $image;
        }
        return $url;
    }

}
