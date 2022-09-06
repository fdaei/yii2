<?php
namespace backend\tests;

use backend\models\Locations;
use common\models\User;

class LocationTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    protected $user_id;
    protected function _before()
    {
        $this->user_id = $this->tester->haveRecord('locations', [
            'zip_code' => '123',
            'city' => 'kerman',
            'province' => '123456',
        ]);
    }

    protected function _after()
    {
    }
    public function testSomeFeature()
    {

    }
}