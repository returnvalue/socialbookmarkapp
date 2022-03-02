<?php
use \FunctionalTester;

class LoginCest
{

    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function testLoggedInUserSeesUsername(FunctionalTester $I)
    {
        $I->wantTo('confirm a signed in user sees his username');
        $I->registerUser($I, 'Jason', 'phpleaks@example.com', 'password');
        $I->amOnPage('/auth/logout');
        $I->amOnPage('/');
        $I->loginUser($I, 'phpleaks@example.com', 'password');
        $I->seeAuthentication();
        $I->see('Jason');
    }



}