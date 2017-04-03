<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;

/**
 * MdfSpeakersDetailsCollection
 *
 * @ORM\Table(name="mdf_speakers_details_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfSpeakersDetailsCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetails", inversedBy="speakersDetailsCollection")
     * @ORM\JoinColumn(name="speakers_details_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $speakersDetails;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoices", inversedBy="speakersDetailsCollections")
     * @ORM\JoinColumn(name="speakers_choice_tab_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $speakersChoiceTab;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSpeakersDetails()
    {
        return $this->speakersDetails;
    }

    /**
     * @param mixed $speakersDetails
     */
    public function setSpeakersDetails($speakersDetails)
    {
        $this->speakersDetails = $speakersDetails;
    }

    /**
     * @return mixed
     */
    public function getSpeakersChoiceTab()
    {
        return $this->speakersChoiceTab;
    }

    /**
     * @param mixed $speakersChoiceTab
     */
    public function setSpeakersChoiceTab($speakersChoiceTab)
    {
        $this->speakersChoiceTab = $speakersChoiceTab;
    }

    /**
     * @param $position
     * @return $this
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
}

