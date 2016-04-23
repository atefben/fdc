<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;

/**
 * WidgetMovie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class WidgetMovie
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
     * @ORM\Column(type="string", length=255)
     */
    private $title;


    /**
     * @var Media
     *
     * @ORM\OneToMany(targetEntity="WidgetMovieFilmFilm", mappedBy="widgetMovie", cascade={"persist"})
     * @Groups({"classics"})
     */
    private $films;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->title) {
            return $this->title;
        }

        if ($this->getId()) {
            return 'Module liste de films #' . strval($this->getId());
        }

        return 'Module liste de films';
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
     * @param \Base\CoreBundle\Entity\WidgetMovieFilmFilm $films
     * @return WidgetMovie
     */
    public function addFilm(\Base\CoreBundle\Entity\WidgetMovieFilmFilm $films)
    {
        $films->setWidgetMovie($this);
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \Base\CoreBundle\Entity\WidgetMovieFilmFilm $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\WidgetMovieFilmFilm $films)
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}
