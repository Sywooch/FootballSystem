<?php
/**
 * @var yii\base\View $this
 * @var array $viewTeam
 * @var array $viewCoach
 * @var string $id
*/

use yii\helpers\Html;

$this->title = "Профіль команди";
?>
<div class="middle_team">
    <div class="bot_line">Детальний огляд команди - "<?=html::encode($viewTeam[0]['name'])?>"</div>
    <div class="mainInfo">
        <p class="profileContactTag">Загальні дані:</p>
        <p>Назва каманди: <span><?=html::encode($viewTeam[0]['name'])?></span></p><br>
        <p>Місце знаходження: <span><?=html::encode($viewTeam[0]['from'])?></span></p><br>
        <p>Стадіон: <span><?=html::encode($viewTeam[0]['stadium'])?></span></p><br>
        <p>Емблема: <br><span class="showImg"><?=Html::img(\common\models\team::teamLogoUrl(html::encode($viewTeam[0]['imgEmblemBig']),1))?></span></p><br>
        <p>Логотип: <br><span class="showImg"><?=Html::img(\common\models\team::teamLogoUrl(html::encode($viewTeam[0]['imgEmblem']),1))?></span></p><br>
    </div>

    <div class="contact">
        <p class="profileContactTag">Контакти:</p>
        <?if(!empty($viewCoach)){
            foreach($viewCoach as $value){?>
                <p>П.І.Б: <span><?=html::encode($value['name_coach'])?></span></p><br>
                <p>Телефон: <span><?=html::encode($value['phone'])?></span></p><br>
                <p>Електронна пошта: <span><?=html::encode($value['email'])?></span></p><br><hr>
            <?}
        }else echo "Контакти відсутні..."?>
    </div>
    <div class="clear"></div>
    <?=Html::a('<button class="endButton">Завершити перегляд</button>',['index'])?>
    <?=Html::a('<button class="editInfoButton">Редагувати</button>',['/team/edit', 'id' => $id])?>
    <?=Html::a('<button class="deleteInfoButton">Видалити</button>',['/team/delete', 'id' => $id])?>
</div>