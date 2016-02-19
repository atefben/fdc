<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PressGuideWidgetPicto
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuideWidgetPicto extends PressGuideWidget
{

    use Translatable;


    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_picto_icon", type="string")
     */
    protected $picto;

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
     * Set picto
     *
     * @param string $picto
     * @return PressGuideWidgetPicto
     */
    public function setPicto($picto)
    {
        $this->picto = $picto;

        return $this;
    }

    /**
     * Get picto
     *
     * @return string 
     */
    public function getPicto()
    {
        return $this->picto;
    }
}
