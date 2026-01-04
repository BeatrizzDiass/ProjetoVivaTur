<?php

use backend\models\Reservas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

//bootstrap
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\ReservasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reservas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservas-index">

    <p>
        <?= Html::a('Create Reservas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'dataReserva',
                'label' => 'Data da Reserva',
                'value' => function($model) {
                    return date('d/m/Y', strtotime($model->dataReserva));
                },
            ],
            'disponivel',
            [
                'attribute' => 'experiencia_id',
                'value' => function($model) {
                    return $model->experiencia->nome;
                },
                'label' => 'Experiencia',
            ],
            [
                'attribute' => 'metodoPagamento_id',
                'value' => function($model) {
                    return $model->metodoPagamento->nome;
                },
                'label' => 'Metodo de Pagamento',
            ],
            [
                'attribute' => 'user_id',
                'value' => function($model) {
                    return $model->user->username;
                },
                'label' => 'User',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reservas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
