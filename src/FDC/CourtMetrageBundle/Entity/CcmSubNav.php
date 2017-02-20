<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmSubNav
 *
 * @ORM\Table(name="ccm_sub_nav")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmSubNav
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = true;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmSubNavCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="subNav")
     */
    protected $subNavsCollection;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * @param CcmSubNavCollection $subNavCollection
     * @return $this
     */
    public function addSubNavsCollection(\FDC\CourtMetrageBundle\Entity\CcmSubNavCollection $subNavCollection)
    {
        $subNavCollection->setSubNav($this);
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
