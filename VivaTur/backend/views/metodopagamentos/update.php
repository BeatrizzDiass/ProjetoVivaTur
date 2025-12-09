<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Metodopagamentos $model */

$this->title = 'Update Metodopagamentos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Metodopagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="metodopagamentos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
