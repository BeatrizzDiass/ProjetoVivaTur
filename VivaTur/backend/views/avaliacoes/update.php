<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Avaliacoes $model */

$this->title = 'Update Avaliacoes: ' . $model->experiencia->nome;
$this->params['breadcrumbs'][] = ['label' => 'Avaliacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avaliacoes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
