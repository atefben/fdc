<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * FDCPagePrepareWidgetPicto
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPagePrepareWidgetPicto extends FDCPagePrepareWidget
{

    use Translatable;


    /**
     * @var string
     *
     * @ORM\Column(name="press_guide_widget_picto_icon", type="string", nullable=true)
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
     * @return FDCPagePrepareWidgetPicto
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
