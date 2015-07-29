<?/**
* @var yii\web\View $this
* @var array $stat
* @var array $team
* @var array $news
*/
use yii\helpers\Html;

$this->title = "Футбольна федерація обухівського району";
?>
<div id="main">
    <p id="head_colum"><span id="head1">Турнірна таблиця</span><span id="head2">Останні новини</span>Команди</p>
      <div id="table_space">
        <table id="table">
            <tr>
                <th>№</th><th>Команда</th><th>І</th><th>О</th><th>&nbsp</th>
            </tr>
            <?$num = 0;
            foreach($stat as $total)
            {   $num++;
                echo "<tr id='tr_$num'>
                          <td>$num</td><td>".html::encode($total['nameTeam'])."</td><td>".html::encode($total['game'])."</td><td>".html::encode($total['score'])."</td><td>&nbsp</td>
                      </tr>";
            }?>
          </table>
    </div>
      <div class='mid'>
        <?if(!empty($news))
        {
        foreach($news as $value3)
            { echo "<div class='headTour'>$value3[title]</div><br>";
              echo $value3['text'];
              echo "<p id='m_time'>Опубліковано - ".date('d.m / H:i',strtotime($value3['time']))."</p><hr>";
            }
         }
         else echo "Новини відсутні";
         ?>
    </div>
      <div id="team">
        <table id="table_team">
            <?foreach($team as $value)
            {echo "<tr><td>".Html::img(\common\models\team::teamLogoUrl($value['imgEmblem']))."</td><td><a href=\"".Yii::$app->urlManager->createUrl(['info', 'team' => rawurlencode($value['name']),'id' => $value['id_team']])."\">".html::encode($value['name'])."</a></td></tr>";}?>
        </table>
    </div>
      <div class="clear"></div>
</div>





