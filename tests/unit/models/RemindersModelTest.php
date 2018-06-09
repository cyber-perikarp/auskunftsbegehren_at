<?php

namespace tests\models;

use app\models\Reminders;

class RemindersModelTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testReminderIsSaved()
    {
        /** @var Generated $model */
        $this->model = $this->getMockBuilder('app\models\Reminders')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        # construct data and generate pdf(s)
        $uid = '###TEST-REMINDER-'.time().'###';

        $this->model->attributes = [
            'id' => $uid,
            'email' => "daniel@derzer.at",
            'quelldatei' => 'none',
            'created_at' => date("Y-m-d"),
            'due_at' => date("Y-m-d"),
            'targets' => "0"
        ];

        # Check if files exist on filesystem

        //expect($this->model->validate())->equals(true);
        expect($this->model->save())->equals(true);
        $this->tester->seeInDatabase("reminders", $this->model->attributes);
    }
}
