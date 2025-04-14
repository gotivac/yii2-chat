<?php

/** @var yii\web\View $this */
/** @var string $content */

use gotivac\chat\ChatAsset;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Breadcrumbs;

AppAsset::register($this);
ChatAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes'=>'32x32', 'href' => Yii::getAlias('@web/favicon-32x32.png')]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes'=>'16x16', 'href' => Yii::getAlias('@web/favicon-16x16.png')]);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes'=>'180x180', 'href' => Yii::getAlias('@web/apple-touch-icon.png')]);
$this->registerLinkTag(['rel' => 'manifest', 'href' => Yii::getAlias('@web/manifest.json')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body class="d-flex flex-column h-100" style="overflow: hidden">
<?php $this->beginBody() ?>

<main class="main" style="overflow: hidden">

    <?=$content;?>
</main>



<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('Service Worker registrovan sa opsegom:', registration.scope);
            }).catch(function(error) {
            console.log('Service Worker registracija nije uspela:', error);
        });
    }
</script>
<?php $this->endBody() ?>


</body>

</html>
<?php $this->endPage() ?>
