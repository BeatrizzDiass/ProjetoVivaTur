<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-3" href="/">Tourist</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold px-3" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold px-3" href="/site/about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold px-3" href="/site/contact">Contact</a>
                </li>

                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-primary text-white fw-semibold px-4 py-2" href="/site/login">
                        Login
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>


<!-- PAGE HEADER (matches index.php style) -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5 text-center">
        <h1 class="display-4 text-white">Create Your Account</h1>
        <p class="text-white-50">Join us and start planning your next adventure!</p>
    </div>
</div>

<!-- SIGNUP FORM CENTERED -->
<div class="container d-flex justify-content-center">
    <div class="col-lg-5">

        <div class="card shadow p-4 mb-5">
            <h3 class="text-center mb-4"><?= Html::encode($this->title) ?></h3>

            <p class="text-center text-muted mb-4">
                Please fill out the form to register:
            </p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'class' => 'form-control'
            ]) ?>

            <?= $form->field($model, 'email')->input('email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="text-center mt-4">
                <?= Html::submitButton('Sign Up', [
                    'class' => 'btn btn-primary w-100 py-2',
                    'name' => 'signup-button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="text-center mb-5">
            <p>Already have an account?  
                <a href="/site/login" class="text-primary">Login here</a>
            </p>
        </div>

    </div>
</div>
