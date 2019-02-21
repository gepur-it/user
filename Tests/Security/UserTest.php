<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 30.10.17
 */

namespace GepurIt\User\Security;

use GepurIt\User\Entity\UserProfile;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserTest
 * @package AppBundle\Tests\Security
 */
class UserTest extends TestCase
{
    public function testUser()
    {
        $ldapSid = 'sid';
        $name = 'name';
        $roles = ['role'];
        $login = 'login';
        $user = new User($login, $ldapSid, $name, $roles);

        $this->assertTrue($user instanceof UserInterface, 'User implement AdvancedUserInterface');

        $this->assertEquals($login, $user->__toString(), 'User::__toString() returns login');
        $this->assertEquals($roles, $user->getRoles(), 'User::getRoles() returns roles');
        $this->assertEquals($ldapSid, $user->getUserId(), 'User::getLdapSid() returns ldap sid');
        $this->assertEquals($name, $user->getName(), 'User::getName() returns name');
        $this->assertEquals($login, $user->getLogin(), 'User::getLogin() returns login');
        $this->assertEquals($login, $user->getUsername(), 'User::getUsername() should return login');
        $this->assertEquals('', $user->getPassword(), 'User::getPassword() is empty string');
        /** @var UserProfile|\PHPUnit_Framework_MockObject_MockObject $userProfile */
        $userProfile = $this->createMock(UserProfile::class);
        $user->setProfile($userProfile);
        $this->assertInstanceOf(UserProfile::class, $user->getProfile());

        $this->assertTrue($user->isAccountNonExpired());
        $this->assertTrue($user->isAccountNonLocked());
        $this->assertTrue($user->isCredentialsNonExpired());
        $this->assertTrue($user->isEnabled());
        $this->assertNull($user->getSalt(), 'User::getSalt() should returns null');
        $user->eraseCredentials();

        $anotherName = 'anotherName';
        $user->setName($anotherName);
        $this->assertNotEquals(
            $name,
            $user->getName(),
            'User::setName should change user`s name and it should not be equals with old name'
        );
        $this->assertEquals($anotherName, $user->getName(), 'User::getName should return last set name');

        $newSid = 'new_sid';
        $user->setUserId($newSid);
        $this->assertEquals($newSid, $user->getUserId());
    }
}

