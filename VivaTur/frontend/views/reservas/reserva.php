<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var frontend\models\Reservas $model */
/** @var frontend\models\Experiencias $experiencia */
/** @var array $metodoPagamento */

$this->title = 'Reservar Experiência' . ' - ' . $experiencia->nome;

// Registrar o arquivo JavaScript customizado
$this->registerJsFile('@web/js/reserva.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Calcular vagas disponíveis
$vagasDisponiveis = $experiencia->getVagasDisponiveis();
?>

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    Reservar a experiência - <?= Html::encode($experiencia->nome) ?>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <!-- Alerta de vagas disponíveis -->
    <div class="alert alert-info mb-4">
        <strong>Vagas disponíveis:</strong> <?= $vagasDisponiveis ?> de <?= $experiencia->numMaxParticipante ?> pessoas
    </div>

    <?php if ($vagasDisponiveis <= 0): ?>
        <div class="alert alert-danger">
            <strong>Experiência esgotada!</strong> Não há mais vagas disponíveis para esta experiência.
        </div>
    <?php else: ?>
                        <?php $form = ActiveForm::begin([
                            'id' => 'avaliacao-form',
                            'action' => ['reservas/create', 'experiencia_id' => $experiencia->id],
                            'method' => 'post',
                            'options' => ['class' => 'needs-validation'],
                        ]); ?>

        <div class="quantidade-pessoas mb-4">
            <label class="form-label">Quantidade de pessoas</label>

            <div class="contador d-flex align-items-center gap-2">
                <button type="button" id="menos" class="btn btn-outline-primary">-</button>

                <?= $form->field($model, 'numPessoas')->textInput([
                    'id' => 'quantidade',
                    'type' => 'number',
                    'class' => 'form-control text-center',
                    'min' => 1,
                    'max' => $vagasDisponiveis,
                    'style' => 'width: 100px;',
                    'data-preco' => $experiencia->precoPessoa
                ])->label(false) ?>

                <button type="button" id="mais" class="btn btn-outline-primary">+</button>
            </div>
            <small class="text-muted">Máximo: <?= $vagasDisponiveis ?> vagas disponíveis</small>
        </div>

        <!-- Preço -->
        <div class="mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumo do Pagamento</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Preço por pessoa:</span>
                        <strong><?= Html::encode($experiencia->precoPessoa) ?>€</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Total:</span>
                        <strong id="preco-total" class="text-primary fs-4"><?= Html::encode($experiencia->precoPessoa) ?>€</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h3>Métodos de Pagamento</h3>
            <?= $form->field($model, 'metodoPagamento_id')->dropDownList(
                \yii\helpers\ArrayHelper::map($metodoPagamento, 'id', 'nome'),
                [
                    'prompt' => 'Selecione um método de pagamento',
                    'class' => 'form-select rounded-pill py-2'
                ]
            )->label(false) ?>
        </div>

        <div class="form-group mt-4">
            <?= Html::submitButton('Confirmar Reserva', [
                'class' => 'btn btn-primary btn-lg rounded-pill px-5'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>
</div>