<?php

namespace tests\functional;

use \Codeception\Util\Locator;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class HomeCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['/']);
    }

    public function checkHome(\FunctionalTester $I)
    {
        $I->see('Her mit den Daten!', 'h1');
        $I->see('Auskunft verlangen!', Locator::href('/auskunft/index'));
        $I->see('office @ auskunftsbegehren . at', 'a');
        $I->see('Formular', Locator::href('/auskunft/suggest'));
        $I->see('Noch Fragen?', Locator::href('/site/faq'));
    }
}
