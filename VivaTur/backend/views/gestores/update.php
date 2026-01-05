<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gestores $model */

$this->title = 'Update Gestores: ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Gestores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gestores-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
