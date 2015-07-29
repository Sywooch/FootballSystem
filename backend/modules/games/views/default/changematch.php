<?php
/**
 * @var yii\base\View $this
 * @var object $model
 * @var array $team
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Редагування матчу";
?>
<div class='reg_matches'>
    <div class='add_games'>
        <div class='regHeadTeam'>Редагування матчу</div>
        <?$form = ActiveForm::begin()?>
        <div class='short_field'>
            <?=$form->field($model, 'tour')->textInput(['value'=>$model->tour])->label('Тур/Стадія')?><br>
            <?=$form->field($model, 'date')->textInput(['value'=>$model->date])->label('Дата матча')->widget(\yii\jui\DatePicker::classname(),
            ['language' => 'ru','dateFormat' => 'dd.MM',])?><br>
        </div>
        <?=$form->field($model, 'homeTeam')->textInput(['value'=>$model->homeTeam])->label('Господарі')->dropDownList($team)?><br>
        <?=$form->field($model, 'guestTeam')->textInput(['value'=>$model->guestTeam])->label('Гості')->dropDownList($team)?><br>
        <div class='short_field'>
            <?=$form->field($model, 'startTime')->textInput(['placeholder' => 'xx.xx','value'=>$model->startTime])->label('Час початку')?><br>
        </div>
        <?=$form->field($model, 'stadium')->textInput(['value'=>$model->stadium])->label('Стадіон')?><br>
        <?=$form->field($model, 'referi')->textInput(['value'=>$model->referi])->label('Арбітр')?><br>
        <div class='reg_ok_button'>
            <?=Html::submitButton('Підтвердити зміни')?>
        </div>
    </div>
    <div class='clear'></div>
    <?ActiveForm::end()?>
</div>
