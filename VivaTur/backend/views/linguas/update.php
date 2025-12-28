<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Linguas $model */

$this->title = 'Update Linguas: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Linguas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="linguas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
