<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class AdminAsGuestCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['admin']);
    }

    public function checkAdminUnauthenticated(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');        
    }
}
