<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books\Books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'date_of_publishing',
            'publisher.publisher_names',
            [
                'attribute' => 'Authors',
                'value' => function($model) {
                    return implode(", ", array_map(function($ar){
                        return $ar->name;
                    }, $model->authors));
                }
            ],
            'rubric.name',
            'created_at',
        ],
    ]) ?>
<?php
foreach ($model->photos as $photo) {

    echo DetailView::widget([
        'model' => $photo,
        'attributes' => [
            'id' => 'id',
            [
                    'format'=> 'html',
                    'label' => 'Image',
                    'value' =>  Html::img('@web/uploads/'.$photo->url,['width'=>200])
            ],
            'delete'=> [
                    'format'=> 'html',
                    'label' => 'delete',
                    'value' => Html::a('Delete', Url::to(['delete-image', 'id' => $photo->id]))
            ]
        ],

    ]);
}
?>
</div>
