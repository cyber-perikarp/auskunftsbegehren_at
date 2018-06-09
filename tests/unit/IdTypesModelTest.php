<?php

namespace tests\models;

use app\models\IdTypes;

class IdTypesModelTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testIdTypeIsSaved()
    {
        /** @var Statistic $model */
        $this->model = $this->getMockBuilder('app\models\IdTypes')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        # construct data and generate pdf(s)
        $uid = '###TEST-ID-TYPES-'.time().'###';

        $this->model->attributes = [
            'id' => $uid,
            'name' => "Test",
            'nameForText' => "Test for Test",
        ];

        # Check if files exist on filesystem

        //expect($this->model->validate())->equals(true);
        expect($this->model->save())->equals(true);
        $this->tester->seeInDatabase("idTypes", $this->model->attributes);
    }
}
