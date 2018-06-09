<?php

namespace tests\models;

use app\models\AdressdatenSearch;

class AdressdatenSearchModelTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testAdressdatenSearchInvalid()
    {
        /** @var AdressdatenSearch $model */
        $this->model = $this->getMockBuilder('app\models\AdressdatenSearch')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        $this->model->attributes = [
            'id' => '1337',
            'name' => '1337',
            'branche' => '1337',
            'typ' => '1337',
            'plz' => 1337,
            'adresse' => '1337',
            'stadt' => '1337',
            'bundesland' => '1337',
            'land' => '1337',
            'email' => '1337',
            'tel' => '1337',
            'fax' => '1337'
        ];

        expect($this->model->search($this->model->attributes)->getCount())->equals(0);
    }

    public function testAdressdatenSearchValid()
    {
        /** @var Auskunft $model */
        $this->model = $this->getMockBuilder('app\models\AdressdatenSearch')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        $this->model->attributes = [
            'id' => '21-banken',
            'name' => '',
            'branche' => '',
            'typ' => '',
            'plz' => '',
            'adresse' => '',
            'stadt' => '',
            'bundesland' => '',
            'land' => '',
            'email' => '',
            'tel' => '',
            'fax' => ''
        ];

        expect($this->model->search($this->model->attributes)->getCount())->equals(1);
    }
}
