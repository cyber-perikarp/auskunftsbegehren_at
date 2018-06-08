<?php

use yii\helpers\Url;

class ImprintCest
{
    public function _before(\AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/imprint'));
    }
    
    public function imprintPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure that imprint page works');
        $I->see('Impressum', 'h1');
        $I->see('Cyber Perikarp - Verein zur Förderung der Netzkultur', 'strong');
    }
}
