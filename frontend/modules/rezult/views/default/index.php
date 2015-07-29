<?php
/**
 * @var yii\web\View $this
 * @var array $stat
 * @var array $match
 */

use yii\helpers\Html;

$this->title = "Результати чемпіонату";
?>
<div id='main'>
    <p id='head_colum'><span id='head1'>Турнірна таблиця</span><span id='head2'>Результати проведених матчів</span></p>
    <div id="table_space">
        <table id="table">
            <tr>
                <th>№</th><th>Команда</th><th>І</th><th>О</th><th>&nbsp</th>
            </tr>
            <?$num = 0;
            foreach($stat as $total)
            {
                $num++;?>
                <tr id='tr_<?=$num?>'>
                   <td><?=$num?></td><td><?=html::encode($total['nameTeam'])?></td><td><?=html::encode($total['game'])?></td><td><?=html::encode($total['score'])?></td><td>&nbsp</td>
                </tr>
          <?}?>
        </table>
    </div>
    <div class='rezTable'>
            <?$a = 0;
            foreach($match as $value)
                {
                   if($value['tour'] !== $a)
                   {?>
                         </tbody>
                        </table>
                       <table class='scoreTable' onmousedown='return false'>
                        <caption><?=$value['tour']?> тур</caption>
                          <tbody class='scoreTableInfo'>
                            <tr>
                              <td><?=$value['homeTeam']?></td><td class='scoreField'><?=$value['rezultato']?></td><td><?=$value['guestTeam']?></td>
                            </tr>
                   <?}
                    else
                    {?>
                        <tr>
                          <td><?=$value['homeTeam']?></td><td class='scoreField'><?=$value['rezultato']?></td><td><?=$value['guestTeam']?></td>
                        </tr>
                    <?}
                     $a = $value['tour'];
                }?>
                    </tbody>
                       </table>
    </div>
    <div class="clear"></div>
</div>
