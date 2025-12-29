<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var frontend\models\Favorito[] $favoritos */

$this->title = 'Meus Favoritos';
$this->params['breadcrumbs'][] = $this->title;

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';
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

<div class="container-xxl py-5">
    <div class="container">
        <?php if (empty($favoritos)): ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                Ainda não tens experiências favoritas. 
                <a href="<?= Url::to(['site/index']) ?>" class="alert-link">Explorar experiências</a>
            </div>
        <?php else: ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($favoritos as $favorito): ?>
                    <?php $experiencia = $favorito->experiencia; ?>
                    <?php if ($experiencia): // Verifica se a experiência ainda existe ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="package-item">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="<?= $backendUrl . $experiencia->imagem ?>" alt="<?= Html::encode($experiencia->nome) ?>" style="height: 250px; width: 100%; object-fit: cover;">
                                </div>
                                <div class="d-flex border-bottom">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= Html::encode($experiencia->local) ?></small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i><?= date('d/m/Y', strtotime($experiencia->dataDisponivel)) ?></small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i><?= $experiencia->numMinParticipante ?>-<?= $experiencia->numMaxParticipante ?></small>
                                </div>
                                <div class="text-center p-4">
                                    <h3 class="mb-0"><?= Html::encode($experiencia->precoPessoa) ?>€</h3>
                                    <div class="mb-3">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                    <p><?= Html::encode($experiencia->nome) ?></p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="<?= Url::to(['site/detalhes', 'id' => $experiencia->id]) ?>" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Ver Detalhes</a>
                                        
                                        <!-- Botão para remover dos favoritos -->
                                        <?= Html::a('Remover', ['favorito/create', 'id_experiencia' => $experiencia->id], [
                                            'class' => 'btn btn-sm btn-danger px-3',
                                            'style' => 'border-radius: 0 30px 30px 0;',
                                            'data' => [
                                                'method' => 'post',
                                                'confirm' => 'Tens a certeza que queres remover esta experiência dos favoritos?',
                                            ],
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
