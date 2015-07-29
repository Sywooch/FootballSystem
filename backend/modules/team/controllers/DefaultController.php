<?php

namespace backend\modules\team\controllers;

use common\models\coach;
use common\models\players;
use common\models\statPlayersCup;
use common\models\statTeam;
use common\models\teamSearch;
use common\models\team;
use common\extensions\file\actions\UploadAction as FileAPIUpload;
use common\extensions;
use frontend\assets\mylib;
use yii\web\Controller;
use Yii;
use common\models\statPlayers;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => Yii::getAlias('@frontend/web/uploads')
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new teamSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $team = team::teamArray();

        return $this->render('index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'team'=>$team
            ]);
    }

    public function actionAdd()
    {
        $team = new team;
        $coach = new coach;

        if(Yii::$app->request->post('team') && Yii::$app->request->post('coach'))
        {
            if ($team->load(Yii::$app->request->post()) && $coach->load(Yii::$app->request->post()))
            {
                $team->save();
                $fk = $team->id_team;
                $coach->id_team = $fk;
                $coach->save(false);

                $statTeam = new statTeam();
                $statTeam->nameTeam = $team->name;
                $statTeam->save(false);

                return $this->redirect('/team');
            }
        }
        else
        {
            return $this->render('add', [
                'team' => $team,
                'coach' => $coach,
            ]);
        }

    }

    public function actionEdit($id)
    {
        $query = team::findOne($id);
        $coach = coach::findOne(['id_team'=>$id]);

        if ($query->load(Yii::$app->request->post()) && $coach->load(Yii::$app->request->post()))
        {
            $query->save();
            $coach->save();
            return $this->redirect('/team');
        }

        return $this->render('edit', [
                    'query' => $query,
                    'coaches' => $coach
                ]);

    }

    public function actionDelete($id)
    {
            $team = team::findOne($id);
            coach::deleteAll(['id_team' => $id]);
            $players = players::find()->select(['id_player'])->where(['team_name'=>$team->name])->all();
            foreach ($players as $player)
            {
                statPlayers::findOne(['id_player'=>$player['id_player']])->delete();
                statPlayersCup::findOne(['id_player'=>$player['id_player']])->delete();
            }
            players::deleteAll(['team_name'=>$team->name]);
            statTeam::deleteAll(['nameTeam'=>$team->name]);
            $team->delete();

            return $this->redirect('/team');
    }

    public  function actionView($id)
    {
        $viewTeam = team::teamView($id);
        $viewCoach = coach::coach($id);

        return $this->render('view',[
                             'id'=>$id,
                             'viewTeam' => $viewTeam,
                             'viewCoach' => $viewCoach
                             ]);
    }

}
