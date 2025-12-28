<?php

use yii\helpers\Url;

$this->title = "Sobre Nós";
?>
<div>
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Sobre Nós</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="<?= Url::to('@web/img/logo.png') ?>" alt="Logo VivaTur"
                         style="object-fit: contain;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Sobre Nós</h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary">VivaTur</span></h1>
                    <p class="mb-4">
                        Somos um grupo de estudantes do TeSP em Programação de Sistemas de Informação do Politécnico de Leiria, dedicados ao projeto VivaTur – Gestão de Experiências Turísticas. Este trabalho resulta da integração de três disciplinas: Plataformas de Sistemas de Informação (PLATSI), Acesso Móvel a Sistemas de Informação (AMSI) e Serviços e Interoperabilidade de Sistemas (SISIS).
                    </p>
                    <p class="mb-4">
                        Procuramos desenvolver ferramentas digitais que reinventem e valorizem o setor do turismo, facilitando o acesso, gestão e ligação entre serviços turísticos e os seus utilizadores. Apostamos numa abordagem multidisciplinar para entregar soluções modernas, colaborativas e de elevado valor.
                    </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Equipa de desenvolvimento</h6>
            <h1 class="mb-5">Equipa de desenvolvimento</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="<?= Url::to('@web/img/perfil_h.png') ?>" alt="">
                    </div>

                    <div class="text-center p-4">
                        <h5 class="mb-0">Rafael Barreiro</h5>
                        <small>2024144369/2241579</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="<?= Url::to('@web/img/perfil_m.png') ?>" alt="">
                    </div>

                    <div class="text-center p-4">
                        <h5 class="mb-0"> Beatriz Dias</h5>
                        <small>2024144618/2241609</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="<?= Url::to('@web/img/perfil_h.png') ?>" alt="">
                    </div>

                    <div class="text-center p-4">
                        <h5 class="mb-0">Gabriel Silvestre</h5>
                        <small>2024144221/22415644</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>