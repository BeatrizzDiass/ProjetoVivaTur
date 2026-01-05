<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Comentarios $model */

$this->title = $model->experiencia->nome;
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comentarios-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'descricao' => $model->descricao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'descricao' => $model->descricao], [
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
            'descricao',
            'dataCriacao',
            [
                'attribute' => 'experiencia_id',
                'value' => $model->experiencia->nome,
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
        ],
    ]) ?>

</div>
