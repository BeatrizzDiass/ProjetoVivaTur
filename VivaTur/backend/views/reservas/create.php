<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Reservas $model */

$this->title = 'Create Reservas';
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
