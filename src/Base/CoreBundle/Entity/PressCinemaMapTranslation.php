<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;

use Base\CoreBundle\Util\Time;

/**
 * PressCinemaMapTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaMapTranslation
{
    use Time;
    use Translation;
    use Seo;

}
