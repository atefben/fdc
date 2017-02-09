<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomeSliderTopTranslation
 * @ORM\Table(name="ccm_homepage_translation")
 * @ORM\Entity
 */
class HomepageTranslation
{
    use Translation;
    use TranslationChanges;
}
