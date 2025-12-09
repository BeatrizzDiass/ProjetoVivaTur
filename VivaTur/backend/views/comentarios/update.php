<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Comentarios $model */

$this->title = 'Update Comentarios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'descricao' => $model->descricao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comentarios-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
