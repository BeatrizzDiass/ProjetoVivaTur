<?php
use yii\helpers\Url;
use yii\helpers\Html;

$backendUrl = str_replace('frontend/web', 'backend/web', Url::base(true)) . '/uploads/';

$this->title = "Index";
?>

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Desfrute de uma experiência connosco !!</h1>

                <div class="animated slideInDown">
                    <!-- Form com método GET -->
                    <form method="GET" action="<?= Url::to(['site/index']) ?>">

                        <div class="position-relative w-75 mx-auto mb-3">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5"
                                   type="text"
                                   name="pesquisa"
                                   value="<?= Html::encode(Yii::$app->request->get('pesquisa', '')) ?>"
                                   placeholder="Pesquise a experiência que deseja">
                            <button type="submit"
                                    class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2"
                                    style="margin-top: 7px;">Search
                            </button>
                        </div>

                        <div class="d-flex justify-content-center w-75 mx-auto">
                            <div class="w-50 me-2">
                                <select name="categoria" class="form-select rounded-pill py-2" onchange="this.form.submit()">
                                    <option value="">Filtrar por categoria</option>
                                    <?php foreach($categorias as $categoria): ?>
                                        <option value="<?= $categoria->id ?>"
                                            <?= Yii::$app->request->get('categoria') == $categoria->id ? 'selected' : '' ?>>
                                            <?= $categoria->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="w-50 ms-2">
                                <select name="pais" class="form-select rounded-pill py-2" onchange="this.form.submit()">
                                    <option value="">Filtrar por pais</option>
                                    <?php foreach($paises as $pais): ?>
                                        <option value="<?= $pais->id ?>"
                                            <?= Yii::$app->request->get('pais') == $pais->id ? 'selected' : '' ?>>
                                            <?= $pais->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <?php if(empty($experiencias)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Nenhuma experiência encontrada.</p>
                </div>
            <?php else: ?>
                <?php foreach ($experiencias as $experiencia): ?>

                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 20rem; height: 20rem;">
                            <img src="<?= $backendUrl . $experiencia->imagem ?>"
                                 class="card-img-top"
                                 style="height: 150px; object-fit: contain; background: #f8f9fa;"
                                 alt="<?= $experiencia->nome ?>">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h5 class="card-title"><?= $experiencia->nome ?></h5>
                                <p class="card-text text-muted" style="font-size: 0.9rem;">
                                    <?= Html::encode(mb_substr($experiencia->descricao ?? 'Sem descrição', 0, 45)) ?>
                                    <?= strlen($experiencia->descricao) > 45 ? '...' : '' ?>
                                </p>
                                <a href="<?= Url::to(['site/detalhes', 'id' => $experiencia->id]) ?>"
                                   class="btn btn-primary rounded-pill"
                                   onclick="console.log('Clicou no ID: <?= $experiencia->id ?>'); return true;">
                                    <i class="bi bi-eye me-2"></i>Ver Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>