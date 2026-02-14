<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var string $newPassword */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Perfil de Utilizador';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/profile.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= Yii::$app->session->getFlash('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= Yii::$app->session->getFlash('error', '', true) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-body">
                    <!-- Modo Visualização -->
                    <div id="view-mode">
                        <!---<div class="text-center mb-4">
                            <img src="<?= Yii::getAlias('@web') ?>/img/default-avatar.png"
                                 alt="Imagem de Perfil"
                                 class="rounded-circle img-thumbnail"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>-->

                        <h2 class="text-center mb-4"><?= Html::encode($user->username) ?></h2>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nome de Utilizador:</strong>
                            </div>
                            <div class="col-md-8">
                                <?= Html::encode($user->username) ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-md-8">
                                <?= Html::encode($user->email) ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Data de Registo:</strong>
                            </div>
                            <div class="col-md-8">
                                <?= Yii::$app->formatter->asDatetime($user->created_at) ?>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary rounded-pill px-4" onclick="toggleEditMode()">
                                <i class="bi bi-pencil me-2"></i>Editar Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Modo Edição -->
                    <div id="edit-mode" style="display: none;">
                        <?php $form = ActiveForm::begin([
                            'id' => 'profile-form',
                            'options' => ['class' => 'needs-validation'],
                        ]); ?>

                        <div class="text-center mb-4">
                            <img src="<?= Yii::getAlias('@web') ?>/img/default-avatar.png"
                                 alt="Imagem de Perfil"
                                 class="rounded-circle img-thumbnail"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <div class="mt-2">
                                <small class="text-muted">Clique para alterar a imagem (em breve)</small>
                            </div>
                        </div>

                        <?= $form->field($user, 'username')->textInput([
                            'maxlength' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Nome de utilizador'
                        ])->label('Nome de Utilizador') ?>

                        <?= $form->field($user, 'email')->textInput([
                            'maxlength' => true,
                            'type' => 'email',
                            'class' => 'form-control',
                            'placeholder' => 'exemplo@email.com'
                        ])->label('Email') ?>

                        <hr class="my-4">

                        <h5 class="mb-3">Alterar Password (opcional)</h5>
                        <p class="text-muted small">Deixe em branco se não deseja alterar a password</p>

                        <div class="form-group">
                            <label for="new_password">Nova Password</label>
                            <input type="password"
                                   class="form-control"
                                   id="new_password"
                                   name="User[new_password]"
                                   placeholder="Nova password (deixe em branco para manter a atual)"
                                   value="">
                            <small class="form-text text-muted">Mínimo 6 caracteres</small>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-secondary rounded-pill px-4 me-2" onclick="toggleEditMode()">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </button>
                            <?= Html::submitButton('<i class="bi bi-check-circle me-2"></i>Guardar Alterações', [
                                'class' => 'btn btn-success rounded-pill px-4'
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


