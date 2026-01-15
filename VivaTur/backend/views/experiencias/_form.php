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

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horaInicio')->input('time') ?>

    <?= $form->field($model, 'horaFim')->input('time') ?>

    <?= $form->field($model, 'duracao')->textInput([
        'maxlength' => true,
        'readonly' => true,
        'placeholder' => 'Calculado automaticamente'
    ]) ?>

    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataDisponivel')->input('date') ?>

    <?= $form->field($model, 'precoPessoa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <!-- MOSTRAR IMAGEM ATUAL -->
    <?php if (!$model->isNewRecord && $model->imagem): ?>
        <div class="form-group">
            <label>Imagem Atual:</label><br>
            <img src="<?= Yii::getAlias('@web/uploads/' . $model->imagemUrl) ?>"
                 alt="Imagem atual"
                 style="max-width: 300px; max-height: 300px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
            <p class="help-block text-muted">Deixe o campo acima em branco para manter esta imagem</p>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'numMaxParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numMinParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(
        ArrayHelper::map(Categorias::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona uma categoria']
    )->label('Categoria') ?>

    <?= $form->field($model, 'gestor_id')->dropDownList(
        ArrayHelper::map(
            Gestores::find()->joinWith('user')->all(),
            'id',
            'user.username'
        ),
        ['prompt' => 'Seleciona um gestor']
    )->label('Gestor') ?>

    <?= $form->field($model, 'pais_id')->dropDownList(
        ArrayHelper::map(\backend\models\Paises::find()->all(), 'id', 'nome'),
        ['prompt' => 'Seleciona um país']
    )->label('País') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>