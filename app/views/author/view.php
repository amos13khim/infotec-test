<?php
/** @var yii\web\View $this */
/** @var app\models\Author $model */

use yii\helpers\Html;

$this->title = $model->full_name;
?>
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><?= Html::encode($model->full_name) ?></h1>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="d-flex gap-2">
                <?= Html::a('Update', ['author/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['author/delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['method' => 'post', 'confirm' => 'Delete this author?']]) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <?= Html::a('Subscribe to this author', ['author/subscribe', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>

    <h3>Books</h3>
    <div class="list-group">
        <?php foreach ($model->books as $book): ?>
            <div class="list-group-item">
                <?= Html::a(Html::encode($book->title), ['book/view', 'id' => $book->id], ['class' => 'fw-bold text-decoration-none']) ?>
                <div class="text-muted small"><?= (int) $book->year ?> · <?= Html::encode($book->isbn) ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
