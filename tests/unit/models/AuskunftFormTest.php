<?php

namespace tests\models;

use app\models\Auskunft;

class AuskunftFormTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testAuskunftIsSaved()
    {
        /** @var Auskunft $model */
        $this->model = $this->getMockBuilder('app\models\Auskunft')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        # construct data and generate pdf(s)
        $uid = '###TEST-AUSKUNFT-'.time().'###';

        $this->model->attributes = [
            'firstName' => "Testo",
            'lastName' => "Testi",
            'street' => "Marinelligasse",
            'streetNumber' => "13-15",
            'zip' => "1020",
            'city' => "Wien",
            'additional' => '',
            'idType' => 1,
            'email' => "daniel@derzer.at",
            'reminder' => false,
            "targets" => $uid
        ];

        # Check if files exist on filesystem

        //expect($this->model->validate())->equals(true);
        expect($this->model->save())->equals(true);
        $this->tester->seeInDatabase("auskunft", $this->model->attributes);
    }
}
