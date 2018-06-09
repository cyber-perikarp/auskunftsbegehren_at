<?php

namespace tests\functional;

use \Codeception\Util\Locator;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class DownloadCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['auskunft/download?id=1']);
    }

    public function checkDownloadBadRequest(\FunctionalTester $I)
    {
        $I->amOnPage(['auskunft/download']);
        $I->see('Bad Request: Missing required parameters: id');
    }

    public function checkDownloadInvalid(\FunctionalTester $I)
    {
        $I->see('Not Found: Link abgelaufen.');
    }

    // TODO: Prepare file to make test pass-able
    // public function checkDownloadSucess(\FunctionalTester $I)
    // {
    //     $I->see('Yay, Drück auf download!');
    // }
}
