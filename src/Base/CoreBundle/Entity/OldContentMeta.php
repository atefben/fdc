<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldContentMeta
 *
 * @ORM\Table(name="old_content_meta")
 * @ORM\Entity
 */
class OldContentMeta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content_type", type="string", length=100, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $contentType;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_translated", type="integer", nullable=false)
     */
    private $countTranslated;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldContentMeta
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set contentType
     *
     * @param string $contentType
     * @return OldContentMeta
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
     * Set countTranslated
     *
     * @param integer $countTranslated
     * @return OldContentMeta
     */
    public function setCountTranslated($countTranslated)
    {
        $this->countTranslated = $countTranslated;

        return $this;
    }

    /**
     * Get countTranslated
     *
     * @return integer 
     */
    public function getCountTranslated()
    {
        return $this->countTranslated;
    }
}
