<?php
use \FunctionalTester;

class WelcomeCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function testHomepageVisibility(FunctionalTester $I)
    {
        $I->wantTo('view the homepage');
        $I->amOnPage('/');
        $I->see('Welcome to PHPLeaks', 'h1');
    }

    public function testRegisterAndSigninLinksVisibility(FunctionalTester $I)
    {
        $I->wantTo('confirm existence of registration and sign-in links');
        $I->amOnPage('/');
        $I->see('Create Account');
        $I->see('Sign In');
    }

}