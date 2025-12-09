<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ExperienciasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="experiencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'horaInicio') ?>

    <?= $form->field($model, 'horaFim') ?>

    <?= $form->field($model, 'duracao') ?>

    <?php // echo $form->field($model, 'local') ?>

    <?php // echo $form->field($model, 'dataDisponivel') ?>

    <?php // echo $form->field($model, 'precoPessoa') ?>

    <?php // echo $form->field($model, 'imagem') ?>

    <?php // echo $form->field($model, 'numMaxParticipante') ?>

    <?php // echo $form->field($model, 'numMinParticipante') ?>

    <?php // echo $form->field($model, 'categoria_id') ?>

    <?php // echo $form->field($model, 'gestor_id') ?>

    <?php // echo $form->field($model, 'pais_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
