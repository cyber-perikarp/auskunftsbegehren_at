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
        $I->see('Invalid Data supplyed.', '.alert-warning');
        $I->see('Name cannot be blank', '.help-block');
        $I->see('Adresse cannot be blank', '.help-block');
        $I->see('Plz cannot be blank', '.help-block');
        $I->see('Stadt cannot be blank', '.help-block');
        $I->see('Bundesland cannot be blank', '.help-block');
        $I->see('Land cannot be blank', '.help-block');
        $I->see('Tel cannot be blank', '.help-block');
        $I->see('Either Email or Fax must be filled up properly        ', '.help-block');
        $I->see('Captcha cannot be blank', '.help-block');
    }

    public function checkSubmitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adress]' => 'test adress 1234',
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
        $I->see('E-Mail is not a valid email address.', '.help-block');
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Betreff cannot be blank', '.help-block');
        $I->dontSee('Nachricht cannot be blank', '.help-block');
        $I->dontSee('Captcha cannot be blank.', '.help-block');        
    }

    public function checkSubmitFormWithIncorrectTel(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adress]' => 'test adress 1234',
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
        $I->see('E-Mail is not a valid email address.', '.help-block');
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Betreff cannot be blank', '.help-block');
        $I->dontSee('Nachricht cannot be blank', '.help-block');
        $I->dontSee('Captcha cannot be blank.', '.help-block');  
    }

    public function checkSubmitFormWithIncorrectCaptcha(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adress]' => 'test adress 1234',
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
        $I->see('E-Mail is not a valid email address.', '.help-block');
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Betreff cannot be blank', '.help-block');
        $I->dontSee('Nachricht cannot be blank', '.help-block');
        $I->dontSee('Captcha cannot be blank.', '.help-block');  
    }


    public function checkSubmitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#suggest-form', [
            'AdressdatenSuggest[name]' => 'Test-Datensammler',
            'AdressdatenSuggest[email]' => 'tester.email',
            'AdressdatenSuggest[adress]' => 'test adress 1234',
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
        $I->seeEmailIsSent();
        $I->dontSeeElement('#suggest-form');
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');        
    }
}
