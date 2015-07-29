<?php
/**
 * @var yii\base\View $this
 * @var object $news
 */
use yii\helpers\Html;
?>

<div class="middle_news mid ">
    <div class="news_view">
        <div class='regHeadTeam'>Детальний перегляд повідомлення</div>
        <p class="viewLabel">Заголовок</p><br>
        <p class="viewContent"><?=html::encode($news->title)?></p><br>
        <p class="viewLabel">Основний текст</p><br>
        <div class="viewContent"><?=$news->text?></div>
    </div>
    <div class="viewsButton">
    <?if(html::encode($news->edit)) echo Html::a('<button class="editInfoButton">Редагувати</button>',['/message/changes', 'id' => $news->id_message])?>
    <?=Html::a('<button class="deleteInfoButton">Видалити</button>',['/message/remove', 'id' => $news->id_message])?>
    </div>
</div>
