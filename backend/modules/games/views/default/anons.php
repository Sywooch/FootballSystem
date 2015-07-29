<?php
/**
 * @var yii\base\View $this
 * @var array $tour
 * @var string $head_title
 * @var string $select
 */
use yii\helpers\Html;
$this->title = $head_title;
?>
<div class='middle_anons'>
    <div class='anonsed'>
        <input id="cupV" type="hidden" value="<?=$_GET['cup']?>">
    <div class='regHeadTeam'><?=$head_title?></div>
        <p><?=$select?>:</p><br>
        <?=Html::dropDownList('tour', ' ', $tour, ['id'=>'al'])?>
        <button id="publicanons">Вибрати</button>
        <hr>
        <div class="ans"></div>
        <hr>
        <button id="publicA">Опублікувати</button>
    </div>

</div>