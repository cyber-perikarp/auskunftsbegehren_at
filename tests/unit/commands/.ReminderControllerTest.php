<?php

namespace tests\models;

use app\models\Auskunft;
use app\models\Generated;
use app\models\Reminders;

use app\commands\ReminderController;

class ReminderControllerTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testReminderIsSaved()
    {
        /** @var Reminders $model */
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
        $this->tester->seeInDatabase("reminders", ['email' => "daniel@derzer.at", 'targets' => $uid]);
    }
}