<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Paises $model */

$this->title = 'Update Paises: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Paises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paises-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
