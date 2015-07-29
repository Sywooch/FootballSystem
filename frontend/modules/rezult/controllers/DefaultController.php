<?php

namespace frontend\modules\rezult\controllers;

use yii\web\Controller;
use common\models\statTeam;
use common\models\game;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $stat = statTeam::TournamentTable();
        $match = game::allMatch();

        return $this->render('index',
            ['stat'=>$stat,
                'match'=>$match]);

    }
}
