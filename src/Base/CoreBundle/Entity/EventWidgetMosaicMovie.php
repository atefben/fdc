<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * EventWidgetMovie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetMosaicMovie extends EventWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="WidgetMosaicMovie")
     * @Groups({"event_show"})
     */
    private $widgetMosaicMovie;

    /**
     * Set widgetMosaicMovie
     *
     * @param \Base\CoreBundle\Entity\WidgetMosaicMovie $widgetMosaicMovie
     * @return EventWidgetMosaicMovie
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
}
