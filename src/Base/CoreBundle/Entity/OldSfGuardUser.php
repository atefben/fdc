<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSfGuardUser
 *
 * @ORM\Table(name="old_sf_guard_user", indexes={@ORM\Index(name="username_unique", columns={"username"}), @ORM\Index(name="is_active", columns={"is_active"}), @ORM\Index(name="is_super_admin", columns={"is_super_admin"})})
 * @ORM\Entity
 */
class OldSfGuardUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=128, nullable=false)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="algorithm", type="string", length=128, nullable=false)
     */
    protected $algorithm;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=128, nullable=false)
     */
    protected $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false)
     */
    protected $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_active", type="integer", nullable=false)
     */
    protected $isActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_super_admin", type="integer", nullable=false)
     */
    protected $isSuperAdmin;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return OldSfGuardUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set algorithm
     *
     * @param string $algorithm
     * @return OldSfGuardUser
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    /**
     * Get algorithm
     *
     * @return string 
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return OldSfGuardUser
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return OldSfGuardUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldSfGuardUser
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

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return OldSfGuardUser
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set isActive
     *
     * @param integer $isActive
     * @return OldSfGuardUser
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isSuperAdmin
     *
     * @param integer $isSuperAdmin
     * @return OldSfGuardUser
     */
    public function setIsSuperAdmin($isSuperAdmin)
    {
        $this->isSuperAdmin = $isSuperAdmin;

        return $this;
    }

    /**
     * Get isSuperAdmin
     *
     * @return integer 
     */
    public function getIsSuperAdmin()
    {
        return $this->isSuperAdmin;
    }
}
