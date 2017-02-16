<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Entity\MediaImage;

/**
 * CcmFilmRegister
 * @ORM\Table(name="ccm_film_register")
 * @ORM\Entity
 */
class CcmFilmRegister
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isTextActive = false;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     *
     */
    protected $headerPhoto;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * MdfConferencePartnerLogo constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isIsTextActive()
    {
        return $this->isTextActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsTextActive($isActive)
    {
        $this->isTextActive = $isActive;

        return $this;
    }

    /**
     * @return MediaImage
     */
    public function getHeaderPhoto()
    {
        return $this->headerPhoto;
    }

    /**
     * @param $headerPhoto
     *
     * @return $this
     */
    public function setHeaderPhoto($headerPhoto)
    {
        $this->headerPhoto = $headerPhoto;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }
}
