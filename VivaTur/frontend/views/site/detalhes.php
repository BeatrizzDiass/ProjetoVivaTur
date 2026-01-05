<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\models\Favorito; // Importante para verificar se é favorito

/** @var frontend\models\Experiencias $model */

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';

$this->title = "Detalhes da experiência - " . $experiencia->nome;

// Verificar se a experiência já está nos favoritos do utilizador logado
$isFavorito = false;
if (!Yii::$app->user->isGuest) {
    $isFavorito = Favorito::find()
        ->where(['user_id' => Yii::$app->user->id, 'experiencia_id' => $experiencia->id])
        ->exists();
}
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
                <a href="<?= Url::to(['site/reserva', 'id' => $experiencia->id]) ?>" class="btn btn-primary btn-lg rounded-pill py-3">
                    <i class="bi bi-cart-plus me-2"></i>Reservar Experiência
                </a>
            </div>
            <div class="experiencia-detalhes">
                <!-- Botão de Favoritos Dinâmico -->
                <p>
                    <?php if ($isFavorito): ?>
                        <!-- Botão REMOVER (Vermelho Sólido) -->
                        <?= Html::a('<i class="bi bi-heart-fill me-2"></i>Remover dos Favoritos', ['favorito/create', 'id_experiencia' => $experiencia->id], [
                            'class' => 'btn btn-danger btn-lg rounded-pill py-3 w-100 mt-3',
                            'data' => [
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php else: ?>
                        <!-- Botão ADICIONAR (Outline Vermelho) -->
                        <?= Html::a('<i class="bi bi-heart me-2"></i>Adicionar aos Favoritos', ['favorito/create', 'id_experiencia' => $experiencia->id], [
                            'class' => 'btn btn-outline-danger btn-lg rounded-pill py-3 w-100 mt-3',
                            'data' => [
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                </p>
            </div>


        </div>
    </div>
</div>
</div>

<!-- Seção de Comentários -->
<!-- Seção de Comentários Atualizada -->
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
                                <!-- Comentário do Cliente -->
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">
                                        <i class="bi bi-person-circle text-primary me-2"></i>
                                        <?= $comentario->user->username ?? 'Utilizador' ?>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= date('d/m/Y H:i', strtotime($comentario->dataCriacao)) ?>
                                    </small>
                                </div>
                                <p class="mb-0 mt-2"><?= nl2br(htmlspecialchars($comentario->descricao)) ?></p>

                                <!-- Resposta do Gestor -->
                                <?php if ($comentario->temResposta()): ?>
                                    <div class="mt-3 p-3 bg-light rounded border-start border-primary border-4">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 text-primary">
                                                <i class="bi bi-reply-fill me-2"></i>
                                                Resposta do Gestor
                                            </h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                <?= date('d/m/Y H:i', strtotime($comentario->dataResposta)) ?>
                                            </small>
                                        </div>
                                        <p class="mb-0 mt-2"><?= nl2br(htmlspecialchars($comentario->resposta)) ?></p>

                                        <!-- Botões de Editar/Remover (apenas para o gestor) -->
                                        <?php if (!Yii::$app->user->isGuest && $experiencia->gestor->user_id == Yii::$app->user->id): ?>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editarResposta<?= $comentario->id ?>">
                                                    <i class="bi bi-pencil me-1"></i>Editar
                                                </button>
                                                <?= Html::a('<i class="bi bi-trash me-1"></i>Remover',
                                                    ['site/remover-resposta', 'id' => $comentario->id],
                                                    [
                                                        'class' => 'btn btn-sm btn-outline-danger',
                                                        'data' => [
                                                            'confirm' => 'Tem certeza que deseja remover esta resposta?',
                                                            'method' => 'post',
                                                        ],
                                                    ]) ?>
                                            </div>

                                            <!-- Modal para Editar Resposta -->
                                            <div class="modal fade" id="editarResposta<?= $comentario->id ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Editar Resposta</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <?php $form = ActiveForm::begin([
                                                            'action' => ['site/editar-resposta', 'id' => $comentario->id],
                                                            'method' => 'post',
                                                        ]); ?>
                                                        <div class="modal-body">
                                                            <textarea name="resposta" class="form-control" rows="4" required><?= htmlspecialchars($comentario->resposta) ?></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                        </div>
                                                        <?php ActiveForm::end(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Botão para Responder (apenas para o gestor, se ainda não respondeu) -->
                                <?php if (!Yii::$app->user->isGuest && $experiencia->gestor->user_id == Yii::$app->user->id && !$comentario->temResposta()): ?>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#responderModal<?= $comentario->id ?>">
                                            <i class="bi bi-reply me-1"></i>Responder
                                        </button>
                                    </div>

                                    <!-- Modal para Responder -->
                                    <div class="modal fade" id="responderModal<?= $comentario->id ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Responder Comentário</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <?php $form = ActiveForm::begin([
                                                    'action' => ['site/responder-comentario', 'id' => $comentario->id],
                                                    'method' => 'post',
                                                ]); ?>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Comentário original:</label>
                                                        <p class="p-2 bg-light rounded"><?= nl2br(htmlspecialchars($comentario->descricao)) ?></p>
                                                    </div>
                                                    <div>
                                                        <label class="form-label fw-bold">Sua resposta:</label>
                                                        <textarea name="resposta" class="form-control" rows="4"
                                                                  placeholder="Digite sua resposta..." required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bi bi-send me-1"></i>Enviar Resposta
                                                    </button>
                                                </div>
                                                <?php ActiveForm::end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
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