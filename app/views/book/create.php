<?php
/** @var yii\web\View $this */
/** @var app\models\Book $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create book';
?>
<div class="py-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'year')->textInput(['type' => 'number']) ?>
        <?= $form->field($model, 'isbn')->textInput() ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
        <?= $form->field($model, 'authorIds')->checkboxList(
            \yii\helpers\ArrayHelper::map(\app\models\Author::find()->all(), 'id', 'full_name')
        ) ?>
        <?= $form->field($model, 'cover_path')->fileInput() ?>
        <div class="d-flex gap-2">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['book/index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
