<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldUser
 *
 * @ORM\Table(name="old_user", indexes={@ORM\Index(name="username", columns={"username"}), @ORM\Index(name="password", columns={"password"}), @ORM\Index(name="receive_email_alerts", columns={"receive_email_alerts"})})
 * @ORM\Entity
 */
class OldUser
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
     * @ORM\Column(name="username", type="string", length=100, nullable=false)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation", type="string", length=250, nullable=true)
     */
    protected $organisation;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    protected $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="receive_email_alerts", type="integer", nullable=true)
     */
    protected $receiveEmailAlerts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="last_login_ip", type="string", length=15, nullable=true)
     */
    protected $lastLoginIp;



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
     * @return OldUser
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
     * Set organisation
     *
     * @param string $organisation
     * @return OldUser
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return string 
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return OldUser
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
     * Set name
     *
     * @param string $name
     * @return OldUser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return OldUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set receiveEmailAlerts
     *
     * @param integer $receiveEmailAlerts
     * @return OldUser
     */
    public function setReceiveEmailAlerts($receiveEmailAlerts)
    {
        $this->receiveEmailAlerts = $receiveEmailAlerts;

        return $this;
    }

    /**
     * Get receiveEmailAlerts
     *
     * @return integer 
     */
    public function getReceiveEmailAlerts()
    {
        return $this->receiveEmailAlerts;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return OldUser
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
     * Set lastLoginIp
     *
     * @param string $lastLoginIp
     * @return OldUser
     */
    public function setLastLoginIp($lastLoginIp)
    {
        $this->lastLoginIp = $lastLoginIp;

        return $this;
    }

    /**
     * Get lastLoginIp
     *
     * @return string 
     */
    public function getLastLoginIp()
    {
        return $this->lastLoginIp;
    }
}
