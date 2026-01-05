<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Reservas $model */

$this->title = $model->experiencia->nome;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reservas-view">

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
                'attribute' => 'turista_id',
                'label' => 'Turista',
                'value' => function($model) {
                    // Checks if 'turista' exists AND if 'user' exists
                    return $model->turista->user->username ?? 'Utilizador não encontrado';
                },
            ],
        ],
    ]) ?>

</div>
