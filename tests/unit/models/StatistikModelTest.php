<?php

namespace tests\models;

use app\models\Statistik;

class StatistikModelTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testStatistikIsSaved()
    {
        /** @var Statistik $model */
        $this->model = $this->getMockBuilder('app\models\Statistik')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        # construct data and generate pdf(s)
        $uid = '###TEST-STATISTIK-'.time().'###';

        $this->model->attributes = [
            'id' => $uid,
            'counter' => 5000,
            'identifier' => "WOW",
        ];

        # Check if files exist on filesystem

        //expect($this->model->validate())->equals(true);
        expect($this->model->save())->equals(true);
        $this->tester->seeInDatabase("statistik", $this->model->attributes);
    }
}
