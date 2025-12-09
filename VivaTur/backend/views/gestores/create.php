<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gestores $model */

$this->title = 'Create Gestores';
$this->params['breadcrumbs'][] = ['label' => 'Gestores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestores-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
