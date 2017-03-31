<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabel
 * @ORM\Table(name="ccm_label")
 * @ORM\Entity
 */
class CcmLabel
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
     * @ORM\OneToMany(targetEntity="CcmLabelSectionPosition", mappedBy="label", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $labelSection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmLabel constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->labelSection = new ArrayCollection();
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
     * @return mixed
     */
    public function getLabelSection()
    {
        return $this->labelSection;
    }

    /**
     * @param CcmLabelSectionPosition $labelSection
     *
     * @return $this
     */
    public function addLabelSection(CcmLabelSectionPosition $labelSection)
    {
        if (!$this->labelSection->contains($labelSection)) {
            $this->labelSection->add($labelSection);
            $labelSection->setLabel($this);
        }

        return $this;
    }

    /**
     * @param CcmLabelSectionPosition $labelSection
     *
     * @return $this
     */
    public function removeLabelSection(CcmLabelSectionPosition $labelSection)
    {
        if ($this->labelSection->contains($labelSection)) {
            $this->labelSection->removeElement($labelSection);
        }

        return $this;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getHeader();
            if (strlen($string) > 14) {
                $string = substr($string, 0, 14) . '...';
            }
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getHeader()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getHeader();
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
