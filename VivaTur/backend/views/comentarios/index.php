<?php

use backend\models\Comentarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ComentariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comentários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-index">

    <p>
        <?= Html::a('Create Comentarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descricao',
            'dataCriacao',
            [
                'attribute' => 'experiencia_id',
                'value' => function($model) {
                    return $model->experiencia->nome;
                },
                'label' => 'Experiência',
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
                'urlCreator' => function ($action, Comentarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'descricao' => $model->descricao]);
                }
            ],
        ],
    ]); ?>


</div>
