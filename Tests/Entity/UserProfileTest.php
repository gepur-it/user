<?php

namespace GepurIt\User\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Class UserProfileTest
 * @package AppBundle\Tests\Security
 */
class UserProfileTest extends TestCase
{
    public function testUserProfile()
    {
        $sid = 'sid';
        $sign = 'sign';
        $name = 'Ivan Ivanov';
        $userProfile = new UserProfile();

        $userProfile->setManagerId($sid);
        $this->assertEquals($sid, $userProfile->getManagerId());

        $userProfile->setManagerSign($sign);
        $this->assertEquals($sign, $userProfile->getManagerSign());

        $userProfile->setManagerName($name);
        $this->assertEquals($name, $userProfile->getManagerName());

        try {
            $userProfile->setManagerId([]);
        } catch (\Throwable $error) {
            $this->assertInstanceOf(\TypeError::class, $error);
        }

        try {
            $userProfile->setManagerSign(true);
        } catch (\Throwable $error) {
            $this->assertInstanceOf(\TypeError::class, $error);
        }

        try {
            $userProfile->setManagerSign(null);
        } catch (\Throwable $error) {
            $this->assertInstanceOf(\TypeError::class, $error);
        }

        try {
            $userProfile->setManagerName(null);
        } catch (\Throwable $error) {
            $this->assertInstanceOf(\TypeError::class, $error);
        }
    }

}
