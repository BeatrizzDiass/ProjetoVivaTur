<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Experiencias $model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Experiencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="experiencias-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'nome',
            'descricao',
            'horaInicio',
            'horaFim',
            'duracao',
            'local',
            [
                'attribute' => 'dataDisponivel',
                'value' => date('d/m/Y', strtotime($model->dataDisponivel)),
            ],
            'precoPessoa',
            'imagem',
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
        ],
    ]) ?>
</div>