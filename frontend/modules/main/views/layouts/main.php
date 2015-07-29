<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body>

<?php $this->beginBody() ?>



<div id="wrapper">
<?if ($this->beginCache(1, ['duration' => 10000])){?>
    <div id="header"></div>
<?$this->endCache();}?>
    <div id="menu">
        <ul>
            <li><a href="<?= Yii::$app->urlManager->createUrl('main');?>">Головна</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('news');?>">Новини</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('rezult');?>">Результати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl('stat');?>">Статистика</a></li>
            <li id="last_item"><a href="<?= Yii::$app->urlManager->createUrl('cup');?>">Кубок</a></li>
        </ul>
        <div class="clear"></div>
    </div>

    <?= $content?>

    <div id="footer">
        <div class="foot1">
            <ul>
            <li id="headF">Наші партнери:</li>
            <li>ФФ Київської області - <a href="http://koff.org.ua/">http://koff.org.ua</a> </li>
            <li>Футбольна федерація України - <a href="http://ffu.org.ua/">http://ffu.org.ua</a></li>
            </ul>
        </div>
        <div class="foot2">
            <ul>
                <li id="headF">Інформаційні портали:</li>
                <li>Новини футболу - <a href="http://football.ua/">http://football.ua</a></li>
                <li>Європейський футбол - <a href="http://uefa.com/">http://uefa.com</a></li>
            </ul>
        </div>
        <p>м.Обухів - <?=date('Y')?></p>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
