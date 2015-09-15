<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmProjectionProgrammationFilm
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="type_film_projection_uniqueness", columns={"type_id", "film_id", "projection_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"type", "film", "projection"})
 */
class FilmProjectionProgrammationFilm
{   
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
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", cascade={"persist"})
     */
    private $film;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="programmationFilms")
     * @ORM\JoinColumn(name="projection_id", onDelete="CASCADE")
     */
    private $projection;

    /**
     * Set type
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationType $type
     * @return FilmProjectionProgrammationFilm
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
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmProjectionProgrammationFilm
     */
    public function setFilm(\FDC\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \FDC\CoreBundle\Entity\FilmFilm 
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set projection
     *
     * @param \FDC\CoreBundle\Entity\FilmProjection $projection
     * @return FilmProjectionProgrammationFilm
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
