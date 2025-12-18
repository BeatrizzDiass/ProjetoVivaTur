<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Experiencias $model */

$this->title = 'Update Experiencias: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Experiencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="experiencias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
