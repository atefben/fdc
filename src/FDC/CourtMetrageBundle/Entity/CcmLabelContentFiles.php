<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelContentFiles
 * @ORM\Table(name="ccm_label_content_files")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmLabelContentFiles implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidgetCollection", mappedBy="labelContentFiles", cascade={"persist", "remove"}, orphanRemoval=true)
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
        $this->labelContentFileWidgetCollection = new ArrayCollection();
    }

    /**
     * @param CcmLabelContentFilesWidgetCollection $collection
     *
     * @return $this
     */
    public function addLabelContentFileWidgetCollection(CcmLabelContentFilesWidgetCollection $collection)
    {
        $collection->setLabelContentFiles($this);
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

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getBoName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getBoName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getBoName();
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
