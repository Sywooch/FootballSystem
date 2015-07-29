<?
/**
 * @var yii\base\View $this
 * @var common\models\teamSearch $dataProvider
 * @var array $tour
 */
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = "Матчі";
?>

<div class="middle_anonsing">
    <div class="top_menu">
        <ul>
            <li><?=Html::a(('<button>Додати матч</button>'),'games/match?cup=1');?></li>
            <li><?=Html::a(('<button>Результати</button>'),'games/select?cup=1');?></li>
            <li><?=Html::a(('<button>Анонс матчів</button>'),'games/anons?cup=1');?></li>

        </ul>
    </div>
    <div class="clear"></div>
    <div class="top_line">Матчі кубка обухівського району</div>
    <?echo GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'tableViewPlayer'],
        'columns' => [
            ['attribute' =>'tour',
                'header'=>'Стадія'],
            'date','homeTeam','guestTeam','startTime','stadium','referi','rezultato',
            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class' => 'lastColumnPlayer'],
                'header'=>'Управління',
                'template' => '{edit} {delete} ',
                'buttons' => [
                    'edit' => function($url, $dataProvider) {
                            $url = \yii\helpers\Url::toRoute(['/games/changematch', 'id' => $dataProvider->id_match,'cup'=>1]);
                            return Html::a('<span class="editButton">Редагувати</span>', $url, [
                                'class' => 'grid-action'
                            ]);
                        },
                    'delete' => function($url, $dataProvider) {
                            $url = \yii\helpers\Url::toRoute(['/games/removematch', 'id' => $dataProvider->id_match,'cup'=>1]);
                            return Html::a('<span class="deleteButton ">Видалити</span>', $url, [
                                'class' => 'grid-action'
                            ]);
                        }
                ]
            ]
        ]]);?>

</div>