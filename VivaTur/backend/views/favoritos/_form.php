<?php

use backend\models\Turistas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Favoritos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="favoritos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'experiencia_id')->dropDownList(
        ArrayHelper::map(\backend\models\Experiencias::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona uma experiencia']
    )->label('Experiência') ?>

    <?= $form->field($model, 'turista_id')->dropDownList(
        ArrayHelper::map(
            Turistas::find()->joinWith('user')->all(),
            'id',
            'user.username'
        ),
        ['prompt' => 'Seleciona um turista']
    )->label('Turista') ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
