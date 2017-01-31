<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.01.2017
 * Time: 11:06
 */

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * MdfConferenceProgramEventTranslation
 * @ORM\Table(name="mdf_conference_program_event_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfConferenceProgramEventTranslationRepository")
 */
class MdfConferenceProgramEventTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $eventPlace;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $eventAccessType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $speakersTitle;

    /**
     * @return string
     */
    public function getSpeakersTitle()
    {
        return $this->speakersTitle;
    }

    /**
     * @param $speakersTitle
     *
     * @return $this
     */
    public function setSpeakersTitle($speakersTitle)
    {
        $this->speakersTitle = $speakersTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * @param $subTitle
     *
     * @return $this
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getEventPlace()
    {
        return $this->eventPlace;
    }

    /**
     * @param $eventPlace
     *
     * @return $this
     */
    public function setEventPlace($eventPlace)
    {
        $this->eventPlace = $eventPlace;

        return $this;
    }

    /**
     * @return string
     */
    public function getEventAccessType()
    {
        return $this->eventAccessType;
    }

    /**
     * @param $eventAccessType
     *
     * @return $this
     */
    public function setEventAccessType($eventAccessType)
    {
        $this->eventAccessType = $eventAccessType;

        return $this;
    }
}
