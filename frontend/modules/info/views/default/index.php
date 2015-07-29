<?php
/**
 * @var string $news
 * @var yii\web\View $this
 * @var array $teamGame
 * @var array $goal
 * @var array $yellow
 * @var array $red
 * @var array $players
 * @var array $teamInfo
 */

use yii\helpers\Html;

$this->title = "Профіль команди";
?>

<div id="main">
    <div class="profileName">Профіль команди<hr></div>
         <div class="teamHeader">
        <div class="profileImg"><?=Html::img(\common\models\team::teamLogoUrl($teamInfo[0]['imgEmblemBig']))?></div>
        <div class="profileInfo1">
            <p class="profileContactTag">Загальні дані:</p>
            <p>Назва: <span class="Under">"<?=$teamInfo[0]['name']?>"</span></p>
            <p>Місто/Село: <span class="Under"><?=$teamInfo[0]['from']?></span></p>
            <p>Стадіон: <span class="Under"><?=$teamInfo[0]['stadium']?></span></p>
            <p>Кількість гравців: <span class="Under"><?=count($players)?></span></p>
        </div>
        <div class="profileInfo2">
            <p class="profileContactTag">Контакти:</p>
            <p>ПІБ: <span class="Under"><?=$teamInfo[0]['name_coach']?></span></p>
            <p>Телефон: <span class="Under"><?=$teamInfo[0]['phone']?></span></p>
            <p>Електронна пошта: <span class="Under"><?=$teamInfo[0]['email']?></span></p><hr>
            <?if(!empty($teamInfo[1]))
            {
            echo "<p>ПІБ: <span class='Under'>".$teamInfo[1]['name_coach']."</span></p>
            <p>Телефон: <span class='Under'>".$teamInfo[1]['phone']."</span></p>
            <p>Електронна пошта: <span class='Under'>".$teamInfo[1]['email']."</span></p>";
            }?>

        </div>
        <div class="clear"></div>
    </div>
    <hr class="middleLine">
         <div class="teamPlayers">
            <p class="tagPlayers">Склад команди</p>
            <div class="players">
            <table class="playersTable">
                <tr>
                    <th>№</th><th>П.І.Б</th><th>Дата народження</th><th>Місце проживання</th><th>Позиція</th>
                </tr>
                <?
                if(!empty($players))
                {
                    foreach($players as $value4)
                    {?>
                        <tr>
                           <td><?=$value4['number']?></td><td><?=$value4['player']?></td><td><?=$value4['old']?></td><td><?=$value4['living']?></td><td><?=$value4['position']?></td>
                        </tr>
                    <?}
                }
                else
                {?>
                   <tr>
                     <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                   </tr>
                <?}?>
            </table>
        </div>
         </div>
    <hr class="middleLine">
         <div class="teamStat">
            <p class="tagPlayers">Загальна статистика гравців</p>
            <div class="statPlayersGoal">
                <table class="goalTable">
                    <caption>Бомбардири сезону - ТОР 5</caption>
                    <tr>
                        <th>№</th><th>Прізвише та ім’я</th><th>Актив</th>
                    </tr>
                    <?
                    if(!empty($goal))
                    {
                        $num = 0;
                        foreach($goal as $value1)
                        {
                           $num++;?>
                           <tr>
                              <td><?=$num?></td><td class='teamName'><?=$value1['player']?></td><td><?=$value1['goal']?></td>
                           </tr>
                        <?}
                    }
                    else
                    {?>
                        <tr>
                          <td>-</td><td>-</td><td>-</td>
                        </tr>
                    <?}?>
                </table>
            </div>
            <div class="statPlayersY">
                <table class="goalTable">
                    <caption>Жовті картки - ТОР 5</caption>
                    <tr>
                        <th>№</th><th>Прізвише та ім’я</th><th>Актив</th>
                    </tr>
                    <?
                    if(!empty($yellow))
                    {
                        $num = 0;
                        foreach($yellow as $value2)
                        {   $num++;?>
                            <tr>
                                <td><?=$num?></td><td class='teamName'><?=$value2['player']?></td><td><?=$value2['yellow_card']?></td>
                            </tr>
                        <?}
                    }
                    else
                    {?>
                        <tr>
                          <td>-</td><td>-</td><td>-</td>
                        </tr>
                    <?}?>
                </table>
            </div>
            <div class="statPlayersR">
                <table class="goalTable">
                    <caption>Червоні картки - ТОР 5</caption>
                    <tr>
                        <th>№</th><th>Прізвише та ім’я</th><th>Актив</th>
                    </tr>
                    <?
                    if(!empty($red))
                    {
                        $num = 0;
                        foreach($red as $value3)
                        {   $num++;?>
                            <tr>
                                <td><?=$num?></td><td class='teamName'><?=$value3['player']?></td><td><?=$value3['red_card']?></td>
                            </tr>
                        <?}
                    }
                    else
                    {?>
                        <tr>
                          <td>-</td><td>-</td><td>-</td>
                        </tr>
                    <?}?>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    <hr class="middleLine">
        <div class="teamGameSpace">
            <p class="tagPlayers">Матчі сезону</p>
            <div class="teamGame">
                <?$a = 0;
                if(!empty($teamGame))
                {
                    foreach($teamGame as $value)
                    {
                        if($value['tour'] !== $a)
                        {?>
                                </tbody>
                            </table>
                           <table class='scoreTable' onmousedown='return false'>
                           <?if($value['tour'] == '1/8' OR $value['tour'] == '1/4' OR $value['tour'] == '1/2' OR $value['tour'] == 'Фінал')
                           {
                            echo "<caption>".$value['tour']." Кубок району - ".\frontend\assets\mylib::dayForTeamGame($value['date'])."</caption>";
                           }
                            else  echo "<caption>".$value['tour']." тур - ".\frontend\assets\mylib::dayForTeamGame($value['date'])."</caption>";

                            echo "<tbody>
                                <tr>
                                  <td>".$value['homeTeam']."</td><td class='scoreField'>".$value['rezultato']."</td><td>".$value['guestTeam']."</td>
                                </tr>

                           ";
                        }
                        else
                        {
                            echo"<tr>
                                  <td>".$value['homeTeam']."</td><td class='scoreField'>".$value['rezultato']."</td><td>".$value['guestTeam']."</td>
                                </tr>";
                        }

                        $a = $value['tour'];
                    }?>
                     </tbody>
                           </table>
                <?}
                else echo "На даний момент матчі відсутні";
                ?>
            </div>
        </div>

</div>

