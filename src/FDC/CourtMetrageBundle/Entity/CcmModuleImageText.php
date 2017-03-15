<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleImageText
 * @ORM\Table(name="ccm_module_image_text")
 * @ORM\Entity
 *
 */
class CcmModuleImageText extends CcmModule
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     */
    protected $image;

    /**
     * HomeSliderTop constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param CcmMediaImageSimple $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}

