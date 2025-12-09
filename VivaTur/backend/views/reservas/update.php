<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Reservas $model */

$this->title = 'Update Reservas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reservas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
