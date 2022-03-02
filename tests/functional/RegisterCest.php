<?php
use \FunctionalTester;

class RegisterCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // protected function register(FunctionalTester $I)
    // {
    //     $I->amOnPage('/auth/register');
    //     $I->fillField('name', 'phpleaker');
    //     $I->fillField('email', 'phpleaker@example.com');
    //     $I->fillField('password', 'password');
    //     $I->fillField('password_confirmation', 'password');
    //     $I->click('button[type=submit]');
    // }

    public function testSuccessfullyRegisterAUser(FunctionalTester $I)
    {
        $I->wantTo('successfully register a user');
        $I->registerUser($I, 'phpleaker', 'phpleaks@example.com', 'password');
        $I->amOnPage('/');
        $I->seeRecord('users', ['email' => 'phpleaks@example.com']);
        $I->seeAuthentication();
    }

    public function testUserRegistrationFailsWithNonAlphanumericUsername(FunctionalTester $I)
    {
        $I->wantTo('ensure user cannot register with a non-alphanumeric username');
        $I->amOnPage('/auth/register');
        $I->fillField('name', 'PHP Leaker');
        $I->fillField('email', 'phpleaker@example.com');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('button[type=submit]');
        $I->amOnPage('/auth/register');
    }

    public function testCannotCreateMultipleAccountsWithDuplicateEmail(FunctionalTester $I)
    {
        $I->wantTo('ensure the same e-mail address cannot be used twice');
        $I->registerUser($I, 'phpleaker', 'phpleaks@example.com', 'password');
        $I->amOnPage('/auth/logout');
        $I->amOnPage('/auth/register');
        $I->registerUser($I, 'phpleaker', 'phpleaks@example.com', 'password');
        $I->amOnPage('/auth/register');
    }

}