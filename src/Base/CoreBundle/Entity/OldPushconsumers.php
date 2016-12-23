<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPushconsumers
 *
 * @ORM\Table(name="old_pushconsumers", uniqueConstraints={@ORM\UniqueConstraint(name="pushconsumers_U_1", columns={"token"})})
 * @ORM\Entity
 */
class OldPushconsumers
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
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    protected $token;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=2, nullable=false)
     */
    protected $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="udid", type="string", length=255, nullable=true)
     */
    protected $udid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;



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
     * Set token
     *
     * @param string $token
     * @return OldPushconsumers
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return OldPushconsumers
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set udid
     *
     * @param string $udid
     * @return OldPushconsumers
     */
    public function setUdid($udid)
    {
        $this->udid = $udid;

        return $this;
    }

    /**
     * Get udid
     *
     * @return string 
     */
    public function getUdid()
    {
        return $this->udid;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldPushconsumers
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return OldPushconsumers
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
