<?php

/** @var yii\web\View $this */
/** @var common\models\User $model */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'O Meu Perfil';
?>

<!-- Hero Header -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown"><?= Html::encode($this->title) ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Perfil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body text-center p-5">
                        <div class="mb-4 position-relative d-inline-block">
                            <!-- Imagem de Perfil (Usando uma imagem padrão dos assets se não houver campo de imagem na BD) -->
                            <img src="<?= Url::to('@web/img/perfil_h.png') ?>" 
                                 alt="Imagem de Perfil" 
                                 class="img-fluid rounded-circle shadow-sm" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #fff;">
                        </div>
                        
                        <h3 class="mb-1"><?= Html::encode($model->username) ?></h3>
                        <p class="text-muted mb-4">Membro da VivaTur</p>

                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <i class="fa fa-envelope text-primary me-2"></i>
                            <span class="text-dark"><?= Html::encode($model->email) ?></span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>