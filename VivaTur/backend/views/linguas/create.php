<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Linguas $model */

$this->title = 'Create Linguas';
$this->params['breadcrumbs'][] = ['label' => 'Linguas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linguas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
