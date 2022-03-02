<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{

    public function registerUser($I, $username, $email, $pswd)
    {
        $I->amOnPage('/auth/register');
        $I->fillField('name', $username);
        $I->fillField('email', $email);
        $I->fillField('password', $pswd);
        $I->fillField('password_confirmation', $pswd);
        $I->click('button[type=submit]');
    }

    public function loginUser($I, $email, $pswd)
    {
        $I->amOnPage('/auth/login');
        $I->fillField('email', $email);
        $I->fillField('password', $pswd);
        $I->click('button[type=submit]');
    }

}
