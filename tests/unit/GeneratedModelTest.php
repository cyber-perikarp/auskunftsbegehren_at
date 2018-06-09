<?php

namespace tests\models;

use app\models\Generated;

class GeneratedModelTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testGeneratedIsSaved()
    {
        /** @var Generated $model */
        $this->model = $this->getMockBuilder('app\models\Generated')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        # construct data and generate pdf(s)
        $uid = '###TEST-GENERATED-'.time().'###';

        $this->model->attributes = [
            'id' => $uid,
            'generated_at' => date("Y-m-d"),
            'todelete_at' => date("Y-m-d"),
            'linkopened' => "0"
        ];

        # Check if files exist on filesystem

        //expect($this->model->validate())->equals(true);
        expect($this->model->save())->equals(true);
        $this->tester->seeInDatabase("generated", $this->model->attributes);
    }
}
