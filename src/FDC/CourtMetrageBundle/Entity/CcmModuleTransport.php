<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleTransport
 * @ORM\Table(name="ccm_module_transport")
 * @ORM\Entity
 *
 */
class CcmModuleTransport extends CcmModule
{
    use Translatable;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HomeSliderTop constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}

