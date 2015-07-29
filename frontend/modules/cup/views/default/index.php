<?php
/**
 * @var yii\web\View $this
 * @var array $news
 * @var array $goal
 * @var array $yellow
 * @var array $red
 * @var array $match1
 * @var array $match2
 * @var array $match3
 * @var array $match4
 */
$this->title = "Кубок району";
?>
<div id='main'>
    <p class='obuhovcup'>Кубок обухівського району</p>
    <div class='cupGrid'>
        <?if(!empty($match1))
        {?>
         <div class='step1'><p class='etap'>Стадія 1/8</p>
            <?foreach($match1 as $val)
            {
                $home = substr($val['rezultato'], 0, 1);
                $guest = substr($val['rezultato'], 2, 1);?>
                <table class='cupTable'>
                <tr>
                    <td><?=$val['homeTeam']?></td><td class='tablescore'><?=$home?></td>
                </tr>
                <tr>
                    <td><?=$val['guestTeam']?></td><td class='tablescore'><?=$guest?></td>
                </tr>
                </table>
            <?}?>
          </div>
        <?}
        if(!empty($match2))
        {?>
           <div class='step2'><p class='etap longtxt'>Стадія 1/4</p>
            <?foreach($match2 as $val)
            {
                $home = substr($val['rezultato'], 0, 1);
                $guest = substr($val['rezultato'], 2, 1);?>
                <table class='cupTable long1'>
                <tr>
                    <td><?=$val['homeTeam']?></td><td class='tablescore'><?=$home?></td>
                </tr>
                <tr>
                    <td><?=$val['guestTeam']?></td><td class='tablescore'><?=$guest?></td>
                </tr>
                </table>
            <?}?>
            </div>
        <?}
        if(!empty($match3))
        {?>
            <div class='step3'><p class='etap longtxt'>Стадія 1/2</p>
            <?foreach($match3 as $val)
            {
                $home = substr($val['rezultato'], 0, 1);
                $guest = substr($val['rezultato'], 2, 1);?>
                <table class='cupTable long2'>
                <tr>
                    <td><?=$val['homeTeam']?></td><td class='tablescore'><?=$home?></td>
                </tr>
                <tr>
                    <td><?=$val['guestTeam']?></td><td class='tablescore'><?=$guest?></td>
                </tr>
                </table>
            <?}?>
            </div>
        <?}
        if(!empty($match4))
        {?>
            <div class='step4'><p class='etap longtxt'>Фінал</p>
            <?foreach($match4 as $val)
            {
                $home = substr($val['rezultato'], 0, 1);
                $guest = substr($val['rezultato'], 2, 1);?>
                <table class='cupTable long3'>
                <tr>
                    <td><?=$val['homeTeam']?></td><td class='tablescore'><?=$home?></td>
                </tr>
                <tr>
                    <td><?=$val['guestTeam']?></td><td class='tablescore'><?=$guest?></td>
                </tr>
                </table>
            <?}?>
           </div>
        <?}?>
        <div class="clear"></div>
    </div>
    <hr>
    <p class='obuhovcup1'>Загальна інформація</p>
    <div class='mid ff'>
        <?if(!empty($news))
            {
            foreach($news as $value3)
                { echo "<div class='headTour'>".$value3['title']."</div><br>";
                  echo $value3['text'];
                  echo "<p id='m_time'>Опубліковано - ".date('d.m / H:i',strtotime($value3['time']))."</p><hr>";
                }
             }
        else echo "Новини відсутні";
        ?>
    </div>
    <div class='cupNews'>
        <?
            if(!empty($goal))
            {?>
                <table class='goalTable'>
                <caption>Найкращі бомбардири кубку - Top 6</caption>
                <tr>
                    <th>№</th><th>Ім’я гравця</th><th>Команда</th><th>Актив</th>
                </tr>
                <?$m = 0;
                foreach($goal as $value1)
                {
                    $m++;?>
                    <tr>
                       <td><?=$m?></td><td class='teamName'><?=$value1['player']?></td><td class='teamName'><?=$value1['team']?></td><td><?=$value1['goal']?></td>
                    </tr>
                <?}?>
                </table>
            <?}
           if(!empty($yellow))
            {?>
                <table class='goalTable'>
                <caption>Статистика жовтих карток - Top 6</caption>
                <tr>
                    <th>№</th><th>Ім’я гравця</th><th>Команда</th><th>Актив</th>
                </tr>
                <?$v = 0;
                foreach($yellow as $value2)
                {
                    $v++;?>
                        <tr>
                           <td><?=$v?></td><td class='teamName'><?=$value2['player']?></td><td class='teamName'><?=$value2['team']?></td><td><?=$value2['yellow_card']?></td>
                        </tr>
                <?}?>
                </table>
            <?}
            if(!empty($red))
            {?>
            <table class='goalTable'>
                <caption>Статистика червоних карток - Top 6</caption>
                <tr>
                    <th>№</th><th>Ім’я гравця</th><th>Команда</th><th>Актив</th>
                </tr>
                <?$c = 0;
                foreach($red as $value3)
                    {
                        $c++;?>
                          <tr>
                            <td><?=$c?></td><td class='teamName'><?=$value3['player']?></td><td class='teamName'><?=$value3['team']?></td><td><?=$value3['red_card']?></td>
                          </tr>
                    <?}?>
                </table>
                <?}?>
    </div>
    <div class='clear'></div>
</div>