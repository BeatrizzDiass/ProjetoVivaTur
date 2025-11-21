<?php

use frontend\models\Favorito;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\FavoritoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Meus Favoritos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorito-index" style="padding: 8rem 2rem 2rem 2rem;">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Adicionar Novo Favorito', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                // Exemplo para mostrar o nome da experiência em vez do ID
                [
                    'attribute' => 'experiencia_id',
                    'value' => 'experiencia.nome', // Assumindo que a relação se chama 'experiencia' e tem um campo 'nome'
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Favorito $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>