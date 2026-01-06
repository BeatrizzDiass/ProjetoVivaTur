<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        // Não é necessário fazer login antes de testar o próprio login
    }

    public function tryToLoginSuccessfully(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Login', 'h1');

        $I->fillField('LoginForm[username]', 'testes1');
        $I->fillField('LoginForm[password]', 'testes1234');
        $I->click('Login');

        $I->see('Logout');
        $I->dontSee('Incorrect username or password.');
    }

    public function tryToLoginWithWrongCredentials(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->fillField('LoginForm[username]', 'testes1');
        $I->fillField('LoginForm[password]', 'wrongpassword');
        $I->click('Login');

        $I->see('Incorrect username or password.');
        $I->dontSee('Logout');
    }
}
