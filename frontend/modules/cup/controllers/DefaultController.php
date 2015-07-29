<?php

namespace frontend\modules\cup\controllers;

use common\models\game;
use yii\web\Controller;
use common\models\message;
use common\models\statPlayersCup;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $match1 = game::bracket('1/8');
        $match2 = game::bracket('1/4');
        $match3 = game::bracket('1/2');
        $match4 = game::bracket('Фінал');
        $news = message::CupNews();
        $goal = statPlayersCup::AllStatCup('statPlayersCup.goal');
        $yellow = statPlayersCup::AllStatCup('statPlayersCup.yellow_card');
        $red = statPlayersCup::AllStatCup('statPlayersCup.red_card');

        return $this->render('index',['news'=>$news,
            'goal'=>$goal,
            'yellow'=>$yellow,
            'red'=>$red,
            'match1'=>$match1,
            'match2'=>$match2,
            'match3'=>$match3,
            'match4'=>$match4
        ]);
    }
}
