<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAtelierDirector
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierDirector
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
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="countryFilmAteliers")
     */
    private $person;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="countries")
     */
    private $film;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $position;

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
     * Set position
     *
     * @param integer $position
     * @return FilmAtelierCountry
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
     * Set country
     *
     * @param \FDC\CoreBundle\Entity\Country $country
     * @return FilmAtelierCountry
     */
    public function setCountry(\FDC\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \FDC\CoreBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelier $film
     * @return FilmAtelierCountry
     */
    public function setFilm(\FDC\CoreBundle\Entity\FilmAtelier $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \FDC\CoreBundle\Entity\FilmAtelier 
     */
    public function getFilm()
    {
        return $this->film;
    }
}
