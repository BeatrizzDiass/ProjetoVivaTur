<?php

use backend\models\Favoritos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FavoritosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Favoritos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favoritos-index">

    <p>
        <?= Html::a('Create Favoritos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'experiencia_id',
                'value' => function($model) {
                    return $model->experiencia->nome;
                },
                'label' => 'Experiencia',
            ],
            [
                'attribute' => 'turista_id',
                'label' => 'Turista',
                'value' => function($model) {
                    // Checks if 'turista' exists AND if 'user' exists
                    return $model->turista->user->username ?? 'Utilizador não encontrado';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Favoritos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
