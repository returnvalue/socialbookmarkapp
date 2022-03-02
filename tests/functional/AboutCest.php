<?php
use \FunctionalTester;

class AboutCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function viewAboutPage(FunctionalTester $I)
    {
        $I->wantTo('view the about page');
        $I->amOnPage('/about');
        $I->see('About PHPLeaks', 'h1');
        $I->see('About the PHPLeaks Website', 'h2');
    }
}