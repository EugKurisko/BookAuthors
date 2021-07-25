<?php

use modules\author\models\Author;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel modules\book\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Modal::begin([
        'toggleButton' =>
            [
                    'label' => 'Create Book',
                    'id' => 'book-modal'
            ],
    ]); ?>

    <?php $form = ActiveForm::begin(
            [
                     'options' => ['enctype'=>'multipart/form-data', 'target'=>'hidden_upload'],
                    'id' => 'BookModel',
                    'enableAjaxValidation'=>false,
            ],
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'title_id']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'id' => 'desc_id']) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'publication_date')->textInput(['type' => 'date', 'id' => 'date_id']); ?>

    <?= $form->field($model, 'bookAuthors')->dropDownList(
        Author::getList(),
        [
            'multiple' => true,
            'id' => 'dropDown_id'
        ]

    )?>

    <div class="form-group">
        <button type="submit"
                class="btn btn-success confirm-add-book"
                id="book_save">
                    Create Book
        </button>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Modal::end(); ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'publication_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
