<?php

use backend\models\Gestores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gestores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestores-index">

    <p>
        <?= Html::a('Create Gestores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'label' => 'User',
                'value' => function ($model) {
                    return $model->turista->user->username ?? 'Utilizador não encontrado';
                },
            ],

            [
                'label' => 'Experiências',
                'format' => 'raw',
                'value' => function ($model) {
                    $count = $model->getExperiencias()->count();
                    return Html::a(
                        $count . ' experiência(s)',
                        ['experiencias', 'id' => $model->id],
                        ['class' => 'btn btn-info btn-sm']
                    );
                }
            ],
        ],
    ]); ?>


</div>
