<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMosaique
 *
 * @ORM\Table(name="old_mosaique")
 * @ORM\Entity
 */
class OldMosaique
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
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=500, nullable=false)
     */
    protected $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_size", type="integer", nullable=false)
     */
    protected $imageSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_online", type="integer", nullable=true)
     */
    protected $isOnline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_date", type="datetime", nullable=true)
     */
    protected $publicationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    protected $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    protected $dateModification;



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
     * Set type
     *
     * @param integer $type
     * @return OldMosaique
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return OldMosaique
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set imageSize
     *
     * @param integer $imageSize
     * @return OldMosaique
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get imageSize
     *
     * @return integer 
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set isOnline
     *
     * @param integer $isOnline
     * @return OldMosaique
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline
     *
     * @return integer 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return OldMosaique
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return OldMosaique
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return OldMosaique
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }
}
