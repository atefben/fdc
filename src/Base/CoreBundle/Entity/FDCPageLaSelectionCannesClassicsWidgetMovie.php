<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FDCPageLaSelectionCannesClassicsWidgetMovie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageLaSelectionCannesClassicsWidgetMovie extends FDCPageLaSelectionCannesClassicsWidget
{
    /**
     * @ORM\ManyToOne(targetEntity="WidgetMovie")
     * @Groups({"news_list", "news_show"})
     */
    private $widgetMovie;

    /**
     * Set widgetMovie
     *
     * @param \Base\CoreBundle\Entity\WidgetMovie $widgetMovie
     * @return FDCPageLaSelectionCannesClassicsWidgetMovie
     */
    public function setWidgetMovie(\Base\CoreBundle\Entity\WidgetMovie $widgetMovie = null)
    {
        $this->widgetMovie = $widgetMovie;

        return $this;
    }

    /**
     * Get widgetMovie
     *
     * @return \Base\CoreBundle\Entity\WidgetMovie 
     */
    public function getWidgetMovie()
    {
        return $this->widgetMovie;
    }
}
