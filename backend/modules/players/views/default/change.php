<?php
/**
 * @var yii\base\View $this
 * @var object $model
 * @var array $position
 * @var array $team
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Редагування Гравця"?>

<div class='middle_anonses'>
    <div class='anonsedPlayer'>
        <div class='regHeadTeam'>Редагування профілю гравця</div>
        <?$form = ActiveForm::begin();
        echo $form->field($model, 'name')->textInput(['value'=>$model->name])->label('П.І.Б')."<br>";
        echo $form->field($model, 'living')->textInput(['value'=>$model->living])->label('Місце проживання')."<br>"?>
        <div class='short'>
            <?=$form->field($model, 'old')->textInput(['value'=>$model->old])->label('Дата народження')->widget(\yii\jui\DatePicker::classname(),
            ['language' => 'ru','dateFormat' => 'dd.MM.yyyy'])."<br>";
            echo $form->field($model, 'number')->textInput(['value'=>$model->number])->label('Ігровий номер')."<br>"?>
        </div>
        <?=$form->field($model, 'position')->textInput(['value'=>$model->position])->label('Позиція')->dropDownList($position)."<br>";
        echo $form->field($model, 'team_name')->textInput(['value'=>$model->team_name])->label('Команда')->dropDownList($team)."<br>"?>
        <div class='reg_ok_button'>
            <?=Html::submitButton('Підтвердити зміни')?>
        </div>
    </div>
    <div class='clear'></div>
    <?ActiveForm::end()?>
</div>
