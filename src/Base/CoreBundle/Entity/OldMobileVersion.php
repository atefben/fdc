<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMobileVersion
 *
 * @ORM\Table(name="old_mobile_version")
 * @ORM\Entity
 */
class OldMobileVersion
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_reset", type="datetime", nullable=true)
     */
    private $dateReset;

    /**
     * @var integer
     *
     * @ORM\Column(name="platform", type="integer", nullable=true)
     */
    private $platform;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reset_device", type="boolean", nullable=true)
     */
    private $resetDevice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    private $dateModification;



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
     * Set dateReset
     *
     * @param \DateTime $dateReset
     * @return OldMobileVersion
     */
    public function setDateReset($dateReset)
    {
        $this->dateReset = $dateReset;

        return $this;
    }

    /**
     * Get dateReset
     *
     * @return \DateTime 
     */
    public function getDateReset()
    {
        return $this->dateReset;
    }

    /**
     * Set platform
     *
     * @param integer $platform
     * @return OldMobileVersion
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return integer 
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set resetDevice
     *
     * @param boolean $resetDevice
     * @return OldMobileVersion
     */
    public function setResetDevice($resetDevice)
    {
        $this->resetDevice = $resetDevice;

        return $this;
    }

    /**
     * Get resetDevice
     *
     * @return boolean 
     */
    public function getResetDevice()
    {
        return $this->resetDevice;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return OldMobileVersion
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
     * @return OldMobileVersion
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
