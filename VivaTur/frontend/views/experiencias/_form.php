<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Experiencias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="experiencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horaInicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horaFim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duracao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataDisponivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precoPessoa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numMaxParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numMinParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->textInput() ?>

    <?= $form->field($model, 'gestor_id')->textInput() ?>

    <?= $form->field($model, 'pais_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
