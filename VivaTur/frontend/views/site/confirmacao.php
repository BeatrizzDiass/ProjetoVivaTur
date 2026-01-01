<?php
use yii\helpers\Html;

$this->title = 'Confirmação de Reserva';
?>

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    Reserva Confirmada!
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-light border border-primary rounded p-4 shadow-sm">
                <div class="text-center mb-4">
                    <i class="fa fa-check-circle text-success" style="font-size: 60px;"></i>
                    <h2 class="text-primary mt-3">Reserva Realizada com Sucesso!</h2>
                </div>

                <h4 class="text-primary mb-3">Detalhes da Reserva</h4>

                <div class="mb-3">
                    <strong>Experiência:</strong> <?= Html::encode($reserva->experiencia->nome) ?>
                </div>

                <div class="mb-3">
                    <strong>Número de Pessoas:</strong> <?= $reserva->numPessoas ?>
                </div>

                <div class="mb-3">
                    <strong>Data da Reserva:</strong> <?= Yii::$app->formatter->asDatetime($reserva->dataReserva) ?>
                </div>

                <div class="mb-3">
                    <strong>Método de Pagamento:</strong> <?= Html::encode($reserva->metodoPagamento->nome) ?>
                </div>

                <div class="mb-3">
                    <strong>Status:</strong>
                    <span class="badge bg-success">Confirmada</span>
                </div>

                <hr>

                <p class="text-muted">
                    Um email de confirmação foi enviado para você com todos os detalhes da reserva.
                </p>

                <div class="mt-4 text-center">
                    <?= Html::a('Ver Minhas Reservas', ['site/minhas-reservas'], [
                        'class' => 'btn btn-primary rounded-pill px-4 me-2'
                    ]) ?>

                    <?= Html::a('Voltar ao Início', ['site/index'], [
                        'class' => 'btn btn-outline-primary rounded-pill px-4'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>