<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Turistas $model */

$this->title = 'Update Turistas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Turistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="turistas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
