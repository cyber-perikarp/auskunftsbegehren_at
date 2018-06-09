<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class ErrorCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/error']);
    }

    public function checkError(\FunctionalTester $I)
    {
        $I->see('Not Found (#404)', 'h1');
        $I->see('Page not found.', '.alert-danger');
    }
}
