<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Metodopagamentos $model */

$this->title = 'Create Metodo de Pagamentos';
$this->params['breadcrumbs'][] = ['label' => 'Metodo pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodopagamentos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
