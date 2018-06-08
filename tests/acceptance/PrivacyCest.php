<?php

use yii\helpers\Url;

class PrivacyCest
{
    public function _before(\AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/privacy'));
    }
    
    public function privacyPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure that privacy page works');
        $I->see('Datenschutzerklärung', 'h1');
    }
}
