<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleFourColumns
 * @ORM\Table(name="ccm_module_four_columns")
 * @ORM\Entity
 *
 */
class CcmModuleFourColumns extends CcmModule
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

