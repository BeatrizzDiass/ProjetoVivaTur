<?php
use yii\helpers\Url;

$this->title = 'Calendário de experiências';
$this->params['breadcrumbs'][] = $this->title;

// Registrar CSS e JS do FullCalendar
$this->registerCssFile('@web/plugins/fullcalendar/main.css');
$this->registerJsFile('@web/plugins/fullcalendar/main.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/plugins/fullcalendar/locales-all.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Registrar o arquivo JavaScript customizado
$this->registerJsFile('@web/js/calendar-init.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>