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
     * @var boolean
     *
     * @ORM\Column(name="program_pic_is_active", type="boolean", nullable=true)
     */
    private $programPicIsActive = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="catalog_pic_is_active", type="boolean", nullable=true)
     */
    private $catalogPicIsActive = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="register_pic_is_active", type="boolean", nullable=true)
     */
    private $registerPicIsActive = true;

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
     * @return boolean
     */
    public function isProgramPicIsActive()
    {
        return $this->programPicIsActive;
    }

    /**
     * @param boolean $programPicIsActive
     */
    public function setProgramPicIsActive($programPicIsActive)
    {
        $this->programPicIsActive = $programPicIsActive;
    }

    /**
     * @return boolean
     */
    public function isCatalogPicIsActive()
    {
        return $this->catalogPicIsActive;
    }

    /**
     * @param boolean $catalogPicIsActive
     */
    public function setCatalogPicIsActive($catalogPicIsActive)
    {
        $this->catalogPicIsActive = $catalogPicIsActive;
    }

    /**
     * @return boolean
     */
    public function isRegisterPicIsActive()
    {
        return $this->registerPicIsActive;
    }

    /**
     * @param boolean $registerPicIsActive
     */
    public function setRegisterPicIsActive($registerPicIsActive)
    {
        $this->registerPicIsActive = $registerPicIsActive;
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
