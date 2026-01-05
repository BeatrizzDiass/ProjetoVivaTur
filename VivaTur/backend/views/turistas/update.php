<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Turistas $model */

$this->title = 'Update Turistas: ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Turistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="turistas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
