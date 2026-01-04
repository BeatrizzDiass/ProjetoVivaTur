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
        <div class="row">
            <?php if (empty($favoritos)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">
                        <i class="bi bi-heart me-1"></i>
                        Ainda não tens experiências favoritas.
                        <br>
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-link">Explorar experiências</a>
                    </p>
                </div>
            <?php else: ?>
                <?php foreach ($favoritos as $favorito): ?>
                    <?php $experiencia = $favorito->experiencia; ?>
                    <?php if ($experiencia): ?>
                        <div class="col-lg-4 mb-3">
                            <div class="card" style="width: 20rem; height: 27rem;">
                                <img src="<?= $backendUrl . $experiencia->imagem ?>"
                                     class="card-img-top"
                                     style="height: 150px; object-fit: contain; background: #f8f9fa;"
                                     alt="<?= Html::encode($experiencia->nome) ?>">

                                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">

                                    <h5 class="card-title"><?= Html::encode($experiencia->nome) ?></h5>

                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            <?= Html::encode($experiencia->local) ?>
                                        </small>
                                    </div>

                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="bi bi-people me-1"></i>
                                            <?= $experiencia->numMinParticipante ?> – <?= $experiencia->numMaxParticipante ?> participantes
                                        </small>
                                    </div>

                                    <h6 class="text-primary mb-3">
                                        <?= Html::encode($experiencia->precoPessoa) ?>€
                                    </h6>

                                    <div class="d-flex gap-2 mt-auto">
                                        <a href="<?= Url::to(['site/detalhes', 'id' => $experiencia->id]) ?>"
                                           class="btn btn-info btn-sm">
                                            Ver detalhes
                                        </a>

                                        <?= Html::a('Remover', ['favorito/create', 'id_experiencia' => $experiencia->id], [
                                            'class' => 'btn btn-danger btn-sm',
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
            <?php endif; ?>
        </div>
    </div>
</div>

