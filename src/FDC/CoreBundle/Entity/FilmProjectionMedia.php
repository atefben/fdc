<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmProjectionMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionMedia
{
    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var FilmProjetionMedia
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", cascade={"persist"})
     */
    private $film;
    
    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="medias", cascade={"persist"})
     */
    private $media;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

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
     * @param \FDC\CoreBundle\Entity\FilmRoom $room
     * @return FilmProjection
     */
    public function setRoom(\FDC\CoreBundle\Entity\FilmRoom $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \FDC\CoreBundle\Entity\FilmRoom 
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
}
