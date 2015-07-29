<?php
/**
 * @var yii\base\View $this
 * @var object $query
 * @var object $coach
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\extensions\file\Widget as FileAPI;

$this->title = "Редагування команди";
?>
<div class='middle_team'>
    <div class='add_team1'>
        <div class='regHeadTeam'>Редагування профілю команди</div>
        <?$form = ActiveForm::begin()?>
        <?=$form->field($query, 'name')->textInput(['value'=>$query->name])->label('Назва')?><br>
        <?=$form->field($query, 'from')->textInput(['value'=>$query->from])->label('Місто/Село')?><br>
        <?=$form->field($query, 'stadium')->textInput(['value'=>$query->stadium])->label('Стадіон')?>
        <?=Html::img(\common\models\team::teamLogoUrl($query->imgEmblemBig,1))." "?>
        <?=Html::img(\common\models\team::teamLogoUrl($query->imgEmblem,1))?><br><br>
        <?=$form->field($query, 'imgEmblemBig')->label('Змінити емблему (200x200)')->widget(FileAPI::className(),
            [
                'cropResizeWidth' => 200,
                'cropResizeHeight' => 200,
                'settings' => [
                    'url' => ['fileapi-upload'],
                    'imageSize' =>  [
                        'minWidth' => 100,
                        'minHeight' => 100
                    ]
                ]
            ])?>
        <?=$form->field($query, 'imgEmblem')->label('Змінити логотип (20х20)')->widget(FileAPI::className(), [
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
        <div class='border_add_team'>
            <?=$form->field($coaches, 'name_coach')->textInput(['value'=>$coaches->name_coach])->label('П.І.Б')?><br>
            <?=$form->field($coaches, 'phone')->textInput(['value'=>$coaches->phone])->label('Телефон')?><br>
            <?=$form->field($coaches, 'email')->textInput(['value'=>$coaches->email])->label('Електронна пошта')?><br>
        </div>
    </div>
    <div class='clear'></div>
    <div class='reg_end_button'>
        <?=Html::submitButton('Підтвердити зміни')?>
    </div>
    <?ActiveForm::end()?>
</div>
