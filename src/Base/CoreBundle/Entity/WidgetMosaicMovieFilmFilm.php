<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     * @Groups({"event_show"})
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"event_show"})
     */
    private $titleOriginal;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"event_show"})
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="WidgetMosaicMovie", inversedBy="films")
     */
    private $widgetMosaicMovie;

    /**
     * @var ArrayCollection
     *
     * @Groups({"event_show"})
     * @Assert\Valid()
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
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

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return WidgetMosaicMovieFilmFilm
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getImage()
    {
        return $this->image;
    }
}
