<?php

namespace FDC\CorporateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CorpoMediaLibraryItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FDC\CorporateBundle\Repository\CorpoMediaLibraryItemRepository")
 */
class CorpoMediaLibraryItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="entity_class", type="string", length=255, nullable=true)
     */
    private $entityClass;

    /**
     * @var string
     * @ORM\Column(name="entity_id", type="string", length=255, nullable=true)
     */
    private $entityId;

    /**
     * @var \DateTime
     * @ORM\Column(name="sorted_at", type="datetime", nullable=true)
     */
    private $sortedAt;

    /**
     * @var string
     * @ORM\Column(name="festival_year", type="string", nullable=true)
     */
    private $festivalYear;

    /**
     * @var string
     * @ORM\Column(name="locale", type="string", nullable=true)
     */
    private $locale;

    /**
     * @var string
     * @ORM\Column(name="search", type="text", nullable=true)
     */
    private $search;

    /**
     * @var int
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    private $weight = 0;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set entityClass
     *
     * @param string $entityClass
     * @return $this
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    /**
     * Get entityClass
     *
     * @return string 
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Set entityId
     *
     * @param string $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return string 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set sorted
     *
     * @param \DateTime $sortedAt
     * @return $this
     */
    public function setSorted($sortedAt)
    {
        $this->sortedAt = $sortedAt;

        return $this;
    }

    /**
     * Get sorted
     *
     * @return \DateTime 
     */
    public function getSortedAt()
    {
        return $this->sortedAt;
    }

    /**
     * Set sortedAt
     *
     * @param \DateTime $sortedAt
     * @return $this
     */
    public function setSortedAt($sortedAt)
    {
        $this->sortedAt = $sortedAt;

        return $this;
    }

    /**
     * Set festivalYear
     *
     * @param string $festivalYear
     * @return $this
     */
    public function setFestivalYear($festivalYear)
    {
        $this->festivalYear = $festivalYear;

        return $this;
    }

    /**
     * Get festivalYear
     *
     * @return string 
     */
    public function getFestivalYear()
    {
        return $this->festivalYear;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return CorpoMediaLibraryItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return CorpoMediaLibraryItem
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set search
     *
     * @param string $search
     * @return CorpoMediaLibraryItem
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return string 
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return CorpoMediaLibraryItem
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
