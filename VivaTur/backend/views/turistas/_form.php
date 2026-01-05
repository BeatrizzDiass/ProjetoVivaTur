<?php

use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Turistas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="turistas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(
            User::find()->all(),
            'id',
            'username'
        ),
        ['prompt' => 'Seleciona um User']
    )->label('User') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>