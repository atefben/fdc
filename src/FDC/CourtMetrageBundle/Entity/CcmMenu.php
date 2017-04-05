<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

/**
 * CcmMenu
 * @ORM\Table(name="ccm_menu")
 * @ORM\Entity
 */
class CcmMenu
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMainNavCollection", mappedBy="menu", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $mainNavsCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->mainNavsCollection = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        $string = "Menu configuration";

        return $string;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmMainNavCollection $mainNavCollection
     * @return $this
     */
    public function addMainNavsCollection(\FDC\CourtMetrageBundle\Entity\CcmMainNavCollection $mainNavCollection)
    {
        $mainNavCollection->setMenu($this);
        $this->mainNavsCollection[] = $mainNavCollection;

        return $this;
    }

    /**
     * @param CcmMainNavCollection $mainNavCollection
     */
    public function removeMainNavsCollection(\FDC\CourtMetrageBundle\Entity\CcmMainNavCollection $mainNavCollection)
    {
        $this->mainNavsCollection->removeElement($mainNavCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getMainNavsCollection()
    {
        return $this->mainNavsCollection;
    }

    /**
     * Get translations.
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set translations.
     *
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
     */
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
