<?php
/**
 * @var yii\base\View $this
 * @var array $tour
 * @var string $head_title
 * @var string $select
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = $head_title;
?>
<div class='middle_anonsing'>
    <div class='anonsed'>
        <div class='regHeadTeam'><?=$head_title?></div>
        <p><?=$select?></p><br>
        <?
        $form = ActiveForm::begin(['action' => 'rezult','method'=>'GET']);
        echo Html::dropDownList('select', ' ', $tour, ['id'=>'al']);?>
        <input type=hidden name='cups' value=<?=$_GET['cup']?>>
        <?echo Html::submitButton('Вибрати',['id'=>'publicanons']);
        ActiveForm::end();
        ?>
    </div>
</div>