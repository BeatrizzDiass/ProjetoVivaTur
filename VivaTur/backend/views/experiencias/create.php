<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Experiencias $model */

$this->title = 'Create Experiencias';
$this->params['breadcrumbs'][] = ['label' => 'Experiencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiencias-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
