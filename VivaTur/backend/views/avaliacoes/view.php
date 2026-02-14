<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Avaliacoes $model */

$this->title = 'Update Avaliações: ' . $model->experiencia->nome;
$this->params['breadcrumbs'][] = ['label' => 'Avaliacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacoes-view">

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
            'estrela',
            [
                'attribute' => 'experiencia_id',
                'label' => 'Experiência',
                'value' => function($model) {
                    return $model->experiencia ? $model->experiencia->nome : 'N/A';
                },
            ],
            [
                'attribute' => 'turista_id',
                'label' => 'Turista',
                'value' => function($model) {
                    return $model->turista->user->username ?? 'Utilizador não encontrado';
                },
            ],
        ],
    ]) ?>

</div>
