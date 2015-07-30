<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CinefSession
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class CinefSession
{
    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endsAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $season;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $number;
    
    /**
     * @ORM\OneToMany(targetEntity="CinefPerson", mappedBy="session")
     */
    private $cinefPersons;

    /**
     *  @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     *  @ORM\PreUpdate
     */
    public function SetModifiedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return CinefSession
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return CinefSession
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set startsAt
     *
     * @param \DateTime $startsAt
     * @return CinefSession
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * Get startsAt
     *
     * @return \DateTime 
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * Set endsAt
     *
     * @param \DateTime $endsAt
     * @return CinefSession
     */
    public function setEndsAt($endsAt)
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * Get endsAt
     *
     * @return \DateTime 
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * Set season
     *
     * @param string $season
     * @return CinefSession
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return string 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return CinefSession
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Add cinefPersons
     *
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPersons
     * @return CinefSession
     */
    public function addCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPersons)
    {
        $this->cinefPersons[] = $cinefPersons;

        return $this;
    }

    /**
     * Remove cinefPersons
     *
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPersons
     */
    public function removeCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPersons)
    {
        $this->cinefPersons->removeElement($cinefPersons);
    }

    /**
     * Get cinefPersons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCinefPersons()
    {
        return $this->cinefPersons;
    }
}
