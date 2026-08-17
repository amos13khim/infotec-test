<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

$items = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'Books', 'url' => ['/book/index']],
    ['label' => 'Authors', 'url' => ['/author/index']],
    ['label' => 'Top authors', 'url' => ['/site/report']],
    ['label' => 'Login', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
    ['label' => 'Logout (' . Html::encode(Yii::$app->user->identity?->username ?? '') . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'New Book', 'url' => ['/book/create'], 'visible' => !Yii::$app->user->isGuest],
    ['label' => 'New Author', 'url' => ['/author/create'], 'visible' => !Yii::$app->user->isGuest],
];
?>
<header id="header">
    <?php NavBar::begin([
        'brandLabel' => 'Books Catalog',
        'brandUrl' => ['/site/index'],
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
    ]); ?>
    <?= Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'encodeLabels' => false,
        'items' => $items,
    ]); ?>
    <?php NavBar::end(); ?>
</header>
