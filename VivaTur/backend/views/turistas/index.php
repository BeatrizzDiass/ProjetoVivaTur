<?php

use backend\models\Turistas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TuristasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Turistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turistas-index">

    <p>
        <?= Html::a('Create Turistas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
    'attribute' => 'user_id',
    'value' => 'user.username',
    'label' => 'User'
],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Turistas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
