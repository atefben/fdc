<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImage
 * @package Base\CoreBundle\Entity
 * @ORM\Table("fdcpage_la_selection_cannes_classics_widget_typeone_mi")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImage extends FDCPageLaSelectionCannesClassicsWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    protected $image;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }


    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return $this
     */
    public function setImage(MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }
}
