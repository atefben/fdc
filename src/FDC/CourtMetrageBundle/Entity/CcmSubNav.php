<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmSubNav
 *
 * @ORM\Table(name="ccm_sub_nav")
 * @ORM\Entity
 */
class CcmSubNav
{
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
     * @var
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var
     *
     * @ORM\Column(name="fo_translation_key", type="string", length=255, nullable=true)
     */
    private $foTranslationKey;

    /**
     * @var
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=true)
     */
    private $route;

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
        $this->subNavsCollection = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFoTranslationKey()
    {
        return $this->foTranslationKey;
    }

    /**
     * @param mixed $foTranslationKey
     */
    public function setFoTranslationKey($foTranslationKey)
    {
        $this->foTranslationKey = $foTranslationKey;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
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
