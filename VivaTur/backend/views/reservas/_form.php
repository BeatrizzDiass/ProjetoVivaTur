<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Reservas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reservas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dataReserva')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disponivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experiencia_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'metodoPagamento_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
