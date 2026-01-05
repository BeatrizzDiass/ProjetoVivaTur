<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

$currentRoute = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);

// Registrar CSS e JS do Bootstrap Datepicker
$this->registerCssFile('@web/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css');
$this->registerJsFile('@web/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/calendar-init.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
                <img src="<?= Yii::getAlias('@web') ?>/imgs/logo.png" alt="Logo de VivaTur"
                     class="logo">
                <span class="brand-text font-weight-light">VivaTur</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= Yii::getAlias('@web') ?>/dist/img/user2-160x160.jpg"
                             class="img-circle elevation-2" alt="4User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?? 'Alexander Pierce' ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                               aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="<?= Url::to(['site/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['site/calendar']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/calendar') ? 'active' : '' ?>">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Calendário - experiências</p>
                            </a>
                        </li>

                        <!-- Gestão -->
                        <li class="nav-header">Gerir</li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['user/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'user/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['experiencias/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'experiencias/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>
                                    Experiências
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['categorias/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'categorias/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Categorias
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['linguas/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'linguas/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-language"></i>
                                <p>
                                    Idioma
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['paises/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'paises/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>
                                    Países
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['avaliacoes/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'avaliacoes/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-star"></i>
                                <p>Avaliações</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to(['metodopagamentos/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'metodopagamentos/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Pagamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['comentarios/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'comentarios/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Comentários</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['reservas/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'reservas/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Reservas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['gestores/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'gestores/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Gestores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['turistas/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'turistas/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Turistas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to(['favoritos/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'favoritos/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-heart"></i>
                                <p>Favoritos</p>
                            </a>
                        </li>
                        <li class="nav-header">Logout</li>
                        <li class="nav-item">
                            <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'w-100']) ?>
                            <?= Html::submitButton(
                                '<i class="fas fa-sign-out-alt"></i> Logout',
                                [
                                    'class' => 'btn btn-danger btn-block mt-2',
                                    'style' => 'text-align: left; padding: 0.5rem 1rem;'
                                ]
                            ) ?>
                            <?= Html::endForm() ?>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header pb-0 mb-0">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= Yii::$app->homeUrl ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <?= Html::encode($this->title) ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> <a href="#">VivaTur</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>