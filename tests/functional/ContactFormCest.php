<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class ContactFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/contact']);
    }

    public function checkContact(\FunctionalTester $I)
    {
        $I->see('Contact', 'h1');        
    }

    public function checkSubmitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->see('Contact', 'h1');
        $I->see('Name cannot be blank', '.help-block');
        $I->see('E-Mail cannot be blank', '.help-block');
        $I->see('Betreff cannot be blank', '.help-block');
        $I->see('Nachricht cannot be blank', '.help-block');
        $I->see('Captcha cannot be blank.', '.help-block');
    }

    public function checkSubmitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'test',
        ]);
        $I->see('E-Mail is not a valid email address.', '.help-block');
        $I->dontSee('Name cannot be blank', '.help-block');
        $I->dontSee('Betreff cannot be blank', '.help-block');
        $I->dontSee('Nachricht cannot be blank', '.help-block');
        $I->dontSee('Captcha cannot be blank.', '.help-block');        
    }

    public function checkSubmitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'test',
        ]);
        $I->seeEmailIsSent();
        $I->dontSeeElement('#contact-form');
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');        
    }
}
