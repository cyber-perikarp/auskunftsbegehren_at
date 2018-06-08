<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));        
        $I->see('Her mit den Daten!');

        $I->seeLink('Startseite');
        $I->seeLink('FAQ');
        $I->seeLink('Auskunft verlangen!');
        $I->seeLink('Formular');
        $I->seeLink('Kontakt');
        $I->seeLink('Impressum');
        $I->seeLink('Datenschutzerklärung');
        $I->click('Kontakt');
        $I->wait(2); // wait for page to be opened
        
        $I->see('Contact');
    }
}
