<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class SuggestFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['auskunft/suggest']);
    }

    public function checkContact(\FunctionalTester $I)
    {
        $I->see('Datensammler melden', 'h1');        
    }

    public function checkSubmitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', []);
        $I->see('Datensammler melden', 'h1');
        $I->see('Fehlerhafte daten.', '.alert-warning');
        $I->dontSee('Fehler beim speichern.', '.alert-danger');
        $I->dontSee('Danke für Ihre meldung!', '.alert-success');

        $I->see('Name ist ein Pflichtfeld.', '.help-block');
        $I->see('Adresse ist ein Pflichtfeld.', '.help-block');
        $I->see('Plz ist ein Pflichtfeld.', '.help-block');
        $I->see('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->see('Bundesland ist ein Pflichtfeld.', '.help-block');
        $I->see('Land ist ein Pflichtfeld.', '.help-block');
        $I->see('Tel ist ein Pflichtfeld.', '.help-block');
        $I->see('Email oder Fax müssen angegeben werden.', '.help-block');
        $I->see('Captcha ist ein Pflichtfeld.', '.help-block');
    }

    public function checkSubmitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adresse]' => 'test adress 1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[branche]' => 'Test',
            'AdressdatenSuggest[typ]' => 'Test',
            'AdressdatenSuggest[stadt]' => 'Wien',
            'AdressdatenSuggest[bundesland]' => 'Wien',
            'AdressdatenSuggest[land]' => 'AT',
            'AdressdatenSuggest[tel]' => '+436600000000',
            'AdressdatenSuggest[email]' => 'test.email',
            'AdressdatenSuggest[fax]' => '',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[verifyCode]' => 'test'
        ]);
        $I->see('Fehlerhafte daten.', '.alert-warning');
        $I->dontSee('Fehler beim speichern.', '.alert-danger');
        $I->dontSee('Danke für Ihre meldung!', '.alert-success');
        $I->see('Email is not a valid email address.', '.help-block');

        $I->dontSee('Name ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Adresse ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Plz ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Bundesland ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Land ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Tel ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Email oder Fax müssen angegeben werden.', '.help-block');
        $I->dontSee('Captcha ist ein Pflichtfeld.', '.help-block');    
    }

    public function checkSubmitFormWithIncorrectTel(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adresse]' => 'test adress 1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[branche]' => 'Test',
            'AdressdatenSuggest[typ]' => 'Test',
            'AdressdatenSuggest[stadt]' => 'Wien',
            'AdressdatenSuggest[bundesland]' => 'Wien',
            'AdressdatenSuggest[land]' => 'AT',
            'AdressdatenSuggest[tel]' => '06600000000',
            'AdressdatenSuggest[email]' => 'test.email',
            'AdressdatenSuggest[fax]' => '',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[verifyCode]' => 'test'
        ]);
        $I->see('Fehlerhafte daten.', '.alert-warning');
        $I->dontSee('Fehler beim speichern.', '.alert-danger');
        $I->dontSee('Danke für Ihre meldung!', '.alert-success');
        $I->see('Tel is invalid', '.help-block');
        
        $I->dontSee('Name ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Adresse ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Plz ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Bundesland ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Land ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Tel ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Email oder Fax müssen angegeben werden.', '.help-block');
        $I->dontSee('Captcha ist ein Pflichtfeld.', '.help-block');   
    }

    public function checkSubmitFormWithIncorrectFax(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adresse]' => 'test adress 1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[branche]' => 'Test',
            'AdressdatenSuggest[typ]' => 'Test',
            'AdressdatenSuggest[stadt]' => 'Wien',
            'AdressdatenSuggest[bundesland]' => 'Wien',
            'AdressdatenSuggest[land]' => 'AT',
            'AdressdatenSuggest[tel]' => '+436600000000',
            'AdressdatenSuggest[email]' => 'test.email',
            'AdressdatenSuggest[fax]' => '06600000000',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[verifyCode]' => 'test'
        ]);
        $I->see('Fehlerhafte daten.', '.alert-warning');
        $I->dontSee('Fehler beim speichern.', '.alert-danger');
        $I->dontSee('Danke für Ihre meldung!', '.alert-success');
        $I->see('Fax is invalid.', '.help-block');
        
        $I->dontSee('Name ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Adresse ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Plz ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Bundesland ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Land ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Tel ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Email oder Fax müssen angegeben werden.', '.help-block');
        $I->dontSee('Captcha ist ein Pflichtfeld.', '.help-block');   
    }

    public function checkSubmitFormWithIncorrectCaptcha(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adresse]' => 'test adress 1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[branche]' => 'Test',
            'AdressdatenSuggest[typ]' => 'Test',
            'AdressdatenSuggest[stadt]' => 'Wien',
            'AdressdatenSuggest[bundesland]' => 'Wien',
            'AdressdatenSuggest[land]' => 'AT',
            'AdressdatenSuggest[tel]' => '+436600000000',
            'AdressdatenSuggest[email]' => 'test.email',
            'AdressdatenSuggest[fax]' => '',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[verifyCode]' => 'pls_let_me_in'
        ]);
        $I->see('Fehlerhafte daten.', '.alert-warning');
        $I->dontSee('Fehler beim speichern.', '.alert-danger');
        $I->dontSee('Danke für Ihre meldung!', '.alert-success');
        $I->see('The verification code is incorrect.', '.help-block');
        
        $I->dontSee('Name ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Adresse ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Plz ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Stadt ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Bundesland ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Land ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Tel ist ein Pflichtfeld.', '.help-block');
        $I->dontSee('Email oder Fax müssen angegeben werden.', '.help-block');
        $I->dontSee('Captcha ist ein Pflichtfeld.', '.help-block');   
    }


    public function checkSubmitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adresse]' => 'test adress 1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[branche]' => 'Test',
            'AdressdatenSuggest[typ]' => 'Test',
            'AdressdatenSuggest[stadt]' => 'Wien',
            'AdressdatenSuggest[bundesland]' => 'Wien',
            'AdressdatenSuggest[land]' => 'AT',
            'AdressdatenSuggest[tel]' => '+436600000000',
            'AdressdatenSuggest[email]' => 'test@mail.ru',
            'AdressdatenSuggest[fax]' => '',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[plz]' => '1234',
            'AdressdatenSuggest[verifyCode]' => 'test'
        ]);
        $I->dontSeeElement('#suggest-form');
        $I->see('Danke für Ihre meldung!', '.alert-success');
        $I->dontSee('Fehlerhafte daten.', '.alert-warning');
        $I->dontSee('Fehler beim speichern.', '.alert-danger');
    }
}
