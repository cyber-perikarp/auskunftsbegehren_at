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

    public function testSuggestionIsSaved()
    {
        /** @var ContactForm $model */
        // $this->model = $this->getMockBuilder('app\models\AdressdatenSuggest')
        //     ->setMethods(['validate'])
        //     ->getMock();

        // $this->model->expects($this->once())
        //     ->method('validate')
        //     ->will($this->returnValue(true));

        // $uid = '###TEST-'.time().'###';

        // # construct data and generate pdf(s)

        // $this->model->attributes = [
        //     'id' => $uid,
        //     'name' => 'Datensammler 2k',
        //     'quelldatei' => '###Suggestion###',
        //     'branche' => 'none',
        //     'typ' => 'test',
        //     'adresse' => 'Marinelligasse 15/28',
        //     'plz' => 1020,
        //     'stadt' => 'Wien',
        //     'bundesland' => 'Wien',
        //     'land' => 'AT',
        //     'email' => 'daniel@derzer.at',
        //     'tel' => '+436605959699',
        //     'fax' => '',
        //     'verifyCode' => 'test'
        // ];

        // # Check if files exist on filesystem

        // expect($this->model->validate())->equals(true);
        // expect($this->model->save(false))->equals(true);

        // expect($this->model->find(['id' => $uid]))->equals($this->model->attributes);
    }
}
