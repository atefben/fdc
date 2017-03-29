<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     *
     */
    protected $headerPhoto;

    /**
     * @ORM\OneToMany(targetEntity="CcmFilmRegisterProcedure", mappedBy="filmRegister", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $filmRegisterProcedure;

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
        $this->filmRegisterProcedure = new ArrayCollection();
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
     * @return CcmMediaImage
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

    /**
     * @return mixed
     */
    public function getFilmRegisterProcedure()
    {
        return $this->filmRegisterProcedure;
    }

    /**
     * @param CcmFilmRegisterProcedure $filmRegisterProcedure
     *
     * @return $this
     */
    public function addFilmRegisterProcedure(CcmFilmRegisterProcedure $filmRegisterProcedure)
    {
        if (!$this->filmRegisterProcedure->contains($filmRegisterProcedure)) {
            $this->filmRegisterProcedure->add($filmRegisterProcedure);
            $filmRegisterProcedure->setFilmRegister($this);
        }

        return $this;
    }

    /**
     * @param CcmFilmRegisterProcedure $filmRegisterProcedure
     *
     * @return $this
     */
    public function removeFilmRegisterProcedure(CcmFilmRegisterProcedure $filmRegisterProcedure)
    {
        if ($this->filmRegisterProcedure->contains($filmRegisterProcedure)) {
            $this->filmRegisterProcedure->removeElement($filmRegisterProcedure);
        }

        return $this;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }
}
