<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>

<!-- Hero Header (similar to About page) -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Login</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- LOGIN FORM CENTERED -->
<div class="container d-flex justify-content-center">
    <div class="col-lg-5">

        <div class="card shadow p-4 mb-5">
            <h3 class="text-center mb-4"><?= Html::encode($this->title) ?></h3>

            <p class="text-center text-muted mb-4">
                Please fill out the following fields to login:
            </p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'class' => 'form-control'
            ]) ?>

            <?= $form->field($model, 'password')->passwordInput([
                'class' => 'form-control'
            ]) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="my-3 text-muted small">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset'], ['class' => 'text-primary']) ?>.
                <br>
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email'], ['class' => 'text-primary']) ?>
            </div>

            <div class="text-center mt-4">
                <?= Html::submitButton('Login', [
                    'class' => 'btn btn-primary w-100 py-2',
                    'name' => 'login-button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="text-center mb-5">
            <p>Don't have an account?
                <a href="signup" class="text-primary">Sign up here</a>
            </p>
        </div>

    </div>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>