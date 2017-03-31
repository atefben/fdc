<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelContentFilesWidget
 * @ORM\Table(name="ccm_label_content_files_widget")
 * @ORM\Entity
 */
class CcmLabelContentFilesWidget
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelFileCollection", mappedBy="contentFilesWidget", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $labelFileCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidgetCollection", mappedBy="labelContentFileWidget", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $labelContentFileWidgetCollection;

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
        $this->labelFileCollection = new ArrayCollection();
        $this->labelContentFileWidgetCollection = new ArrayCollection();
    }

    /**
     * @param CcmLabelContentFilesWidgetCollection $collection
     *
     * @return $this
     */
    public function addLabelContentFileWidgetCollection(CcmLabelContentFilesWidgetCollection $collection)
    {
        $collection->setLabelContentFileWidget($this);
        $this->labelContentFileWidgetCollection[] = $collection;

        return $this;
    }

    /**
     * @param CcmLabelContentFilesWidgetCollection $collection
     */
    public function removeLabelContentFileWidgetCollection(CcmLabelContentFilesWidgetCollection $collection)
    {
        $this->labelContentFileWidgetCollection->removeElement($collection);
    }

    /**
     * @return ArrayCollection
     */
    public function getLabelContentFileWidgetCollection()
    {
        return $this->labelContentFileWidgetCollection;
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
     * @param CcmLabelFileCollection $collection
     *
     * @return $this
     */
    public function addLabelFileCollection(CcmLabelFileCollection $collection)
    {
        $collection->setContentFilesWidget($this);
        $this->labelFileCollection[] = $collection;

        return $this;
    }

    /**
     * @param CcmLabelFileCollection $collection
     */
    public function removeLabelFileCollection(CcmLabelFileCollection $collection)
    {
        $this->labelFileCollection->removeElement($collection);
    }

    /**
     * @return ArrayCollection
     */
    public function getLabelFileCollection()
    {
        return $this->labelFileCollection;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getButtonsSectionTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getButtonsSectionTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getButtonsSectionTitle();
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
