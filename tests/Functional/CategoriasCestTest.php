<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;
use backend\models\Categorias;

class CategoriasCest
{
    public function _before(FunctionalTester $I)
    {
        // Fazer login antes de cada teste
        $I->amOnPage('site/login');
        $I->fillField('LoginForm[username]', 'testes1');
        $I->fillField('LoginForm[password]', 'testes1234');
        $I->click('Login');
        $I->see('Logout');
    }

    // Teste de acesso à página index
    public function tryToAccessIndex(FunctionalTester $I)
    {
        $I->amOnPage('categorias/index');
        $I->see('Categorias', 'h1');
        $I->seeResponseCodeIs(200);
    }

    // Teste de criação de categoria
    public function tryToCreateCategoria(FunctionalTester $I)
    {
        $I->amOnPage('categorias/create');
        $I->see('Create Categorias', 'h1');
        
        $I->fillField('Categorias[nome]', 'Nova Categoria Funcional');
        $I->click('Save');
        
        // Após salvar, o Yii redireciona para a página de visualização (view)
        $I->see('Nova Categoria Funcional');
        $I->seeRecord(Categorias::class, ['nome' => 'Nova Categoria Funcional']);
    }
}
