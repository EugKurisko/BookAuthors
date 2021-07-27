<?php

use kartik\file\FileInput;
use modules\author\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\book\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [

        'options' => ['accept' => 'image/*', 'id' => 'image_id']]) ?>

    <?= $form->field($model, 'publication_date')->textInput(['type' => 'date']); ?>

    <?= $form->field($model, 'bookAuthors')->dropDownList(
        Author::getList(),
        [
            'multiple' => true,
            'required'=>true
        ]
    )->label('Author')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
