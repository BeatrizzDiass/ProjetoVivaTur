<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Favoritos $model */

$this->title = 'Update Favoritos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Favoritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="favoritos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
