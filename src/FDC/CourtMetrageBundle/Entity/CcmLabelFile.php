<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelFile
 * @ORM\Table(name="ccm_label_file")
 * @ORM\Entity
 */
class CcmLabelFile
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
     * @var
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelFileCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="labelFile")
     */
    protected $labelFileCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmLabelFile constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->labelFileCollection = new ArrayCollection();
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
        $collection->setLabelFile($this);
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
            $string = $translation->getFileTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getFileTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getFileTitle();
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
