<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgramEvent
 * @ORM\Table(name="mdf_conference_program_event")
 * @ORM\Entity
 */
class MdfConferenceProgramEvent
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     */
    protected $translations;

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
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection", mappedBy="programEvent", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $speakerCollections;

    /**
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection", mappedBy="conferenceProgramEvent")
     */
    protected $programEventCollection;

    /**
     * MdfContentTemplate constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->speakerCollections = new ArrayCollection();
        $this->programEventCollection = new ArrayCollection();
    }

    /**
     * @param MdfProgramSpeakerCollection $widgets
     *
     * @return $this
     */
    public function addSpeakerCollection(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection $widgets)
    {
        $widgets->setProgramEvent($this);
        $this->speakerCollections[] = $widgets;

        return $this;
    }

    /**
     * @param MdfProgramSpeakerCollection $widgets
     */
    public function removeSpeakerCollection(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection $widgets)
    {
        $this->speakerCollections->removeElement($widgets);
    }

    /**
     * @return ArrayCollection
     */
    public function getSpeakerCollections()
    {
        return $this->speakerCollections;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

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

    /**
     * @param MdfConferenceProgramEventCollection $programEventCollection
     * @return $this
     */
    public function addProgramEventCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection $programEventCollection)
    {
        $programEventCollection->setConferenceProgramEvent($this);
        $this->programEventCollection[] = $programEventCollection;

        return $this;
    }

    /**
     * @param MdfConferenceProgramEventCollection $programEventCollection
     */
    public function removeProgramEventCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventCollection $programEventCollection)
    {
        $this->programEventCollection->removeElement($programEventCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getProgramEventCollection()
    {
        return $this->programEventCollection;
    }
}

