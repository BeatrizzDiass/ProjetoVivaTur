<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper

/** @var yii\web\View $this */
/** @var backend\models\Avaliacoes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="avaliacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estrela')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'experiencia_id')->dropDownList(
        ArrayHelper::map(\backend\models\Experiencias::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona uma experiencia']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
