<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class ImprintCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/imprint']);
    }

    public function checkImprint(\FunctionalTester $I)
    {
        $I->see('Impressum', 'h1');
        $I->see('Cyber Perikarp - Verein zur Förderung der Netzkultur');
        $I->see('Vereinsregisternummer: 712531114');
        $I->see('Datenverarbeitungsregister: 4016968');
        $I->see('EU-Transparenz-Registernummer: 334990728439-25');
        $I->see('D-U-N-S® Nummer: 300530810');
    }
}
