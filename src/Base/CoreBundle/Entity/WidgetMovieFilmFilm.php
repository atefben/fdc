<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * WidgetMovieFilmFilm
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class WidgetMovieFilmFilm
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     * @Groups({"classics"})
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="WidgetMovie", inversedBy="films")
     */
    private $widgetMovie;

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
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return WidgetMovieFilmFilm
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

    /**
     * Set widgetMovie
     *
     * @param \Base\CoreBundle\Entity\WidgetMovie $widgetMovie
     * @return WidgetMovieFilmFilm
     */
    public function setWidgetMovie(\Base\CoreBundle\Entity\WidgetMovie $widgetMovie = null)
    {
        $this->widgetMovie = $widgetMovie;

        return $this;
    }

    /**
     * Get widgetMovie
     *
     * @return \Base\CoreBundle\Entity\WidgetMovie 
     */
    public function getWidgetMovie()
    {
        return $this->widgetMovie;
    }
}
