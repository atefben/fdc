<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     */
    protected $logo;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
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
     * @return CcmMediaImageSimple
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param CcmMediaImageSimple $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param CcmMediaImageSimple $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}

