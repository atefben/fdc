<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmProjection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjection
{
    use Time;
    use Soif;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startsAt;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endsAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $type;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     */
    private $film;

    /**
     * @var FilmRoom
     *
     * @ORM\ManyToOne(targetEntity="FilmProjectionRoom", inversedBy="projections", cascade={"persist"})
     */
    private $room;

    /**
     * @var FilmProjectionMedia
     *
     * @ORM\OneToMany(targetEntity="FilmProjectionMedia", mappedBy="media")
     */
    private $medias;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmFilm", mappedBy="projections")
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
     * Set startsAt
     *
     * @param \DateTime $startsAt
     * @return FilmProjection
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
     * @return FilmProjection
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
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmProjection
     */
    public function setFestival(\FDC\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \FDC\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmProjection
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
     * Set room
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionRoom $room
     * @return FilmProjection
     */
    public function setRoom(\FDC\CoreBundle\Entity\FilmProjectionRoom $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \FDC\CoreBundle\Entity\FilmProjectionRoom 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Add films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     * @return FilmProjection
     */
    public function addFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
    {
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

    /**
     * Set type
     *
     * @param string $type
     * @return FilmProjection
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
     * Set id
     *
     * @param integer $id
     * @return FilmProjection
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionMedia $medias
     * @return FilmProjection
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmProjectionMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmProjectionMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
