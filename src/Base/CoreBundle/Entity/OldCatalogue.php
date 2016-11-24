<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCatalogue
 *
 * @ORM\Table(name="old_catalogue")
 * @ORM\Entity
 */
class OldCatalogue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="source_lang", type="string", length=100, nullable=true)
     */
    private $sourceLang;

    /**
     * @var string
     *
     * @ORM\Column(name="target_lang", type="string", length=100, nullable=true)
     */
    private $targetLang;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_created", type="integer", nullable=true)
     */
    private $dateCreated;

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
     * Get catId
     *
     * @return integer 
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return OldCatalogue
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
     * Set sourceLang
     *
     * @param string $sourceLang
     * @return OldCatalogue
     */
    public function setSourceLang($sourceLang)
    {
        $this->sourceLang = $sourceLang;

        return $this;
    }

    /**
     * Get sourceLang
     *
     * @return string 
     */
    public function getSourceLang()
    {
        return $this->sourceLang;
    }

    /**
     * Set targetLang
     *
     * @param string $targetLang
     * @return OldCatalogue
     */
    public function setTargetLang($targetLang)
    {
        $this->targetLang = $targetLang;

        return $this;
    }

    /**
     * Get targetLang
     *
     * @return string 
     */
    public function getTargetLang()
    {
        return $this->targetLang;
    }

    /**
     * Set dateCreated
     *
     * @param integer $dateCreated
     * @return OldCatalogue
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return integer 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateModified
     *
     * @param integer $dateModified
     * @return OldCatalogue
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
     * @return OldCatalogue
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
}
