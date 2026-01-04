<?php

use yii\helpers\Url;

$this->title = 'Dashboard';

// Registrar CSS e JS do Bootstrap Datepicker
$this->registerCssFile('@web/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css');
$this->registerJsFile('@web/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Script para inicializar o calendário
$this->registerJs("
$(function () {
    $('#calendar').datepicker({
        language: 'pt',
        todayHighlight: true,
        format: 'dd/mm/yyyy',
        inline: true
    });
});
");
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Row 1 -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= isset($experiencesCount) ? $experiencesCount : 0 ?></h3>
                        <p>Experiências</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                    </div>
                    <a href="<?= Url::to(['experiencias/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= isset($categoriasCount) ? $categoriasCount : 0 ?></h3>
                        <p>Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-tags"></i>
                    </div>
                    <a href="<?= Url::to(['categorias/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= isset($userCount) ? $userCount : 0 ?></h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-users"></i>
                    </div>
                    <a href="<?= Url::to(['user/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= isset($idiomasCount) ? $idiomasCount : 0 ?></h3>
                        <p>Idioma</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-language"></i>
                    </div>
                    <a href="<?= Url::to(['idiomas/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-lightblue">
                    <div class="inner">
                        <h3><?= isset($paisesCount) ? $paisesCount : 0 ?></h3>
                        <p>Países</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-flag"></i>
                    </div>
                    <a href="<?= Url::to(['paises/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?= isset($avaliacoesCount) ? $avaliacoesCount : 0 ?></h3>
                        <p>Avaliações</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-star"></i>
                    </div>
                    <a href="<?= Url::to(['avaliacoes/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3><?= isset($metodosPagamentoCount) ? $metodosPagamentoCount : 0 ?></h3>
                        <p>Metodos de Pagamento</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-credit-card"></i>
                    </div>
                    <a href="<?= Url::to(['metodopagamentos/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?= isset($comentariosCount) ? $comentariosCount : 0 ?></h3>
                        <p>Comentários</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-comments"></i>
                    </div>
                    <a href="<?= Url::to(['comentarios/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row">



            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= isset($reservasCount) ? $reservasCount : 0 ?></h3>
                        <p>Reservas</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-calendar-check"></i>
                    </div>
                    <a href="<?= Url::to(['reservas/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>






            <div class="col-lg-3 col-6">
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3><?= isset($gestoresCount) ? $gestoresCount : 0 ?></h3>
                        <p>Gestores</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-user-tie"></i>
                    </div>
                    <a href="<?= Url::to(['gestores/index']) ?>" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>