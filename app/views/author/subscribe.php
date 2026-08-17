<?php
/** @var yii\web\View $this */
/** @var app\models\Author $author */
/** @var app\models\Subscription $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Subscribe to ' . $author->full_name;
?>
<div class="py-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'phone')->textInput(['placeholder' => '+79991234567']) ?>
        <?= Html::hiddenInput('author_id', $author->id) ?>
        <div class="d-flex gap-2">
            <?= Html::submitButton('Subscribe', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Back to author', ['author/view', 'id' => $author->id], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
