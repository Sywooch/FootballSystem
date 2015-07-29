<?php
/**
 * @var yii\base\View $this
 * @var common\models\team $player
 * @var array $position
 * @var array $team
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Реєстрація гравця";
?>
<div class='middle_anonses'>
    <div class='anonsedPlayer'>
        <div class='regHeadTeam'>Реєстрація нового гравця</div>
        <?$form = ActiveForm::begin();
        echo $form->field($player, 'name')->textInput(['placeholder' => 'Прізвище та Ім’я'])->label('П.І.Б')."<br>";
        echo $form->field($player, 'living')->textInput(['placeholder' => 'За паспортом'])->label('Місце проживання')."<br>";?>
        <div class='short'>
            <?=$form->field($player, 'old')->label('Дата народження')->widget(\yii\jui\DatePicker::classname(),
            ['language' => 'ru','dateFormat' => 'dd.MM.yyyy'])."<br>";
            echo $form->field($player, 'number')->label('Ігровий номер')."<br>"?>
        </div>
        <?=$form->field($player, 'position')->label('Позиція')->dropDownList($position,['prompt' => 'Виберіть позицію'])."<br>";
        echo $form->field($player, 'team_name')->label('Команда')->dropDownList($team,['prompt' => 'Виберіть команду'])."<br>"?>
        <div class='reg_ok_button'>
        <?=Html::submitButton('Завершити')?>
        </div>
    </div>
    <?ActiveForm::end()?>
</div>