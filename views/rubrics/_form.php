<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use \app\models\Books\Rubrics;

/* @var $this yii\web\View */
/* @var $model app\models\Books\Rubrics */
/* @var $form yii\widgets\ActiveForm */
?>
<pre><?php print_r($model->errors) ?></pre>
<div class="rubrics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub')->dropDownList(ArrayHelper::map(Rubrics::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
