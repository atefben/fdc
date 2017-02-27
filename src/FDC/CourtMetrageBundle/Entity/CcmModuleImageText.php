<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
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
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
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
     * @return MediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param MediaImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}

