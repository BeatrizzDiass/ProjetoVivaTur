<?php

use backend\models\Categorias;
use backend\models\Gestores;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Experiencias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="experiencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horaInicio')->input('time') ?>

    <?= $form->field($model, 'horaFim')->input('time') ?>

    <?= $form->field($model, 'duracao')->textInput(['maxlength' => true]) ?>


    <?php
    //calcular a duração

    ?>

    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataDisponivel')->input('date') ?>

    <?= $form->field($model, 'precoPessoa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numMaxParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numMinParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(
        ArrayHelper::map(Categorias::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona uma categoria']
    ) ?>


            <?= $form->field($model, 'gestor_id')->dropDownList(
        ArrayHelper::map(Gestores::find()->all(), 'id', 'id'),
        ['prompt' => 'Seleciona um user para gestor']
    ) ?>

    <?= $form->field($model, 'pais_id')->dropDownList(
        ArrayHelper::map(\backend\models\Paises::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona um país']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>