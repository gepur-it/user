<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since : 25.09.17
 */

namespace GepurIt\User\Security;

use GepurIt\User\Entity\UserProfile;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package LdapBundle\Security
 */
class User implements UserInterface
{
    /** @var  string */
    private $userId;

    /** @var string */
    private $name;

    /** @var  array */
    private $roles;

    /** @var  string */
    private $login;

    /** @var string */
    private $objectGUID = '';

    /** @var array */
    private $params = [];

    /**
     * @var UserProfile
     */
    private $profile;

    /**
     * User constructor.
     *
     * @param string $login
     * @param string $ldapSid
     * @param string $name
     * @param array  $roles
     */
    public function __construct(string $login, string $ldapSid, string $name, array $roles)
    {
        $this->login  = $login;
        $this->userId = $ldapSid;
        $this->name   = $name;
        $this->roles  = $roles;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getLogin();
    }

    /**
     * Manager_Login
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getLogin();
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @deprecated use getUserId instead
     * @see        getUserId
     * @return string
     */
    public function getLdapSid(): string
    {
        return $this->getUserId();
    }

    /**
     * @deprecated use setUserId instead
     * @see        setUserId
     *
     * @param string $userId
     */
    public function setLdapSid(string $userId)
    {
        $this->setUserId($userId);
    }

    /**
     * ManagerFirstName and ManagerSecondName
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     * @return string The password
     */
    public function getPassword()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     *
     * @return string The username
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return UserProfile|null
     */
    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }

    /**
     * @param UserProfile $profile
     */
    public function setProfile(UserProfile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return string
     */
    public function getObjectGUID(): string
    {
        return $this->objectGUID;
    }

    /**
     * @param string $guid
     */
    public function setObjectGUID(string $guid)
    {
        $this->objectGUID = $guid;
    }

    /**
     * @param string $name
     * @param        $value
     */
    public function setParam(string $name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasParam(string $name)
    {
        return array_key_exists($name, $this->params);
    }

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed|null
     */
    public function getParam(string $name, $default = null)
    {
        if (!$this->hasParam($name)) {
            return $default;
        }

        return $this->params[$name];
    }

    /**
     * @return array
     */
    public function getAllParams(): array
    {
        return $this->params;
    }

    /**
     *
     */
    public function cleanParams()
    {
        $this->params = [];
    }
}
