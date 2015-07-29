<?
/**
 * @var yii\base\View $this
 * @var object $model
 */

use common\extensions\ckeditor\CKEditor;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="middle_news">
    <div class="add_news">
        <div class='regHeadTeam'>Опублікувати новину</div>
        <?
        $form = ActiveForm::begin(['id'=>'add_form_message']);
        echo $form->field($model, 'title')->label('Заголовок')->textarea()."<br>";
        echo $form->field($model, 'text')->label('Текст повідомлення')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', //разработанны настройки basic, standard, full
                ],
            ])."<br>";
        echo Html::submitButton('Завершити');
        ActiveForm::end();
        ?>
    </div>
</div>