<?php

use yii\helpers\Url;
use yii\helpers\Html;

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';

$this->title = "Experiências Comentadas";
?>
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Experiências comentadas por <?= Yii::$app->user->identity->username ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <?php if(empty($comentarios)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Ainda não comentou em nenhuma experiência.</p>
                </div>
            <?php else: ?>
                <?php foreach ($comentarios as $comentario): ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 20rem; height: 25rem;">
                            <img src="<?= $backendUrl . $comentario->experiencia->imagem ?>"
                                 class="card-img-top"
                                 style="height: 150px; object-fit: contain; background: #f8f9fa;"
                                 alt="<?= $comentario->experiencia->nome ?>">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h5 class="card-title">Experiência: <?= $comentario->experiencia->nome ?></h5>

                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= date('d/m/Y', strtotime($comentario->dataCriacao)) ?>
                                    </small>
                                </div>

                                <p class="card-text" style="font-style: italic; font-size: 0.9rem;"> Comentário:
                                    "<?= substr($comentario->descricao, 0, 60) ?><?= strlen($comentario->descricao) > 60 ? '...' : '' ?>"
                                </p>

                                <a href="<?= Url::to(['site/detalhes', 'id' => $comentario->experiencia->id]) ?>"
                                   class="btn btn-info mt-auto" role="button">Ver detalhes</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>