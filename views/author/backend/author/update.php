<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\author\models\Author */

$this->title = 'Update Author: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Modal::begin([
        'toggleButton' =>
            [
                'label' => 'Update Author',
                'id' => 'author-modal',
                'class' => 'btn btn-success'
            ],
    ]); ?>

    <?php $form = ActiveForm::begin(
        [
            'id' => 'AuthorModel',
        ],
    ); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <button type="submit"
                class="btn btn-success confirm-add-author"
                id="author_save">Update Author
        </button>
    </div>

    <?php ActiveForm::end(); ?>

    <?php Modal::end(); ?>

</div>
