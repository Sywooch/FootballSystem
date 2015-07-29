<?php
use yii\helpers\Html;
use backend\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body>

<?php $this->beginBody() ?>


<div class="wrapper">
    <div class="menus">
        <ul>
            <li><a href="<?= Yii::$app->urlManager->createUrl('main');?>">Головна</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('team');?>">Команди</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('players');?>">Гравці</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('games');?>">Матчі</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('cup');?>">Кубок</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('message');?>">Новини</a></li>
        </ul>
        <div class="clear"></div>
    </div>

    <?= $content?>

    <footer>
        <p>м.Обухів - <?=date('Y')?></p>
    </footer>

</div>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage() ?>
