<?php
/**
 * @var yii\base\View $this
 * @var common\models\team $team
 * @var common\models\coach $coach
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\extensions\file\Widget as FileAPI;

$this->title = "Реєстрація команди";
?>
<div class='middle_team'>
    <div class='add_team1'>
        <div class='regHeadTeam'>Реєстрація команди</div>
        <?$form = ActiveForm::begin()?>
        <?=$form->field($team, 'name')->label('Назва')?><br>
        <?=$form->field($team, 'from')->label('Місто/Село')?><br>
        <?=$form->field($team, 'stadium')->label('Стадіон')?><br>
        <?=$form->field($team, 'imgEmblemBig')->label('Емблема (200x200)')->widget(FileAPI::className(),
                ['cropResizeWidth' => 200,
                'cropResizeHeight' => 200,
                'settings' => [
                    'url' => ['fileapi-upload'],
                    'imageSize' =>  [
                        'minWidth' => 100,
                        'minHeight' => 100
                    ]
                ]
            ])?>
        <?=$form->field($team, 'imgEmblem')->label('Логотип (20х20)')->widget(FileAPI::className(), [
                    'cropResizeWidth' => 26,
                    'cropResizeHeight' => 28,
                    'settings' => [
                        'url' => ['fileapi-upload'],
                        'imageSize' =>  [
                            'minWidth' => 26,
                            'minHeight' => 28
                        ],
                        'elements' => [
                            'preview' => [
                                'el' => '.uploader-preview',
                                'width' => 26,
                                'height' => 28
                            ]
                        ]
                    ]
                ])?>
    </div>
    <div class='add_team2'>
        <div class='regHeadTeam'>Контакти</div>
        <?=$form->field($coach, 'name_coach')->label('П.І.Б')?><br>
        <?=$form->field($coach, 'phone')->label('Телефон')?><br>
        <?=$form->field($coach, 'email')->label('Електронна пошта')?><br>
    </div>
    <div class='clear'></div>
    <div class='reg_ok_button'>
        <?=Html::submitButton('Завершити')?>
    </div>
    <?ActiveForm::end()?>
</div>