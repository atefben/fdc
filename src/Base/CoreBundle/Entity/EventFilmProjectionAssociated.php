<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * EventFilmProjectionAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventFilmProjectionAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="associatedProjections")
     */
    protected $event;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection")
     * @Groups({"event_show"})
     */
    protected $association;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position = 0;

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #' . $this->getId();
        }

        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set event
     *
     * @param \Base\CoreBundle\Entity\Event $event
     * @return EventFilmProjectionAssociated
     */
    public function setEvent(\Base\CoreBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Base\CoreBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $association
     * @return EventFilmProjectionAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmProjection $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmProjection
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return EventFilmProjectionAssociated
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
