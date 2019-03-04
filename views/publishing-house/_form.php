<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\PublishingHouseForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publishing-house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model->publishingHouse, 'publisher_names')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model->publishingHouse, 'phones')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model->country, 'country_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model->region, 'region_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model->city, 'city_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model->publisherAddresses, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
