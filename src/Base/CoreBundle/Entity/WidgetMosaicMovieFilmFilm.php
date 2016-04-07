<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * WidgetMosaicMovieFilmFilm
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class WidgetMosaicMovieFilmFilm
{
    use Time;
    use Translatable;

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
     * @Groups({"event_show"})
     */
    private $film;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleOriginal;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="WidgetMosaicMovie", inversedBy="films")
     */
    private $widgetMosaicMovie;

    /**
     * @var ArrayCollection
     *
     * @Groups({"live", "web_tv_show", "live"})
     * @Assert\Valid()
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * Set titleOriginal
     *
     * @param string $titleOriginal
     * @return WidgetMosaicMovieFilmFilm
     */
    public function setTitleOriginal($titleOriginal)
    {
        $this->titleOriginal = $titleOriginal;

        return $this;
    }

    /**
     * Get titleOriginal
     *
     * @return string 
     */
    public function getTitleOriginal()
    {
        return $this->titleOriginal;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return WidgetMosaicMovieFilmFilm
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set widgetMosaicMovie
     *
     * @param \Base\CoreBundle\Entity\WidgetMosaicMovie $widgetMosaicMovie
     * @return WidgetMosaicMovieFilmFilm
     */
    public function setWidgetMosaicMovie(\Base\CoreBundle\Entity\WidgetMosaicMovie $widgetMosaicMovie = null)
    {
        $this->widgetMosaicMovie = $widgetMosaicMovie;

        return $this;
    }

    /**
     * Get widgetMosaicMovie
     *
     * @return \Base\CoreBundle\Entity\WidgetMosaicMovie 
     */
    public function getWidgetMosaicMovie()
    {
        return $this->widgetMosaicMovie;
    }
}
