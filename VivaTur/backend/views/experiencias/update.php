<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Experiencias $model */

$this->title = 'Update Experiencias: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Experiencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="experiencias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
