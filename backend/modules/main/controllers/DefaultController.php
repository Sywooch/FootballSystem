<?php
namespace backend\modules\main\controllers;

use Yii;
use yii\web\Controller;
use common\models\game;
use common\models\goals;
use common\models\message;
use common\models\redCards;
use common\models\yellowCards;

use common\models\statTeam;
use common\models\statPlayers;
use common\models\statPlayersCup;
/**
 * Site controller
 */
class DefaultController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAllcancel()
    {
        game::deleteAll();
        goals::deleteAll();
        yellowCards::deleteAll();
        redCards::deleteAll();
        message::deleteAll();

        statTeam::updateAll(['game' => 0,'win'=>0,'draw'=>0,'lose'=>0,'goalPlus'=>0,'goalMinus'=>0,'score'=>0]);
        statPlayers::updateAll(['goal'=>0,'yellow_card'=>0,'red_card'=>0,'enable_tour_red_card'=>0]);
        statPlayersCup::updateAll(['goal'=>0,'yellow_card'=>0,'red_card'=>0,'enable_tour_red_card'=>0]);

        return $this->redirect(Yii::$app->homeUrl);
    }

}
