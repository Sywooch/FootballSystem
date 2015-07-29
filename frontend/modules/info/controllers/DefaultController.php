<?php

namespace frontend\modules\info\controllers;

use yii\web\Controller;
use common\models\game;
use common\models\statPlayers;
use common\models\players;
use common\models\team;

class DefaultController extends Controller
{
    public function actionIndex($team,$id)
    {
        $team = rawurldecode($team);
        $teamGame = game::allMatchTeam($team);
        $goal = statPlayers::TeamStatistic('statPlayers.goal',$team);
        $yellow = statPlayers::TeamStatistic('statPlayers.yellow_card',$team);
        $red = statPlayers::TeamStatistic('statPlayers.red_card',$team);
        $players = Players::TeamPlayers($team);
        $teamInfo = team::teamInfo($id);

        return $this->render('index', [ 'team'=>$team,
            'teamGame'=>$teamGame,
            'teamInfo'=>$teamInfo,
            'goal'=>$goal,
            'yellow'=>$yellow,
            'red'=>$red,
            'players'=>$players]);
    }
}
