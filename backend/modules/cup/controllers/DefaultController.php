<?php

namespace backend\modules\cup\controllers;

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
use yii\helpers\ArrayHelper;
use common\models\statPlayers;
use yii\base\Model;

use common\models\statPlayersCup;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = game::allMatchCup();
        return $this->render('index',['dataProvider' => $dataProvider]);
    }


    public  function actionCupstat()
    {
            $id = Yii::$app->request->get('id');
            $currentTour = Yii::$app->request->get('currentTour');
            $home = Yii::$app->request->post('hgoals');
            $guest = Yii::$app->request->post('growGoals');
            $homeTeam = Yii::$app->request->post('homeTeam');

            if(empty($_POST['hgoals'])) $home = 0;
            if(empty($_POST['growGoals'])) $guest = 0;


            $match = game::find()->select(['homeTeam','guestTeam'])->where(['id_match'=>$id])->one();

            if(!empty($_POST['goals']) OR !empty($_POST['yellowCards']) OR !empty($_POST['redCards']))
            {

                if(!empty($_POST['goals']))
                {
                    foreach( $_POST['goals'] as $m )
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
                            $stat_p = statPlayersCup::findOne(['id_player'=>$id_y->id_player]);
                            $stat_p->goal = $stat_p->goal + 1;

                            $stat_p->save(false);
                        }

                    }
                }

                if(!empty($_POST['yellowCards']))
                {
                    foreach( $_POST['yellowCards'] as $n )
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
                            $stat_y = statPlayersCup::findOne(['id_player'=>$id_y->id_player]);
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

                if(!empty($_POST['redCards']))
                {
                    foreach( $_POST['redCards'] as $g )
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
                            $stat_r = statPlayersCup::findOne(['id_player'=>$id_r->id_player]);
                            $stat_r->red_card = $stat_r->red_card + 1;
                            if($currentTour == '1/8') $stat_r->enable_tour_red_card = "1/4";
                            if($currentTour == '1/4') $stat_r->enable_tour_red_card = "1/2";
                            if($currentTour == '1/2') $stat_r->enable_tour_red_card = "Фінал";
                            $stat_r->save(false);
                        }
                    }
                }
                $games = game::findOne($id);
                $games->rezultato = $home.':'.$guest;
                $games->save(false);
                return $this->redirect('/games/rezult?select='.$currentTour.'&cups=1');

            }
            else if($homeTeam)
            {
                $games = game::findOne($id);
                $games->rezultato = $home.':'.$guest;
                $games->save(false);
                return $this->redirect('/games/rezult?select='.$currentTour.'&cups=1');
            }
            else
            {
                return $this->render('cupstat',['match'=>$match]);
            }

    }

    public  function actionCancelcupstat()
    {
        $id = Yii::$app->request->get('id');
        $currentTour = Yii::$app->request->get('currentTour');

            $goals = goals::find()->select(['author_goals'])->where(['id_match'=>$id])->all();
            if(!empty($goals))
            {
                foreach ($goals as $goal)
                {
                    $id_y = players::findOne(['name'=>$goal['author_goals']]);
                    $stat_p = statPlayersCup::findOne(['id_player'=>$id_y->id_player]);
                    $stat_p->goal = $stat_p->goal - 1;
                    $stat_p->save(false);
                }
                goals::deleteAll(['id_match'=>$id]);
            }

            $yellows = yellowCards::find()->select(['author_yellow_card'])->where(['id_match'=>$id])->all();
            if(!empty($yellows))
            {
                foreach ($yellows as $yellow)
                {
                    $id_y = players::findOne(['name'=>$yellow['author_yellow_card']]);
                    $stat_y = statPlayersCup::findOne(['id_player'=>$id_y->id_player]);
                    $stat_y->yellow_card = $stat_y->yellow_card - 1;
                    if($stat_y->yellow_card % 4 == 3)
                    {
                        $stat_y->red_card = $stat_y->red_card - 1;
                        $stat_y->enable_tour_red_card = 0;
                    }
                    $stat_y->save(false);
                }
                yellowCards::deleteAll(['id_match'=>$id]);
            }

            $reds = redCards::find()->select(['author_red_card'])->where(['id_match'=>$id])->all();
            if(!empty($reds))
            {
                foreach ($reds as $red)
                {
                    $id_y = players::findOne(['name'=>$red['author_red_card']]);
                    $stat_r = statPlayersCup::findOne(['id_player'=>$id_y->id_player]);
                    $stat_r->red_card = $stat_r->red_card - 1;
                    $stat_r->enable_tour_red_card = 0;
                    $stat_r->save(false);
                }
                redCards::deleteAll(['id_match'=>$id]);
            }
            $score = game::findOne(['id_match'=>$id]);
            $score->rezultato = "-";
            $score->save(false);

            $this->redirect('/games/rezult?select='.$currentTour.'&cups=1');

        }
}
