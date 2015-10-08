<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * EventNewsTag
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventNewsTag
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
     * @var News
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="tags")
     */
    protected $event;

    /**
     * @var NewsTag
     *
     * @ORM\ManyToOne(targetEntity="NewsTag")
     */
    protected $tag;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId() && $this->getTags()) {
            $translation = $this->getTags()->findTranslationByLocale('fr');
            if ($translation !== null) {
                return $translation->getName();
            }
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
     * Set tags
     *
     * @param \Base\CoreBundle\Entity\NewsTag $tags
     * @return NewsNewsTag
     */
    public function setTag(\Base\CoreBundle\Entity\NewsTag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tags
     *
     * @return \Base\CoreBundle\Entity\NewsTag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set event
     *
     * @param \Base\CoreBundle\Entity\Event $event
     * @return EventNewsTag
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
}
