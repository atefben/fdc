<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmProjectionProgrammationFilmList
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionProgrammationFilmList
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var FilmProjectionProgrammationType
     *
     * @ORM\ManyToOne(targetEntity="FilmProjectionProgrammationType", cascade={"persist"})
     */
    private $type;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="programmationFilmsList")
     */
    private $projection;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToMany(targetEntity="FilmFilm")
     */
    private $films;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationType $type
     * @return FilmProjectionProgrammationFilmList
     */
    public function setType(\FDC\CoreBundle\Entity\FilmProjectionProgrammationType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \FDC\CoreBundle\Entity\FilmProjectionProgrammationType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set projection
     *
     * @param \FDC\CoreBundle\Entity\FilmProjection $projection
     * @return FilmProjectionProgrammationFilmList
     */
    public function setProjection(\FDC\CoreBundle\Entity\FilmProjection $projection = null)
    {
        $this->projection = $projection;

        return $this;
    }

    /**
     * Get projection
     *
     * @return \FDC\CoreBundle\Entity\FilmProjection 
     */
    public function getProjection()
    {
        return $this->projection;
    }

    /**
     * Add films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     * @return FilmProjectionProgrammationFilmList
     */
    public function addFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
    {
        if ($this->films->contains($films)) {
            return;
        }
        
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
    {
        if (!$this->films->contains($films)) {
            return;
        }
        
        $this->films->removeElement($films);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilms()
    {
        return $this->films;
    }
}
