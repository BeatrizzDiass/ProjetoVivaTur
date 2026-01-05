<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Avaliacoes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="avaliacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estrela')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experiencia_id')->textInput() ?>

    <?= $form->field($model, 'turista_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
