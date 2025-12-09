<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Metodopagamentos $model */

$this->title = 'Create Metodopagamentos';
$this->params['breadcrumbs'][] = ['label' => 'Metodopagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodopagamentos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
