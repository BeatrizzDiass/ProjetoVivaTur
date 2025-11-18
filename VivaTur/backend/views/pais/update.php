<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pais $model */

$this->title = 'Atualizar País: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Pais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'pais' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="pais-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
