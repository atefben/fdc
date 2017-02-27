<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModulePF
 * @ORM\Table(name="ccm_module_pf")
 * @ORM\Entity
 *
 */
class CcmModulePF extends CcmModule
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
    protected $logo;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     */
    protected $photo;

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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param MediaImage $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return MediaImage
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param MediaImage $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}

