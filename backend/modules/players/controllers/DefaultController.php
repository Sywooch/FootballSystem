<?php

namespace backend\modules\players\controllers;

use frontend\assets\mylib;
use Yii;
use yii\web\Controller;
use common\models\playersSearch;
use common\models\players;
use common\models\team;
use common\models\statPlayers;
use common\models\statPlayersCup;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $players = players::GroupPlayers();
        return $this->render('index',['players' => $players]);
    }

    public function actionNew()
    {
            $player = new players;
            $position = mylib::position();
            $team = team::teamArray();
            if ($player->load(Yii::$app->request->post()) && $player->save())
            {
                $statPlayer = new statPlayers;
                $statPlayer->id_player = $player->id_player;
                $statPlayer->save(false);

                $statPlayerCup = new statPlayersCup;
                $statPlayerCup->id_player = $player->id_player;
                $statPlayerCup->save(false);

                return $this->redirect('/players');
            }
            else
            {
                return $this->render('new', [
                    'player' => $player,
                    'position' => $position,
                    'team' => $team
                    ]);
            }
    }

    public function actionChange($id)
    {
        $model = players::findOne($id);
        $position = mylib::position();
        $team = team::teamArray();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect('/players');
        }
            return $this->render('change', [
                'model' => $model,
                'position' => $position,
                'team' => $team
            ]);
    }


    public function actionDel($id)
    {
        players::findOne($id)->delete();
        statPlayers::findOne(['id_player'=>$id])->delete();
        statPlayersCup::findOne(['id_player'=>$id])->delete();

        return $this->redirect('/players');
    }

    public function actionCurrent($team)
    {
        $searchModel = new playersSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get(),$team);
        $model = players::currentPlayers($team);
        $name_player = mylib::namePlayers($model);
        $living = mylib::livingPlayers($model);

        return $this->render('current',[
                            'team'=>$team,
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                            'name_player'=>$name_player,
                            'living'=>$living,
                        ]);
    }

}
