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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection", mappedBy="programEvent", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $speakersCollections;

    /**
     * MdfContentTemplate constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @param MdfProgramSpeakerCollection $widgets
     *
     * @return $this
     */
    public function addSpeakersCollection(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection $widgets)
    {
        $widgets->setProgramEvent($this);
        $this->speakersCollections[] = $widgets;

        return $this;
    }

    /**
     * @param MdfProgramSpeakerCollection $widgets
     */
    public function removeSpeakersCollection(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection $widgets)
    {
        $this->speakersCollections->removeElement($widgets);
    }

    /**
     * @return ArrayCollection
     */
    public function getSpeakersCollections()
    {
        return $this->speakersCollections;
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
}
