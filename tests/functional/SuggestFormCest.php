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
        $I->dontSee('Failed to Insert data.', '.alert-danger');
        $I->dontSee('Successfully Inserted Data', '.alert-success');

        $I->see('Name cannot be blank', '.help-block');
        $I->see('Adresse cannot be blank', '.help-block');
        $I->see('Plz cannot be blank', '.help-block');
        $I->see('Stadt cannot be blank', '.help-block');
        $I->see('Bundesland cannot be blank', '.help-block');
        $I->see('Land cannot be blank', '.help-block');
        $I->see('Tel cannot be blank', '.help-block');
        $I->see('Either Email or Fax must be filled up properly', '.help-block');
        $I->see('Captcha cannot be blank', '.help-block');
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
        $I->see('Invalid Data supplyed.', '.alert-warning');
        $I->dontSee('Failed to Insert data.', '.alert-danger');
        $I->dontSee('Successfully Inserted Data', '.alert-success');
        $I->see('Email is not a valid email address.', '.help-block');

        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Adresse cannot be blank', '.help-block');
        $I->dontSee('Plz cannot be blank', '.help-block');
        $I->dontSee('Stadt cannot be blank', '.help-block');
        $I->dontSee('Bundesland cannot be blank', '.help-block');
        $I->dontSee('Land cannot be blank', '.help-block');
        $I->dontSee('Tel cannot be blank', '.help-block');
        $I->dontSee('Either Email or Fax must be filled up properly', '.help-block');
        $I->dontSee('Captcha cannot be blank', '.help-block');    
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
        $I->see('Invalid Data supplyed.', '.alert-warning');
        $I->dontSee('Failed to Insert data.', '.alert-danger');
        $I->dontSee('Successfully Inserted Data', '.alert-success');
        $I->see('Tel is invalid', '.help-block');
        
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Adresse cannot be blank', '.help-block');
        $I->dontSee('Plz cannot be blank', '.help-block');
        $I->dontSee('Stadt cannot be blank', '.help-block');
        $I->dontSee('Bundesland cannot be blank', '.help-block');
        $I->dontSee('Land cannot be blank', '.help-block');
        $I->dontSee('Tel cannot be blank', '.help-block');
        $I->dontSee('Either Email or Fax must be filled up properly', '.help-block');
        $I->dontSee('Captcha cannot be blank', '.help-block');   
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
        $I->see('Invalid Data supplyed.', '.alert-warning');
        $I->dontSee('Failed to Insert data.', '.alert-danger');
        $I->dontSee('Successfully Inserted Data', '.alert-success');
        $I->see('Fax is invalid.', '.help-block');
        
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Adresse cannot be blank', '.help-block');
        $I->dontSee('Plz cannot be blank', '.help-block');
        $I->dontSee('Stadt cannot be blank', '.help-block');
        $I->dontSee('Bundesland cannot be blank', '.help-block');
        $I->dontSee('Land cannot be blank', '.help-block');
        $I->dontSee('Tel cannot be blank', '.help-block');
        $I->dontSee('Either Email or Fax must be filled up properly', '.help-block');
        $I->dontSee('Captcha cannot be blank', '.help-block');   
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
        $I->see('Invalid Data supplyed.', '.alert-warning');
        $I->dontSee('Failed to Insert data.', '.alert-danger');
        $I->dontSee('Successfully Inserted Data', '.alert-success');
        $I->see('The verification code is incorrect.', '.help-block');
        
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Adresse cannot be blank', '.help-block');
        $I->dontSee('Plz cannot be blank', '.help-block');
        $I->dontSee('Stadt cannot be blank', '.help-block');
        $I->dontSee('Bundesland cannot be blank', '.help-block');
        $I->dontSee('Land cannot be blank', '.help-block');
        $I->dontSee('Tel cannot be blank', '.help-block');
        $I->dontSee('Either Email or Fax must be filled up properly', '.help-block');
        $I->dontSee('Captcha cannot be blank', '.help-block');   
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
        $I->see('Successfully Inserted Data', '.alert-success');
        $I->dontSee('Invalid Data supplyed.', '.alert-warning');
        $I->dontSee('Failed to Insert data.', '.alert-danger');
    }
}
