<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Experiencias $model */

$this->title = 'Create Experiencias';
$this->params['breadcrumbs'][] = ['label' => 'Experiencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
