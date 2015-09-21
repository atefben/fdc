<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmProjectionRoom
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionRoom
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmProjection", mappedBy="room")
     */
    private $projections;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projections = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmRoom
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
     * Set name
     *
     * @param string $name
     * @return FilmRoom
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add projections
     *
     * @param \FDC\CoreBundle\Entity\FilmProjection $projections
     * @return FilmRoom
     */
    public function addProjection(\FDC\CoreBundle\Entity\FilmProjection $projections)
    {
        if ($this->projections->contains($projections)) {
            return;
        }

        $this->projections[] = $projections;

        return $this;
    }

    /**
     * Remove projections
     *
     * @param \FDC\CoreBundle\Entity\FilmProjection $projections
     */
    public function removeProjection(\FDC\CoreBundle\Entity\FilmProjection $projections)
    {
        if (!$this->projections->contains($projections)) {
            return;
        }
        
        $this->projections->removeElement($projections);
    }

    /**
     * Get projections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjections()
    {
        return $this->projections;
    }
}
