<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;

class ManagementPagesCest
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

    public function tryToAccessUsersPage(FunctionalTester $I)
    {
        $I->amOnPage('user/index');
        $I->see('Users', 'h1');
        $I->seeResponseCodeIs(200);
    }

    public function tryToAccessPaisesPage(FunctionalTester $I)
    {
        $I->amOnPage('paises/index');
        $I->see('Paises', 'h1');
        $I->seeResponseCodeIs(200);
    }
}
