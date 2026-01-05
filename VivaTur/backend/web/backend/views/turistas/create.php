<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Turistas $model */

$this->title = 'Create Turistas';
$this->params['breadcrumbs'][] = ['label' => 'Turistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turistas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
