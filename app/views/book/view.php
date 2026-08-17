<?php
/** @var yii\web\View $this */
/** @var app\models\Book $model */

use yii\helpers\Html;

$this->title = $model->title;
?>
<div class="py-4">
    <div class="row g-4">
        <div class="col-md-4">
            <?php if ($model->cover_path): ?>
                <?= Html::img($model->cover_path, ['class' => 'img-fluid rounded', 'style' => 'max-height: 420px;']) ?>
            <?php else: ?>
                <div class="bg-light text-center py-5 rounded">No cover</div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <h1><?= Html::encode($model->title) ?></h1>
            <p class="text-muted">Year: <?= (int) $model->year ?> · ISBN: <?= Html::encode($model->isbn) ?></p>
            <div class="mb-3">
                <?php foreach ($model->authors as $author): ?>
                    <?= Html::a(Html::encode($author->full_name), ['author/view', 'id' => $author->id], ['class' => 'badge bg-secondary text-decoration-none me-1']) ?>
                <?php endforeach; ?>
            </div>
            <p><?= nl2br(Html::encode($model->description)) ?></p>

            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="d-flex gap-2">
                    <?= Html::a('Update', ['book/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['book/delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['method' => 'post', 'confirm' => 'Delete this book?']]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
