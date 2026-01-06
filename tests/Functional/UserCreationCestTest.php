<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;
use common\models\User;

class UserCreationCest
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

    public function tryToCreateUser(FunctionalTester $I)
    {
        $I->amOnPage('user/create');
        $I->see('Create User', 'h1');

        // Gerar dados únicos para o novo utilizador
        $username = 'newuser' . time();
        $email = $username . '@example.com';
        $password = 'password123';

        // Preencher o formulário
        $I->fillField('User[username]', $username);
        $I->fillField('User[email]', $email);
        $I->fillField('User[password]', $password);
        $I->selectOption('User[status]', 'Active'); // Assumindo que o texto da opção é 'Active'

        $I->click('Save');

        // Verificar se fomos redirecionados e se o utilizador foi criado
        $I->see($username);
        $I->seeRecord('common\models\User', [
            'username' => $username,
            'email' => $email
        ]);
    }
}
