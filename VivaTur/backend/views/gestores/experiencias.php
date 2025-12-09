<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\Gestores $model */

$this->title = 'Experiências de ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Gestores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="gestores-experiencias">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'descricao:ntext',
            'preco',
            'data_inicio:date',
            'data_fim:date',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>