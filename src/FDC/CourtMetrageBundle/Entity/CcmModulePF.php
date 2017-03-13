<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImageSimple;
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
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     */
    protected $logo;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
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
     * @return MediaImageSimple
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param MediaImageSimple $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return MediaImageSimple
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param MediaImageSimple $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}

