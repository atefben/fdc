<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldTransUnit
 *
 * @ORM\Table(name="old_trans_unit", indexes={@ORM\Index(name="trans_unit_FI_1", columns={"cat_id"})})
 * @ORM\Entity
 */
class OldTransUnit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="msg_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $msgId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=true)
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255, nullable=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="text", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="target", type="text", nullable=true)
     */
    private $target;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_added", type="integer", nullable=true)
     */
    private $dateAdded;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_modified", type="integer", nullable=true)
     */
    private $dateModified;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @var boolean
     *
     * @ORM\Column(name="translated", type="boolean", nullable=true)
     */
    private $translated;



    /**
     * Get msgId
     *
     * @return integer 
     */
    public function getMsgId()
    {
        return $this->msgId;
    }

    /**
     * Set catId
     *
     * @param integer $catId
     * @return OldTransUnit
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;

        return $this;
    }

    /**
     * Get catId
     *
     * @return integer 
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return OldTransUnit
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return OldTransUnit
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param string $target
     * @return OldTransUnit
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return OldTransUnit
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set dateAdded
     *
     * @param integer $dateAdded
     * @return OldTransUnit
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return integer 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set dateModified
     *
     * @param integer $dateModified
     * @return OldTransUnit
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return integer 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return OldTransUnit
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set translated
     *
     * @param boolean $translated
     * @return OldTransUnit
     */
    public function setTranslated($translated)
    {
        $this->translated = $translated;

        return $this;
    }

    /**
     * Get translated
     *
     * @return boolean 
     */
    public function getTranslated()
    {
        return $this->translated;
    }
}
