<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldEncart
 *
 * @ORM\Table(name="old_encart", indexes={@ORM\Index(name="encart_FI_1", columns={"mosaique_id"})})
 * @ORM\Entity
 */
class OldEncart
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
     * @ORM\Column(name="mosaique_id", type="integer", nullable=true)
     */
    private $mosaiqueId;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_size", type="integer", nullable=false)
     */
    private $imageSize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modified", type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mosaique_picto", type="boolean", nullable=true)
     */
    private $mosaiquePicto;



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
     * Set mosaiqueId
     *
     * @param integer $mosaiqueId
     * @return OldEncart
     */
    public function setMosaiqueId($mosaiqueId)
    {
        $this->mosaiqueId = $mosaiqueId;

        return $this;
    }

    /**
     * Get mosaiqueId
     *
     * @return integer 
     */
    public function getMosaiqueId()
    {
        return $this->mosaiqueId;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return OldEncart
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return OldEncart
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set imageSize
     *
     * @param integer $imageSize
     * @return OldEncart
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return OldEncart
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return OldEncart
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set mosaiquePicto
     *
     * @param boolean $mosaiquePicto
     * @return OldEncart
     */
    public function setMosaiquePicto($mosaiquePicto)
    {
        $this->mosaiquePicto = $mosaiquePicto;

        return $this;
    }

    /**
     * Get mosaiquePicto
     *
     * @return boolean 
     */
    public function getMosaiquePicto()
    {
        return $this->mosaiquePicto;
    }
}
