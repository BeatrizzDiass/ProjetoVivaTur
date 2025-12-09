<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\Comentarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataCriacao')->textInput(['maxlength' => true]) ?>

           <?= $form->field($model, 'experiencia_id')->dropDownList(
        ArrayHelper::map(\backend\models\Experiencias::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona uma experiencia']
    ) ?>

            <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(\backend\models\User::find()->all(), 'id', 'username'),
        ['prompt' => 'Seleciona um user']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
