<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmProsDescriptionDoubleColumn
 * @ORM\Table(name="ccm_pros_description_double_column")
 * @ORM\Entity
 */
class CcmProsDescriptionDoubleColumn extends CcmProsDescription
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

