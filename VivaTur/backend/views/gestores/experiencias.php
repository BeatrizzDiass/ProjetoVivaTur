<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\Gestores $model */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Experiências de ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Gestores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="gestores-experiencias">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'descricao',
            'horaInicio',
            'horaFim',
            'duracao',
            'local',
            'dataDisponivel',
            'precoPessoa',
            'numMaxParticipante',
            'numMinParticipante',
            [
                'attribute' => 'categoria_id',
                'value' => function($model) {
                    return $model->categoria ? $model->categoria->nome : '-';
                },
                'label' => 'Categoria',
            ],
            [
                'attribute' => 'pais_id',
                'value' => function($model) {
                    return $model->pais ? $model->pais->nome : '-';
                },
                'label' => 'País',
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute(['/experiencias/' . $action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>