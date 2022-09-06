<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
class EventCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['events/create']);
        $I->seeInDatabase('events',['title' => 'test']);
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
