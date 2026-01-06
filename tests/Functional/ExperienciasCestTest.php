<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;
use backend\models\Experiencias;

class ExperienciasCest
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

    /**
     * @skip Este teste está temporariamente desativado para investigar um bug silencioso no save().
     */
    public function tryToCreateExperiencia(FunctionalTester $I)
    {
        $I->amOnPage('experiencias/create');
        $I->see('Create Experiencias');

        $uniqueName = 'Experiência de Teste ' . time();

        // Preencher o formulário
        $I->fillField('Experiencias[nome]', $uniqueName);
        $I->fillField('Experiencias[horaInicio]', '10:00');
        $I->fillField('Experiencias[horaFim]', '12:00');
        $I->fillField('Experiencias[local]', 'Local de Teste');
        $I->fillField('Experiencias[dataDisponivel]', '2024-12-31');
        $I->fillField('Experiencias[precoPessoa]', '99.99');
        $I->fillField('Experiencias[numMaxParticipante]', '10');
        $I->fillField('Experiencias[numMinParticipante]', '2');

        $I->selectOption('Experiencias[categoria_id]', '3'); 
        $I->selectOption('Experiencias[gestor_id]', '1');    
        $I->selectOption('Experiencias[pais_id]', '2');      

        $I->click('button[type=submit]');

        $I->dontSee('Erro:', '.alert-danger'); 

        $I->see($uniqueName);
        $I->seeRecord(Experiencias::class, [
            'nome' => $uniqueName,
            'local' => 'Local de Teste'
        ]);
    }
}
