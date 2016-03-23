<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Seo;

/**
 * FDCPageParticipateTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateTranslation implements TranslateChildInterface
{
    use Time;
    use TranslateChild;
    use Translation;
    use Seo;

}
