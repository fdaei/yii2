<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class DepartmentCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['departments/index']);
        $I->see('Departments', 'h1');
    }
    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {

    }
}
