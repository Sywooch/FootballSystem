<?
/**
 * @var yii\base\View $this
 * @var common\models\teamSearch $dataProvider
 * @var common\models\teamSearch $searchModel
 * @var array $tour
 */
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = "Матчі";
?>

<div class="middle_anonsing">
    <div class="top_menu">
        <ul>
            <li><?=Html::a(('<button>Додати матч</button>'),'games/match');?></li>
            <li><?=Html::a(('<button>Результати</button>'),'games/select');?></li>
            <li><?=Html::a(('<button>Анонс туру</button>'),'games/anons');?></li>

        </ul>
    </div>
    <div class="clear"></div>
    <div class="top_line">Матчі чемпіонату обухівського району</div>
    <?echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'tableViewPlayer'],
        'columns' => [
            ['attribute' =>'tour',
                'filter' => Html::activeDropDownList($searchModel, 'tour', $tour, ['class' => 'dropdownlist', 'prompt' => ' '])],

            'date','homeTeam','guestTeam','startTime','stadium','referi','rezultato',
            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class' => 'lastColumnPlayer'],
                'header'=>'Управління',
                'template' => '{edit} {delete} ',
                'buttons' => [
                    'edit' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/games/changematch', 'id' => $searchModel->id_match]);
                            return Html::a('<span class="editButton">Редагувати</span>', $url, [
                                'class' => 'grid-action'
                            ]);
                        },
                    'delete' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/games/removematch', 'id' => $searchModel->id_match]);
                            return Html::a('<span class="deleteButton ">Видалити</span>', $url, [
                                'class' => 'grid-action'
                            ]);
                        }
                ]
            ]
        ]]);?>

</div>