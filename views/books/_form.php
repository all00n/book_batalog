<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Books\Rubrics;
use app\models\PublishingHouse\PublishingHouse;
use app\models\Books\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\forms\BooksForm */
/* @var $form yii\widgets\ActiveForm */
?>
<pre><?= print_r($model->errors) ?></pre>
<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model->books, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->books, 'date_of_publishing')->textInput() ?>

    <?= $form->field($model->books, 'publisher_id')->textInput()->dropDownList(ArrayHelper::map(PublishingHouse::find()->all(),'id','publisher_names'))  ?>

    <?= $form->field($model->books, 'rubric_id')->dropDownList(ArrayHelper::map(Rubrics::find()->all(),'id','name')) ?>

    <?= $form->field($model->bookAuthor, 'author_id')->dropDownList(ArrayHelper::map(Authors::find()->all(),'id','name')) ?>

    <?= $form->field($model->photos, 'url')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
