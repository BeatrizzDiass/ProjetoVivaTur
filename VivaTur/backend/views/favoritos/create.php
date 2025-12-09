<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Favoritos $model */

$this->title = 'Create Favoritos';
$this->params['breadcrumbs'][] = ['label' => 'Favoritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favoritos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
