<?php

namespace tests\models;

use app\models\Auskunft;
use app\models\Generated;
use app\models\Reminders;

use app\commands\GenerateController;

class GenerateControllerTest extends \Codeception\Test\Unit
{
            // Somehow Test GenerateController in Unit Tests

    // public function testReminderIsSaved()
    // {
    //     /** @var Auskunft $model */
    //     $this->model = $this->getMockBuilder('app\models\Auskunft')
    //         ->setMethods(['validate'])
    //         ->getMock();

    //     $this->model->expects($this->once())
    //         ->method('validate')
    //         ->will($this->returnValue(true));

    //     # construct data and generate pdf(s)
    //     $uid = '###TEST-AUSKUNFT-'.time().'###';

    //     $this->model->attributes = [
    //         'firstName' => "Testo",
    //         'lastName' => "Testi",
    //         'street' => "Marinelligasse",
    //         'streetNumber' => "13-15",
    //         'zip' => "1020",
    //         'city' => "Wien",
    //         'additional' => '',
    //         'idType' => 1,
    //         'email' => "daniel@derzer.at",
    //         'reminder' => false,
    //         "targets" => $uid
    //     ];

    //     # Check if files exist on filesystem

    //     //expect($this->model->validate())->equals(true);
    //     expect($this->model->save())->equals(true);
    //     $this->tester->seeInDatabase("reminders", ['email' => "daniel@derzer.at", 'targets' => $uid]);
    // }

    // public function testPdfIsGenerated()
    // {
    //     /** @var Auskunft $model */
    //     $this->model = $this->getMockBuilder('app\models\Auskunft')
    //     ->setMethods(['validate'])
    //     ->getMock();

    //     $this->model->expects($this->once())
    //         ->method('validate')
    //         ->will($this->returnValue(true));

    //     # construct data and generate pdf(s)

    //     $this->model->attributes = [
    //         'firstName' => "Daniel",
    //         'lastName' => "Weissengruber",
    //         'street' => "Marinelligasse",
    //         'streetNumber' => "13-15",
    //         'zip' => "1020",
    //         'city' => "Wien",
    //         'additional' => '',
    //         'idType' => 1,
    //         'email' => "daniel@derzer.at",
    //         'reminder' => false,
    //         "targets" => '["A1", "B2"]'
    //     ];

    //     # Check if files exist on filesystem

    //     expect($this->model->validate())->equals(true);
    //     expect($this->model->save(false))->equals(true);

    //     assertFileExists($path);
    // }

    // public function testEmailIsSent()
    // {
    //     /** @var Auskunft $model */
    //     $this->model = $this->getMockBuilder('app\models\Auskunft')
    //     ->setMethods(['validate'])
    //     ->getMock();

    //     $this->model->expects($this->once())
    //         ->method('validate')
    //         ->will($this->returnValue(true));

    //     # construct data and generate pdf(s)

    //     $this->model->attributes = [
    //         'firstName' => "Daniel",
    //         'lastName' => "Weissengruber",
    //         'street' => "Marinelligasse",
    //         'streetNumber' => "13-15",
    //         'zip' => "1020",
    //         'city' => "Wien",
    //         'additional' => '',
    //         'idType' => '',
    //         'email' => "daniel@derzer.at",
    //         'reminder' => false,
    //         "targets" => '["A1", "B2"]'
    //     ];

    //     expect_that($this->model->contact('admin@example.com'));

    //     // using Yii2 module actions to check email was sent
    //     $this->tester->seeEmailIsSent();

    //     $emailMessage = $this->tester->grabLastSentEmail();
    //     expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
    //     expect($emailMessage->getTo())->hasKey('admin@example.com');
    //     expect($emailMessage->getFrom())->hasKey('tester@example.com');
    //     expect($emailMessage->getSubject())->equals('very important letter subject');
    //     expect($emailMessage->toString())->contains('body of current message');
    // }
}