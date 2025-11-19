<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Sign Up';
?>

<!-- Hero Header (similar to About page) -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Sign Up</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Sign Up</li>
                    </ol>
                </nav>
            </div>
        </div>
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
                <a href="login" class="text-primary">Login here</a>
            </p>
        </div>

    </div>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>