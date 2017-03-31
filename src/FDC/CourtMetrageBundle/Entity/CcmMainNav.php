<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmMainNav
 *
 * @ORM\Table(name="ccm_main_nav")
 * @ORM\Entity
 */
class CcmMainNav
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
     */
    protected $translations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmSubNavCollection", mappedBy="mainNav", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $subNavsCollection;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMainNavCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="mainNav")
     */
    private $mainNavsCollection;

    /**
     * @var
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = true;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->mainNavsCollection = new ArrayCollection();
        $this->subNavsCollection = new ArrayCollection();
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
    

    /**
     * @return int
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
        $mainNavCollection->setMainNav($this);
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
     * @param CcmSubNavCollection $subNavCollection
     * @return $this
     */
    public function addSubNavsCollection(\FDC\CourtMetrageBundle\Entity\CcmSubNavCollection $subNavCollection)
    {
        $subNavCollection->setMainNav($this);
        $this->subNavsCollection[] = $subNavCollection;

        return $this;
    }

    /**
     * @param CcmSubNavCollection $subNavCollection
     */
    public function removeSubNavsCollection(\FDC\CourtMetrageBundle\Entity\CcmSubNavCollection $subNavCollection)
    {
        $this->subNavsCollection->removeElement($subNavCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getSubNavsCollection()
    {
        return $this->subNavsCollection;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
}

