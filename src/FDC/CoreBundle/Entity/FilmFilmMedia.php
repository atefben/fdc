<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmFilmMedia
 *
 * @ORM\Table(
    uniqueConstraints = {@ORM\UniqueConstraint(name="film_film_media", columns={"film_id", "media_id"})}
  )
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity({"film", "media"})
 */
class FilmFilmMedia implements FilmFilmMediaInterface
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="medias", cascade={"persist"})
     */
    private $film;
    
    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmMedia", inversedBy="medias", cascade={"persist"})
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
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FilmFilmMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return FilmFilmMedia
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return FilmFilmMedia
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmFilmMedia
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
     * Set media
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $media
     * @return FilmFilmMedia
     */
    public function setMedia(\FDC\CoreBundle\Entity\FilmMedia $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \FDC\CoreBundle\Entity\FilmMedia 
     */
    public function getMedia()
    {
        return $this->media;
    }
}
