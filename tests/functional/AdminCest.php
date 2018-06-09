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

    // TODO: Way more testing

    // public function checkSubmitFormWithIncorrectCaptcha(\FunctionalTester $I)
    // {
    //     $I->submitForm('#suggest-form', [
    //         'AdressdatenSuggest[name]' => 'Test-Datensammler',
    //         'AdressdatenSuggest[email]' => 'tester.email',
    //         'AdressdatenSuggest[adresse]' => 'test adress 1234',
    //         'AdressdatenSuggest[plz]' => '1234',
    //         'AdressdatenSuggest[branche]' => 'Test',
    //         'AdressdatenSuggest[typ]' => 'Test',
    //         'AdressdatenSuggest[stadt]' => 'Wien',
    //         'AdressdatenSuggest[bundesland]' => 'Wien',
    //         'AdressdatenSuggest[land]' => 'AT',
    //         'AdressdatenSuggest[tel]' => '+436600000000',
    //         'AdressdatenSuggest[email]' => 'test.email',
    //         'AdressdatenSuggest[fax]' => '',
    //         'AdressdatenSuggest[plz]' => '1234',
    //         'AdressdatenSuggest[plz]' => '1234',
    //         'AdressdatenSuggest[verifyCode]' => 'pls_let_me_in'
    //     ]);
    //     $I->see('Invalid Data supplyed.', '.alert-warning');
    //     $I->dontSee('Failed to Insert data.', '.alert-danger');
    //     $I->dontSee('Successfully Inserted Data', '.alert-success');
    //     $I->see('The verification code is incorrect.', '.help-block');
        
    //     $I->dontSee('Name cannot be blank', '.help-block');
    //     $I->dontSee('Adresse cannot be blank', '.help-block');
    //     $I->dontSee('Plz cannot be blank', '.help-block');
    //     $I->dontSee('Stadt cannot be blank', '.help-block');
    //     $I->dontSee('Bundesland cannot be blank', '.help-block');
    //     $I->dontSee('Land cannot be blank', '.help-block');
    //     $I->dontSee('Tel cannot be blank', '.help-block');
    //     $I->dontSee('Either Email or Fax must be filled up properly', '.help-block');
    //     $I->dontSee('Captcha cannot be blank', '.help-block');   
    // }


    // public function checkSubmitFormSuccessfully(\FunctionalTester $I)
    // {
    //     $I->submitForm('#suggest-form', [
    //         'AdressdatenSuggest[name]' => 'Test-Datensammler',
    //         'AdressdatenSuggest[email]' => 'tester.email',
    //         'AdressdatenSuggest[adresse]' => 'test adress 1234',
    //         'AdressdatenSuggest[plz]' => '1234',
    //         'AdressdatenSuggest[branche]' => 'Test',
    //         'AdressdatenSuggest[typ]' => 'Test',
    //         'AdressdatenSuggest[stadt]' => 'Wien',
    //         'AdressdatenSuggest[bundesland]' => 'Wien',
    //         'AdressdatenSuggest[land]' => 'AT',
    //         'AdressdatenSuggest[tel]' => '+436600000000',
    //         'AdressdatenSuggest[email]' => 'test@mail.ru',
    //         'AdressdatenSuggest[fax]' => '',
    //         'AdressdatenSuggest[plz]' => '1234',
    //         'AdressdatenSuggest[plz]' => '1234',
    //         'AdressdatenSuggest[verifyCode]' => 'test'
    //     ]);
    //     $I->dontSeeElement('#suggest-form');
    //     $I->see('Successfully Inserted Data', '.alert-success');
    //     $I->dontSee('Invalid Data supplyed.', '.alert-warning');
    //     $I->dontSee('Failed to Insert data.', '.alert-danger');
    // }
}
