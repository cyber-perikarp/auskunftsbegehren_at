<?php

namespace tests\functional;

use \Codeception\Util\Locator;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class DownloadCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['auskunft/download']);
    }

    public function checkDownloadInvalid(\FunctionalTester $I)
    {
        $I->see('Not Found (#404)', 'h1');
        $I->see('Link abgelaufen.', '.alert-danger');
    }

    public function checkDownloadSucess(\FunctionalTester $I)
    {
        $I->see('Yay, Drück auf download!');
    }
}
