<?php

use yii\helpers\Url;

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';


$this->title = "Experiências que avaliei";
?>
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Experiências avaliadas por <?= Yii::$app->user->identity->username ?></h1>
            </div>
        </div>
    </div>
</div>


<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <?php if(empty($avaliacoes)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Ainda não avaliou nenhuma experiência.</p>
                </div>
            <?php else: ?>
                <?php foreach ($avaliacoes as $avaliacao): ?>

                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 20rem; height: 20rem;">
                            <img src="<?= $backendUrl . $avaliacao->experiencia->imagem ?>"
                                 class="card-img-top"
                                 style="height: 150px; object-fit: contain; background: #f8f9fa;"
                                 alt="<?= $avaliacao->experiencia->nome ?>">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h5 class="card-title">Experiência: <?= $avaliacao->experiencia->nome ?></h5>
                                <div class="mt-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= $avaliacao->estrela): ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        <?php else: ?>
                                            <i class="bi bi-star text-warning"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <a href="<?= Url::to(['site/detalhes', 'id' => $avaliacao->experiencia->id]) ?>"
                                   class="btn btn-info mt-auto" role="button">Ver detalhes</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
