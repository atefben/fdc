<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * EventWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "EventWidgetText",
 *  "quote" = "EventWidgetQuote",
 *  "audio" = "EventWidgetAudio",
 *  "image" = "EventWidgetImage",
 *  "image_dual_align" = "EventWidgetImageDualAlign",
 *  "video" = "EventWidgetVideo",
 *  "video_youtube" = "EventWidgetVideoYoutube",
 * })
 */
abstract class EventWidget
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="events")
     */
    protected $events;

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"event_list", "event_show"})
     */
    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Set position
     *
     * @param integer $position
     * @return EventWidget
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

    /**
     * Set events
     *
     * @param \Base\CoreBundle\Entity\Event $events
     * @return EventWidget
     */
    public function setEvents(\Base\CoreBundle\Entity\Event $events = null)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * Get events
     *
     * @return \Base\CoreBundle\Entity\Event 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
