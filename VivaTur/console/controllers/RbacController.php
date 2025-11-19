<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // --- UTILIZADORES ---
        $createUsers = $auth->createPermission('createUsers');
        $createUsers->description = 'Criar users';
        $auth->add($createUsers);

        $viewUsers = $auth->createPermission('viewUsers');
        $viewUsers->description = 'Visualizar users';
        $auth->add($viewUsers);

        $editUsers = $auth->createPermission('editarUsers');
        $editUsers->description = 'Editar users';
        $auth->add($editUsers);

        $updateUsers = $auth->createPermission('updateUsers');
        $updateUsers->description = 'Atualizar users';
        $auth->add($updateUsers);

        $deleteUsers = $auth->createPermission('deleteUsers');
        $deleteUsers->description = 'Eliminar users';
        $auth->add($deleteUsers);

        // --- EXPERIÊNCIAS ---
        $createExperiencias = $auth->createPermission('createExperiencias');
        $createExperiencias->description = 'Criar experiencias';
        $auth->add($createExperiencias);

        $viewExperiencias = $auth->createPermission('viewExperiencias');
        $viewExperiencias->description = 'Visualizar experiencias';
        $auth->add($viewExperiencias);

        $editExperiencias = $auth->createPermission('editarExperiencias');
        $editExperiencias->description = 'Editar experiencias';
        $auth->add($editExperiencias);

        $updateExperiencias = $auth->createPermission('atualizarExperiencias');
        $updateExperiencias->description = 'Atualizar experiencias';
        $auth->add($updateExperiencias);

        $deleteExperiencias = $auth->createPermission('eliminarExperiencias');
        $deleteExperiencias->description = 'Eliminar experiencias';
        $auth->add($deleteExperiencias);

        // --- CATEGORIAS ---
        $createCategorias = $auth->createPermission('createCategorias');
        $createCategorias->description = 'Criar categorias';
        $auth->add($createCategorias);

        $viewCategorias = $auth->createPermission('viewCategorias');
        $viewCategorias->description = 'Visualizar categorias';
        $auth->add($viewCategorias);

        $editCategorias = $auth->createPermission('editarCategorias');
        $editCategorias->description = 'Editar categorias';
        $auth->add($editCategorias);

        $updateCategorias = $auth->createPermission('atualizarCategorias');
        $updateCategorias->description = 'Atualizar categorias';
        $auth->add($updateCategorias);

        $deleteCategorias = $auth->createPermission('eliminarCategorias');
        $deleteCategorias->description = 'Eliminar categorias';
        $auth->add($deleteCategorias);

        // --- AVALIAÇÕES ---
        $createAvaliacoes = $auth->createPermission('createAvaliacoes');
        $createAvaliacoes->description = 'Criar avaliacoes';
        $auth->add($createAvaliacoes);

        $viewAvaliacoes = $auth->createPermission('viewAvaliacoes');
        $viewAvaliacoes->description = 'Visualizar avaliacoes';
        $auth->add($viewAvaliacoes);

        $editAvaliacoes = $auth->createPermission('editarAvaliacoes');
        $editAvaliacoes->description = 'Editar avaliacoes';
        $auth->add($editAvaliacoes);

        $updateAvaliacoes = $auth->createPermission('atualizarAvaliacoes');
        $updateAvaliacoes->description = 'Atualizar avaliacoes';
        $auth->add($updateAvaliacoes);

        $deleteAvaliacoes = $auth->createPermission('eliminarAvaliacoes');
        $deleteAvaliacoes->description = 'Eliminar avaliacoes';
        $auth->add($deleteAvaliacoes);

        // --- COMENTÁRIOS ---
        $createComentarios = $auth->createPermission('createComentarios');
        $createComentarios->description = 'Criar comentarios';
        $auth->add($createComentarios);

        $editComentarios = $auth->createPermission('editarComentarios');
        $editComentarios->description = 'Editar comentarios';
        $auth->add($editComentarios);

        $updateComentarios = $auth->createPermission('atualizarComentarios');
        $updateComentarios->description = 'Atualizar comentarios';
        $auth->add($updateComentarios);

        $deleteComentarios = $auth->createPermission('eliminarComentarios');
        $deleteComentarios->description = 'Eliminar comentarios';
        $auth->add($deleteComentarios);

        // --- RESERVAS ---
        $createReservas = $auth->createPermission('createReservas');
        $createReservas->description = 'Criar reservas';
        $auth->add($createReservas);

        $viewReservas = $auth->createPermission('viewReservas');
        $viewReservas->description = 'Visualizar reservas';
        $auth->add($viewReservas);

        $editReservas = $auth->createPermission('editarReservas');
        $editReservas->description = 'Editar reservas';
        $auth->add($editReservas);

        $updateReservas = $auth->createPermission('atualizarReservas');
        $updateReservas->description = 'Atualizar reservas';
        $auth->add($updateReservas);

        $deleteReservas = $auth->createPermission('eliminarReservas');
        $deleteReservas->description = 'Eliminar reservas';
        $auth->add($deleteReservas);

        // --- IDIOMA ---
        $createIdioma = $auth->createPermission('createIdioma');
        $createIdioma->description = 'Criar idioma';
        $auth->add($createIdioma);

        $viewIdioma = $auth->createPermission('viewIdioma');
        $viewIdioma->description = 'Visualizar idioma';
        $auth->add($viewIdioma);

        $editIdioma = $auth->createPermission('editarIdioma');
        $editIdioma->description = 'Editar idioma';
        $auth->add($editIdioma);

        $updateIdioma = $auth->createPermission('atualizarIdioma');
        $updateIdioma->description = 'Atualizar idioma';
        $auth->add($updateIdioma);

        $deleteIdioma = $auth->createPermission('eliminarIdioma');
        $deleteIdioma->description = 'Eliminar idioma';
        $auth->add($deleteIdioma);

        // --- METODO DE PAGAMENTO ---
        $createPagamento = $auth->createPermission('createPagamento');
        $createPagamento->description = 'Criar metodo de pagamento';
        $auth->add($createPagamento);

        $viewPagamento = $auth->createPermission('viewPagamento');
        $viewPagamento->description = 'Visualizar metodo de pagamento';
        $auth->add($viewPagamento);

        $editPagamento = $auth->createPermission('editarPagamento');
        $editPagamento->description = 'Editar metodo de pagamento';
        $auth->add($editPagamento);

        $updatePagamento = $auth->createPermission('atualizarPagamento');
        $updatePagamento->description = 'Atualizar metodo de pagamento';
        $auth->add($updatePagamento);

        $deletePagamento = $auth->createPermission('eliminarPagamento');
        $deletePagamento->description = 'Eliminar metodo de pagamento';
        $auth->add($deletePagamento);

        // --- PAÍS ---
        $createPais = $auth->createPermission('createPais');
        $createPais->description = 'Criar pais';
        $auth->add($createPais);

        $editPais = $auth->createPermission('editarPais');
        $editPais->description = 'Editar pais';
        $auth->add($editPais);

        $updatePais = $auth->createPermission('atualizarPais');
        $updatePais->description = 'Atualizar pais';
        $auth->add($updatePais);

        $deletePais = $auth->createPermission('eliminarPais');
        $deletePais->description = 'Eliminar pais';
        $auth->add($deletePais);

        // --- LÍNGUA ---
        $createLingua = $auth->createPermission('createLingua');
        $createLingua->description = 'Criar lingua';
        $auth->add($createLingua);

        $editLingua = $auth->createPermission('editarLingua');
        $editLingua->description = 'Editar lingua';
        $auth->add($editLingua);

        $updateLingua = $auth->createPermission('atualizarLingua');
        $updateLingua->description = 'Atualizar lingua';
        $auth->add($updateLingua);

        $deleteLingua = $auth->createPermission('eliminarLingua');
        $deleteLingua->description = 'Eliminar lingua';
        $auth->add($deleteLingua);

        // --- FAVORITOS ---
        $createFavoritos = $auth->createPermission('createFavoritos');
        $createFavoritos->description = 'Criar favoritos';
        $auth->add($createFavoritos);

        $deleteFavoritos = $auth->createPermission('eliminarFavoritos');
        $deleteFavoritos->description = 'Eliminar favoritos';
        $auth->add($deleteFavoritos);


        // ============= CRIAR ROLES E ATRIBUIR PERMISSÕES =============

        // --- ADMIN (controlo Total) ---
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrador - controlo total do sistema';
        $auth->add($admin);

        // Users
        $auth->addChild($admin, $createUsers);
        $auth->addChild($admin, $viewUsers);
        $auth->addChild($admin, $editUsers);
        $auth->addChild($admin, $updateUsers);
        $auth->addChild($admin, $deleteUsers);

        // Experiências
        $auth->addChild($admin, $createExperiencias);
        $auth->addChild($admin, $viewExperiencias);
        $auth->addChild($admin, $editExperiencias);
        $auth->addChild($admin, $updateExperiencias);
        $auth->addChild($admin, $deleteExperiencias);

        // Categorias
        $auth->addChild($admin, $createCategorias);
        $auth->addChild($admin, $viewCategorias);
        $auth->addChild($admin, $editCategorias);
        $auth->addChild($admin, $updateCategorias);
        $auth->addChild($admin, $deleteCategorias);

        // Avaliações
        $auth->addChild($admin, $viewAvaliacoes);
        $auth->addChild($admin, $editAvaliacoes);
        $auth->addChild($admin, $updateAvaliacoes);
        $auth->addChild($admin, $deleteAvaliacoes);

        // Comentários
        $auth->addChild($admin, $editComentarios);
        $auth->addChild($admin, $updateComentarios);
        $auth->addChild($admin, $deleteComentarios);

        // Reservas
        $auth->addChild($admin, $viewReservas);

        // Idioma
        $auth->addChild($admin, $createIdioma);
        $auth->addChild($admin, $viewIdioma);
        $auth->addChild($admin, $editIdioma);
        $auth->addChild($admin, $updateIdioma);
        $auth->addChild($admin, $deleteIdioma);

        // Método de Pagamento
        $auth->addChild($admin, $createPagamento);
        $auth->addChild($admin, $viewPagamento);
        $auth->addChild($admin, $editPagamento);
        $auth->addChild($admin, $updatePagamento);
        $auth->addChild($admin, $deletePagamento);

        // País
        $auth->addChild($admin, $createPais);
        $auth->addChild($admin, $editPais);
        $auth->addChild($admin, $updatePais);
        $auth->addChild($admin, $deletePais);


        // --- GESTOR DE EXPERIÊNCIAS ---
        $gestor = $auth->createRole('gestor');
        $gestor->description = 'Gestor de Experiências';
        $auth->add($gestor);

        // Users (apenas visualizar)
        $auth->addChild($gestor, $viewUsers);

        // Experiências (CRUD completo)
        $auth->addChild($gestor, $createExperiencias);
        $auth->addChild($gestor, $viewExperiencias);
        $auth->addChild($gestor, $editExperiencias);
        $auth->addChild($gestor, $updateExperiencias);
        $auth->addChild($gestor, $deleteExperiencias);

        // Categorias (CRUD completo)
        $auth->addChild($gestor, $createCategorias);
        $auth->addChild($gestor, $viewCategorias);
        $auth->addChild($gestor, $editCategorias);
        $auth->addChild($gestor, $updateCategorias);
        $auth->addChild($gestor, $deleteCategorias);

        // Idioma (CRUD completo)
        $auth->addChild($gestor, $createIdioma);
        $auth->addChild($gestor, $viewIdioma);
        $auth->addChild($gestor, $editIdioma);
        $auth->addChild($gestor, $updateIdioma);
        $auth->addChild($gestor, $deleteIdioma);

        // Comentários (CRUD completo)
        $auth->addChild($gestor, $createComentarios);
        $auth->addChild($gestor, $editComentarios);
        $auth->addChild($gestor, $updateComentarios);
        $auth->addChild($gestor, $deleteComentarios);

        // Avaliações (apenas visualizar)
        $auth->addChild($gestor, $viewAvaliacoes);

        // Reservas das suas experiências (CRUD completo)
        $auth->addChild($gestor, $viewReservas);
        $auth->addChild($gestor, $editReservas);
        $auth->addChild($gestor, $updateReservas);
        $auth->addChild($gestor, $deleteReservas);

        // Pagamento (CRUD completo)
        $auth->addChild($gestor, $createPagamento);
        $auth->addChild($gestor, $viewPagamento);
        $auth->addChild($gestor, $editPagamento);
        $auth->addChild($gestor, $updatePagamento);
        $auth->addChild($gestor, $deletePagamento);

        // Língua (CRUD completo)
        $auth->addChild($gestor, $createLingua);
        $auth->addChild($gestor, $editLingua);
        $auth->addChild($gestor, $updateLingua);
        $auth->addChild($gestor, $deleteLingua);


        // --- TURISTA ---
        $turista = $auth->createRole('turista');
        $turista->description = 'Turista com conta';
        $auth->add($turista);

        // Experiências e Categorias (apenas visualizar)
        $auth->addChild($turista, $viewExperiencias);
        $auth->addChild($turista, $viewCategorias);

        // Comentários (CRUD completo dos seus)
        $auth->addChild($turista, $createComentarios);
        $auth->addChild($turista, $editComentarios);
        $auth->addChild($turista, $updateComentarios);
        $auth->addChild($turista, $deleteComentarios);

        // Avaliações (CRUD completo das suas)
        $auth->addChild($turista, $createAvaliacoes);
        $auth->addChild($turista, $editAvaliacoes);
        $auth->addChild($turista, $updateAvaliacoes);
        $auth->addChild($turista, $deleteAvaliacoes);

        // Reservas (criar e eliminar as suas)
        $auth->addChild($turista, $createReservas);
        $auth->addChild($turista, $deleteReservas);

        // Favoritos
        $auth->addChild($turista, $createFavoritos);
        $auth->addChild($turista, $deleteFavoritos);

        // Visualizar
        $auth->addChild($turista, $viewPagamento);
        $auth->addChild($turista, $viewIdioma);




        // ============= ATRIBUIR ROLES AOS UTILIZADORES =============

        $auth->assign($admin, 1);    // User ID 1 = Admin
        $auth->assign($gestor, 2);   // User ID 2 = Gestor
        $auth->assign($turista, 3);  // User ID 3 = Turista com conta


        echo "RBAC inicializado com sucesso.\n";
        echo "Roles criados: admin, gestor, turista.\n";


    }
}