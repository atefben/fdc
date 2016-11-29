<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldContentLock
 *
 * @ORM\Table(name="old_content_lock")
 * @ORM\Entity
 */
class OldContentLock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="content_id", type="integer", nullable=true)
     */
    private $contentId;

    /**
     * @var string
     *
     * @ORM\Column(name="content_type", type="string", length=100, nullable=true)
     */
    private $contentType;

    /**
     * @var string
     *
     * @ORM\Column(name="lock_type", type="string", length=7, nullable=true)
     */
    private $lockType;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="expires", type="bigint", nullable=false)
     */
    private $expires;



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
     * Set contentId
     *
     * @param integer $contentId
     * @return OldContentLock
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;

        return $this;
    }

    /**
     * Get contentId
     *
     * @return integer 
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * Set contentType
     *
     * @param string $contentType
     * @return OldContentLock
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return string 
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set lockType
     *
     * @param string $lockType
     * @return OldContentLock
     */
    public function setLockType($lockType)
    {
        $this->lockType = $lockType;

        return $this;
    }

    /**
     * Get lockType
     *
     * @return string 
     */
    public function getLockType()
    {
        return $this->lockType;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return OldContentLock
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldContentLock
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
     * Set expires
     *
     * @param integer $expires
     * @return OldContentLock
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer 
     */
    public function getExpires()
    {
        return $this->expires;
    }
}
