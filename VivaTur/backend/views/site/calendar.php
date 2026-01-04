<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Calendário de experiências';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/plugins/fullcalendar/main.css');
$this->registerJsFile('@web/plugins/fullcalendar/main.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/plugins/fullcalendar/locales-all.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/calendar-init.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <div id="calendar" data-eventos='<?= Html::encode($eventos) ?>'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="experienciaModal" tabindex="-1" role="dialog" aria-labelledby="experienciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="experienciaModalLabel">Detalhes da Experiência</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 id="modal-nome" class="mb-3"></h4>
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td width="150"><strong><i class="fas fa-calendar"></i> Data:</strong></td>
                                <td id="modal-data"></td>
                            </tr>
                            <tr>
                                <td><strong><i class="fas fa-clock"></i> Horário:</strong></td>
                                <td id="modal-horario"></td>
                            </tr>
                            <tr>
                                <td><strong><i class="fas fa-map-marker-alt"></i> Local:</strong></td>
                                <td id="modal-local"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="#" id="modal-ver-detalhes" class="btn btn-primary">Ver Todos os Detalhes</a>
            </div>
        </div>
    </div>
</div>