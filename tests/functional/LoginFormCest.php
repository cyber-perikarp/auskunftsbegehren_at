<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class LoginFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
    }

    public function checkLogin(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');        
    }

    // demonstrates `amLoggedInAs` method
    public function checkInternalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        $I->amOnPage('/');
        $I->see('Admin-UI');
    }

    public function checkLoginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function checkLoginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function checkLoginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => '1337Datenschuetzer',
        ]);
        $I->dontSeeElement('form#login-form');   
        $I->see('Admin-UI');           
    }
}