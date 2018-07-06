<?php

namespace tests\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('test');

        expect_not(User::findIdentity(0));
    }

    // public function testFindUserByAccessToken()
    // {
    //     expect_that($user = User::findIdentityByAccessToken('100-token'));
    //     expect($user->username)->equals('admin');
    //
    //     expect_not(User::findIdentityByAccessToken('non-existing'));
    // }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('test'));
        expect_not(User::findByUsername('not-test'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('test');
        // expect_that($user->validateAuthKey('test100key'));
        // expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('test','test123'));
        expect_not($user->validatePassword('test','123456'));
    }

}
