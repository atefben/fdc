<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * CcmGalleryTranslation
 *
 * @ORM\Table(name="ccm_gallery_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmGalleryTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;

    /**
     * Constructor
     */
    public function __construct()
    {
        
    }
}
