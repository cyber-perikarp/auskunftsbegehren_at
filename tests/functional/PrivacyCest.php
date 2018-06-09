<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class PrivacyCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/privacy']);
    }

    public function checkPrivacy(\FunctionalTester $I)
    {
        $I->see('Datenschutzerklärung', 'h1');
    }
}
