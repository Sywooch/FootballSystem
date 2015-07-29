<?php
/**
 * @var yii\web\View $this
 * @var array $redName
 * @var array $yellowName
 * @var array $match
 * @var object $model
 * @var $check
 * @var string $title
 * @var string $redtitle
 */

use yii\helpers\Html;

echo "
    <div id='table_space'></div>
      <div class='mid color'>";

$a = 0;
if($match['0']['tour'] == 'Фінал')
{
    echo "<div class='headTour'>Анонс фіналу кубка</div><br>";

$model->title = "Анонс фіналу кубка";
$redtitle = "Фінал пропускають";
}
else
{
    echo "<div class='headTour'>Анонс ".$match['0']['tour']." ".$title."</div><br>";

    $model->title = "Анонс ".$match['0']['tour']." ".$title;
}

foreach($match as $value){
    if($value['date'] !== $a)
    { echo $r = "<div class='dateTour'>".html::encode($value['date'])."</div>";
      $a = $value['date'];
      $model->text.= $r;}
    else false;
    echo $r = "<p class='match'>".html::encode($value['homeTeam'])." - ".html::encode($value['guestTeam'])."<br><span>".html::encode($value['startTime'])." | ".html::encode($value['stadium'])." | рефері:".html::encode($value['referi'])."</span></p>";
    $model->text.= $r;
}

echo $r = "<div class='cardLable'>Під загрозою дискваліфікації(3 жовті):</div><ul id='yellow_card'>";
$model->text.= $r;
if($yellowName == NULL)
{
    echo  $r = "<li> - </li>";
    $model->text.= $r;
}
else
{
    foreach($yellowName as $value2)
    { echo  $r = "<li>".$value2['playerName']." - (".$value2['teamName'].")</li>";
        $model->text.= $r;}
}

echo $r = "</ul><div class='cardLable'>$redtitle</div><ul id='red_card'>";
$model->text.= $r;
if($redName == NULL)
{
    echo  $r = "<li> - </li>";
    $model->text.= $r;
}
else
{
    foreach($redName as $value1)
    { echo  $r = "<li>".$value1['playerName']." - (".$value1['teamName'].")</li>";
        $model->text.= $r;}
}
echo $r = "</ul> <div class='moreInfo'>*Час та дата матчу може бути змінена за згодою обох команд</div>";
$model->text.= $r;
 echo "</div>
 <div class='clear'></div>";

if($_GET['check'] == 1)
{
    $model->save();
}
