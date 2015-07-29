<?php

namespace frontend\modules\stat\controllers;

use yii\web\Controller;
use common\models\statTeam;
use common\models\statPlayers;

class DefaultController extends Controller
{
    public function actionIndex()
    {

        $team = statTeam::find()->orderBy(['score' => SORT_DESC])->asArray()->all();
        $goal = statPlayers::AllStatistic('statPlayers.goal');
        $yellow = statPlayers::AllStatistic('statPlayers.yellow_card');
        $red = statPlayers::AllStatistic('statPlayers.red_card');


        return $this->render('index',['team'=>$team,
            'goal'=>$goal,
            'yellow'=>$yellow,
            'red'=>$red
        ]);
    }
}
