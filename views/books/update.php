<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\forms\BooksForm */

$this->title = 'Update Books: ' . $model->books->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->books->title, 'url' => ['view', 'id' => $model->books->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
