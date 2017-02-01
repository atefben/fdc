<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfSpeakersChoicesCollection
 *
 * @ORM\Table(name="mdf_speakers_choices_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfSpeakersChoicesCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoices", inversedBy="speakersChoicesCollection")
     * @Groups({"news_list", "search", "news_show", "event_show", "home"})
     * @Assert\Count(
     *      max = "4",
     *      maxMessage = "validation.speakers_widget_tab_max"
     * )
     * @ORM\JoinColumn(name="speakers_choice_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $speakersChoice;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakers", inversedBy="speakersChoicesCollections")
     * @ORM\JoinColumn(name="speakers_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $speakersPage;

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
    public function getSpeakersChoice()
    {
        return $this->speakersChoice;
    }

    /**
     * @param mixed $speakersChoices
     */
    public function setSpeakersChoice($speakersChoice)
    {
        $this->speakersChoice = $speakersChoice;
    }

    /**
     * @return mixed
     */
    public function getSpeakersPage()
    {
        return $this->speakersPage;
    }

    /**
     * @param mixed $speakersPage
     */
    public function setSpeakersPage($speakersPage)
    {
        $this->speakersPage = $speakersPage;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return GalleryMdfMedia
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

