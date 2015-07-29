<?php
/**
 * @var yii\web\View $this
 * @var array $news
 * @var object $pages
 */
use yii\widgets\LinkPager;

$this->title = "Новини";
?>
    <div id='main'>
         <p id='head_colum'><span id='head3'>Архів опублікованих новин</span></p>

         <div class='mid'>
            <?if(!empty($news)){
                foreach($news as $value){?>
                    <div class='headTour'><?=$value['title']?></div><br>
                    <?=$value['text'];?>
                    <p id='m_time'>Опубліковано - <?=date('d.m / H:i',strtotime($value['time']))?></p><hr>
                <?}
            }
            else echo "Новини відсутні";

            echo LinkPager::widget([
            'pagination' => $pages,
            'maxButtonCount'=>6
            ]);?>
         </div>
        <div class='clear'></div>
    </div>";
