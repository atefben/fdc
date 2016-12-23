<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPusherrors
 *
 * @ORM\Table(name="old_pusherrors")
 * @ORM\Entity
 */
class OldPusherrors
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
     * @ORM\Column(name="udid", type="string", length=255, nullable=false)
     */
    protected $udid;

    /**
     * @var integer
     *
     * @ORM\Column(name="article_id", type="integer", nullable=true)
     */
    protected $articleId;

    /**
     * @var string
     *
     * @ORM\Column(name="push_error", type="string", length=255, nullable=false)
     */
    protected $pushError;

    /**
     * @var string
     *
     * @ORM\Column(name="obj", type="text", nullable=true)
     */
    protected $obj;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;



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
     * Set udid
     *
     * @param string $udid
     * @return OldPusherrors
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
     * Set articleId
     *
     * @param integer $articleId
     * @return OldPusherrors
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * Get articleId
     *
     * @return integer 
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * Set pushError
     *
     * @param string $pushError
     * @return OldPusherrors
     */
    public function setPushError($pushError)
    {
        $this->pushError = $pushError;

        return $this;
    }

    /**
     * Get pushError
     *
     * @return string 
     */
    public function getPushError()
    {
        return $this->pushError;
    }

    /**
     * Set obj
     *
     * @param string $obj
     * @return OldPusherrors
     */
    public function setObj($obj)
    {
        $this->obj = $obj;

        return $this;
    }

    /**
     * Get obj
     *
     * @return string 
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldPusherrors
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
