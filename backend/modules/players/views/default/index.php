
<?php
/**
 * @var yii\base\View $this
 * @var array $players
 */

use yii\helpers\Html;

$this->title = "Команди та гравці";
?>
<div class="middle_anonsing">
    <div class="top_menu"><?=Html::a(('<button>Зареєструвати гравця</button>'),'players/new');?></div>
    <div class="top_line">Сортування гравців чемпіонату по командам</div>
<?$f = 0;
foreach($players as $value){?>
    <div class="playersTeam">
        <?=html::a(('<p>'.html::encode($value['team_name']).'<br>
        <p class="count"><span>гравці:</span> '.html::encode($value['count(id_player)']).'</p></p>'),'players/current?team='.html::encode($value['team_name']));?>
    </div>
<?}?>

</div>