<?php
/**
 * @var yii\base\View $this
 * @var common\models\game $game
 * @var array $team
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Реєстрація матчу";
?>
<div class='reg_matches'>
    <div class='add_games'>
        <div class='regHeadTeam'>Реєстрація матчу</div>
        <?$form = ActiveForm::begin();?>
        <input type=hidden name='cup' value="<?=$_GET['cup']?>">
        <div class='short_field'>
            <?=$form->field($game, 'tour')->textInput(['placeholder' => '№ Туру/Стадії'])->label('Тур/Стадія')."<br>";?>
            <?=$form->field($game, 'date')->label('Дата матча')->widget(\yii\jui\DatePicker::classname(),
            ['language' => 'ru','dateFormat' => 'dd.MM'])?>
        </div><br>
        <?=$form->field($game, 'homeTeam')->label('Господарі')->dropDownList($team,['prompt' => 'Виберіть команду'])?><br>
        <?=$form->field($game, 'guestTeam')->label('Гості')->dropDownList($team,['prompt' => 'Виберіть команду'])?><br>
        <div class='short_field'>
            <?=$form->field($game, 'startTime')->textInput(['placeholder' => 'xx.xx'])->label('Час початку')?><br>
        </div>
        <?=$form->field($game, 'stadium')->textInput(['placeholder' => 'Назва'])->label('Стадіон')?><br>
        <?=$form->field($game, 'referi')->textInput(['placeholder' => 'П.І.Б'])->label('Арбітр')?><br>
        <div class='reg_ok_button'>
            <?=Html::submitButton('Завершити')?>
        </div>
    </div>
        <?ActiveForm::end();?>
</div>