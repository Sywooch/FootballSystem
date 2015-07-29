<?php

namespace backend\modules\message\controllers;

use common\models\message;
use common\models\messageSearch;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new messageSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);

    }

    public function actionAddnews()
    {
        $model = new message;
        if ($model->load(Yii::$app->request->post()))
        {
            $model->edit = 1;
            $model->save();
            return $this->redirect('/message');
        }
        else
        {
            return $this->render('addnews',['model'=>$model]);
        }
    }

    public function actionRemove($id)
    {
        message::findOne($id)->delete();
        return $this->redirect('/message');
    }

    public function actionChanges($id)
    {
        $model = message::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect('/message');
        }

        return $this->render('changes', [
            'model' => $model,
        ]);
    }

    public  function actionViews($id)
    {
        $news = message::newsView($id);

        return $this->render('views',
            [
                'news' => $news,
            ]);
    }
}
