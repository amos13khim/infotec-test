<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'Books Catalog';
?>
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Books catalog</h1>
            <p class="text-muted mb-0">Browse books, manage authors and subscribe to new releases.</p>
        </div>
        <div class="d-flex gap-2">
            <?= Html::a('Books', ['/book/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Authors', ['/author/index'], ['class' => 'btn btn-outline-secondary']) ?>
            <?= Html::a('Top authors report', ['/site/report'], ['class' => 'btn btn-outline-dark']) ?>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5">Guest access</h3>
                    <p class="text-muted mb-0">View books, authors and subscribe to a specific author by phone.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5">User access</h3>
                    <p class="text-muted mb-0">Create, edit and delete books and authors after login.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5">SMS notifications</h3>
                    <p class="text-muted mb-0">Testing mode is enabled by default via SMSPilot emulator.</p>
                </div>
            </div>
        </div>
    </div>
</div>
