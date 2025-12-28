<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;

/** @var yii\web\View $this */
/** @var backend\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([10 => 'Active', 9 => 'Inactive']) ?>

<!--    --><?php //= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>
<!---->
<!--    --><?php //= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>


    <div class="row">
        <div class="col-md-12">
            <!-- CORREÇÃO: Chamamos o método estático getAllRolesList() -->
            <?= $form->field($model, 'role')->dropDownList(
                User::getAllRolesList(),
                [
                    'prompt' => 'Selecione um perfil/role',
                    'class' => 'form-control'
                ]
            ) ?>
            <small class="text-muted">
                O role define as permissões do utilizador no sistema
            </small>
        </div>
    </div

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
