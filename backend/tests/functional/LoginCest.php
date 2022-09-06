<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class LoginCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', '123456789');
        $I->click('Login');
    }
}
