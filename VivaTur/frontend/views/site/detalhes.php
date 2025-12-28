<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var frontend\models\Experiencias $model */

use yii\widgets\ActiveForm;

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';

$this->title = "Detalhes da experiência - " . $experiencia->nome;
?>
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Detalhes da experiência
                    - <?= $experiencia->nome ?> </h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Imagem do lado esquerdo -->
        <div class="col-md-6">
            <div style="background: #eee; height: 600px;">
                <img src="<?= $backendUrl . $experiencia->imagem ?>"
                     class="card-img-top"
                     style="height: 100%; width: 100%; object-fit: cover;"
                     alt="Imagem">
            </div>
        </div>

        <!-- Detalhes do lado direito -->
        <div class="col-md-6">
            <h2><?= $experiencia->nome ?></h2>
            <div>
                <p><b style="color: #28a745; font-weight: bold; font-size: 25px;"><?= $experiencia->precoPessoa ?>€</b> por pessoa</p>
            </div>
            <!--TODO: falta a descrição-->
            <!--<p class="descricao"><//?= $experiencia->descricao ?></p>-->

            <div class="row mb-3">
                <!-- Duração -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center h-100" style="border: 1px solid #ccc; padding: 10px;">
                        <i class="bi bi-clock me-2"></i>
                        <span><b>Duração:</b> <?= $experiencia->duracao ?></span>
                    </div>
                </div>

                <!-- Local -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center h-100" style="border: 1px solid #ccc; padding: 10px;">
                        <i class="bi bi-geo-alt me-2"></i>
                        <span><b>Local:</b> <?= $experiencia->local ?></span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Data da experiência -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center h-100" style="border: 1px solid #ccc; padding: 10px;">
                        <i class="bi bi-calendar me-2"></i>
                        <span><b>Data:</b> <?= date('d/m/Y', strtotime($experiencia->dataDisponivel)); ?></span>
                    </div>
                </div>

                <!-- Participantes -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center h-100" style="border: 1px solid #ccc; padding: 10px;">
                        <i class="bi bi-person me-2"></i>
                        <span><b>Participantes:</b> <?= $experiencia->numMinParticipante ?> - <?= $experiencia->numMaxParticipante ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4> Horário</h4>
                <div class="row mb-3">
                    <!-- Hora de Inicio -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-center h-100" style="border: 1px solid #ccc; padding: 10px;">
                            <i class="bi bi-clock me-2"></i>
                            <span><b>Hora de Início:</b> <?= $experiencia->horaInicio ?></span>
                        </div>
                    </div>

                    <!-- Hora de Fim -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-center h-100" style="border: 1px solid #ccc; padding: 10px;">
                            <i class="bi bi-clock me-2"></i>
                            <span><b>Hora de Fim:</b> <?= $experiencia->horaFim ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4> Informações adicionais</h4>
                <p><b>Categoria:</b><?= $experiencia->categoria->nome ?></p>
                <p><b>País:</b><?= $experiencia->pais->nome ?></p>
                <p><b>Gestor:</b><?= $experiencia->gestor->user->username ?></p>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg rounded-pill py-3">
                    <i class="bi bi-cart-plus me-2"></i>Reservar Experiência
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Seção de Comentários -->
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-chat-dots me-2"></i>Comentários
            </h2>

            <!-- Lista de Comentários -->
            <?php if (!empty($experiencia->comentarios)): ?>
                <div class="mb-5">
                    <?php foreach ($experiencia->comentarios as $comentario): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">
                                        <i class="bi bi-person-circle text-primary me-2"></i>
                                        <?php if ($comentario->user->username) {
                                            echo $comentario->user->username;
                                        } else {
                                            echo 'Utilizador';
                                        } ?>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= date('d/m/Y', strtotime($comentario->dataCriacao)) ?>
                                    </small>
                                </div>
                                <p class="mb-0 mt-2"><?= nl2br(htmlspecialchars($comentario->descricao)) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Ainda não há comentários. Seja o primeiro a comentar esta experiência!
                </div>
            <?php endif; ?>

            <!-- Formulário para adicionar comentário -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-pencil-square me-2"></i>Deixe o seu comentário
                        </h5>

                        <?php $form = ActiveForm::begin([
                            'id' => 'comentario-form',
                            'options' => ['class' => 'needs-validation'],
                        ]); ?>

                        <?= $form->field($novoComentario, 'descricao')->textarea([
                            'rows' => 4,
                            'placeholder' => 'Partilhe a sua opinião sobre esta experiência...',
                            'class' => 'form-control'
                        ])->label('Comentário') ?>

                        <div class="d-grid mt-3">
                            <?= Html::submitButton('<i class="bi bi-send me-2"></i>Publicar Comentário', [
                                'class' => 'btn btn-primary rounded-pill py-2'
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Por favor, <a href="<?= Url::to(['site/login']) ?>" class="alert-link">inicie sessão</a>
                    para deixar um comentário.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Seção de Avaliações -->
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-star me-2"></i>Avaliações
            </h2>

            <!-- Lista de Avaliações -->
            <?php if (!empty($experiencia->avaliacoes)): ?>
                <div class="mb-5">
                    <?php foreach ($experiencia->avaliacoes as $avaliacao): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-0">
                                            <i class="bi bi-person-circle text-primary me-2"></i>
                                            <?php if ($avaliacao->user->username) {
                                                echo $avaliacao->user->username;
                                            } else {
                                                echo 'Utilizador';
                                            } ?>
                                        </h6>
                                        <!-- Estrelas da avaliação -->
                                        <div class="mt-2">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <?php if ($i <= $avaliacao->estrela): ?>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                <?php else: ?>
                                                    <i class="bi bi-star text-warning"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Ainda não existem avaliações. Seja o primeiro a avaliar esta experiência!
                </div>
            <?php endif; ?>

            <!-- Formulário para adicionar avaliação -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-star me-2"></i>Deixe a sua avaliação
                        </h5>

                        <?php $formAvaliacao = ActiveForm::begin([
                            'id' => 'avaliacao-form',
                            'options' => ['class' => 'needs-validation'],
                        ]); ?>

                        <!-- Campo de classificação (estrelas) -->
                        <?= $formAvaliacao->field($novaAvaliacao, 'estrela')->dropDownList([
                            1 => '1 estrela',
                            2 => '2 estrelas',
                            3 => '3 estrelas',
                            4 => '4 estrelas',
                            5 => '5 estrelas',
                        ], [
                            'prompt' => 'Selecione a classificação',
                            'class' => 'form-control'
                        ])->label('Classificação') ?>


                        <div class="d-grid mt-3">
                            <?= Html::submitButton('<i class="bi bi-send me-2"></i>Publicar Avaliação', [
                                'class' => 'btn btn-warning rounded-pill py-2'
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Por favor, <a href="<?= Url::to(['site/login']) ?>" class="alert-link">inicie sessão</a>
                    para deixar uma avaliação.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>