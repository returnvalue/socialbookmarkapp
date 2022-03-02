<?php
use \FunctionalTester;

class CreateLinkCest
{
    public function _before(FunctionalTester $I)
    {

    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function testGuestRedirectedWhenAccessingLinkCreationForm(FunctionalTester $I)
    {
        $I->wantTo('ensure guest is redirected to sign in when accessing link creation form');
        $I->amOnPage('/link/create');
        $I->seeCurrentUrlEquals('/auth/login');
    }

    public function testAuthenticatedUserCanAccessLinkCreationForm(FunctionalTester $I)
    {
        $I->wantTo('ensure authenticated user can access the link creation form');
        $I->amOnPage('/link/create');
        $I->seeCurrentUrlEquals('/auth/login');
    }

}