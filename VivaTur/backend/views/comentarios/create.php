<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Comentarios $model */

$this->title = 'Create Comentarios';
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
