<?
/**
 * @var yii\base\View $this
 * @var common\models\teamSearch $dataProvider
 * @var common\models\teamSearch $searchModel
 * @var array $team
 */

use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = "Команди чемпіонату";
?>
<div class="middle_anonsing">
    <div class="top_menu">
            <?=Html::a(('<button>Зареєструвати команду</button>'),'team/add');?>
    </div>
    <div class="clear"></div>
    <div class="top_line">Зареєстровані команди чемпіонату обухівського району</div>

        <?=GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'tableView'],
            'columns' => [
                ['class' => SerialColumn::className(), 'header'=>'№',
                'options'=>['class' => 'firstColumn']],
                ['attribute' => 'name',
                'filter' => Html::activeDropDownList($searchModel, 'name', $team, ['class' => 'dropdownlist', 'prompt' => 'Виберіть команду'])],
                'from','stadium',
                ['class' => 'yii\grid\ActionColumn',
                'options'=>['class' => 'lastColumns'],
                'header'=>'Управління',
                'template' => '{view} {edit} {delete} ',
                'buttons' => [
                    'view' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/team/view', 'id' => $searchModel->id_team]);
                            return Html::a('<span class="viewButton">Детальний огляд</span>', $url, [
                            'data-pjax' => '0',
                            'class' => 'grid-action'
                            ]);
                        },
                    'edit' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/team/edit', 'id' => $searchModel->id_team]);
                            return Html::a('<span class="editButton">Редагувати</span>', $url, [
                            'data-pjax' => '0',
                            'class' => 'grid-action'
                            ]);
                        },
                    'delete' => function($url, $searchModel) {
                            $url = \yii\helpers\Url::toRoute(['/team/delete', 'id' => $searchModel->id_team]);
                            return Html::a('<span class="deleteButton ">Видалити</span>', $url, [
                            'data-pjax' => '0',
                            'class' => 'grid-action'
                            ]);
                        }
                    ]
                ]
            ]]);?>

</div>