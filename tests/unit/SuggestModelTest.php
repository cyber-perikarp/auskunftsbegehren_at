<?php

namespace tests\models;

use app\models\AdressdatenSuggest;

class SuggestModelTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testSuggestionIsSaved()
    {
        /** @var AdressdatenSuggest $model */
        $this->model = $this->getMockBuilder('app\models\AdressdatenSuggest')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        $uid = '###TEST-SUGGEST-'.time().'###';

        # construct test-data

        $this->model->attributes = [
            'id' => $uid,
            'name' => 'Datensammler 2k',
            'branche' => 'test',
            'typ' => 'test',
            'adresse' => 'Marinelligasse 15/28',
            'plz' => 1020,
            'stadt' => 'Wien',
            'bundesland' => 'Wien',
            'land' => 'AT',
            'email' => 'daniel@derzer.at',
            'tel' => '+436605959699',
            'fax' => '',
            'verifyCode' => 'test'
        ];

        # Check if entry is Saved

        expect($this->model->validate())->equals(true);
        expect($this->model->save(false))->equals(true);
        $this->tester->seeInDatabase("adressdaten", ['id' => $uid]);
        expect($this->model->delete())->equals(true);
        $this->tester->dontSeeInDatabase("adressdaten", ['id' => $uid]);
    }

    public function testInputValidation()
    {
        /** @var AdressdatenSuggest $model */
        $this->model = $this->getMockBuilder('app\models\AdressdatenSuggest')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        $uid = '###TEST-SUGGEST-'.time().'###';

        # construct test-data

        $this->model->attributes = [
            'id' => $uid,
            'name' => 'Datensammler 2k',
            'branche' => 'test',
            'typ' => 'test',
            'adresse' => 'Marinelligasse 15/28',
            'plz' => 1020,
            'stadt' => 'Wien',
            'bundesland' => 'Wien',
            'land' => 'AT',
            'email' => 'daniel@derzer.at',
            'tel' => '+436605959699',
            'fax' => '',
            'verifyCode' => 'test'
        ];

        # Check if entry is Saved

        expect($this->model->validate())->equals(true);
        expect($this->model->save(false))->equals(true);
        $this->tester->seeInDatabase("adressdaten", ['id' => $uid]);
        expect($this->model->delete())->equals(true);
        $this->tester->dontSeeInDatabase("adressdaten", ['id' => $uid]);
    }
}
