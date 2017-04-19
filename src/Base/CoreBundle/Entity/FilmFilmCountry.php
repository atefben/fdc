<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmFilmCountry
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFilmCountry
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "trailer_list",
     *     "trailer_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "programmation",
     *     "projection_show",
     *     "news_show",
     *     "search"
     * })
     */
    protected $position;
    
    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="countryFilms")
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "trailer_list",
     *     "trailer_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list", "programmation",
     *     "projection_show",
     *     "news_show",
     *     "search"
     * })
     */
    protected $country;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="countries")
     */
    protected $film;

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
     * @return FilmCountry
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
     * @param \Base\CoreBundle\Entity\Country $country
     * @return FilmCountry
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
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return FilmCountry
     */
    public function setFilm(\Base\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Base\CoreBundle\Entity\FilmFilm
     */
    public function getFilm()
    {
        return $this->film;
    }
}
