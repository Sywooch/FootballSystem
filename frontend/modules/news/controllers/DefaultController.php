<?php

namespace frontend\modules\news\controllers;

use yii\web\Controller;
use common\models\message;
use yii\data\Pagination;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $query = message::find()->select(['title','text','time'])->orderBy(['time'=> SORT_DESC]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSizeLimit'=>[1, 6]]);
        $news = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        return $this->render('index', ['news' => $news,'pages' => $pages]);
    }
}
