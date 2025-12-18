<?php

use yii\helpers\Url;

$this->title = "Serviços";
?>

<!-- Hero Header -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown">Serviços</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Service</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Services Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Serviços</h6>
            <h1 class="mb-5">Nossos Serviços</h1>
        </div>

        <div class="row g-4">
            <!-- Explorar Experiências -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5>Explorar Experiências</h5>
                        <p>Pesquisa experiências turísticas por categoria, pais, e nome da experiência.</p>
                    </div>
                </div>
            </div>

            <!-- Reservas Online -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-calendar-check text-primary mb-4"></i>
                        <h5>Reservas Online</h5>
                        <p>Reserva experiências de forma simples, escolhendo a data e o número de participantes.</p>
                    </div>
                </div>
            </div>

            <!-- Gestão de Reservas -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-ticket-alt text-primary mb-4"></i>
                        <h5>Gestão de Reservas</h5>
                        <p>Consulta e cancela reservas de experiências de forma organizada e segura.</p>
                    </div>
                </div>
            </div>

            <!-- Favoritos -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-heart text-primary mb-4"></i>
                        <h5>Favoritos</h5>
                        <p>Guarda as tuas experiências favoritas para acesso rápido no futuro.</p>
                    </div>
                </div>
            </div>

            <!-- Avaliações -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-star text-primary mb-4"></i>
                        <h5>Avaliações</h5>
                        <p>Avalia experiências através de estrelas e ajuda outros utilizadores a decidir.</p>
                    </div>
                </div>
            </div>

            <!-- Comentários -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-comments text-primary mb-4"></i>
                        <h5>Comentários</h5>
                        <p>Partilha a tua experiência e consulta comentários de outros turistas.</p>
                    </div>
                </div>
            </div>

            <!-- Multilingue -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.8s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-language text-primary mb-4"></i>
                        <h5>Múltiplos Idiomas</h5>
                        <p>Utiliza a plataforma no idioma da tua preferência para maior conforto.</p>
                    </div>
                </div>
            </div>

            <!-- Contactar Gestor -->
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.9s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-envelope text-primary mb-4"></i>
                        <h5>Contactar o Gestor</h5>
                        <p>Entra em contacto com o gestor da experiência para esclarecer dúvidas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
