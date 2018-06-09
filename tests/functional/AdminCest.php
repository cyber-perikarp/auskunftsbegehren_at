<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class AdminCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        $I->amOnPage(['admin']);
    }

    public function checkAdmin(\FunctionalTester $I)
    {
        $I->see('Admin-UI', 'h1');        
    }

    public function checkCreateAndUpdate(\FunctionalTester $I)
    {
        $I->see('Admin-UI', 'h1');
        $I->click('Create Adressdaten', '.btn-success');
        $I->see('Create Adressdaten', 'h1');

        $uid = '###TEST-ADMIN-CREATE-'.time().'###';

        $I->submitForm('#admin-create', [
            'Adressdaten[id]' => $uid,
            'Adressdaten[name]' => 'Datensammler 2k',
            'Adressdaten[branche]' => 'test',
            'Adressdaten[typ]' => 'test',
            'Adressdaten[adresse]' => 'Marinelligasse 15/28',
            'Adressdaten[plz]' => 1020,
            'Adressdaten[stadt]' => 'Wien',
            'Adressdaten[bundesland]' => 'Wien',
            'Adressdaten[land]' => 'AT',
            'Adressdaten[email]' => 'daniel@derzer.at',
            'Adressdaten[tel]' => '+436605959699',
            'Adressdaten[fax]' => ''
        ]);

        $I->see('Datensammler 2k', 'h1');
        $I->click('Update');
        $I->see('Update Adressdaten: Datensammler 2k', 'h1');
        $I->fillField(['name' => 'Adressdaten[email]'], 'test@mail.ru');
        $I->click('Save');
        $I->see('Datensammler 2k', 'h1');
        $I->seeRecord("app\models\Adressdaten", [
            'id' => $uid,
            'name' => 'Datensammler 2k',
            'branche' => 'test',
            'typ' => 'test',
            'adresse' => 'Marinelligasse 15/28',
            'plz' => 1020,
            'stadt' => 'Wien',
            'bundesland' => 'Wien',
            'land' => 'AT',
            'email' => 'test@mail.ru',
            'tel' => '+436605959699',
            'fax' => ''
        ]);
    }
}
