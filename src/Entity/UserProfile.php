<?php

namespace GepurIt\User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserProfile
 * @ORM\Entity(repositoryClass="GepurIt\User\Repository\UserProfileRepository")
 * @ORM\Table(
 *     name="user_profile",
 *     options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
 * )
 */
class UserProfile
{
    const REGARDS_DEFAULT = 'С уважением, ';

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="manager_id", type="string", length=80, nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $managerId;

    /**
     * @var string
     * @ORM\Column(name="manager_sign", type="string", length=255, nullable=false)
     */
    private $managerSign = '';

    /**
     * @var string
     * @ORM\Column(name="manager_name", type="string", length=255, nullable=false)
     */
    private $managerName = '';

    /**
     * @return string
     */
    public function getManagerId(): string
    {
        return $this->managerId;
    }

    /**
     * @param string $managerId
     */
    public function setManagerId(string $managerId)
    {
        $this->managerId = $managerId;
    }

    /**
     * @return string
     */
    public function getManagerSign(): string
    {
        return $this->managerSign;
    }

    /**
     * @param string $managerSign
     */
    public function setManagerSign(string $managerSign)
    {
        $this->managerSign = $managerSign;
    }

    /**
     * @return string
     */
    public function getManagerName(): string
    {
        return $this->managerName;
    }

    /**
     * @param string $managerName
     */
    public function setManagerName(string $managerName)
    {
        $this->managerName = $managerName;
    }
}