<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfGlobalEventsSchedule
 *
 * @ORM\Table(name="mdf_global_events_schedule")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfGlobalEventsSchedule
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var MdfTheme
     *
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfTheme")
     */
    private $theme;

    /**
     * @var \DateTime
     * @ORM\Column(name="start_time_event", type="datetime", nullable=true)
     */
    protected $startTimeEvent;

    /**
     * @var \DateTime
     * @ORM\Column(name="end_time_event", type="datetime", nullable=true)
     */
    protected $endTimeEvent;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getEventType();
        } else {
            $string = strval($this->getId());
        }

        return (string) $string;
    }

    public function getEventType()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getEventType();
        }

        return $string;
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return MdfTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param MdfTheme $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return \DateTime
     */
    public function getStartTimeEvent()
    {
        return $this->startTimeEvent;
    }

    /**
     * @param \DateTime $startTimeEvent
     */
    public function setStartTimeEvent($startTimeEvent)
    {
        $this->startTimeEvent = $startTimeEvent;
    }

    /**
     * @return \DateTime
     */
    public function getEndTimeEvent()
    {
        return $this->endTimeEvent;
    }

    /**
     * @param \DateTime $endTimeEvent
     */
    public function setEndTimeEvent($endTimeEvent)
    {
        $this->endTimeEvent = $endTimeEvent;
    }
}

