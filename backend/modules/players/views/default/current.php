<?
/**
 * @var yii\base\View $this
 * @var common\models\teamSearch $dataProvider
 * @var common\models\teamSearch $searchModel
 * @var array $name_player
 * @var array $living
 * @var array $team_name
 * @var string $team
 */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Гравці чемпіонату";
?>
<div class="middle_anonsing">
    <div class="top_menu">
        <?=Html::a(('<button>Зареєструвати гравця</button>'),'new');?>
    </div>
    <div class="clear"></div>
    <div class="top_line">Зареєстровані гравці команди "<?=html::encode($team)?>"</div>
    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'tableViewPlayer'],
        'filterModel' => $searchModel,
        'columns' => [
            'number',
            ['attribute' =>'name',
                'filter' => Html::activeDropDownList($searchModel, 'name', $name_player, ['class' => 'dropdownlist', 'prompt' => 'Вибрати'])],

            ['attribute' =>'living',
                'filter' => Html::activeDropDownList($searchModel, 'living', $living, ['class' => 'dropdownlist', 'prompt' => 'Вибрати'])],

            'old', 'position',
            ['class' => 'yii\grid\ActionColumn',
                'options'=>['class' => 'lastColumnPlayer'],
                'header'=>'Управління',
                'template' => '{edit} {delete} ',
                'buttons' => [
                    'edit' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/players/change', 'id' => $searchModel->id_player]);
                            return Html::a('<span class="editButton">Редагувати</span>', $url, [
                                'data-pjax' => '0',
                                'class' => 'grid-action'
                            ]);
                        },
                    'delete' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/players/del', 'id' => $searchModel->id_player]);
                            return Html::a('<span class="deleteButton ">Видалити</span>', $url, [
                                'data-pjax' => '0',
                                'class' => 'grid-action'
                            ]);
                        }
                ]
            ]
        ]]);?>

</div>