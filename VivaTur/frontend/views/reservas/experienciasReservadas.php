<?php

use yii\helpers\Url;
use yii\helpers\Html;

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';

$this->title = "Experiências Reservadas";
?>
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Experiências reservadas por <?= Yii::$app->user->identity->username ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <?php if(empty($reservas)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Ainda não reservou nenhuma experiência.</p>
                </div>
            <?php else: ?>
                <?php foreach ($reservas as $reserva): ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 20rem; height: 28rem;">
                            <img src="<?= $backendUrl . $reserva->experiencia->imagem ?>"
                                 class="card-img-top"
                                 style="height: 150px; object-fit: contain; background: #f8f9fa;"
                                 alt="<?= $reserva->experiencia->nome ?>">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h5 class="card-title">Experiência: <?= $reserva->experiencia->nome ?></h5>

                                <div class="mt-2">
                                    <p class="mb-1"><strong>Pessoas:</strong> <span class="badge bg-primary"><?= $reserva->numPessoas ?></span></p>
                                    <p class="mb-1"><strong>Método de Pagamento:</strong> <?= $reserva->metodoPagamento->nome ?></p>
                                    <p class="mb-1"><strong>Data:</strong> <?= date('d/m/Y', strtotime($reserva->dataReserva)) ?></p>
                                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success"><?= $reserva->disponivel ?></span></p>
                                </div>

                                <a href="<?= Url::to(['experiencias/detalhes', 'id' => $reserva->experiencia->id]) ?>"
                                   class="btn btn-info mt-auto" role="button">Ver detalhes</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>