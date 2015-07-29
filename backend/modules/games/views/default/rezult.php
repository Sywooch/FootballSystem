<?php
/**
 * @var yii\web\View $this
 * @var array $match
 * @var array $homeTeamGoals
 * @var array $guestTeamGoals
 * @var array $homeTeamYCards
 * @var array $guestTeamYCards
 * @var array $homeTeamRCards
 * @var array $guestTeamRCards
 * @var string $title
 * @var string $anostitle
 * @var string $controller
 */
use yii\helpers\Html;

$this->title = "Оголошення результатів";
?>
<input id="tourVal" type="hidden" value="<?=html::encode($match[0]['tour'])?>">
<input id="anostitle" name="anostitle" type="hidden" value="<?=$anostitle;?>">
<input id="controller" type="hidden" value="<?=$controller;?>">

<div class='middle_team'>

<div class="top_menu">
        <ul>
            <li><button id="anonsRezult">Оголошення результатів</button></li>
        </ul>
</div>
        <div class="clear"></div>
    <div class="top_line"></div>
    <div class='rezultField1'>
        <?if($match['0']['tour'] == 'Фінал')
        {
            $title = "кубка";
        }?>
        <div class='toure'><?=html::encode($match[0]['tour'])." ".$title?></div><br>
<?
if($controller == 'cup')
{
    $action = "cup/cupstat";
    $delete = "cup/cancelcupstat";
}
else
{
    $action = "games/addscore";
    $delete = "games/cancelscore";
}

foreach($match as $value)
{

    if($value['rezultato'] == '-')
    {
        echo "<div class='emptyscore'>
        <div class='noscore'>$value[homeTeam] - $value[guestTeam]</div>";
        echo "<p>Результат невизначений &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"
            .Html::a('<button>Внести інформацію</button>',[Yii::$app->homeUrl.$action.'?id='.$value['id_match'].'&currentTour='.$match[0]['tour']."&controller=".$controller])."</p></div><br><br>";
    }

    else {
        echo "<input id='idmatch' type='hidden' value=$value[id_match]>
        <table class='score' onmousedown='return false'>
        <th class='scoreH'>".$value['homeTeam']." ".count($homeTeamGoals[$value['homeTeam']]).":</th><th class='scoreG'> ".count($guestTeamGoals[$value['guestTeam']])." ".$value['guestTeam']."</th>
                <tbody class='info'>
                <tr>
                    <td><ul id='ball'>";
        if(!empty($homeTeamGoals[$value['homeTeam']]))
        {
            foreach($homeTeamGoals[$value['homeTeam']] as $value1)
            {
                echo "<li>".$value1."</li>";
            }
        }
        else echo "<li> - </li>";
        echo "</ul></td><td><ul id='ball'>";

        if(!empty($guestTeamGoals[$value['guestTeam']]))
        {
            foreach($guestTeamGoals[$value['guestTeam']] as $gGvalue)
            {
                echo "<li>".$gGvalue."</li>";
            }
        }
        else echo "<li> - </li>";
        echo "</ul></td></tr><tr><td><ul id='yellow_card'>";

        if(!empty($homeTeamYCards[$value['homeTeam']]))
        {
            foreach($homeTeamYCards[$value['homeTeam']] as $hYvalue)
            {
                echo  "<li>".$hYvalue."</li>";
            }
        }
        else echo "<li> - </li>";
        echo "</ul></td><td><ul id='yellow_card'>";

        if(!empty($guestTeamYCards[$value['guestTeam']]))
        {
            foreach($guestTeamYCards[$value['guestTeam']] as $gYvalue)
            {
                echo "<li>".$gYvalue."</li>";
            }
        }
        else echo "<li> - </li>";
        echo "</ul></td></tr><tr><td><ul id='red_card'>";

        if(!empty($homeTeamRCards[$value['homeTeam']]))
        {
            foreach($homeTeamRCards[$value['homeTeam']] as $hRvalue)
            {
                echo "<li>".$hRvalue."</li>";
            }
        }
        else echo "<li> - </li>";
        echo "</ul></td><td><ul id='red_card'>";

        if(!empty($guestTeamRCards[$value['guestTeam']]))
        {
            foreach($guestTeamRCards[$value['guestTeam']] as $gRvalue)
            {
                echo "<li>".$gRvalue."</li>";
            }
        }
        else echo "<li> - </li>";
        echo "</ul></td> </tr>
        </tbody></table><div class=crez>".Html::a('Відмінити результат матчу',[Yii::$app->homeUrl.$delete.'?id='.$value['id_match'].'&currentTour='.$match[0]['tour'].'&home='.count($homeTeamGoals[$value['homeTeam']]).'&guest='.count($guestTeamGoals[$value['guestTeam']]).'&homeTeam='.$value['homeTeam'].'&guestTeam='.$value['guestTeam']."&controller=".$controller])."</div><div class='clear'></div><br><br>";
    }
}?>

</div>
    <div class="loadAnons"></div>
    <button id="publicR">Опублікувати</button>
<div class="clear"></div>
</div>