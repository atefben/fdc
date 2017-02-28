<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSection
 * @ORM\Table(name="ccm_label_section")
 * @ORM\Entity
 */
class CcmLabelSection
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
     * @var CcmLabelSectionContent
     *
     * @ORM\OneToMany(targetEntity="CcmLabelSectionContent", mappedBy="labelSection", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $labelSectionContent;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmLabelSection constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->labelSectionContent = new ArrayCollection();
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
     * @param CcmLabelSectionContent $content
     */
    public function addLabelSectionContent(CcmLabelSectionContent $content)
    {
        $content->setLabelSection($this);
        $this->labelSectionContent->add($content);
    }

    /**
     * @param CcmLabelSectionContent $content
     */
    public function removeLabelSectionContent(CcmLabelSectionContent $content)
    {
        $this->labelSectionContent->removeElement($content);
    }

    /**
     * @return ArrayCollection|CcmLabelSectionContent
     */
    public function getLabelSectionContent()
    {
        return $this->labelSectionContent;
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
