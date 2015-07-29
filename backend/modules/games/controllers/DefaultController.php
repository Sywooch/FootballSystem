<?php

namespace backend\modules\games\controllers;

use common\models\game;
use common\models\goals;
use common\models\message;
use common\models\redCards;
use common\models\statTeam;
use common\models\team;
use common\models\players;
use common\models\gameSearch;
use common\models\yellowCards;
use yii\web\Controller;
use Yii;
use common\models\statPlayers;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DefaultController extends Controller
{

    public function actionIndex()
    {

        $searchModel = new gameSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $tour = game::tourGame();

        return $this->render('index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'tour'=>$tour
            ]);
    }

    public function actionMatch()
    {
        $game = new game;
        $team = ArrayHelper::map(team::find()->select('name')->asArray()->all(), 'name', 'name');
        if ($game->load(Yii::$app->request->post()) && $game->save())
        {
            if(Yii::$app->request->post('cup') == 1) return $this->redirect('/cup');
            else return $this->redirect('/games');
        }
        else
        {
            return $this->render('match', [
                'game' => $game,
                'team' => $team
            ]);
        }
    }

    public function actionChangematch($id)
    {
        $model = game::findOne($id);
        $team = team::teamArray();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            if($id = Yii::$app->request->get('cup') == 1) return $this->redirect('/cup');
            else return $this->redirect('/games');
        }

        return $this->render('changematch', [
            'model' => $model,
            'team' => $team
        ]);
    }

    public function actionRemovematch($id)
    {
        game::findOne($id)->delete();
        if($id = Yii::$app->request->get('cup') == 1) return $this->redirect('/cup');
        else return $this->redirect('/games');
    }

    public function actionAnons($cup = 0)
    {
        if($cup == 1)
        {
            $tour = game::stadGame();
            $head_title = "Анонс стадії кубка";
            $select = "Вибрати стадію";
            return $this->render('anons',['tour'=>$tour,'head_title'=>$head_title,'select'=>$select,]);
        }
        else
        {
            $tour = game::tourGame();
            $head_title = "Анонс туру чемпіоната";
            $select = "Вибрати тур";
            return $this->render('anons',['tour'=>$tour,'head_title'=>$head_title,'select'=>$select,]);
        }
    }

    public function actionListplayer($team,$num,$type)
    {
        $list = players::listPlayer($team);
        if($type == 'g')
        {
            $name = "goals[$num][author_goals]";
        }
        if($type == 'y')
        {
            $name = "yellowCards[$num][author_yellow_card]";
        }
        if($type == 'r')
        {
            $name = "redCards[$num][author_red_card]";
        }

        return $this->renderPartial('listplayer',['list'=>$list,'name'=>$name]);
    }

    public function actionPreview($tour,$cup)
    {
        $model = new message;
        $match = game::match($tour);
        $redName = statPlayers::redCard($tour,$cup);
        $yellowName = statPlayers::yellowCard($cup);

        if($cup)
        {
            $title = " стадії кубка";
            $redtitle = "Стадію пропускають";
        }
        else
        {
            $title = "туру";
            $redtitle = "Тур пропускають";
        }

            return $this->renderPartial('preview',
                    ['match'=>$match,
                    'redName'=>$redName,
                    'yellowName'=>$yellowName,
                    'model'=>$model,
                    'title'=>$title,
                    'redtitle'=>$redtitle]);

    }

    public  function actionSelect($cup = 0)
    {
        if($cup == 1)
        {
            $tour = game::stadGame();
            $head_title = "Результати кубку";
            $select = "Вибрати стадію";

            return $this->render('select',['tour'=>$tour,'head_title'=>$head_title,'select'=>$select,]);
        }
        else
        {
            $tour = game::tourGame();
            $head_title = "Результати чемпіонату";
            $select = "Вибрати тур";

            return $this->render('select',['tour'=>$tour,'head_title'=>$head_title,'select'=>$select,]);
        }

    }

    public  function actionScore($tour, $anostitle)
    {
        $model = new message;
        $match = game::find()->select(['id_match','tour','homeTeam','guestTeam','rezultato'])->where(['tour'=>$tour])->asArray()->all();
        foreach($match as $value)
        {
            $matches = goals::find()->where(['id_match' => $value['id_match']])->with('authorGoals')->asArray()->all();
            foreach($matches as $match1)
            {
                if($match1['authorGoals']['team_name'] == $value['homeTeam'])
                {
                    $homeTeamGoals[$value['homeTeam']][] = $match1['author_goals'];
                }
                if($match1['authorGoals']['team_name'] == $value['guestTeam'])
                {
                    $guestTeamGoals[$value['guestTeam']][] = $match1['author_goals'];
                }
            }


            $yellowCards = yellowCards::find()->where(['id_match' => $value['id_match']])->with('authorYellowCard')->asArray()->all();
            foreach($yellowCards as $cardY)
            {
                if($cardY['authorYellowCard']['team_name'] == $value['homeTeam'])
                {
                    $homeTeamYCards[$value['homeTeam']][] = $cardY['author_yellow_card'];
                }
                if($cardY['authorYellowCard']['team_name'] == $value['guestTeam'])
                {
                    $guestTeamYCards[$value['guestTeam']][] = $cardY['author_yellow_card'];
                }
            }


            $redCards = redCards::find()->where(['id_match' => $value['id_match']])->with('authorRedCard')->asArray()->all();
            foreach($redCards as $cardR)
            {
                if($cardR['authorRedCard']['team_name'] == $value['homeTeam'])
                {
                    $homeTeamRCards[$value['homeTeam']][] = $cardR['author_red_card'];
                }
                if($cardR['authorRedCard']['team_name'] == $value['guestTeam'])
                {
                    $guestTeamRCards[$value['guestTeam']][] = $cardR['author_red_card'];
                }
            }
        }
        return $this->renderPartial('score',
                     ['match'=>$match,
                     'title'=>$anostitle,
                    'homeTeamGoals'=>$homeTeamGoals,
                    'guestTeamGoals'=>$guestTeamGoals,
                    'homeTeamYCards'=>$homeTeamYCards,
                    'guestTeamYCards'=>$guestTeamYCards,
                    'homeTeamRCards'=>$homeTeamRCards,
                    'guestTeamRCards'=>$guestTeamRCards,
                    'model'=>$model]);
    }

    public  function actionRezult($cups = 0, $select)
    {
        if($cups)
        {
            $title = "Стадія фіналу";
            $anostitle = "стадії";
            $controller = "cup";
        }
        else
        {
            $title = "тур";
            $anostitle = "туру";
            $controller = "games";
        }
        $match = game::find()->select(['id_match','tour','homeTeam','guestTeam','rezultato'])->where(['tour'=>$select])->asArray()->all();
        foreach($match as $value)
        {
            $matches = goals::find()->where(['id_match' => $value['id_match']])->with('authorGoals')->asArray()->all();
            foreach($matches as $match1)
            {
                if($match1['authorGoals']['team_name'] == $value['homeTeam'])
                {
                    $homeTeamGoals[$value['homeTeam']][] = $match1['author_goals'];
                }
                if($match1['authorGoals']['team_name'] == $value['guestTeam'])
                {
                    $guestTeamGoals[$value['guestTeam']][] = $match1['author_goals'];
                }
            }

            $yellowCards = yellowCards::find()->where(['id_match' => $value['id_match']])->with('authorYellowCard')->asArray()->all();
            foreach($yellowCards as $cardY)
            {
                if($cardY['authorYellowCard']['team_name'] == $value['homeTeam'])
                {
                    $homeTeamYCards[$value['homeTeam']][] = $cardY['author_yellow_card'];
                }
                if($cardY['authorYellowCard']['team_name'] == $value['guestTeam'])
                {
                    $guestTeamYCards[$value['guestTeam']][] = $cardY['author_yellow_card'];
                }
            }

            $redCards = redCards::find()->where(['id_match' => $value['id_match']])->with('authorRedCard')->asArray()->all();
            foreach($redCards as $cardR)
            {
                if($cardR['authorRedCard']['team_name'] == $value['homeTeam'])
                {
                    $homeTeamRCards[$value['homeTeam']][] = $cardR['author_red_card'];
                }
                if($cardR['authorRedCard']['team_name'] == $value['guestTeam'])
                {
                    $guestTeamRCards[$value['guestTeam']][] = $cardR['author_red_card'];
                }
            }
        }
        return $this->render('rezult',
                ['match'=>$match,
                    'title'=>$title,
                    'anostitle'=>$anostitle,
                    'controller'=>$controller,
                    'homeTeamGoals'=>$homeTeamGoals,
                    'guestTeamGoals'=>$guestTeamGoals,
                    'homeTeamYCards'=>$homeTeamYCards,
                    'guestTeamYCards'=>$guestTeamYCards,
                    'homeTeamRCards'=>$homeTeamRCards,
                    'guestTeamRCards'=>$guestTeamRCards,
                ]);
    }

    public  function actionCancelscore($id,$currentTour,$home,$guest,$homeTeam,$guestTeam)
    {
       if($home > $guest) statTeam::cancelScoreWinHome($homeTeam,$guestTeam);
       else if($home < $guest) statTeam::cancelScoreWinGuest($homeTeam,$guestTeam);
       else statTeam::cancelScoreDraw($homeTeam,$guestTeam);

       goals::cancelScoreGoals($id);
       yellowCards::cancelScoreYellowCards($id);
       redCards::cancelScoreRedCards($id);
       game::cancelScore($id);

       $this->redirect('/games/rezult?select='.$currentTour);
    }

    public  function actionAddscore($id,$currentTour)
    {
        $home = Yii::$app->request->post('hgoals');
        $guest = Yii::$app->request->post('growGoals');
        $homeTeam = Yii::$app->request->post('homeTeam');
        $guestTeam = Yii::$app->request->post('guestTeam');

        $goals = Yii::$app->request->post('goals');
        $yellowCards = Yii::$app->request->post('yellowCards');
        $redCards = Yii::$app->request->post('redCards');

        if(empty($home)) $home = 0;
        if(empty($guest)) $guest = 0;

        if(!empty($home) or !empty($guest))
        {
            if($home > $guest) statTeam::addScoreWinHome($homeTeam,$guestTeam);
            else if($home < $guest) statTeam::addScoreWinGuest($homeTeam,$guestTeam);
            else  statTeam::addScoreDraw($homeTeam,$guestTeam);
        }

        $match = game::find()->select(['homeTeam','guestTeam'])->where(['id_match'=>$id])->one();

        if(!empty($goals) OR !empty($yellowCards) OR !empty($redCards))
        {
            if(!empty($goals))
            {
                foreach( $goals as $m )
                {
                    $models[] = new goals();
                }
                if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models))
                {
                    foreach ($models as $model)
                    {
                        $model->id_match = $id;
                        $model->save(false);

                        $id_y = players::findOne(['name'=>$model->author_goals]);
                        $stat_p = statPlayers::findOne(['id_player'=>$id_y->id_player]);
                        $stat_p->goal = $stat_p->goal + 1;
                        $stat_p->save(false);
                    }

                }
            }
            else  statTeam::addScoreDraw($homeTeam,$guestTeam);

            if(!empty($yellowCards))
            {
                foreach( $yellowCards as $n )
                {
                    $yellows[] = new yellowCards();
                }
                if (Model::loadMultiple($yellows, Yii::$app->request->post()) && Model::validateMultiple($yellows))
                {
                    foreach ($yellows as $yellow)
                    {
                        $yellow->id_match = $id;
                        $yellow->save(false);

                        $id_y = players::findOne(['name'=>$yellow->author_yellow_card]);
                        $stat_y = statPlayers::findOne(['id_player'=>$id_y->id_player]);
                        $stat_y->yellow_card = $stat_y->yellow_card + 1;
                        if($stat_y->yellow_card % 4 == 0)
                        {
                            $stat_y->red_card = $stat_y->red_card + 1;
                            $stat_y->enable_tour_red_card = $currentTour + 1;
                        }
                        $stat_y->save(false);
                    }
                }
            }
            if(!empty($redCards))
            {
                foreach( $redCards as $g )
                {
                    $Reds[] = new redCards();
                }
                if (Model::loadMultiple($Reds, Yii::$app->request->post()) && Model::validateMultiple($Reds))
                {
                    foreach ($Reds as $red)
                    {
                        $red->id_match = $id;
                        $red->save(false);

                        $id_r = players::findOne(['name'=>$red->author_red_card]);
                        $stat_r = statPlayers::findOne(['id_player'=>$id_r->id_player]);
                        $stat_r->red_card = $stat_r->red_card + 1;
                        $stat_r->enable_tour_red_card = $currentTour + 1;
                        $stat_r->save(false);
                    }
                }
            }
            game::addScore($id,$home,$guest);
            return $this->redirect('/games/rezult?select='.$currentTour);
        }
        else if(!empty($homeTeam))
        {
            statTeam::addScoreDraw($homeTeam,$guestTeam);
            game::addScore($id,$home,$guest);
            return $this->redirect('/games/rezult?select='.$currentTour);
        }
        else
        {
            return $this->render('addscore',['match'=>$match]);
        }
    }

}
