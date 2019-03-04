<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PublishingHouse\PublishingHouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publishing Houses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publishing-house-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publishing House', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'publisher_names',
            [
                'attribute'=>'Address',
                'value'=>'showAddress.address',
            ],
            'phones',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    //[
    //                'attribute'=>'phone',
    //                'value'=>'publishing_phones.phone',
    //            ],
    ?>
    <?php Pjax::end(); ?>
</div>
