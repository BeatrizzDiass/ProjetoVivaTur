<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<!-- Hero Header (similar to About page) -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    <?= $name === 'Not Found' ? 'Not Found' : Html::encode($name) ?>
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            <?= $name === 'Not Found' ? '404' : Html::encode($name) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- 404 Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                <h1 class="display-1"><?= $name === 'Not Found' ? '404' : Html::encode($name) ?></h1>
                <h1 class="mb-4"><?= $name === 'Not Found' ? 'Page Not Found' : Html::encode($name) ?></h1>
                <p class="mb-4">
                    <?php if ($name === 'Not Found'): ?>
                        We're sorry, the page you have looked for does not exist in our website! Maybe go to our home page or try to use a search?
                    <?php else: ?>
                        <?= nl2br(Html::encode($message)) ?>
                    <?php endif; ?>
                </p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="<?= Url::to(['/site/index']) ?>">Go Back To Home</a>
            </div>
        </div>
    </div>
</div>
<!-- 404 End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>