<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSfGuardRememberKey
 *
 * @ORM\Table(name="old_sf_guard_remember_key")
 * @ORM\Entity
 */
class OldSfGuardRememberKey
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=15, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="remember_key", type="string", length=32, nullable=true)
     */
    protected $rememberKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;



    /**
     * Set userId
     *
     * @param integer $userId
     * @return OldSfGuardRememberKey
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return OldSfGuardRememberKey
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set rememberKey
     *
     * @param string $rememberKey
     * @return OldSfGuardRememberKey
     */
    public function setRememberKey($rememberKey)
    {
        $this->rememberKey = $rememberKey;

        return $this;
    }

    /**
     * Get rememberKey
     *
     * @return string 
     */
    public function getRememberKey()
    {
        return $this->rememberKey;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldSfGuardRememberKey
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
