<?php
/** @var yii\web\View $this */
/** @var array $authors */
/** @var yii\data\Pagination $pagination */

use yii\helpers\Html;

$this->title = 'Authors';
?>
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Authors</h1>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::a('Create author', ['author/create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <div class="list-group">
        <?php foreach ($authors as $author): ?>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><?= Html::encode($author->full_name) ?></h5>
                    <small class="text-muted"><?= $author->getBooks()->count() ?> books</small>
                </div>
                <div class="d-flex gap-2">
                    <?= Html::a('View', ['author/view', 'id' => $author->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                    <?= Html::a('Subscribe', ['author/subscribe', 'id' => $author->id], ['class' => 'btn btn-sm btn-outline-success']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
