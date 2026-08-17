<?php
/** @var yii\web\View $this */
/** @var app\models\Author $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create author';
?>
<div class="py-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
        <div class="d-flex gap-2">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['author/index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
