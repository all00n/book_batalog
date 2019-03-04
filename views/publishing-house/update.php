<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\forms\PublishingHouseForm */

$this->title = 'Update Publishing House: ' . $model->publishingHouse->id;
$this->params['breadcrumbs'][] = ['label' => 'Publishing Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->publishingHouse->id, 'url' => ['view', 'id' => $model->publishingHouse->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publishing-house-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
