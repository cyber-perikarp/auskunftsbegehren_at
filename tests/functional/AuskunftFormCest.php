<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class AuskunftFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['auskunft/index']);
    }

    public function checkContact(\FunctionalTester $I)
    {
        $I->see('Generieren', 'h1');        
    }

    public function checkSubmitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#generate-form', []);
        $I->see('Generieren', 'h1');
        $I->see('Vorname ist ein Pflichtfeld.', '.help-block');
        $I->see('Nachname ist ein Pflichtfeld.', '.help-block');
        $I->see('Straße ist ein Pflichtfeld.', '.help-block');
        $I->see('Hausnummer ist ein Pflichtfeld.', '.help-block');
        $I->see('Postleitzahl ist ein Pflichtfeld.', '.help-block');
        $I->see('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->see('Emailadresse ist ein Pflichtfeld.', '.help-block');
    }

    public function checkSubmitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#generate-form', [
            'Auskunft[firstName]' => 'Testi',
            'Auskunft[lastName]' => 'Testo',
            'Auskunft[street]' => 'Master-Chief-Street',
            'Auskunft[streetNumber]' => '101',
            'Auskunft[zip]' => '1337',
            'Auskunft[city]' => 'Middle of nowhere',
            'Auskunft[idType]' => '12',
            'Auskunft[additional]' => '###TEST###',
            'Auskunft[email]' => 'test.email',
            'Auskunft[reminder]' => '0',
            'Auskunft[targets]' => ['U44czbOnpsMStIounJzeM6NY9toTTFws', '1-firmen', '5-banken']
        ]);
        $I->see('Emailadresse is not a valid email address.', '.help-block');
        $I->dontSee('Vorname ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Nachname ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Straße ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Hausnummer ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Postleitzahl ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Emailadresse ist ein Pflichtfeld.', '.help-block'); 
    }

    public function checkSubmitFormWithNoTargets(\FunctionalTester $I)
    {
        $I->submitForm('#generate-form', [
            'Auskunft[firstName]' => 'Testi',
            'Auskunft[lastName]' => 'Testo',
            'Auskunft[street]' => 'Master-Chief-Street',
            'Auskunft[streetNumber]' => '101',
            'Auskunft[zip]' => '1337',
            'Auskunft[city]' => 'Middle of nowhere',
            'Auskunft[idType]' => '12',
            'Auskunft[additional]' => '###TEST###',
            'Auskunft[email]' => 'test@mail.ru',
            'Auskunft[reminder]' => '0',
            'Auskunft[targets]' => []
        ]);
        $I->see('Bitte mindestens ein Ziel angeben.', '.alert-info');
        $I->dontSee('Emailadresse is not a valid email address.', '.help-block');
        $I->dontSee('Vorname ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Nachname ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Straße ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Hausnummer ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Postleitzahl ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Emailadresse ist ein Pflichtfeld.', '.help-block'); 
    }

    public function checkSubmitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#generate-form', [
            'Auskunft[firstName]' => 'Testi',
            'Auskunft[lastName]' => 'Testo',
            'Auskunft[street]' => 'Master-Chief-Street',
            'Auskunft[streetNumber]' => '101',
            'Auskunft[zip]' => '1337',
            'Auskunft[city]' => 'Middle of nowhere',
            'Auskunft[idType]' => '12',
            'Auskunft[additional]' => '###TEST###',
            'Auskunft[email]' => 'test@mail.ru',
            'Auskunft[reminder]' => '0',
            'Auskunft[targets]' => ['U44czbOnpsMStIounJzeM6NY9toTTFws', '1-firmen', '5-banken']
        ]);

        $I->dontSeeElement('#generate-form');
        $I->see('Gratulation! Deine Auskunftsbegehren werden jetzt generiert und sind dann für 72 Stunden abrufbar. Den Link bekommst du in den nächsten 30 Minuten per Email zugestellt.');        
    }
}
