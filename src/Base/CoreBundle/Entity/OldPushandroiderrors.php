<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPushandroiderrors
 *
 * @ORM\Table(name="old_pushandroiderrors")
 * @ORM\Entity
 */
class OldPushandroiderrors
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
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(name="article_id", type="integer", nullable=true)
     */
    private $articleId;

    /**
     * @var string
     *
     * @ORM\Column(name="push_error", type="string", length=255, nullable=false)
     */
    private $pushError;

    /**
     * @var string
     *
     * @ORM\Column(name="obj", type="text", nullable=true)
     */
    private $obj;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;



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
     * @return OldPushandroiderrors
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
     * Set articleId
     *
     * @param integer $articleId
     * @return OldPushandroiderrors
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
     * @return OldPushandroiderrors
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
     * @return OldPushandroiderrors
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
     * @return OldPushandroiderrors
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
