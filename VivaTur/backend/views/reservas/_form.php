<?php

use backend\models\Experiencias;
use backend\models\Turistas;
use backend\models\Metodopagamentos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Reservas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reservas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dataReserva')->input('date', [
        'class' => 'form-control',
        'min' => date('Y-m-d')
    ])->label('Data da Reserva') ?>

    <?= $form->field($model, 'numPessoas')->textInput([
        'type' => 'number',
        'min' => 1,
        'max' => 50
    ])->label('Número de Pessoas') ?>

    <?= $form->field($model, 'experiencia_id')->dropDownList(
        ArrayHelper::map(Experiencias::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona uma experiência']
    )->label('Experiência') ?>

    <?= $form->field($model, 'turista_id')->dropDownList(
        ArrayHelper::map(
            Turistas::find()->joinWith('user')->all(),
            'id',
            'user.username'
        ),
        ['prompt' => 'Seleciona um turista']
    )->label('Turista') ?>


    <?= $form->field($model, 'metodoPagamento_id')->dropDownList(
        ArrayHelper::map(Metodopagamentos::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona um método']
    )->label('Método de Pagamento') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>