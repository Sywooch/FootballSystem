<?
/**
 * @var yii\base\View $this
 * @var common\models\teamSearch $dataProvider
 * @var object $searchModel
 */
use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="middle_anonsing">
    <div class="top_menu"><?=Html::a(('<button>Нове повідомлення</button>'),'message/addnews');?></div>
    <div class="top_line">Опубліковані новини</div>
    <?echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'tableView'],
        'columns' => [
            'title',
            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class' => 'lastColumn'],
                'header'=>'Управління',
                'template' => '{view} {edit} {delete} ',
                'buttons' => [
                    'view' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/message/views', 'id' => $searchModel->id_message]);
                            return Html::a('<span class="viewButton">Повний текст</span>', $url, [
                                'class' => 'grid-action'
                            ]);
                        },
                    'edit' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/message/changes', 'id' => $searchModel->id_message]);
                            if($searchModel->edit) return Html::a('<span class="editButton">Редагувати</span>', $url, ['class' => 'grid-action']);
                            else false;
                        },
                    'delete' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/message/remove', 'id' => $searchModel->id_message]);
                            return Html::a('<span class="deleteButton ">Видалити</span>', $url, [
                                'class' => 'grid-action'
                            ]);
                        }
                ]
            ]
        ]]);?>

</div>