<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\forms\PublishingHouseForm */


$this->title = 'Create Publishing House';
$this->params['breadcrumbs'][] = ['label' => 'Publishing Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publishing-house-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
