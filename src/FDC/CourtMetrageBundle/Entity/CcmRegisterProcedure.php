<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaPdf;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmRegisterProcedure
 * @ORM\Table(name="ccm_register_procedure")
 * @ORM\Entity
 */
class CcmRegisterProcedure
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
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     *
     */
    protected $registerFormBackground;

    /**
     * @var MediaPdf
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf")
     */
    protected $regulationDetailsFile;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmRegisterProcedure constructor.
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
     * @return MediaPdf
     */
    public function getRegulationDetailsFile()
    {
        return $this->regulationDetailsFile;
    }

    /**
     * @param $regulationDetailsFile
     *
     * @return $this
     */
    public function setRegulationDetailsFile($regulationDetailsFile)
    {
        $this->regulationDetailsFile = $regulationDetailsFile;

        return $this;
    }

    /**
     * @return MediaImage
     */
    public function getRegisterFormBackground()
    {
        return $this->registerFormBackground;
    }

    /**
     * @param $registerFormBackground
     *
     * @return $this
     */
    public function setRegisterFormBackground($registerFormBackground)
    {
        $this->registerFormBackground = $registerFormBackground;

        return $this;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
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
