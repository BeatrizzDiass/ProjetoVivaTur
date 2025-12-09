<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Paises $model */

$this->title = 'Create Paises';
$this->params['breadcrumbs'][] = ['label' => 'Paises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paises-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
