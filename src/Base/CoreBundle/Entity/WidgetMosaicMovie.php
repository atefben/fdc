<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * WidgetMosaicMovie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class WidgetMosaicMovie
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var Media
     *
     * @ORM\OneToMany(targetEntity="WidgetMosaicMovieFilmFilm", mappedBy="widgetMosaicMovie", cascade={"persist"})
     * @Groups({"event_show"})
     */
    private $films;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function __toString()
    {
        if ($this->getId()) {
            return strval($this->getId());
        }

        return '';
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
     * Add films
     *
     * @param \Base\CoreBundle\Entity\WidgetMosaicMovieFilmFilm $films
     * @return WidgetMosaicMovie
     */
    public function addFilm(\Base\CoreBundle\Entity\WidgetMosaicMovieFilmFilm $films)
    {
        $films->setWidgetMosaicMovie($this);
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \Base\CoreBundle\Entity\WidgetMosaicMovieFilmFilm $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\WidgetMosaicMovieFilmFilm $films)
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
     * Set title
     *
     * @param string $title
     * @return WidgetMosaicMovie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
