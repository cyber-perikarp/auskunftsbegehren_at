<?php

namespace tests\functional;
use tests\FunctionalTester;
/* @var $scenario \Codeception\Scenario */

class FaqCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/faq']);
    }

    public function checkFaq(\FunctionalTester $I)
    {
        $I->see('FAQ', 'h1');
    }
}
