<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

use yii\helpers\Html;

$this->title = 'Perfil de Utilizador';
$this->params['breadcrumbs'][] = $this->title;
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
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <!-- Imagem de Perfil (Placeholder) -->
                        <img src="<?= Yii::getAlias('@web') ?>/img/default-avatar.png" 
                             alt="Imagem de Perfil" 
                             class="rounded-circle img-thumbnail" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    
                    <h2 class="mb-3"><?= Html::encode($user->username) ?></h2>
                    
                    <div class="mb-3">
                        <i class="bi bi-envelope me-2 text-primary"></i>
                        <span class="text-muted"><?= Html::encode($user->email) ?></span>
                    </div>

                    <div class="mt-4">
                        <?= Html::a('Editar Perfil', ['site/update-profile'], ['class' => 'btn btn-primary rounded-pill px-4']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
