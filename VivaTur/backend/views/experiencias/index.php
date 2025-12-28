<?php

use backend\models\Experiencias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ExperienciasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Experiências';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiencias-index">

    <p>
        <?= Html::a('Create Experiencias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'horaInicio',
            'horaFim',
            'duracao',
            'local',
            'dataDisponivel',
            'precoPessoa',
            // 'imagem',
            'numMaxParticipante',
            'numMinParticipante',
            [
                'attribute' => 'categoria_id',
                'value' => function($model) {
                    return $model->categoria->nome;
                },
                'label' => 'Categoria',
            ],
            [
                'attribute' => 'gestor_id',
                'value' => function($model) {
                    return $model->gestor->user->username;
                },
                'label' => 'Gestor',
            ],
            [
                'attribute' => 'pais_id',
                'value' => function($model) {
                    return $model->pais->nome;
                },
                'label' => 'País',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Experiencias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
