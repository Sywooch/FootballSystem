<?php
/**
 * @var yii\web\View $this
 * @var array $team
 * @var array $goal
 * @var array $yellow
 * @var array $red
 */

$this->title = "Загальна статистика";
?>

<div id='main'>
    <p id='head_colum'><span id='head1'>Розширена турнірна таблиця</span><span id='head2'>Загальна статистика</span></p>
    <div class="spaceFullTable">
      <table class='fullTable' onmousedown='return false'>
            <tr>
                <th>№</th><th class='teamName'>Команда</th><th>Матчі</th><th>Виграш</th><th>Нічія</th><th>Програш</th><th>Гол (+)</th><th>Гол (-)</th><th>Очки</th>
            </tr>
            <?$num = 0;
            foreach($team as $value)
            {   $num++;?>
                <tr>
                   <td><?=$num?></td><td class='teamName'><?=$value['nameTeam']?></td><td><?=$value['game']?></td><td><?=$value['win']?></td><td><?=$value['draw']?></td><td><?=$value['lose']?></td><td><?=$value['goalPlus']?></td><td><?=$value['goalMinus']?></td><td><?=$value['score']?></td>
                </tr>
            <?}?>
        </table>
    </div>
    <hr>
    <div class="slider">
        <div>
          <table class="goalTable">
                <caption>Найкращі бомбардири сезону - Top 10</caption>
                <tr>
                    <th>№</th><th>Ім’я гравця</th><th>Команда</th><th>Голи</th>
                </tr>
                <?$num = 0;
               foreach($goal as $value1)
                {   $num++;?>
                   <tr>
                     <td><?=$num?></td><td class='teamName'><?=$value1['player']?></td><td class='teamName'><?=$value1['team']?></td><td><?=$value1['goal']?></td>
                   </tr>
                <?}?>
            </table>
        </div>

        <div>
          <table class="goalTable">
                <caption>Статистика жовтих карток - Top 10</caption>
                  <tr>
                      <th>№</th><th>Ім’я гравця</th><th>Команда</th><th>Актив</th>
                  </tr>
                <?$num = 0;
                foreach($yellow as $value2)
                {   $num++;?>
                    <tr>
                      <td><?=$num?></td><td class='teamName'><?=$value2['player']?></td><td class='teamName'><?=$value2['team']?></td><td><?=$value2['yellow_card']?></td>
                    </tr>
                <?}?>
            </table>
        </div>
        <div>
          <table class="goalTable">
                <caption>Статистика червоних карток - Top 10</caption>
                  <tr>
                      <th>№</th><th>Ім’я гравця</th><th>Команда</th><th>Актив</th>
                  </tr>
                <?$num = 0;
                foreach($red as $value3)
                {   $num++;?>
                    <tr>
                      <td><?=$num?></td><td class='teamName'><?=$value3['player']?></td><td class='teamName'><?=$value3['team']?></td><td><?=$value3['red_card']?></td>
                    </tr>
                <?}?>
            </table>
        </div>
    </div>
    <div class="statimg"></div>
    <div class="clear"></div>
</div>
