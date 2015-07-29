<?php
/**
 * @var yii\base\View $this
 * @var object $model
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\extensions\ckeditor\CKEditor;

$this->title = "Редагування повідомлення";
?>
<div class='middle_news'>
    <div class='add_news'>
<div class='regHeadTeam'>Редагування новини</div>

<?$form = ActiveForm::begin();

echo $form->field($model, 'title')->textInput(['value'=>$model->title])->textarea()->label('Заголовок')."<br>";
echo $form->field($model, 'text')->textInput(['value'=>$model->text])->label('Основний текст')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
        ],
    ])."<br>";
echo Html::submitButton('Підтвердити зміни');?>
    </div>
<div class='clear'></div>
<?ActiveForm::end();?>
</div>
