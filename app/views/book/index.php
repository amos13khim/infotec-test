<?php
/** @var yii\web\View $this */
/** @var array $books */
/** @var yii\data\Pagination $pagination */

use yii\helpers\Html;

$this->title = 'Books';
?>
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Books</h1>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::a('Create book', ['book/create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <div class="row g-3">
        <?php foreach ($books as $book): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <?php if ($book->cover_path): ?>
                        <?= Html::img($book->cover_path, ['class' => 'card-img-top', 'style' => 'height: 220px; object-fit: cover;']) ?>
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                            No cover
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($book->title) ?></h5>
                        <p class="text-muted mb-2"><?= (int) $book->year ?> · ISBN: <?= Html::encode($book->isbn) ?></p>
                        <p class="card-text small"><?= Html::encode(mb_strimwidth($book->description, 0, 140, '...')) ?></p>
                        <div class="mb-2">
                            <?php foreach ($book->authors as $author): ?>
                                <?= Html::a(Html::encode($author->full_name), ['author/view', 'id' => $author->id], ['class' => 'badge bg-secondary text-decoration-none me-1']) ?>
                            <?php endforeach; ?>
                        </div>
                        <?= Html::a('View', ['book/view', 'id' => $book->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($books)): ?>
        <div class="alert alert-info mt-4">No books found.</div>
    <?php endif; ?>
</div>
