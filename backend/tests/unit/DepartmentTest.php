<?php
namespace backend\tests;

use backend\models\Departments;

class DepartmentTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    protected function _before()
    {

    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        // insert records in database
        $this->tester->haveRecord('backend\models\Events', ['title' => 'test','description'=>'test','created_date'=>'2022/1/1']);

        // check records in database
        $this->tester->seeRecord('backend\models\Events',  ['title' => 'test','description'=>'test','created_date'=>'2022/1/1']);
    }
}