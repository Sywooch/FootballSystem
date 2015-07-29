<?php

namespace frontend\modules\main\controllers;

use yii\web\Controller;
use common\models\message;
use common\models\statTeam;
use common\models\team;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $team = team::allTeam();
        $stat = statTeam::TournamentTable();
        $news = message::lastNews(8);

        return $this->render('index', ['team'=>$team,
            'stat'=>$stat,
            'news'=>$news]);
    }
}
