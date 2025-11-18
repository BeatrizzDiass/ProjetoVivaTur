<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pais $model */

$this->title = 'Create Pais';
$this->params['breadcrumbs'][] = ['label' => 'Pais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pais-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
