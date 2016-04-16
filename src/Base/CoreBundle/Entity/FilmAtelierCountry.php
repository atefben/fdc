<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FilmAtelierCountry
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierCountry
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
    private $country;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="countries")
     */
    private $film;

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
     * Set country
     *
     * @param \Base\CoreBundle\Entity\Country $country
     * @return FilmAtelierCountry
     */
    public function setCountry(\Base\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Base\CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmAtelier $film
     * @return FilmAtelierCountry
     */
    public function setFilm(\Base\CoreBundle\Entity\FilmAtelier $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Base\CoreBundle\Entity\FilmAtelier
     */
    public function getFilm()
    {
        return $this->film;
    }
}
