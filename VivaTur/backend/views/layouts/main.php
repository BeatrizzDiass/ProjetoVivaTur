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
        <!-- Preloader (Remover após o carregamento) -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= Yii::getAlias('@web') ?>/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= Yii::$app->homeUrl ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <?= Html::beginForm(['/site/logout'], 'post') ?>
                    <?= Html::submitButton('Logout', ['class' => 'btn btn-danger btn-sm']) ?>
                    <?= Html::endForm() ?>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                       aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="<?= Yii::getAlias('@web') ?>/dist/img/user1-128x128.jpg" alt="User Avatar"
                                     class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

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
                <img src="<?= Yii::getAlias('@web') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
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
                        <!-- Dashboard -->
                        <li class="nav-item <?= (strpos($currentRoute, 'site/') === 0) ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= (strpos($currentRoute, 'site/') === 0) ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Url::to(['site/index']) ?>"
                                       class="nav-link <?= ($currentRoute == 'site/index') ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>

                            </ul>
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
                            <a href="<?= Url::to(['site/experiencia']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/experiencia') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>
                                    Experiência
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['categoria/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'categoria/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Categorias
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['site/idioma']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/idioma') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-language"></i>
                                <p>
                                    Idioma
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['pais/index']) ?>"
                               class="nav-link <?= ($currentRoute == 'pais/index') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>
                                    Países
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['site/avaliacoes']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/avaliacoes') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Avaliações
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['site/pagamento']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/pagamento') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Pagamento
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['site/comentarios']) ?>"
                               class="nav-link <?= ($currentRoute == 'site/comentarios') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Comentários</p>
                            </a>
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
            <strong>Copyright &copy; <?= date('Y') ?> <a href="#">Your Company</a>.</strong>
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